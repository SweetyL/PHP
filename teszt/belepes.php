<?php
require 'db.inc.php';
require 'menu.inc.php';
require 'functions.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
				if(!empty($_SESSION["id"])){
						echo "üdv" .$_SESSION["nev"].'!';
						echo "<form action='belepes.php' method='post'><input type='submit' value='Kilépés' name='logout'></form>";		
				}
					else{
						if(isset($_POST['user'])){
							echo '<p class="error">'.$loginError.'</p>';
						}
					
				?>
				<form action="belepes.php" method="post">
					Felhasználó: <input type="text" name="user">
					Jelszó: <input type="password" name="pass">
					<input type="submit" value="Belépés">
				</form>
				<?php } ?>
</body>
</html>