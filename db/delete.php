<?php 
 require_once '../config/connect.php';
 $db = $_GET["db"];
 $id = $_GET["id"];
 mysqli_query($connect,"DELETE FROM `$db` WHERE `id` = '$id' ");
 echo "Объект успешно удален <br/>";
 echo "<a href=../index.php>Вернуться на главную страницу</a>";
 mysqli_close($connect);
?>