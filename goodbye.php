<?php
session_start();

// clearing cash so no going back
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");


$message = "Your account has been successfully deleted.";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Gelöscht</title>
</head>
<body>
    <h1>Goodbye!</h1>
    <p style="color: green;"><?= htmlspecialchars($message) ?></p>
    <a href="index.php">Back to Home</a>
</body>
</html>