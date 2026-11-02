<?php
$message = '';
$maxSize = 2 * 1024 * 1024; // 2 MB
$allowedExt  = ['jpg', 'jpeg', 'png', 'gif'];
$allowedMime = ['image/jpeg', 'image/png', 'image/gif'];
$uploadDir = __DIR__ . '/uploads/';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $message = "Upload error code: " . $file['error'];
    } elseif ($file['size'] > $maxSize) {
        $message = "File too large (max 2 MB).";
    } else {
        $ext  = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $mime = mime_content_type($file['tmp_name']);

        if (!in_array($ext, $allowedExt, true) || !in_array($mime, $allowedMime, true)) {
            $message = "Only JPG, PNG and GIF images are allowed.";
        } else {
            $newName = uniqid('img_', true) . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
                $message = "Uploaded successfully as $newName";
            } else {
                $message = "Failed to save the file. Check folder permissions.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Image Upload</title></head>
<body>
<h2>Upload Image</h2>
<p><?= htmlspecialchars($message) ?></p>
<form method="post" enctype="multipart/form-data">
  <input type="file" name="image" accept="image/*" required>
  <button type="submit">Upload</button>
</form>
</body></html>
