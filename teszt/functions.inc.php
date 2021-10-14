<?php
function getStudents($conn){
		$sql = "SELECT * FROM `5/13ice`";
		$result = $conn->query($sql);
		return $result;
}
?>