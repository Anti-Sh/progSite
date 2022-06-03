<?php
session_start();
require_once "connect.php";

$login = $_POST["reg_login"];
$email = $_POST["reg_mail"];
$password1 = $_POST["reg_password1"];
$password2 = $_POST["reg_password2"];

$_SESSION["hide_mode"] = [" hide", ""];

if ($login === '') {
    $_SESSION["error"] = 'Логин не введен';
    header('Location: ../auth.php');
    die;
}
if ($email === '') {
    $_SESSION["error"] = 'Почта не введена';
    header('Location: ../auth.php');
    die;
}
if ($password1 === '') {
    $_SESSION["error"] = 'Пароль не введен';
    header('Location: ../auth.php');
    die;
}
if ($password2 === '') {
    $_SESSION["error"] = 'Подтверждение пароля не введено';
    header('Location: ../auth.php');
    die;
}
if ($password1 !== $password2) {
    $_SESSION["error"] = 'Пароли не совпадают';
    header('Location: ../auth.php');
    die;
}

$check_user = mysqli_query($connect, "SELECT `user_id` FROM `users` WHERE `username` = '$login' OR `email` = '$email'");
if (mysqli_num_rows($check_user) > 0) { // Проверка на соответствие введенных данных
    $_SESSION["error"] = 'Аккаунт с таким логином или почтой существует';
    header('Location: ../auth.php');
    die;
}
$date = date("Y-m-d");
mysqli_query($connect, "INSERT INTO `users`(`user_id`, `username`, `email`, `password`, `reg_date`) VALUES (NULL, '$login', '$email', '$password1', '$date')");
$_SESSION["hide_mode"] = ["", " hide"];

header('Location: ../auth.php');


