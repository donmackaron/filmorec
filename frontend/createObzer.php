<?php
session_start();
$error_image='';
$error_video='';
$name_obzer='';
$obzer='';
    if (isset($_POST['add'])) {
        require 'C:/OpenServer/domains/localhost/backend/access_right.php';
        $admin = new admin;
        $admin->set_admin($_POST['name_obzor'], $_POST['obzor'], $_FILES['image'], $_FILES['video'], $_POST['add']);
        $error_image = $admin->error_image;
        $error_video = $admin->error_video;
        $name_obzer = $admin->error_name_obzer;
        $obzer = $admin->error_obzer;
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание обзора</title>

</head>
<body>
<?php if($_SESSION['admin']) {?>
<form name="addObzer" action="" method="post" enctype="multipart/form-data">
    <label>Название фильма</label>
    <input type="text" name="name_obzor"/><?php if(isset($name_obzer)){?><label><?php echo $name_obzer; }?></label><br>
    <label>Описание фильма</label>
    <input type="text" name="obzor"/><?php if(isset($obzer)){?><label><?php echo $obzer; }?></label><br>
    <label>Добавьте постер фильма</label>
    <input type="file" name="image"/><?php if(isset($error_image)){?><label><?php echo $error_image; }?></label><br>
    <label>Добавьте трейлер фильма</label>
    <input type="file" name="video"/><?php if(isset($error_video)){?><label><?php echo $error_video; }?><br>
    <input type="submit" name="add" value="Загрузить обзор">
</form>
<?}else echo "Соси Жопу";?>
</body>
</html>