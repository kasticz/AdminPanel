
<?php
require_once '../funcs/validations.php';
require_once '../config/connect.php';

    $product = $_POST;
    $t = trim($product["title"]);
    $p = number_format($product["price"],2);
    $m = trim($product["manufacturer"]);
    $pr = array_key_exists("purchasable",$product);
    $d = $product["discount"];
    $o = trim($product["overview"]);
    $q = $product["quantity"];
    $type = trim($product["productType"]);
    $specialsValid = strpos(trim($product["specials"]),"-") ;
    $p = $product["price"];
    $editMode = array_key_exists("editMode",$product);
    $id = array_key_exists("id",$product) ? $product["id"] : null;

    if($specialsValid && $t && $m && $o && $type){
        $specials = makeSpecials($product["specials"]);
        
        if($editMode && $id){
        mysqli_query($connect,"UPDATE `products` SET `title` = '$t', `price`='$p',`manufacturer`='$m',`purchasable`='$pr',`discount`='$d',`overview`='$o',`quantity`='$q',`specials`='$specials',`productType`='$type' WHERE `id` = '$id'");
            echo "Товар успешно изменен <br>";
        }else{
        mysqli_query($connect,"INSERT INTO `products` (`title`,`price`,`manufacturer`,`purchasable`,`discount`,`overview`,`quantity`,`specials`,`productType`) VALUES ('$t','$p','$m',
        '$pr','$d','$o','$q','$specials','$type')");
        echo 'Товар успешно создан <br/>';
        }

        
    }else{
        if(!$specialsValid){
            echo 'В поле "особенности" допускаются только буквы латинского алфавита, цифры и специальные символы <br>';
        }
        if(!$t){
            echo 'Название не должно быть пустым <br/>';
        }
        if(!$m){
            echo 'Производитель не должен быть пустым <br/>';
        }
        if(!$o){
            echo 'Описание не должно быть пустым <br/>';
        }
        if(!$type){
            echo 'Тип товара не должен быть пустым <br/>';
        }
        echo "<a href='javascript:history.go(-1)'>Вернуться назад</a> <br>";
    }

    echo "<a href='../index.php'>Вернуться на главную</a>"; 
    
    mysqli_close($connect);
?>