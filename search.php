<?php
session_start();
require("./phpFunc/utils.php");
require_once("phpFunc/DB_connect.php");
$output = "";



if (isset($_POST["searchval"])) {
    $param = "%{$_POST["searchval"]}%";

    if (!empty($_POST["srchbnd"])) {

        $sql_bands = '
        SELECT name as bnm, id as bid, photo
        FROM bands
        where name like ?
        order by name
        LIMIT 100;
        ';

        if ($stmt = mysqli_prepare($db, $sql_bands)) {

            mysqli_stmt_bind_param($stmt, "s", $param);
            if (mysqli_stmt_execute($stmt)) {
                $result_bands = mysqli_stmt_get_result($stmt);
            }
        }
        $bands = mysqli_fetch_all($result_bands, MYSQLI_ASSOC);
    } else {
        $bands = [];
    }

    if (!empty($_POST["srchalb"])) {
        $sql_albums = '
  SELECT albums.name as anm, albums.id as aid,cover,bands.name as bandname,albums.single as sngl
  FROM albums 
  JOIN bands
  on bands.id = albums.band_id
  where albums.name like ?
  order by albums.name
  LIMIT 100;
  ';
        if ($stmt = mysqli_prepare($db, $sql_albums)) {

            mysqli_stmt_bind_param($stmt, "s", $param);
            if (mysqli_stmt_execute($stmt)) {
                $result_albums = mysqli_stmt_get_result($stmt);
            }
        }
        $albums = mysqli_fetch_all($result_albums, MYSQLI_ASSOC);
    } else {
        $albums = [];
    }

    if (!empty($_POST["srchsng"])) {
        $sql_songs = '
SELECT songs.name as snm, albums.id as aid, albums.cover as cover, albums.name as albname
FROM songs
JOIN albums
ON albums.id = songs.album_id
where songs.name like ?
order by songs.name
LIMIT 100;

';
        if ($stmt = mysqli_prepare($db, $sql_songs)) {

            mysqli_stmt_bind_param($stmt, "s", $param);
            if (mysqli_stmt_execute($stmt)) {
                $result_songs = mysqli_stmt_get_result($stmt);
            }
        }

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
}
//require("./view/find.phtml");
