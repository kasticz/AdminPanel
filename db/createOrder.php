
<?php
require_once '../funcs/validations.php';
require_once '../config/connect.php';

    
    $order = $_POST;
    $editMode = array_key_exists("editMode",$order);
    $id = array_key_exists("id",$order) ? $order["id"] : null;
    $uID = validateUserID($order["userID"],$connect);
    $c = validateProductsIDs($order["orderContent"],$connect);





    if($uID[0] && $c[0] ){
        if($editMode && $id){
            mysqli_query($connect,"UPDATE `orders` SET `order_content` = '$c[1]',`user_id`='$uID[1]' WHERE `id` = '$id'");
            echo "Заказ успешно изменен <br>";
        }else{
            mysqli_query($connect,"INSERT INTO `orders` (`order_content`,`user_id`) VALUES ('$c[1]','$uID[1]')");
            echo 'Заказ успешно создан <br/>';
        }

    }else{
        if(!$uID[0]){
            echo $uID[1] . "<br>";
        }
        if(!$c[0]){
            echo $c[1] . "<br>";
        }
        echo "<a href='javascript:history.go(-1)'>Вернуться назад</a> <br>";
    }

    echo "<a href='../index.php'>Вернуться на главную</a>";
    
    mysqli_close($connect);
?>