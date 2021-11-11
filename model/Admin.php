<?php

require 'includes/db.inc.php';
require 'Kijeloltfelhasznalo.php';

class Admin extends Kijeloltfelhasznalo{

    function __construct() {
        $this->tablaNev = 'adminok';
    }
}
?>