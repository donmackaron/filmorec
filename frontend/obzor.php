<?php
require "C:/OpenServer/domains/localhost/backend/access_right.php";
if(isset($_POST['add_com'])){
    $com=new polz;
    $idd=$_POST['id'];

    $com->set_polz($_GET['id'],htmlspecialchars($_POST['com']),$_POST['add_com']);

}
$id=$_GET['id'];
$path_img="http://localhost/server_image/";
$path_video="http://localhost/server_video/";
$BD=new DB;
$obzor=$BD->DaBa->query("SELECT `id`, `name_obzor` , `text`, `files_pic`,`files_vid` , `time` FROM `obzor` WHERE `id` LIKE '$id'");
$obzor_col=$obzor->fetchAll();
$polz=$BD->DaBa->query("SELECT `Commnet`,`time` FROM `comment`");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Создание обзора</title>
</head>
<body>

<?php foreach ($obzor_col as $row){?>
    <p><? $images=$path_img.$row['files_pic'];?>
        <?$video=$path_video.$row['files_vid']?>
<?echo  "<img src='$images' width='300' height='60'>";?>
        <?echo "<video width='320' controls><source src='$video' ></video>";?>
<?echo $row['name_obzor'];?>
<? echo $row['time'];?>
<? echo $row['text'];?></p>
<?}?>


<?php foreach($polz as $row){?>

    <p><? echo $row['Commnet'];?></p>
<?}?>
<?if(isset($_SESSION['user'])){?>
<form name="addcom" action="" method="post" enctype="multipart/form-data">
    <label>Ваш коментарий</label>
    <input type="text" name="com"/><br>
    <input type="submit" name="add_com" value="Отправить комментарий">
</form>
<?}else echo 'Вы не зарегестрированы/авторизированы';?>
</body>
</html>