<?php
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome</title>
        <style>

        .btn {
            display: inline-block;
            padding: 15px 20px;
            text-decoration: none;
            font-size: 16px;
            /*font-weight: bold;*/
            border-radius: 20px;
            transition: background 0.7s ease;
            text-align: center;
        }

        .btn-logout {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-logout:hover {
            background-color: #0056b3;
        }

        .btn-delete {
            /*background-color: #dc3545;*/
            color:rgba(179, 0, 69, 0.8);
            /*border: none;*/
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        .btn-delete:hover {
            color:rgba(255, 21, 21, 0.74);
        }
        

    </style>
    </head>
    <body>
        <h1>Welcome</h1>
        <a href="logout.php" class="btn btn-logout">Abmelden</a>
        <a href="confirm-delete-account.php">Account löschen</a>
    </body>
</html>

