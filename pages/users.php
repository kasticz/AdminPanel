<?php
 require_once '../config/connect.php';
 require_once '../funcs/formatting.php';

 $users = mysqli_query($connect,"SELECT * FROM users");

 $usersAssoc = [];

 for($i=0;$i<$users->num_rows;$i++){
    $usersAssoc[] = mysqli_fetch_assoc($users);
 }

 $titlesOfFields = array_keys($usersAssoc[0]);
 $numberOffields = count($usersAssoc[0]);











 mysqli_close($connect);





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
            <a href="createPageUser.php?mode=create"><button class="nav__create">Создать нового пользователя</button></a>
        </div>
    </nav>

    <main>
        <table class="content">
        <thead>
                <tr>
                <?php
                foreach($usersAssoc[0] as $title=>$value){
                    ?>
                    <th> <?=  $title ?></th>
                    <?php
                }                             
                ?>  
                <th>&#9998</th>  
                <th>&#10006</th> 
                </tr>
            </thead>
            <tbody>
                <?php
            foreach($usersAssoc as $user){
                    ?>
                    <tr>
                        <?php
                    for($i=0;$i<$numberOffields;$i++){
                        ?>
                        <td> <?=  $user[$titlesOfFields[$i]] ?></td>
                        <?php
                    } 
                    ?>
                        <td><a href="createPageUser.php?mode=edit&id=<?php echo $user['id'] ?>"> <button>&#9998</button> </a> </td>  
                        <td><a href="<?= '../db/delete.php?db=users&id=' . $user['id'] ?>"><button>&#10006</button> </a> </td> 
                    </tr>
                   
                    <?php
                }  
                ?>

            </tbody>
        </table>
    </main>
    
</body>
</html>