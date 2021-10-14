<?php
session_start();
require 'db.inc.php';
if(!empty($_SESSION["isLoggedin"])){
    $StringForLink = "Kilépés";
}
else{
    $StringForLink = "Belépés";
}
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
$activeNumber = 0;
if($curPageName=="index.php"){
    $activeNumber=0;
}elseif($curPageName=="ulesrend.php"){
    $activeNumber=1;
}elseif($curPageName=="chPass.php"){
    $activeNumber = 2;
}

$admins = array();
$sql2 = "SELECT id FROM admins";
	$result2 = $conn->query($sql2);
	if ($result2->num_rows > 0) {
		while($row = $result2->fetch_assoc()) {
			array_push($admins,$row["id"]);
		}
	}
if(isset($_POST['user']) and isset($_POST['pass'])){
    $loginError = '';
    if(strlen($_POST['user']) == 0){$loginError.='Nem írtál be felhasználót!<br>';}
    if(strlen($_POST['pass']) == 0){$loginError.='Nem írtál be jelszót!<br>';}
    if($loginError == ''){
        $sql = "SELECT id, jelszo, nev FROM `5/13ice` WHERE felhasznalonev = '".$_POST['user']."'";
        $result = $conn->query($sql);
        if($result){
            if ($result->num_rows > 0) {
                if($row = $result->fetch_assoc()) {
                    if(md5($_POST['pass']) == $row['jelszo']){
                        $_SESSION["id"] = $row['id'];
                        $_SESSION["nev"] = $row['nev'];
                        $_SESSION["user"] = $_POST['user'];
                        $_SESSION["isLoggedin"] = TRUE;
                        if(in_array($_SESSION["id"], $admins)){
                            $_SESSION["isAdmin"]=TRUE;
                        }
                        else {
                            $_SESSION["isAdmin"]=FALSE;
                        }
                        header("Refresh:0; url=ulesrend.php");
                        exit();
                    }else{
                        $loginError .= 'Érvénytelen jelszó<br>';
                    }
                }
            }
            else{$loginError .= 'Érvénytelen felhasználónév!';}
        }
        else{echo "Ne piszkáld az SQL-em!";}
    }
}elseif(isset($_POST['logout'])){
    $_SESSION["isLoggedin"] = FALSE;
    session_unset();
    header('Location: ./index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
    <?php
        if($activeNumber==0){
            echo'<li class="nav-item">
            <a class="nav-link active" href="index.php">Főoldal</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="ulesrend.php">Ülésrend</a>
            </li>';
            if(!empty($_SESSION["id"])){
                echo '<li class="nav-item"><a class="nav-link" href="chPass.php">Beállítások</a></li>';
                echo'<li><form method="post" action="menu.inc.php"><input type="submit" name="logout" value="'.$StringForLink.'"/></form>';
            }else{
                echo'<a href="belepes.php"><input type="submit" value="Belépés"/></a>';
            }
            echo '</li>';
        }elseif($activeNumber==1){
            echo'<li class="nav-item">
            <a class="nav-link" href="index.php">Főoldal</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="ulesrend.php">Ülésrend</a>
            </li>';
            if(!empty($_SESSION["id"])){
                echo '<li class="nav-item"><a class="nav-link" href="chPass.php">Beállítások</a></li>';
                echo'<li><form method="post" action="menu.inc.php"><input type="submit"  name="logout" value="'.$StringForLink.'"/></form>';
            }else{
                echo'<a href="belepes.php"><input type="submit" value="Belépés"/></a>';
            }
            echo '</li>';
        }elseif($activeNumber==2){
            echo'<li class="nav-item">
            <a class="nav-link" href="index.php">Főoldal</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="ulesrend.php">Ülésrend</a>
            </li>';
            if(!empty($_SESSION["id"])){
                echo '<li class="nav-item"><a class="nav-link active" href="chPass.php">Beállítások</a></li>';
                echo'<li><form method="post" action="menu.inc.php"><input type="submit"  name="logout" value="'.$StringForLink.'"/></form>';
            }else{
                echo'href="belepes.php"><input type="submit" value="Belépés"/></a>';
            }
            echo '</li>';
        }
    ?>
    <?php
    if(!empty($_SESSION["id"])){
        echo'<li class="nav-item"><p class="nav-link">Üdv'.$_SESSION['nev'].'</p></li>';
    }
    ?>
    </ul>
    </div>
</nav>
</body>
</html>