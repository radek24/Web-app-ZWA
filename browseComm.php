<?php
session_start();
require("./view/head.phtml");
require("./phpFunc/utils.php");
require("./phpFunc/DB_connect.php");
?>

<div class="container pt-5 ">

    <h1 class="display-2" style="font-weight: bold; padding-top:7%">BROWSE MOST COMMENTED ALBUMS</h1>
    <?php 
    $result = returnMostCommentedAlbums($db);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
       require("./view/browseCommAlbum.phtml");        
    }
    ?>


</div>


<?php
require("./view/footer.phtml");
?>