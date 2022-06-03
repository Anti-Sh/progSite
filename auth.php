<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/css/style.css">
    <title>Редактор.Ру</title>
</head>
<body>
    <? 
        require "php_modules/header.php"; 
        if (isset($_SESSION["user"])) header('Location: ../index.php');
        echo $_SESSION["user"];
    ?>
    <section class="auth__page">
        <div class="auth__block">
            <div class="auth__page<?=$_SESSION["hide_mode"][0]?>" id="auth__page">
                <form action="/php_core/auth.php" method="post">
                    <div class="auth__header">Авторизация</div>
                    <div class="auth__input__label">Логин</div>
                    <input class="auth__input" type="text" name="auth_login" id="auth_login">
                    <div class="auth__input__label">Пароль</div>
                    <input class="auth__input" type="password" name="auth_password" id="auth_password">
                    <div class="auth__description">У вас нет аккаунта? <br> <span onclick="switchScreen(0);" class="auth__link">Нажмите, чтобы зарегистрироваться</span></div>    
                    <button type="submit" class="auth__button">Вход</button>
                    <? if ($_SESSION["error"]): ?>
                        <div class="auth__error"><?=$_SESSION["error"]?></div>
                    <? 
                        endif; 
                    ?>
                </form>
            </div>
            <?
                $mode = isset($_SESSION["hide_mode"][1]) ? $_SESSION["hide_mode"][1] : " hide"
            ?>
            <div class="reg__page<?=$mode?>" id="reg__page">
                <form action="php_core/reg.php" method="post">
                    <div class="auth__header">Регистрация</div>
                    <div class="auth__input__label">Логин</div>
                    <input class="auth__input" type="text" name="reg_login" id="reg_login">
                    <div class="auth__input__label">Почта</div>
                    <input class="auth__input" type="email" name="reg_mail" id="reg_mail">
                    <div class="auth__input__label">Пароль</div>
                    <input class="auth__input" minlength="4" maxlength="30" type="password" name="reg_password1" id="reg_password1">
                    <div class="auth__input__label">Подтверждение пароля</div>
                    <input class="auth__input" minlength="4" maxlength="30" type="password" name="reg_password2" id="reg_password2">
                    <div class="auth__description">У вас есть аккаунт? <br> <span onclick="switchScreen(1);" class="auth__link">Нажмите, чтобы войти</span></div>    
                    <button type="submit" class="auth__button">Регистрация</button>
                    <? if ($_SESSION["error"]): ?>
                        <div class="auth__error"><?=$_SESSION["error"]?></div>
                    <? 
                        unset($_SESSION["error"]);
                        endif; 
                    ?>
                </form>
            </div>
        </div>  
    </section>
    <script src="/src/js/script.js"></script>
</body>
</html>