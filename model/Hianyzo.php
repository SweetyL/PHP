<?php

require_once 'Kijeloltfelhasznalo.php';

class Hianyzo extends Kijeloltfelhasznalo {

    function __construct() {
        $this->tablaNev = 'hianyzok';
    }

    function remove_id($id,$conn){
        $sql = "DELETE FROM hianyzok WHERE id =$id";
        $result = $conn->query($sql);
    }
}
?>