<?php
    session_start();
    require_once("phpFunc/DB_connect.php");
    require("./phpFunc/utils.php");
if (isset($_SESSION["user"])){
if(isset($_GET["deletecom"])){
        deleteComments($db,$_GET["deletecom"],$_SESSION["curralb"],$_SESSION["user"]["id"], $_SESSION["user"]["admin"]);
        exit;
    }


}
    
    
    $_SESSION["curralb"] = $_GET["album"];
    $band = $_GET["album"];
    $sql = 'SELECT DISTINCT albums.id as albid, albums.name as albname, COUNT(songs.id) as songCnt, bands.name,SUM(songs.lenght) as lenght,bands.id as bndid, albums.releaseyear as yr
	FROM albums
    JOIN songs
    ON albums.id = songs.album_id
    JOIN bands
    ON bands.id = albums.band_id
     WHERE albums.id = ?';
    
    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_band);
        $param_band = $band;
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    require("./view/album.phtml");
                }
            }
        }
        
    }
    
    if(isset($_POST["comment"])){
        addComment($db,$_POST, $_GET["album"]);
    }
