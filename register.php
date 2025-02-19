<!doctype html>
<html lang="de" dir="ltr">
    <head>
        <meta charset="utf-8" dir="ltr">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account erstellen</title>
    </head>
    <body>
        <?php
        if (isset($_POST["submit"])){
            require("mysql.php");
            $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); // username püfen
            $stmt->bindParam(":user", $_POST["username"]);
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count == 0){
                if($_POST["pw"] == $_POST["pw2"]){
                    $stmt = $mysql->prepare("INSERT INTO accounts(USERNAME, PASSWORD) VALUES (:user, :pw)");
                    $stmt->bindParam(":user", $_POST["username"]);
                    $phash = password_hash($_POST["pw"], PASSWORD_BCRYPT); // Hashen
                    $stmt->bindParam(":pw", $phash);
                    $stmt->execute();
                    echo "Ihr Account wurde erfolgreich erstellt";
                } else {
                    echo "Passwörter stimmen nicht überein";
                } 
                }else {
                    echo "Username ist bereits vergeben";
            }
        }
        ?>
        <h1>Account erstellen</h1>
        <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="pw" placeholder="Passwort" required><br>
        <input type="password" name="pw2" placeholder="Passwort wiederholen" required><br>
        <button type="submit" name="submit">Erstellen</button>
        </form>
        <br>
        <a href="index.php">Hast du bereits einen Account?</a>
    </body>
</html>