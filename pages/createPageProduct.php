
<?php
 require_once '../config/connect.php';
 require_once '../funcs/formatting.php';
$mode = $_GET["mode"];


$editItem = null;
$id = null;
if($mode === 'edit'){
    $id = $_GET["id"];
    $item = mysqli_query($connect,"SELECT * FROM `products` WHERE `id` = '$id'");
    $item = mysqli_fetch_assoc($item);
    $item["specials"] = formatSpecials($item["specials"],true);
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
        <form class="create" action="../db/createProduct.php" method="POST">
            <input value="<?= isset($editItem) ?>" name="editMode" type="hidden">
            <input value="<?= isset($id) ? $id : '' ?>" name="id" type="hidden">
        <div class="create__inputWrapper">
                <label for="title">Название</label>
                <input value="<?= $editItem ? $editItem['title'] : ''  ?>" id="title" name="title" required type="text">
        </div>
        <div class="create__inputWrapper">
                <label for="price">Цена</label>
                <input value="<?= $editItem ? $editItem['price'] : ''  ?>" id="price" step=0.01 min=0 name="price" required type="number">
        </div>
        <div class="create__inputWrapper">
                <label for="manufacturer">Производитель</label>
                <input value="<?=  $editItem ? $editItem['manufacturer'] : ''  ?>" id="manufacturer" required name="manufacturer" type="manufacturer">
        </div>
        <div class="create__inputWrapper">
                <label for="purchasable">В продаже</label>
                <input <?=$editItem ? 'checked' : ''?> id="purchasable" name="purchasable" type="checkbox">
        </div>
        <div class="create__inputWrapper">
                <label for="discount">Скидка</label>
                <input value="<?= $editItem ? $editItem['discount'] : ''  ?>"  required min=0 max = 100 name="discount" type="number">
        </div>
        <div class="create__inputWrapper">
                <label for="overview">Описание</label>
                <textarea   rows=10 id="overview" required name="overview"><?= $editItem ? $editItem['overview'] : ''  ?></textarea>
        </div>
        <div class="create__inputWrapper">
                <label for="quantity">Количество</label>
                <input value="<?= $editItem ? $editItem['quantity'] : ''  ?>"  id="quantity" required name="quantity" min=0 type="number">
        </div>
        <div class="create__inputWrapper">
                <label for="productType">Тип товара</label>
                <input value="<?= $editItem ? $editItem['productType'] : ''  ?>"  id="productType" required name="productType"  type="type">
        </div>
        <div class="create__inputWrapper">
                <label for="specials">Особенности(формат - "тип особенности - значение,тип особенности - значение...")</label>
                <input value="<?= $editItem ? $editItem['specials'] : ''  ?>" id="specials" required name="specials" type="text">
        </div>
        <button class="create__createButton"><?= $editItem ? "Редактировать товар" :  "Создать товар" ?></button>
        </form>
    </main>
    
</body>
</html>