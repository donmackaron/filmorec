<?php
session_start();
require "backend/login.php";
if($_SESSION['user']){
    echo "не пусто";
}else echo "пусто";
if(isset($_POST['exit'])) {
    unset($_SESSION['user']);
    if (!empty($_SESSION['admin'])) {
        unset($_SESSION['admin']);
    }
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
    <?php if(empty($_SESSION['user']) ){?><input type="submit" name="rega" value="Зарегестрироваться"/><?}?><br>
    <?php if(empty($_SESSION['user']) ){?><input type="submit" name="autoriz" value="Авторизироваться"/><?}?><br>

</form>
<form name="login" action="frontend/createObzer.php" method="post">
    <?php if(!empty($_SESSION['admin'])){?><input type="submit" name="add_abz" value="Добавить обзор"/><?}?><br>

</form>
<form name="login" action="" method="post">
    <?php if(!empty($_SESSION['user'])){?><input type="submit" name="exit" value="Выход"/><?}?><br>

</form>
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