<?php
require 'model/Admin.php';
$tanuloIdk = $tanulo->tanulokListaja($conn);
$errors = array();
$admin = new Admin();
$adminok = $admin->lista($conn);
//kép feltöltés
if(isset($_FILES["fileToUpload"])) {
    if(isset($_POST["selUser"])){
        $sql = "SELECT id, nev, sor, oszlop, jelszo, felhasznalonev FROM ulesrend  WHERE id = '".$_POST["selUser"]."'";
        $result = $conn->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $id = $row["id"];
            }
        } 
    }else{
        $id = $_SESSION["id"];
    }
    if(file_exists($id.".jpg")){
        unlink("uploads/".$id.".jpg");
    }else if(file_exists($id.".jpeg")){
        unlink("uploads/".$id.".jpeg");
    }else if(file_exists($id.".png")){
        unlink("uploads/".$id.".png");
    }
    $target_dir = "uploads/";
    $allowed_filetypes = array('image/png', 'image/jpg','image/jpeg');
    $name = basename($_FILES["fileToUpload"]["name"]);
    $extension = substr(strrchr($name, '.'), 1);
    $target_file = $target_dir . $id . "." . $extension;
  
      if ($_FILES["fileToUpload"]["size"] > 102400) {
        $errors[$key][] = "A $name túl nagy méretű, 100KB-nál nem lehet nagyobb";
      }
      elseif ($_FILES["fileToUpload"]["size"] < 1024) {
        $errors[$key][] = "A $name túl kis méretű, 1KB-nál nem lehet kisebb";
      }
  
      if (!in_array($_FILES["fileToUpload"]["type"], $allowed_filetypes) ) {
        $errors[$key][] = "A $name file nem jpg vagy png.";
      }
  
      if(!isset($errors[$key])) {
        if (!(@move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))) {
            $errors[$key][] = "Hiba történt a $name file mentésekor."; // felhasználónak  
        }
      }
    }
//jelszó és felhasználó
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