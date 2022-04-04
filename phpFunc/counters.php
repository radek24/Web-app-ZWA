<?php
function getAlbums($db,$id){
    $sql = "SELECT COUNT(albums.id) FROM bands INNER JOIN albums ON albums.band_id = bands.id WHERE bands.id =  $id ";
    $result = mysqli_query($db, $sql);
    return mysqli_fetch_assoc($result)["COUNT(albums.id)"];
}
function getSongsNum($db,$id){
    $sql = "SELECT COUNT(songs.id) FROM bands 
    JOIN albums 
    ON albums.band_id = bands.id 
    JOIN songs
    ON albums.id = songs.album_id
    WHERE bands.id =  $id ";
    $result = mysqli_query($db, $sql);
    return mysqli_fetch_assoc($result)["COUNT(songs.id)"];
}
function GetRandomSongs($db,$album_id){
    $sql ="SELECT songs.name as nm
    FROM songs
    JOIN albums
    ON albums.id = songs.album_id
    WHERE albums.id = $album_id
    ";
    $result = mysqli_query($db, $sql);
    $tmp =mysqli_fetch_all($result,MYSQLI_ASSOC);
    $songs = array_column($tmp, 'nm');
    shuffle($songs);
    return array_slice($songs,0,3);
}
function getallsongs($db){
    $sql = "SELECT COUNT(songs.id) FROM bands 
    JOIN albums 
    ON albums.band_id = bands.id 
    JOIN songs
    ON albums.id = songs.album_id;";
    $result = mysqli_query($db, $sql);
    return mysqli_fetch_assoc($result)["COUNT(songs.id)"];
}

?>