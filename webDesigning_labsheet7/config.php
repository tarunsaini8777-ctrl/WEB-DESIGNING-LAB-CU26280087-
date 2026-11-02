<?php
// ---- Database settings: edit for your server ----
const DB_HOST = 'localhost';
const DB_NAME = 'bookstore';
const DB_USER = 'root';
const DB_PASS = '';
const PER_PAGE = 8;           // books per page (pagination)

// ---- Secure session setup ----
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_httponly', '1');
session_set_cookie_params([
    'httponly' => true,
    'samesite' => 'Lax',
    'secure'   => !empty($_SERVER['HTTPS']),
]);
if (session_status() === PHP_SESSION_NONE) session_start();

// ---- PDO connection (prepared statements everywhere) ----
function db(): PDO {
    static $pdo = null;
    if (!$pdo) {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
    return $pdo;
}

// ---- Helpers ----
function e($s): string { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function redirect(string $url): never { header("Location: $url"); exit; }
function flash(string $msg, string $type = 'success'): void { $_SESSION['flash'][] = [$type, $msg]; }
function money($n): string { return '$' . number_format((float)$n, 2); }
function clean(string $s): string { return trim(strip_tags($s)); }          // input sanitization
function post(string $k): string { return clean($_POST[$k] ?? ''); }
function is_logged_in(): bool { return !empty($_SESSION['user']); }
function is_admin(): bool { return is_logged_in() && $_SESSION['user']['role'] === 'admin'; }
function require_login(): void {
    if (!is_logged_in()) { flash('Please log in first.', 'warning'); $_SESSION['after_login'] = $_SERVER['REQUEST_URI']; redirect(base() . 'login.php'); }
}
function require_admin(): void {
    if (!is_admin()) { http_response_code(403); flash('Admin access only.', 'danger'); redirect(base() . 'login.php'); }
}
// Web path to project root (works for /bookstore/ or / and for admin/ subfolder)
function base(): string {
    $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    if (basename($dir) === 'admin') $dir = dirname($dir);
    return rtrim($dir, '/') . '/';
}

// ---- CSRF protection ----
function csrf_token(): string {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
}
function csrf_field(): string { return '<input type="hidden" name="csrf" value="' . csrf_token() . '">'; }
function csrf_check(): void {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) { http_response_code(400); exit('Invalid CSRF token.'); }
    }
}

// ---- Book cover (falls back to an inline SVG placeholder) ----
function cover(?string $image, string $title = ''): string {
    if ($image && is_file(__DIR__ . '/uploads/' . $image)) return base() . 'uploads/' . rawurlencode($image);
    $t = htmlspecialchars(mb_substr($title, 0, 22), ENT_XML1);
    $hue = crc32($title) % 360;
    $svg = "<svg xmlns='http://www.w3.org/2000/svg' width='300' height='420'><rect width='300' height='420' fill='hsl($hue,45%,35%)'/>"
         . "<rect x='20' y='20' width='260' height='380' fill='none' stroke='white' stroke-opacity='.5'/>"
         . "<text x='150' y='210' fill='white' font-size='22' font-family='Georgia,serif' text-anchor='middle'>$t</text></svg>";
    return 'data:image/svg+xml;base64,' . base64_encode($svg);
}

// ---- Cart helpers ----
function cart_count(): int { return array_sum($_SESSION['cart'] ?? []); }

function stars(float $r): string {
    $out = ''; for ($i = 1; $i <= 5; $i++) $out .= $i <= round($r) ? '★' : '☆';
    return '<span class="stars">' . $out . '</span>';
}
