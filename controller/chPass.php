<?php
if(!empty($_POST['nwUser']) or !empty($_POST['nwPass'])){
        $sqlGetUser ="SELECT nev, felhasznalonev, jelszo FROM ulesrend WHERE id = '".$_SESSION["id"]."'";
        $sqlRe = $conn->query($sqlGetUser);

        if($sqlRe){
            if ($sqlRe->num_rows > 0) {
                if($row = $sqlRe->fetch_assoc()) {
                    if(!empty($_POST['nwUser'])){
                        $sqlSetUsername = "UPDATE ulesrend SET felhasznalonev = '".$_POST["nwUser"]."' WHERE ulesrend.id = '".$_SESSION["id"]."'";
                        $conn->query($sqlSetUsername);
                    }
                    if(!empty($_POST['nwPass'])){
                        $sqlSetPass ="UPDATE ulesrend SET jelszo = md5('".$_POST["nwPass"]."') WHERE ulesrend.id = '".$_SESSION["id"]."'";
                        $conn->query($sqlSetPass);
                    }
                }
            }
            else{
                echo "ERROR: Nincs ilyen felhasználónév";
            }
        }
     }
include 'view/chPass.php';
?>