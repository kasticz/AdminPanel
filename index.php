<?php
 require_once 'config/connect.php';

 $products = mysqli_query($connect,"SELECT * FROM products WHERE id = 1");

 $products = mysqli_fetch_assoc($products);









?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/index.css">
    <title>Document</title>
</head>
<body>


    <nav class="nav">
        <a href="/" class="nav__title">
            <img src="./assets/h1icon.svg" alt="">
            <h1>Административная панель</h1>
        </a>
        <div class="nav__separator"></div>
        <div class="nav__admin">
            <img src="./assets/avatar.svg" alt="">
            <div>Иван Иванов</div>
        </div>
        <div class="nav__separator"></div>
        <div class="nav__search">
            <img src="./assets/search.svg" alt="">
            <input class="nav__search">
            <button>Найти</button>
        </div>
        <div class="nav__separator"></div>
        <div class="nav__content">
            <div class="dbsTitle">
                Базы данных
            </div>
            <ul class="nav__dbs">
                <li><button class="nav__categoryButton">Товары</button> </li>
                <li> <button class="nav__categoryButton">Пользователи</button></li>
                <li><button class="nav__categoryButton">Заказы</button></li>
            </ul>
        </div>
    </nav>

    <main>
        <table class="content">
            <tr>
                <?php
                foreach($products as $title=>$value){
                    ?>
                    <th> <?=  $title ?></th>
                    <?php
                }

                ?>  
            </tr>


        </table>

    </main>
    
</body>
</html>