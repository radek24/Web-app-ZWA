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
?>