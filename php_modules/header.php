<?
    session_start();
    $k = 0;
    $href = "auth.php";
    $id = "";
    if(isset($_SESSION["user"])){
        $k = 1;
        $href = "";
        $id = ' id="profile_text"';
    }
       
?>
<header>
    <img src="src/img/logo.png" class="menu__img inline">
    <nav>
        <div class="nav"><a href="index.php" class="nav__link">Главная</a></div>
        <div class="nav"><a href="catalog.php" class="nav__link">Каталог</a></div>
        <div class="nav profile__outer" id="prof__outer">
            <a href="<?=$href?>" class="nav__link"<?=$id?>>Профиль</a>
            <div class="profile hide" id="profile_div">
                <div class="profile__label">Имя пользователя</div>
                <div class="profile__param"><?=$_SESSION["user"]["username"]?></div>
                <div class="profile__label">Почта</div>
                <div class="profile__param"><?=$_SESSION["user"]["email"]?></div>
                <div class="profile__label">Дата регистрации</div>
                <div class="profile__param"><?=$_SESSION["user"]["reg_date"]?></div>
                <button type="button" id="hide__button" class="profile__button" onclick="closeProfile();">Cкрыть</button>
                <form action="/php_core/logout.php" method="POST">
                    <button type="submit" class="profile__button">Выход</button>
                </form>
            </div>
        </div>
    </nav>

    <script src="/src/js/script.js"></script>
</header>