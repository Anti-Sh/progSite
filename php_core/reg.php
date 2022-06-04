<?php
session_start(); // начало сессии
require_once "connect.php"; // подключение к БД

$login = $_POST["reg_login"]; // логин, полученный после отправки формы
$email = $_POST["reg_mail"]; // почта, полученная после отправки формы
$password1 = $_POST["reg_password1"]; // пароль, полученный после отправки формы
$password2 = $_POST["reg_password2"]; // подтверждение пароля, полученное после отправки формы

$_SESSION["hide_mode"] = [" hide", ""]; // запись в сессию видимости нужного блока

if ($login === '') { // Если логин не введен
    $_SESSION["error"] = 'Логин не введен'; // Запись ошибки в сессию
    header('Location: ../auth.php'); // Перенаправление на страницу авторизации
    die;
}
if ($email === '') { // Если почта не введена
    $_SESSION["error"] = 'Почта не введена'; // Запись ошибки в сессию
    header('Location: ../auth.php'); // Перенаправление на страницу авторизации
    die;
}
if ($password1 === '') { // Если пароль не введен
    $_SESSION["error"] = 'Пароль не введен'; // Запись ошибки в сессию
    header('Location: ../auth.php'); // Перенаправление на страницу авторизации
    die;
}
if ($password2 === '') { // Если пароль2 не введен
    $_SESSION["error"] = 'Подтверждение пароля не введено'; // Запись ошибки в сессию
    header('Location: ../auth.php'); // Перенаправление на страницу авторизации
    die;
}
if ($password1 !== $password2) { // Если пароли не совпадают
    $_SESSION["error"] = 'Пароли не совпадают'; // Запись ошибки в сессию
    header('Location: ../auth.php'); // Перенаправление на страницу авторизации
    die;
}

$check_user = mysqli_query($connect, "SELECT `user_id` FROM `users` WHERE `username` = '$login' OR `email` = '$email'");
if (mysqli_num_rows($check_user) > 0) { // Проверка на соответствие введенных данных
    $_SESSION["error"] = 'Аккаунт с таким логином или почтой существует';
    header('Location: ../auth.php'); // Перенаправление на страницу авторизации
    die;
}
$date = date("Y-m-d"); // Текущая дата
mysqli_query($connect, "INSERT INTO `users`(`user_id`, `username`, `email`, `password`, `reg_date`) VALUES (NULL, '$login', '$email', '$password1', '$date')");
$_SESSION["hide_mode"] = ["", " hide"];

header('Location: ../auth.php'); // Перенаправление на страницу авторизации 