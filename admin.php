<?php
session_start();

if (isset($_SESSION["user"]) && $_SESSION["user"]["admin"] == 1) {
  
  
  
  
  
  
  require("./phpFunc/admin_upload.php");
  require("./phpFunc/DB_connect.php");
  require("./phpFunc/utils.php");
  require("./phpFunc/user.php");

  if(isset($_GET["banusr"])){
    banuser($db,$_GET["banusr"]);
    exit;
}

if(isset($_GET["unbanusr"])){
  unbanuser($db,$_GET["unbanusr"]);
  exit;
}

  if (isset($_FILES["photo"])) {
    if (isset($_POST["name"])) {
      $adresarSeSoubory = "Img/Bands";
      
      move_uploaded_file($_FILES["photo"]["tmp_name"], $adresarSeSoubory . "/" . $_FILES["photo"]["name"]);
    }
    addBand($db,$_POST,$_FILES["photo"]["name"]);
  }
  
  
  
  
  require("./view/head.phtml");
  require("./view/admin.phtml");
  require("./view/footer.phtml");
}else{
  echo "<h1>NOT ENOUGH PERMISSON</h1>";
}
