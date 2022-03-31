<?php
require("./phpFunc/admin_upload.php");
require("./phpFunc/DB_connect.php");
if (isset($_FILES["photo"])) {
  if (isset($_POST["name"])) {
    $adresarSeSoubory = "Img/Bands";
    
    move_uploaded_file($_FILES["photo"]["tmp_name"], $adresarSeSoubory . "/" . $_FILES["photo"]["name"]);
  }
  addBand($db,$_POST,$_FILES["photo"]["name"]);
}
?>


<?php

require("./view/head.phtml");
require("./view/admin.phtml");
require("./view/footer.phtml");
?>