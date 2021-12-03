<?php

if($errors) {
  foreach ($errors as $error) {
    foreach ($error as $errorMsg) {
      echo "$errorMsg <br>";
    }
  }
}

?>
<table>
	<tr>
		<th colspan="3">
            <form action="index.php?page=chPass" method="post">
                <label for="nwUser">Új Felhasználónév:</label><input type="text" maxlength="100" name="nwUser"><br>
                <label for="nwPass">Új jelszó:</label><input type="password" name="nwPass">
                <br>
                <input type="submit" value="Küldés">
            </form>
            <br>
            <form action="index.php?page=chPass" method="post" enctype="multipart/form-data">
                <label for="fileToUpload">Töltsön fel egy profil képet!</label>
            <input type="file" name="fileToUpload" id="fileToUpload" multiple>
            <input type="submit" value="Upload Image" name="submit">
            </form>
        </th>
	</tr>
</table>