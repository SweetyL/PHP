<?php

// form feldolgozása

if(!empty($_POST["hianyzo_id"])) {
	$sql = "INSERT INTO hianyzok VALUES(".$_POST["hianyzo_id"].")";
	$result = $conn->query($sql);
}
elseif(!empty($_GET['nem_hianyzo'])) {
	$sql = "DELETE FROM hianyzok WHERE id =".$_GET['nem_hianyzo'];
	$result = $conn->query($sql);	
}

$hianyzok = $hianyzo->hianyzokListaja($conn);

$adminok = $admin->adminokListaja($conn);

$en = 0;
if(!empty($_SESSION["id"])) $en = $_SESSION["id"];

$tanar = 17;
$tanuloIdk = $tanulo->tanulokListaja($conn);

include 'view/ulesrend.php';
?>