<?php
require 'includes/db.inc.php';
set_time_limit(500);
$myfile = @fopen("telepulesek.txt", "r") or die("Unable to open file!");

while(!feof($myfile)) {
  $tempArray = explode("\t",fgets($myfile));
  $sql = "INSERT INTO `varosok` (`irsz`, `nev`) VALUES ('".$tempArray[0]."', '".$tempArray[1]."');";
  $conn->query($sql);
}

$sql = "SELECT `irsz`, `nev` FROM `varosok` ORDER BY `varosok`.`nev` ASC;";
?>
<table>
    <?php
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["nev"]." ".$row["irsz"]."</td></tr>";
            }
        }
    ?>
</table>