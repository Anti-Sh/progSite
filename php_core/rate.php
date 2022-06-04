<?
session_start();
require_once "connect.php";

$val = 0;
if(isset($_POST["decrement"])){
    $val = "- 1";
    $id = $_POST["decr_button"]; 
}
if(isset($_POST["increment"])){
    $val = "+ 1";
    $id = $_POST["incr_button"]; 
}
if(isset($_SESSION["user"])){
    $user_id = $_SESSION['user']['user_id'];
    $query_check = "SELECT * FROM `rating_history` WHERE `user_id`='$user_id' AND `editor_id`='$id'";
    $check = mysqli_query($connect, $query_check);
    if (mysqli_num_rows($check) > 0){
        header('Location: ../catalog.php');
        die;
    }
    $query_log = "INSERT INTO `rating_history`(`id`, `user_id`, `editor_id`) VALUES (NULL, '$user_id', '$id')";
    $query_update = "UPDATE `editors` SET user_rating=user_rating $val WHERE editor_id='$id'";
    mysqli_query($connect, $query_log);
    mysqli_query($connect, $query_update);

    header('Location: ../catalog.php');
}