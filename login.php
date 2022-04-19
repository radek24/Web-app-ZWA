<?php
session_start();
require("./phpFunc/DB_connect.php.php");
require("./phpFunc/user.php");

if (isset($_POST["password"])) {
    $chyba = login($db, $_POST);
}

$titulek = "Rater - Login";
require("./view/login.phtml");