<?php
session_start();
?>
<!doctype html>
<html lang="de" dir="ltr">
    <head>
        <meta charset="utf-8" dir="ltr">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>
    <body>

        <?php 
        if (isset($_SESSION['message'])): ?>            
            <div style="color: green;"><?= htmlspecialchars($_SESSION['message']) ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div style="color: red;"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <?php
            if(isset($_POST["submit"])){
                require("mysql.php");
                $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
                $stmt-> bindParam(":user", $_POST["username"]); //SQL INJECTION PROTECTION
                $stmt->execute();
                $count = $stmt->rowCount();
                if($count == 1){
                    $row = $stmt->fetch();
                    if(password_verify($_POST["pw"], $row["PASSWORD"])){
                        //session_start();// better at the start
                        $_SESSION["username"] = $row["USERNAME"];
                        header("Location: geheim.php");
                    } else {
                        $_SESSION['error'] = "Anmeldung fehlgeschlagen";
                        header("Location: index.php");
                        exit();
                        //echo '<div style="color: red;">Anmeldung fehlgeschlagen</div>'; // keep the other method for now
                    }
                } else {
                    $_SESSION['error'] = "Anmeldung fehlgeschlagen";
                    header("Location: index.php");
                    exit();
                    //echo '<div style="color: red;">Anmeldung fehlgeschlagen</div>';
                }    
            }
        ?>
    
        <h1>Anmelden</h1>
        <form action="index.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="pw" placeholder="Passwort" required><br>
        <button type="submit" name="submit">Einloggen</button>
        </form>
        <br>
        <a href="register.php">Noch keinen Account?</a>
    </body>
</html>
