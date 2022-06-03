<?php
session_start();
require_once "connect.php";

$login = $_POST["auth_login"];
$password = $_POST["auth_password"];

$_SESSION["hide_mode"] = ["", " hide"];

if ($login === '') {
    $_SESSION["error"] = 'mail1';
    header('Location: ../auth.php');
    die;
}
if ($password === '') {
    $_SESSION["error"] = 'mail1';
    header('Location: ../auth.php');
    die;
}
$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '$login' AND `password` = '$password'");
if (mysqli_num_rows($check_user) > 0) { // Проверка на соответствие введенных данных
    $user = mysqli_fetch_assoc($check_user); // массив полей, полученный в результате выполнения запроса
    $_SESSION['user'] = [
        "user_id" => $user['user_id'],
        "username" => $user['username'],
        "email" => $user['email'],
        "reg_date" => $user['reg_date']
    ];
    $_SESSION["error"] = "Успешно";
}
else{
    $_SESSION["error"] = 'Неверный логин или пароль';
}
header('Location: ../auth.php');


