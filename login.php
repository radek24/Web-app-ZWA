<?php
session_start();
require("./phpFunc/DB_connect.php");
require("./phpFunc/user.php");



if (isset($_POST["password"])) {
    $chyba = login($db, $_POST);
}

$titulek = "Rater - Login";
require("./view/head.phtml");
require("./view/login.phtml");
require("./view/footer.phtml");