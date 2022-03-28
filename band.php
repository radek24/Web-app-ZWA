<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require_once("phpFunc/DB_connect.php");
    $band = $_GET["band"];
    $sql = 'SELECT * FROM bands WHERE name = ?';
    if($stmt = mysqli_prepare($db, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_band);
        $param_band = $band;
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    require("./view/band.phtml");
                }
            }
        }
    }
    /*
    $hacker = '<script>alert("hacking")</script>';
    echo $hacker;
    $hacker_denied = htmlspecialchars($hacker);
    echo $hacker_denied;
    */

    ?>
</body>
</html>