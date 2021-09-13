<?php
$error_image='';
$error_video='';
if(isset($_POST['add'])){
    require 'C:/OpenServer/domains/localhost/backend/access_right.php';
    $admin=new admin;
    $admin->set_admin($_POST['name_obzor'],$_POST['obzor'],$_FILES['image'],$_FILES['video'],$_POST['add']);
    $error_image=$admin->error_image;
    $error_video=$admin->error_video;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание обзора</title>

</head>
<body>
<form name="addObzer" action="" method="post" enctype="multipart/form-data">
    <label>Название фильма</label>
    <input type="text" name="name_obzor"/><br>
    <label>Описание фильма</label>
    <input type="text" name="obzor"/><br>
    <label>Добавьте постер фильма</label>
    <input type="file" name="image"/><?php if(isset($error_image)){?><label><?php echo $error_image; }?></label><br>
    <label>Добавьте трейлер фильма</label>
    <input type="file" name="video"/><?php if(isset($error_video)){?><label><?php echo $error_video; }?><br>
    <input type="submit" name="add" value="Загрузить обзор">
</form>
</body>
</html>