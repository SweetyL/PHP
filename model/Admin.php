<?php
require_once 'Kijeloltfelhasznalo.php';
class Admin extends Kijeloltfelhasznalo{

    function __construct() {
        $this->tablaNev = 'adminok';
    }
}
?>