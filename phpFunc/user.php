<?php
function login($db, $userdata) {
    $sql =  
    "SELECT *
    FROM users
    WHERE email = ?
      AND password = SHA1(?)
   ";

    if ($stmt = mysqli_prepare($db, $sql)) {

        mysqli_stmt_bind_param($stmt, "ss",  $userdata["email"], $userdata["password"]);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            }
        }
    
    $user = mysqli_fetch_assoc($result);
    
    
    if ($user["archived"]==1){
        $error = "Account banned";
        return $error;
    }

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
"INSERT INTO `users`  (`name`,`email`,`password`) VALUES ( ? , ? , ? )
";

    if ($stmt = mysqli_prepare($db, $sql)) {
        $tmp =sha1($userdata["password"]);
        mysqli_stmt_bind_param($stmt, "sss",  $userdata["username"], $userdata["email"],$tmp);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            }
        }   


$_SESSION["msg"] = "<p class=\" text-success text-center\">Account succesfully created, you can now log in<p>";
header("Location: login.php");
exit;
}

function banuser($db, $usrid){

$sql = "UPDATE users
SET archived = 1
WHERE users.id = $usrid;

";
mysqli_query($db, $sql);
header("Location: admin.php");
}
function unbanuser($db, $usrid){

    $sql = "UPDATE users
    SET archived = 0
    WHERE users.id = $usrid;
    
    ";
    mysqli_query($db, $sql);
    header("Location: admin.php");
    }