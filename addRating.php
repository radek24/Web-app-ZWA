<?php
session_start();
require("./phpFunc/utils.php");
require_once("phpFunc/DB_connect.php");
$output = "xd";


if (isset($_POST["rating"])) {
    saveRating($db,round(floatval($_POST["rating"])*2),$_POST["userid"],$_POST["songid"]);
    
}