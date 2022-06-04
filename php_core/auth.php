<?php
session_start(); // Запуск сессии 
require_once "connect.php"; // Подключение к БД

$login = $_POST["auth_login"]; // введенный пользователем логин
$password = $_POST["auth_password"]; // введенный пользователем пароль

$_SESSION["hide_mode"] = ["", " hide"];

if ($login === '') { // Если логин не введен
    $_SESSION["error"] = 'Вы не ввели логин!';
    header('Location: ../auth.php'); // Перенаправление на страницу авторизации
    die;
}
if ($password === '') { // Если пароль не введен
    $_SESSION["error"] = 'Вы не ввели пароль!';
    header('Location: ../auth.php'); // Перенаправление на страницу авторизации
    die;
}
$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '$login' AND `password` = '$password'");
if (mysqli_num_rows($check_user) > 0) { // Проверка на соответствие введенных данных
    $user = mysqli_fetch_assoc($check_user); // массив полей, полученный в результате выполнения запроса
    $_SESSION['user'] = [ // Запись пользовательских данных в сессию
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
header('Location: ../auth.php'); // Перенаправление на страницу авторизации


