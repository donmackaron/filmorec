<?php
$err_email='';
$err_name='';
$err_password='';
$err_reterypass='';
$err_chek='';
$err_reg_email='';
$err_reg_name='';
$err_reg_reterypass='';
$err_count_email='';
$err_count_name='';
$err_count_password='';
$err_count_reterypass='';
$err_auto_email='';
$err_auto_name='';
$err_auto_password='';
if(isset($_POST['reg']) || isset($_POST['auto'])){
    require 'C:/OpenServer/domains/localhost/backend/login.php';
    $log= new login(htmlspecialchars($_POST['email']),htmlspecialchars($_POST['name']),htmlspecialchars(MD5($_POST['password'])),htmlspecialchars(MD5($_POST['retry_pass'])),$_POST['chek'],$_POST['reg'],$_POST['auto']);
}
$err_email=$_POST['err_email'];
$err_name=$_POST['err_name'];
$err_password=$_POST['err_password'];
$err_reterypass=$_POST['err_reterypass'];
$err_chek=$_POST['err_chek'];
$err_reg_email=$_POST['err_reg_email'];
$err_count_email=$_POST['err_count_email'];
$err_reg_name=$_POST['err_reg_name'];
$err_count_name=$_POST['err_count_name'];
$err_count_password=$_POST['err_count_password'];
$err_reg_reterypass=$_POST['err_reg_reterypass'];
$err_count_reterypass=$_POST['err_count_reterypass'];
$err_auto_email=$_POST['err_auto_email'];
$err_auto_name=$_POST['err_auto_name'];
$err_auto_password=$_POST['err_auto_password'];
$err_reg=$_POST['err_reg'];
$err_auto=$_POST['err_auto'];
if(isset($err_reg)){
    $_POST['rega']=$err_reg;
}
if(isset($err_auto)){
    $_POST['autoriz']=$err_auto;
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>

</head>
<body>
<form name="login" action="" method="post">
    <lable>Ваш email</lable>
    <input type="text" name="email"/><?php if(isset($err_email)){?><label> email был не введён</label><?}?><?php if(isset($err_reg_email)){?><label> email был введён не верно</label><?}?><?php if(isset($err_count_email)){?><label> слишком большой email</label><?}?><br>
    <?php if(isset($_POST['rega'])){?><label> Ваше имя</label>
    <input type="text" name="name"/><?php if(isset($err_name)){?><label> Ваше имя не было введено</label><?}?><?php if(isset($err_reg_name)){?><label> в имени используются недопустимые значения</label><?}?><?php if(isset($err_count_name)){?><label> слишком большое имя</label><?}?><br><?}?>
    <label>Ваш пароль</label>
    <input type="text" name="password"/><?php if(isset($err_password)){?><label> пароль был не введён</label><?}?><?php if(isset($err_count_password)){?><label> Слишком большой пароль</label><?}?><br>
    <?php if(isset($_POST['rega'])){?><label>Повторите пароль</label>
    <input type="text" name="retry_pass"/><?php if(isset($err_reterypass)){?><label> повторный пароль был не введён</label><?}?><?php if(isset($err_reg_reterypass)){?><label>повторынй пароль был не введён</label><?}?><?php if(isset($err_count_reterypass)){?><label> пароль не совпадает с повторным</label><?}?><br>
    <input type="checkbox" name="chek" value="согласен на обработку персональных данных"/><?php if(isset($err_chek)){?><label> необходиом согласие на обработку персональных данных</label><?}?><br>
    <input type="submit" name="reg" value="Зарегестрироваться"/><br><?}?>
    <?php if(isset($_POST['autoriz'])){?><input type="submit" name="auto" value="Авторизироваться"/><br><?}?>
</form>
</body>
</html>
