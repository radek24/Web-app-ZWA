<?php
session_start();
require("./phpFunc/DB_connect.php");
require("./phpFunc/user.php");


$chyba ="";
if (isset($_POST["password"])) {
    $chyba = login($db, $_POST);
}

$titulek = "Rater - Login";
require("./view/head.phtml");
if (isset($_SESSION["user"])) {
    echo '<div class="container pt-5 ">

    <h1 class="display-2 text-center" style="font-weight: bold; padding-top:7%">You are already logged in </h1>
</div>
';
}else{
    require("./view/login.phtml");
    
}
require("./view/footer.phtml");
