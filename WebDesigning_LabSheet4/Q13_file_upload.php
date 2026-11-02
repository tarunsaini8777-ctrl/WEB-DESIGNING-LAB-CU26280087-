<?php
/**
 * Lab Sheet 4 - Question 13: Write a PHP script that handles file uploads ($_FILES), validates file size and extension, and stores images in an Apache server directory.
 */
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file       = $_FILES['image'];
    $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
    $maxSize    = 2 * 1024 * 1024; // 2 MB
    $uploadDir  = __DIR__ . '/uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $message = "Upload error code: " . $file['error'];
    } elseif (!in_array($ext, $allowedExt, true)) {
        $message = "Invalid file type. Allowed: " . implode(', ', $allowedExt);
    } elseif ($file['size'] > $maxSize) {
        $message = "File too large. Maximum size is 2 MB.";
    } elseif (!getimagesize($file['tmp_name'])) {
        $message = "File is not a valid image.";
    } else {
        $newName = uniqid('img_', true) . '.' . $ext;   // avoid name clashes / path tricks
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
            $message = "Uploaded successfully: uploads/" . htmlspecialchars($newName);
        } else {
            $message = "Failed to move uploaded file.";
        }
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Image Upload</title></head>
<body style="font-family:Arial;margin:30px">
<h2>Upload Image</h2>
<form method="post" enctype="multipart/form-data">
  <input type="file" name="image" accept="image/*" required>
  <button type="submit">Upload</button>
</form>
<p><?= $message ?></p>
</body></html>
