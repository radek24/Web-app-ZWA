<?php
require("./view/head.phtml");
require("./phpFunc/utils.php");
require("./phpFunc/counters.php");
require("./phpFunc/DB_connect.php");
?>
<style>
    body {
        background: url('Img/bckgrn.svg') no-repeat center center fixed ;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    footer{
        display: none;
    }
</style>
<div class="container pt-5">

    <h1 class="display-2 text-center" style="font-weight: bold; padding-top:10%">WELCOME TO RATER</h1>
    <p class="lead text-center">Browse and rate your favourite music! </p>
    <h2 class="pt-5 text-center"><a href="index.php">Login</a> to start rating <br><br> or just <a href="find.php">browse</a> <?php echo getallsongs($db) ?> songs </h2>

</div>

<?php
require("./view/footer.phtml");
?>