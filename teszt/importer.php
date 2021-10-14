<?php
	require 'db.inc.php'; 

    $osztaly = array(
	array("Kulhanek László","Bakcsányi Dominik","Füstös Lóránt","Orosz Zsolt","Harsányi László",NULL),
	array("Molnár Gergő","Juhász Levente","Szabó László","Sütő Dániel","Détári Klaudia",NULL),
	array("Keresztúri Kevin",NULL,NULL,NULL,NULL,NULL),
	array("Fazekas Miklós",NULL,"Gombos János","Bicsák József",NULL,NULL)
);

	
	foreach($osztaly as $oSor => $tomb){
		foreach($tomb as $oOszlop => $tanulo){
			$sql = "INSERT INTO `5/13ice` (nev, sor, oszlop) VALUES (' $tanulo ' ,  ($oSor+1) ,  ($oOszlop+1) )";

			if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			}
	
		}
	}
?>