<?php
function addBand($db,$BandInfo,$file){
    $sql = "
    INSERT INTO bands
    (name, info, photo)
    VALUES
    ('{$BandInfo["name"]}', \"{$BandInfo["info"]}\", '{$file}')
";

mysqli_query($db, $sql);
header("Location: admin.php");
}
