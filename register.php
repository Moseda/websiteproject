<!doctype html>
<html lang="de" dir="ltr">
    <head>
        <meta charset="utf-8" dir="ltr">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account erstellen</title>
    </head>
    <body>
        <?php
        session_start();
        if (isset($_POST["submit"])){
            require("mysql.php");
            $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); // check if user name is used
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

                    // Second aproach to display test in index.php
                    $_SESSION['message'] = "Ihr Account wurde erfolgreich erstellt";
                    header("Location: index.php");
                    exit();
                    //echo '<div style="color: green;">Ihr Account wurde erfolgreich erstellt. Sie können jetzt einlogen</div>';
                } else {
                    echo '<div style="color: red;">Passwörter stimmen nicht überein</div>';
                } 
                }else {
                    echo '<div style="color: red;">Username ist bereits vergeben</div>';
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