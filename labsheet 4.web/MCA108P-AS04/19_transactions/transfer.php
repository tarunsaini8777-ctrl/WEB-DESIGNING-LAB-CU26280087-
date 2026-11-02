<?php
require __DIR__ . '/../config/db.php';
$pdo = getConnection();

function transfer(PDO $pdo, int $from, int $to, float $amount): string {
    try {
        $pdo->beginTransaction();

        $check = $pdo->prepare("SELECT balance FROM accounts WHERE id = :id FOR UPDATE");
        $check->execute([':id' => $from]);
        $balance = $check->fetchColumn();

        if ($balance === false) throw new Exception("Sender account not found.");
        if ($balance < $amount) throw new Exception("Insufficient funds.");

        $pdo->prepare("UPDATE accounts SET balance = balance - :a WHERE id = :id")
            ->execute([':a' => $amount, ':id' => $from]);
        $pdo->prepare("UPDATE accounts SET balance = balance + :a WHERE id = :id")
            ->execute([':a' => $amount, ':id' => $to]);
        $pdo->prepare("INSERT INTO transfer_log (from_id, to_id, amount) VALUES (:f, :t, :a)")
            ->execute([':f' => $from, ':t' => $to, ':a' => $amount]);

        $pdo->commit();
        return "Transfer committed.";
    } catch (Exception $e) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        return "Rolled back: " . $e->getMessage();
    }
}

// Seed demo accounts if empty
if ($pdo->query("SELECT COUNT(*) FROM accounts")->fetchColumn() == 0) {
    $pdo->exec("INSERT INTO accounts (holder, balance) VALUES ('Alice', 1000), ('Bob', 500)");
}

echo transfer($pdo, 1, 2, 200) . "<br>";     // succeeds
echo transfer($pdo, 1, 2, 99999) . "<br>";   // fails -> rollback

echo "<h3>Balances</h3>";
foreach ($pdo->query("SELECT * FROM accounts") as $a) {
    echo htmlspecialchars($a['holder']) . ": " . $a['balance'] . "<br>";
}
