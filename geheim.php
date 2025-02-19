<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>geheim</title>
    </head>
    <body>
        <h1>Secret</h1>
        <a href="logout.php">Abmelden</a>
    </body>
</html>