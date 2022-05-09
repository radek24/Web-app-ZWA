<?php
function returnsongs($db, $id)
{
    $sql = "
    SELECT *
    FROM songs
    WHERE album_id = $id
    ORDER BY songs.order;
    ";
    return mysqli_query($db, $sql);
}
function getColorFromID($id)
{
    srand($id);
    return rand(0, 355);
}

function secsToMins($t)
{
    return sprintf("%02d%s%02d", ($t / 60) % 60, ":", $t % 60);
}
function returnCoverPath($image)
{
    $path = "";
    if (empty($image)) {
        $path = "Img/Covers/DefaultCover.png";
    } else {
        $path = "Img/Covers/" . $image;
    }
    return $path;
}

function returnBandimgPath($image)
{
    $path = "";
    if (empty($image)) {
        $path = "Img/Bands/DefaultBand.png";
    } else {
        $path = "Img/Bands/" . $image;
    }
    return $path;
}

function saveRating($db, $rating, $userID, $songID)
{
    $sql2 = "
    SELECT *
    FROM `ratings`
    WHERE userid = $userID AND songid = $songID
    ";
    $result2 =  mysqli_query($db, $sql2);
    $isedit = mysqli_fetch_row($result2);

    if ($isedit == NULL) {

        $sql = "
    INSERT into `ratings` (`songid`,`userid`,`rating`)
    VALUES (' $songID ' , ' $userID ' , ' $rating ');
    ";
    } else {
        $sql = "
        UPDATE `ratings` 
        SET `rating` = $rating
        WHERE ratings.id = {$isedit[0]}
        ";
    }
    mysqli_query($db, $sql);
}
function returnAverageRating($db, $songID)
{
    $sql = "
SELECT AVG(rating) FROM `ratings` WHERE songid = $songID";

    $result =  mysqli_query($db, $sql);
    $temp = mysqli_fetch_row($result);

    if ($temp[0] == NULL) {
        return "No rating yet.";
    } else {
        $val = round(floatval($temp[0]) / 2.0, 2);

        $col = $val * 21;
        return "AVG Rating: <span style =\"color: hsl($col, 100%, 50%) \">{$val}</span> / 5";
    }
}
function returnAverageAlbumRating($db, $albumID)
{
    $sql = "SELECT AVG(rating) FROM ratings 
    JOIN songs 
    ON songs.id = ratings.songid
    WHERE songs.album_id = $albumID
    ";
    $result =  mysqli_query($db, $sql);
    $temp = mysqli_fetch_row($result);

    if ($temp[0] == NULL) {
        return "No rating yet.";
    } else {
        $val = round(floatval($temp[0]) / 2.0, 2);

        $col = $val * 21;
        return "<span style =\"color: hsl($col, 100%, 50%) \">{$val}</span> / 5";
    }
}

function tryFindRatingFromUser($db, $userID, $songID)
{
    $sql = "
    SELECT *
    FROM `ratings`
    WHERE userid = $userID AND songid = $songID
    ";
    $result =  mysqli_query($db, $sql);
    return mysqli_fetch_row($result);
}
function returnMostRatedAlbums($db)
{
    $sql = '
SELECT albums.name as albnm, count(ratings.rating) as rcount, albums.cover as albcvr, albums.single as singl,albums.band_id as bndid,albums.id as albid,albums.releaseyear as rls, bands.name as bndname
FROM albums
JOIN songs
ON songs.album_id = albums.id
JOIN ratings
ON songs.id = ratings.songid
JOIN bands
ON bands.id = albums.band_id 
GROUP BY albnm
ORDER BY COUNT(ratings.rating) DESC

';

    return  mysqli_query($db, $sql);
}
function returnBestRatedAlbums($db)
{
    $sql = '
    SELECT albums.name as albnm, count(ratings.rating) as rcount, albums.cover as albcvr, albums.single as singl,albums.band_id as bndid,albums.id as albid,albums.releaseyear as rls, bands.name as bndname
    FROM albums
    JOIN songs
    ON songs.album_id = albums.id
    JOIN ratings
    ON songs.id = ratings.songid
    JOIN bands
    ON bands.id = albums.band_id 
    GROUP BY albnm
    ORDER BY AVG(ratings.rating) DESC
    
    ';

    return  mysqli_query($db, $sql);
}

