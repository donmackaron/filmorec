<?php
session_start();
require "backend/DB.php";
if(isset($_POST['exit'])) {
    unset($_SESSION['user']);
    if (!empty($_SESSION['admin'])) {
        unset($_SESSION['admin']);
    }
}
$path="server_image/";
$BD=new DB;
$obzor=$BD->DaBa->query("SELECT `id`, `name_obzor` , `text`, `files_pic` , `time` FROM `obzor`");
$obzor_col=$obzor->fetchAll();
foreach($obzor_col as $row){
    print_r($row['id']);
    echo "\n";
}


?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Filmorec</title>
</head>
<body>
<form name="login" action="frontend/login.php" method="post">
    <?php if(empty($_SESSION['user'])){?><input type="submit" name="rega" value="Зарегестрироваться"/><?}?><br>
    <?php if(empty($_SESSION['user'])){?><input type="submit" name="autoriz" value="Авторизироваться"/><?}?><br>
</form>
<form name="createObzor" action="frontend/createObzer.php" method="post">
    <?php if(!empty($_SESSION['admin'])){?><input type="submit" name="add_abz" value="Добавить обзор"/><?}?><br>
</form>
<form name="log_out" action="" method="post">
    <?php if(!empty($_SESSION['user'])){?><input type="submit" name="exit" value="Выход"/><?}?><br>
</form>

    <?php foreach($obzor_col as $row){?>

        <p><?$images=$path.$row['files_pic'];?>
        <?echo  "<img src='$images' width='300' height='60'>";?>
        <a href="frontend/obzor.php?id=<? echo $row['id'];?>"><?echo $row['name_obzor'];?></a>
        <? echo $row['time'];?>
<? echo $row['text'];?></p>
    <?}?>


</body>
</html>
<?php
if(isset($_POST['rega'])){
    header("Location:/frontend/login.php");
    exit;
}
elseif(isset($_POST['autoriz'])){
    header("Location:/frontend/login.php ");
    exit;
}elseif(isset($_POST['add_abz'])){
    header("Location:/frontend/createObzer.php ");
    exit;
}

?>