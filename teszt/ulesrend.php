<?php
	session_start();

	require 'db.inc.php';

	$tanar=22;
	$admins = array();
	$sql2 = "SELECT id FROM admins";
	$result2 = $conn->query($sql2);
	if ($result2->num_rows > 0) {
		while($row = $result2->fetch_assoc()) {
			array_push($admins,$row["id"]);
		}
	}

	//form feldolgozása
	if(!empty($_POST['hianyzo_id'])){
		$sql = "INSERT INTO `5/13ice_hianyzok` (id) VALUES (" .$_POST['hianyzo_id'] .")";
		$conn->query($sql);
			
	}
	elseif(!empty($_GET['nem_hianyzo'])){
		$sql ="DELETE FROM `5/13ice_hianyzok` WHERE id =".$_GET['nem_hianyzo'];
		$conn->query($sql);
	}elseif(isset($_POST['user']) and isset($_POST['pass'])){
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
							if(in_array($_SESSION["id"], $admins)){
								$_SESSION["isAdmin"]=TRUE;
							}
							else {
								$_SESSION["isAdmin"]=FALSE;
							}
						}else{
							$loginError .= 'Érvénytelen jelszó<br>';
						}
					}
				}
				else{$loginError .= 'Érvénytelen felhasználónév!';}
			}
			else{echo "Ne piszkáld az SQL-em!";}
		}
	}
	elseif(isset($_POST['logout'])){
		session_unset();
	}

	$sql = "SELECT * FROM `5/13ice_hianyzok`";
	$result = $conn->query($sql);

	$hianyzok= array();

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			array_push($hianyzok,$row["id"]);
		}
	}
	
	function getStudents($conn){
		$sql = "SELECT * FROM `5/13ice`";
		$result = $conn->query($sql);
		return $result;
	}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
	<meta charset="utf-8">
	<Title>Ülésrend</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<table>
		<tr>
			<th colspan="3">
				<?php
					if(!empty($_SESSION["id"])){
						echo "üdv" .$_SESSION["nev"].'!';
						echo "<form action='ulesrend.php' method='post'><input type='submit' value='Kilépés' name='logout'></form>";		
				}
					else{
						if(isset($_POST['user'])){
							echo $loginError;
						}
					
				?>
				<form action="ulesrend.php" method="post">
					Felhasználó: <input type="text" name="user">
					Jelszó: <input type="password" name="pass">
					<input type="submit" value="Belépés">
				</form>
				<?php } ?>
			</th>
			<th colspan="3">Ülésrend
				<?php
					if(!empty($_SESSION["id"]) and $_SESSION["isAdmin"]==TRUE){
							echo '<form action="ulesrend.php" method="post">';
							echo "Hiányzó: <select name='hianyzo_id'>";
							$result=getStudents($conn);
							if ($result->num_rows > 0) {
								
								while($row = $result->fetch_assoc()) {
									if($row["nev"] and !in_array($row["id"], $hianyzok)){
										echo '<option value='.$row["id"].'>'.$row["nev"].'</option>';
									}
								}
							}
						
							
					echo'</select><br>';
					echo'<input type="submit">';
				echo'</form>';
						}
				?>
			</th>
		</tr>
		<?php
				$result=getStudents($conn);
				if ($result->num_rows > 0) {
					$sor=0;
					while($row = $result->fetch_assoc()) {
						if($row["sor"] != $sor){
							if($sor != 0){
								echo '</tr>';
							}
							echo '<tr>';
							$sor = $row["sor"];
						}
						if(!$row["nev"]) echo "<td>";
						else{
							$plusz='';
							if(in_array($row["id"],$hianyzok)) $plusz.=  ' class="missing"';

							if(!empty($_SESSION["id"]) and $row["id"] == $_SESSION["id"]) $plusz.= ' id="me"';
							
							if($row["id"] == $tanar) $plusz.=  ' id="tanar" colspan="2"';
							echo "<td".$plusz." >";
						}
						if(!empty($_SESSION["id"]) and $row["id"] == $_SESSION["id"]){
							echo '<a href="chPass.php">'.$row["nev"].'</a>';
						}else{
							echo $row["nev"];
						}
						if(in_array($row["id"],$hianyzok) and !empty($_SESSION["id"]) and $_SESSION["isAdmin"]==TRUE) echo '<br><a href="ulesrend.php?nem_hianyzo='.$row['id'].'">Nem hiányzó</a>';
						echo "</td>";
					}
				} else {
					echo "0 results";
				}

				$conn->close();

			?>
	</table>

</body>

</html>