function returnMostCommentedAlbums($db)
{
    $sql = '
    SELECT albums.name as albnm, count(comments.id) as comcount, albums.cover as albcvr, albums.single as singl,albums.band_id as bndid,albums.id as albid,albums.releaseyear as rls, bands.name as bndname
    FROM albums
    JOIN comments
    ON albums.id = comments.albumid
    JOIN bands
    ON bands.id = albums.band_id 
    GROUP BY albnm
    ORDER BY COUNT(comments.id) DESC
    
    ';
    return  mysqli_query($db, $sql);
}
function addComment($db, $commentdata, $albumid)
{
    $hacker =  htmlspecialchars($commentdata["comment"], ENT_QUOTES, 'UTF-8');
    
    
    
    $sql =
    "INSERT INTO comments (albumid,userid,albumcomment)
VALUES ( ? , ? , ? )
";

    if ($stmt = mysqli_prepare($db, $sql)) {

        mysqli_stmt_bind_param($stmt, "sss",  $albumid, $commentdata["userid"],$hacker);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            }
        }

        
    header("Location: album.php?album=" . $albumid);
    exit;
}

function getComments($db, $albumID)
{
    $sql =
        "SELECT comments.albumcomment as comment, users.name as usrnm,comments.createdT as time,users.id as usrid, comments.id as cmid
    FROM comments
    JOIN users
    ON users.id = comments.userid
    WHERE albumid = $albumID
    ORDER BY time DESC
    ";
    return mysqli_query($db, $sql);
}

function getAllComments($db)
{
    $sql =
        "SELECT comments.albumcomment as comment, users.name as usrnm,comments.createdT as time,users.id as usrid, comments.id as cmid, albums.name as albnm, albums.id as albid
    FROM comments
    JOIN users
    ON users.id = comments.userid
    JOIN albums
    ON comments.albumid = albums.id
    ORDER BY time DESC
    ";
    return mysqli_query($db, $sql);
}


function deleteComments($db, $cmid, $albumid, $usrid, $admin)
{
    if ($admin == 0) {
        $sql =
        "DELETE FROM
        comments
        WHERE comments.id = ? AND comments.userid = ?
        ";
                if ($stmt = mysqli_prepare($db, $sql )) {
        
                    mysqli_stmt_bind_param($stmt, "si", $cmid,$usrid);
                    if (mysqli_stmt_execute($stmt)) {
                        $result_songs = mysqli_stmt_get_result($stmt);
                    }
                }
    } else {
        $sql =
            "DELETE FROM
    comments
    WHERE comments.id = $cmid
    ";
    mysqli_query($db, $sql);
    }
    
    header("Location: album.php?album=" . $albumid);
    exit;
}
function deleteCommentUnsafe($db, $cmid)
{
    $sql =
        "DELETE FROM
        comments
        WHERE comments.id = $cmid
        ";

    mysqli_query($db, $sql);
    header("Location: admin.php");
}


function getUsers($db)
{
    $sql =
        "SELECT users.name as name, users.email as email, users.admin as admin, users.archived as archived, users.id as id, COUNT(comments.id) as comms
    FROM users
    LEFT JOIN comments
    ON comments.userid = users.id
    GROUP BY users.id
    ";
    return mysqli_query($db, $sql);
}

function getuserRatings($db, $id)
{
    $sql =
        "SELECT COUNT(ratings.id) as rate  
    FROM ratings
    WHERE ratings.userid = $id";
    $result = mysqli_query($db, $sql);
    $tmp = mysqli_fetch_assoc($result);
    return $tmp["rate"];
}
