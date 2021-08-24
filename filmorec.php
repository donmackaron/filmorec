
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Filmorec</title>

</head>
<body>
<form name="login" action="frontend/login.php" method="post">
    <input type="submit" name="rega" value="Зарегестрироваться"/><br>
    <input type="submit" name="autoriz" value="Авторизироваться"/><br>
</form>
</body>
</html>
<?php
if(isset($_POST[rega])){

    header("Location:/frontend/login.php");
    exit;
}
elseif(isset($_POST[autoriz])){

    header("Location:/frontend/login.php ");
    exit;
}
?>