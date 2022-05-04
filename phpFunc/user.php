<?php
function login($db, $userdata) {
    $sql = 
    "SELECT *
     FROM users
     WHERE email = '{$userdata["email"]}' 
       AND password = '" . sha1($userdata["password"]) . "'
    ";

    $result = mysqli_query($db, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) { 
        $_SESSION["user"] = $user;
        header("Location: index.php");
        exit;
    }
    else
    {
        $error = "Login unsuccesfull";
        return $error;
    }

}
function logoff(){
    unset($_SESSION["user"]);
    header("Location: index.php");
    exit;
}
function create_account($db, $userdata){
$sql = 
"INSERT INTO `users`  (`name`,`email`,`password`) VALUES ('{$userdata["username"]}','{$userdata["email"]}', '" . sha1($userdata["password"]) . "')
";

mysqli_query($db, $sql);
header("Location: index.php");
exit;

}