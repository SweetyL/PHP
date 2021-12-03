<?php
$errors = array();
//kép feltöltés
if(isset($_FILES["fileToUpload"])) {
    $target_dir = "uploads/";
    $allowed_filetypes = array('image/png', 'image/jpg','image/jpeg');
    $name = basename($_FILES["fileToUpload"]["name"]);
    $extension = substr(strrchr($name, '.'), 1);
    $target_file = $target_dir . $_SESSION["id"] . "." . $extension;
  
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