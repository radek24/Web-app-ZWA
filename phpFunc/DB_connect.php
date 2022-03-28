<?php
$DBserver = "localhost";
$DBuser = "root";
$DBpassword = "";
$DBname = "rater";

$db = mysqli_connect($DBserver, $DBuser, $DBpassword, $DBname);
mysqli_set_charset($db, "utf8");



?>