<?php

require_once("phpFunc/DB_connect.php");
    require("./phpFunc/utils.php");

if(isset($_POST["comment"])){
            addComment($db,$_POST, $_POST["albid"]);
        }

