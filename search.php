<?php
require("./phpFunc/utils.php");
require_once("phpFunc/DB_connect.php");
$output = "";

if (isset($_POST["searchval"])) {
    if (!empty($_POST["srchbnd"])) {
        $sql_bands = '
SELECT name as bnm, id as bid, photo
FROM bands
where name like "%' . $_POST["searchval"] . '%"
order by name
LIMIT 100;
';
        $result_bands = mysqli_query($db, $sql_bands);
        $bands = mysqli_fetch_all($result_bands, MYSQLI_ASSOC);
    } else {
        $bands = [];
    }
    if (!empty($_POST["srchalb"])) {
        $sql_albums = '
  SELECT name as anm, id as aid,cover
  FROM albums
  where name like "%' . $_POST["searchval"] . '%"
  order by name
  LIMIT 100;
  ';
        $result_albums = mysqli_query($db, $sql_albums);
        $albums = mysqli_fetch_all($result_albums, MYSQLI_ASSOC);
    } else {
        $albums = [];
    }

    if (!empty($_POST["srchsng"])) {
        $sql_songs = '
SELECT songs.name as snm, albums.id as aid, albums.cover as cover
FROM songs
JOIN albums
ON albums.id = songs.album_id
where songs.name like "%' . $_POST["searchval"] . '%"
order by songs.name
LIMIT 100;

';
        $result_songs = mysqli_query($db, $sql_songs);
        $songs = mysqli_fetch_all($result_songs, MYSQLI_ASSOC);
    } else {
        $songs = [];
    }
}


if (isset($_POST["searchval"])) {
    foreach ($bands  as $find_var) {
        require("./view/FindCards/bandCard.phtml");
    }
    foreach ($albums  as $find_var) {
        require("./view/FindCards/albumCard.phtml");
    }
    foreach ($songs  as $find_var) {
        require("./view/FindCards/songCard.phtml");
    }
    if (empty($bands) && empty($albums) && empty($songs)) {

        echo "<h1 class=\"pt-5\">We didn't find anything, maybe try something else?</h1>";
    }
} else {

    echo "<h1 class=\"pt-5\">Type something and we will try to find it!</h1>";
}
//require("./view/find.phtml");
