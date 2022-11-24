
<?php
require_once '../funcs/validations.php';
require_once '../config/connect.php';

    $user = $_POST;
    $editMode = array_key_exists("editMode",$user);
    $id = array_key_exists("id",$user) ? $user["id"] : null;
    $l = validateLogin(trim($user["login"]),$connect,$editMode && $id);
    $p = validatePassword(trim($user["password"]));
    $n = trim($user["name"]);
    $s = trim($user["surname"]);

    if($l[0] && $p[0] && $n && $s){
        if($id){
            mysqli_query($connect,"UPDATE `users` SET `login` = '$l[1]',`password`='$p[1]',`name`='$n',`surname`='$s' WHERE `id` = '$id'");
            echo "Пользователь успешно изменен <br>";
        }else{
            mysqli_query($connect,"INSERT INTO `users` (`login`,`password`,`name`,`surname`) VALUES ('$l[1]','$p[1]','$n',
            '$s')");
            echo 'Пользователь успешно создан <br/>';
        }

    }else{
        if(!$l[0]){
            echo $l[1] . "<br>";
        }
        if(!$p[0]){
            echo $p[1] . "<br>";
        }
        echo "<a href='javascript:history.go(-1)'>Вернуться назад</a> <br>";
    }

    echo "<a href='../index.php'>Вернуться на главную</a>";
    
    mysqli_close($connect);
?>