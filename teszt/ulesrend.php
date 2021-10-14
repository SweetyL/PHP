<?php
	require 'db.inc.php';
	require 'menu.inc.php';
	require 'functions.inc.php';
	$tanar=22;

	//form feldolgozása
	if(!empty($_POST['hianyzo_id'])){
		$sql = "INSERT INTO `5/13ice_hianyzok` (id) VALUES (" .$_POST['hianyzo_id'] .")";
		$conn->query($sql);
			
	}
	elseif(!empty($_GET['nem_hianyzo'])){
		$sql ="DELETE FROM `5/13ice_hianyzok` WHERE id =".$_GET['nem_hianyzo'];
		$conn->query($sql);
	}
	$sql = "SELECT * FROM `5/13ice_hianyzok`";
	$result = $conn->query($sql);

	$hianyzok= array();

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			array_push($hianyzok,$row["id"]);
		}
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
</head>

<body>
	<table>
		<tr>
			<th colspan="6">Ülésrend
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
							echo $row["nev"];
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