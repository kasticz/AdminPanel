<?php
 require_once '../config/connect.php';
 require_once '../funcs/formatting.php';
$mode = $_GET["mode"];
$editItem = null;
$id = null;
if($mode === 'edit'){
    $id = $_GET["id"];
    $item = mysqli_query($connect,"SELECT * FROM `orders` WHERE `id` = '$id'");
    $item = mysqli_fetch_assoc($item);
    $item["order_content"] = formatOrderContent($item["order_content"],$connect,true);
    $editItem = $item;      
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
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

    <main>
    <form class="create" action="../db/createOrder.php" method="POST">
    <input value="<?= isset($editItem) ?>" name="editMode" type="hidden">
    <input value="<?= isset($id) ? $id : '' ?>" name="id" type="hidden">
        <div class="create__inputWrapper">
                <label for="userID">ID пользователя</label>
                <input value="<?= $editItem ? $editItem['user_id'] : ''  ?>" id="userID" name="userID" min=1 required type="number">
        </div>
        <div class="create__inputWrapper">
                <label for="orderContent">Содержимое заказа(формат - "id товара - количество товара","id товара - количество товара",...)</label>
                <input value="<?= $editItem ? $editItem['order_content'] : ''  ?>" id="orderContent"  name="orderContent" required type="text">
        </div>
        <button class="create__createButton"><?= $editItem ? "Редактировать заказ" :  "Создать заказ" ?></button>
        </form>
    </main>
    
</body>
</html>