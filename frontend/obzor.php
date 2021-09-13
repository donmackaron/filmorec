<?php
require "C:/OpenServer/domains/localhost/backend/access_right.php";
if(isset($_POST['add_com'])){
    $com=new polz;
    $com->set_polz($_POST['com'],$_POST['add_com']);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание обзора</title>

</head>
<body>
<form name="addcom" action="" method="post" enctype="multipart/form-data">
    <label>Ваш коментарий</label>
    <input type="text" name="com"/><br>
    <input type="submit" name="add_com" value="Загрузить обзор">
</form>
</body>
</html>