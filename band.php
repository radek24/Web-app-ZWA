    <?php
    session_start();
    require_once("phpFunc/DB_connect.php");
    $band = $_GET["band"];
    $sql = 'SELECT * FROM bands WHERE id = ?';
    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_band);
        $param_band = $band;
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    require("./view/band.phtml");
                }
            }
        }
    }

    ?>
