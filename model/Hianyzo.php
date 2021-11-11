<?php
require_once 'Kijeloltfelhasznalo.php';
class Hianyzo extends Kijeloltfelhasznalo {

    function __construct() {
        $this->tablaNev = 'hianyzok';
    }
}
?>