<?php

	require 'db.inc.php';
    require 'menu.inc.php';
    require 'functions.inc.php';

    if(!empty($_POST['nwUser']) or !empty($_POST['nwPass'])){
        $sqlGetUser ="SELECT id, nev, jelszo FROM `5/13ice` WHERE felhasznalonev = '".$_SESSION["user"]."'";
        $sqlRe = $conn->query($sqlGetUser);

        if($sqlRe){
            if ($sqlRe->num_rows > 0) {
                if($row = $sqlRe->fetch_assoc()) {
                    if(!empty($_POST['nwUser'])){
                        $sqlSetUsername = "UPDATE `5/13ice` SET `felhasznalonev` = '".$_POST["nwUser"]."' WHERE `5/13ice`.`id` = '".$_SESSION["id"]."'";
                        $conn->query($sqlSetUsername);
                        $_SESSION["user"] = $sqlSetUsername;
                    }
                    if(!empty($_POST['nwPass'])){
                        $sqlSetPass ="UPDATE `5/13ice` SET `jelszo` = md5('".$_POST["nwPass"]."') WHERE `5/13ice`.`id` = '".$_SESSION["id"]."'";
                        $conn->query($sqlSetPass);
                    }
                }
            }
            else{
                echo "ERROR: Nincs ilyen felhasználónév";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Jelszó változtató</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="chPass.php" method="post">
        <label for="nwUser">Új Felhasználónév:</label><input type="text" maxlength="100" name="nwUser"><br>
        <label for="nwPass">Új jelszó:</label><input type="password" name="nwPass">
        <br>
        <br>
        <input type="submit">
    </form>
    <a href="ulesrend.php">Vissza</a>
</body>
</html>