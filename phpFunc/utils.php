<?php
function returnsongs($db, $id){
    $sql ="
    SELECT *
    FROM songs
    WHERE album_id = $id
    ORDER BY songs.order;
    ";
    return mysqli_query($db, $sql);

}
function getColorFromID($id){
    srand($id);
    return rand(0,355);
}

function secsToMins($t){
    return sprintf("%02d%s%02d", ($t/60)%60, ":", $t%60);
}
function returnCoverPath($image){
    $path="";
    if (empty($image)){
        $path = "Img/Covers/DefaultCover.png";
    }else{
        $path = "Img/Covers/".$image;
    }
return $path;
}

function returnBandimgPath($image){
    $path="";
    if (empty($image)){
        $path = "Img/Bands/DefaultBand.png";
    }else{
        $path = "Img/Bands/".$image;
    }
return $path;
}

function saveRating($db, $rating, $userID,$songID){ 
    $sql2 = "
    SELECT *
    FROM `ratings`
    WHERE userid = $userID AND songid = $songID
    ";
    $result2 =  mysqli_query($db,$sql2);
    $isedit = mysqli_fetch_row($result2);

    if($isedit == NULL){
    
    $sql = "
    INSERT into `ratings` (`songid`,`userid`,`rating`)
    VALUES (' $songID ' , ' $userID ' , ' $rating ');
    ";
    }else{
        $sql = "
        UPDATE `ratings` 
        SET `rating` = $rating
        WHERE ratings.id = {$isedit[0]}
        ";
    }
    mysqli_query($db,$sql);


}
function returnAverageRating($db,$songID){
$sql ="
SELECT AVG(rating) FROM `ratings` WHERE songid = $songID";

$result =  mysqli_query($db,$sql);
$temp = mysqli_fetch_row( $result);

if ($temp[0] == NULL){
return "No rating yet.";
}
else{
    $val = round(floatval($temp[0])/2.0,2);

    $col = $val*21;
   return "AVG Rating: <span style =\"color: hsl($col, 100%, 50%) \">{$val}</span> / 5"; 
}
}
function returnAverageAlbumRating($db,$albumID){
    $sql = "SELECT AVG(rating) FROM ratings 
    JOIN songs 
    ON songs.id = ratings.songid
    WHERE songs.album_id = $albumID
    ";
    $result =  mysqli_query($db,$sql);
    $temp = mysqli_fetch_row( $result);
    
    if ($temp[0] == NULL){
    return "No rating yet.";
    }
    else{
        $val = round(floatval($temp[0])/2.0,2);
    
        $col = $val*21;
       return "<span style =\"color: hsl($col, 100%, 50%) \">{$val}</span> / 5"; 
    }
    }

function tryFindRatingFromUser($db, $userID,$songID){
$sql = "
    SELECT *
    FROM `ratings`
    WHERE userid = $userID AND songid = $songID
    ";
   $result =  mysqli_query($db,$sql);
    return mysqli_fetch_row( $result);
}

?>