<?
session_start(); // запуск сессии
session_destroy(); // удаление всех переменных сессии

header('Location: ../index.php'); // перенаправление на главную страницу