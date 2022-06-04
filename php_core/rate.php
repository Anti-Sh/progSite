<?
session_start(); // запуск сессии
require_once "connect.php"; // подключение к БД

$val = ""; // Значение по умолчанию 
if(isset($_POST["decrement"])){ // Если форма "уменьшение" отправлена
    $val = "- 1"; // Операция, которая будет производится
    $id = $_POST["decr_button"]; // ID редактора, рейтинг которого хотят изменить
}
if(isset($_POST["increment"])){ // Если форма "увеличение" отправлена
    $val = "+ 1"; // Операция, которая будет производится
    $id = $_POST["incr_button"]; // ID редактора, рейтинг которого хотят изменить
}
if(isset($_SESSION["user"])){ // Если пользователь существует
    $user_id = $_SESSION['user']['user_id']; // ID пользователя из СЕССИИ
    $query_check = "SELECT * FROM `rating_history` WHERE `user_id`='$user_id' AND `editor_id`='$id'"; // Запрос на проверку наличия голоса от конкректного пользователя конкретному редактору
    $check = mysqli_query($connect, $query_check); // Выполнение запроса
    if (mysqli_num_rows($check) > 0){ // Если запись имеется
        header('Location: ../catalog.php'); // Перенаправление назад
        die; // Конец выполнения программы
    }
    $query_log = "INSERT INTO `rating_history`(`id`, `user_id`, `editor_id`) VALUES (NULL, '$user_id', '$id')"; // Запись в таблицу действия пользователя
    $query_update = "UPDATE `editors` SET user_rating=user_rating $val WHERE editor_id='$id'"; // Изменение соответствующей колонки у редактора
    mysqli_query($connect, $query_log); // Выполнение запроса
    mysqli_query($connect, $query_update); // Выполнение запроса

    header('Location: ../catalog.php'); // Перенаправление назад
}