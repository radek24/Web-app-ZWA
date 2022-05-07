<?php
session_start();
require("./view/head.phtml");
require("./phpFunc/utils.php");
require("./phpFunc/DB_connect.php");
?>

<div class="container pt-5 ">

    <h1 class="display-2" style="font-weight: bold; padding-top:7%">BROWSE MOST RATED ALBUMS</h1>
    <?php 
    $result = returnMostRatedAlbums($db);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
       require("./view/browseAlbum.phtml");        
    }
    ?>


</div>


<?php
require("./view/footer.phtml");
?>