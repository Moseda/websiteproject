<!doctype html>
<html lang="de" dir="ltr">
    <head>
        <meta charset="utf-8" dir="ltr">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>
    <body>
        <?php
            if(isset($_POST["submit"])){
                require("mysql.php");
                $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
                $stmt-> bindParam(":user", $_POST["username"]);
                $stmt->execute();
                $count = $stmt->rowCount();
                if($count == 1){
                    $row = $stmt->fetch();
                    if(password_verify($_POST["pw"], $row["PASSWORD"])){
                        session_start();
                        $_SESSION["username"] = $row["USERNAME"];
                        header("Location: geheim.php");
                    } else {
                        echo "Anmeldung fehlgeschlagen";
                    }
                } else {
                    echo "Anmeldung fehlgeschlagen";
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
