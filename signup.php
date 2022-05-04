<?php
session_start();
require("./phpFunc/DB_connect.php");
require("./phpFunc/user.php");



if (isset($_POST["password"])) {
    $chyba = create_account($db, $_POST);
}

$titulek = "Rater - Sign Up";
require("./view/head.phtml");
require("./view/signup.phtml");
require("./view/footer.phtml");