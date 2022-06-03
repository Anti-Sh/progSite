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
    <title>Редактор.Ру  | Каталог</title>
</head>
<body class="catalog__body">
    <? require "php_modules/header.php" ?>
    <section>
        <h1 class="section__header">Приложения-редакторы</h1>
        <div class="catalog">
            <?
            require_once "php_core/connect.php";
            $id = -1;
            if (isset($_POST)){
                $id = $_POST["id"];
                $class = " selected";
            }
            $sql = "SELECT `editor_id`, `editor_name`, `img_name` FROM `editors`";
            $query = mysqli_query($connect, $sql);
            while( $row = mysqli_fetch_array($query)):?>
            <form action="catalog.php" method="post">
                <div class="catalog__item<? if ($id == $row[0]) { echo $class; }?>">
                    <div class="item__logo">
                        <img class="item__logo__inner" src="/src/img/catalog/<?=$row[2]?>" alt="">
                    </div>
                    <span class="item__name"><?=$row[1]?></span>
                    <div class="item__button__outer">
                        <button type="submit" class="item__button">Выбрать</button>
                    </div>
                    <input type="number" class="hide" value="<?=$row[0]?>" name="id">
                </div>
            </form>
            <? endwhile; ?>
        </div>
        <? 
        if (isset($_POST)):
            $sql = "SELECT * FROM editors e INNER JOIN makers m ON e.maker_id=m.maker_id INNER JOIN `fields` ON e.field_id=`fields`.`field_id` WHERE e.editor_id = '$id'";
            $query = mysqli_query($connect, $sql);
            while( $row = mysqli_fetch_assoc($query) ):
        ?>
        <div class="item__about">
            <h1 class="section__header"><?=$row["editor_name"]?></h1>
            <div class="item__about__outer">
                <div class="item__about__inner about__left">
                    <div class="item__about__img">
                        <img src="src/img/catalog/<?=$row["img_name"]?>" class="about__img__inner">
                    </div>
                    <div class="item__rating__label">Рейтинг</div>
                    <div class="item__rating__outer">
                        <button class="item__row">▼</button>
                        <div class="item__rating">
                            <span class="item__rating__number"><?=$row["user_rating"]?></span>
                            <div class="item__rating__inner"></div>
                        </div>
                        <button class="item__row">▲</button>
                    </div>
                </div>
                <div class="item__about__inner">
                    <div class="about__inner_child">
                        <h3 class="inner__child__header">Основные характеристики</h4>
                        <span class="inner__child__label">Производитель:</span>
                        <span class="inner__child__spec"><?=$row["maker_name"]?></span>
                        <br>
                        <span class="inner__child__label">Область применения:</span>
                        <span class="inner__child__spec"><?=$row["field_name"]?></span>
                        <br>
                        <span class="inner__child__label">Год релиза:</span>
                        <span class="inner__child__spec"><?=$row["release_year"]?></span>
                        <br>
                        <span class="inner__child__label">Наша оценка:</span>
                        <span class="inner__child__spec"><?=$row["our_mark"]?> / 10.0</span>
                        <br>
                        <span class="inner__child__label">Последняя версия:</span>
                        <span class="inner__child__spec"><?=$row["version"]?> (от <?=$row["version_date"]?>)</span>
                        <br>
                        <br>
                    </div>
                    <div class="about__inner_child">
                        <h3 class="inner__child__header">Описание</h3>
                        <p class="inner__child__description"><?=$row["description"]?></p>
                        <?
                            $status = " locked";
                            $url = "";
                            if (isset($_SESSION["user"])){
                                $status = "";
                                $url = $row["download_link"];
                            }
                        ?>
                        <a class="item__download__button<?=$status?>" href="<?=$url?>">Скачать</a>
                    </div>
                    
                </div>
            </div>
        </div>
        <? 
            endwhile; endif;
        ?>
    </section>
</body>
</html>