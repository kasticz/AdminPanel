<?php
require_once '../config/connect.php';
require_once '../funcs/search.php';
    $s = $_POST['input'];
    $result = searchDbs($s,$connect);
    mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/index.css">
    <title>Document</title>
</head>
<body>
<nav class="nav">
        <a href="/" class="nav__title">
            <img src="../assets/h1icon.svg" alt="">
            <h1>Административная панель</h1>
        </a>
        <div class="nav__separator"></div>
        <div class="nav__admin">
            <img src="../assets/avatar.svg" alt="">
            <div>Иван Иванов</div>
        </div>
        <div class="nav__separator"></div>
        <div class="nav__search">
            <img src="../assets/search.svg" alt="">
            <input class="nav__search">
            <button>Найти</button>
        </div>
        <div class="nav__separator"></div>
        <div class="nav__content">
            <div class="dbsTitle">
                Базы данных
            </div>
            <ul class="nav__dbs">
                <li><a href="../index.php"> <button class="nav__categoryButton">Товары</button> </a> </li>
                <li> <a href="users.php"> <button class="nav__categoryButton">Пользователи</button> </a></li>
                <li><a href="orders.php"><button class="nav__categoryButton">Заказы</button></a></li>
            </ul>
        </div>
    </nav>
    <main class="search">
        <?php
        for($i=0;$i<count($result);$i++){       
            ?>
            <div class="search__item">
                <?php
                foreach($result[$i] as $key=>$value){
                    if($key === 'overview'){
                        continue;
                    }
                    ?>
                    <div class="search__itemField <?="search__".$key?>">
                    <h4><?= $key ?></h4>
                    <p><?= $value ?></p>
                    </div>
                    <?php
                }
                
                if($result[$i]["overview"]){
                    ?>
                     <div class="search__itemField search__overview">
                     <h4><?= "overview" ?></h4>
                     <p><?= $result[$i]["overview"] ?></p>
                </div>
                     <?php
                }
                $id = $result[$i]["id"];
                $type = $result[$i]["item_type"] === 'products' ? "createPageProduct.php" : "createPageUser.php";
                ?>
                <a href=<?= $type . "?id=$id&mode=edit" ?>><button>Редактировать</button></a>
                <a href=<?= "../db/delete.php?db=" . $result[$i]["item_type"] ."&id=$id" ?>><button>Удалить</button></a>
                
            </div>
            <?php
        }
        ?>
    </main>    
</body>
</html>