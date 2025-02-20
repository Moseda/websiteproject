--not needed for now

<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account löschen bestätigen</title>
</head>
<body>
    <h1>Account löschen bestätigen</h1>
    <p>Are you sure you want to delete your account? This action cannot be undone.</p>
    <form action="delete-account.php" method="get">
        <button type="submit">Yes, delete my account</button>
        <a href="geheim.php">Cancel</a>
    </form>
</body>
</html>