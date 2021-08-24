<?php
require 'DB.php';
class login{
    private $email='';
    private $name='';
    private $password='';
    private $reterypass='';
    private $chek='';
    private $button_reg='';
    private $button_auto='';
    private $DB='';
    function __construct($email='',$name='',$password='',$reterypass='',$chek=false,$button_reg=false,$buton_auto=false){
$this->email=$email;
$this->name=$name;
$this->password=$password;
$this->reterypass=$reterypass;
$this->chek=$chek;
$this->button_reg=$button_reg;
$this->button_auto=$buton_auto;
$this->DB=new DB();
        if(isset($this->chek)){
            echo "chek is real\n";
        }else echo "chek is not real\n";
$this->validation();
    }
    private function validation(){
        if(!empty($this->email)|| !empty($this->name)&& !empty($this->password)) {
            $regchek = $this->DB->DB->prepare("SELECT * FROM `registred` WHERE `email` LIKE '$this->email' OR `name`='$this->name'");
            $regchek->execute();
            $regchek = $this->DB->DB->prepare("SELECT FOUND ROWS");
            $regchek_column = $regchek->fetchColumn();
            $autochek = $this->DB->DB->prepare("SELECT * FROM `registred` WHERE `email` LIKE '$this->email' AND `name` = '$this->name' AND `password`=MD5('$this->password')");
            $autochek->execute();
            $autochek = $this->DB->DB->prepare("SELECT FOUND ROWS");
            //$autochek->execute();
            $autochek_column = $autochek->fetchColumn();
            if (isset($this->button_reg) && empty($regchek_column)) {
                echo "Начало регистрации\n";
                if (filter_var($this->email, FILTER_VALIDATE_EMAIL) && strlen($this->email) < 30 && strlen($this->name) < 30 && preg_match("/^[a-zа-яё\d]{1}[a-zа-яё\d\s]*[a-zа-яё\d]{1}$/i", $this->name) && strlen($this->password) == 32 && isset($this->reterypass) && MD5($this->password) == MD5($this->reterypass) && isset($this->chek)) {

                    $this->registration();
                    echo "Успешная регистрация\n";
                }else{
                    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                        $err_reg_email = 1;
                    }
                    if(strlen($this->email) > 30){
                        $err_count_email=1;
                    }
                    if(!preg_match("/^[a-zа-яё\d]{1}[a-zа-яё\d\s]*[a-zа-яё\d]{1}$/i", $this->name)){
                        $err_reg_name=1;
                    }

                    if(strlen($this->name) > 30){
                        $err_count_name=1;
                    }
                    if(strlen($this->password) != 32){
                        $err_count_password=1;
                    }
                    if(!isset($this->reterypass)){
                        $err_reg_reterypass=1;
                    }

                    if(MD5($this->password) != MD5($this->reterypass) && isset($this->reterypass)){
                        $err_count_reterypass=1;
                    }
                    if(!isset($this->chek)){
                        $err_chek=1;
                    }

                    $err_reg=1;
                    $_POST[err_reg_email]=$err_reg_email;
                    $_POST[err_count_email]=$err_count_email;
                    $_POST[err_reg_name]=$err_reg_name;
                    $_POST[err_count_name]=$err_count_name;
                    $_POST[err_count_password]=$err_count_password;
                    $_POST[err_reg_reterypass]=$err_reg_reterypass;
                    $_POST[err_count_reterypass]=$err_count_reterypass;
                    $_POST[err_chek]=$err_chek;
                    $_POST[err_reg]=$err_reg;
               }
            }elseif(!empty($regchek_column)){
                echo "Данный пользователь уже зарегестрирован\n";
            }
            if (isset($this->button_auto) && !empty($autochek_column)) {
                $this->autorization();
            }elseif (isset($this->button_auto) && empty($autochek_column) && empty($regchek_column)){
                echo "Данный пользователь не зарегестрирован\n";
            }elseif(isset($this->button_auto) && empty($autochek_column) && !empty($regchek_column)){
                echo "Не верно введены имя или пароль или всё вместе\n";
            }
        }else{
            if(isset($this->button_reg)){
                $err_email=!isset($this->email);
                $err_name=!isset($this->name);
                $err_password=!isset($this->password);
                $err_reterypass=!isset($this->reterypass);
                $err_chek=!isset($this->chek);
                $err_reg=1;
                $_POST[err_email]=$err_email;
                $_POST[err_name]=$err_name;
                $_POST[err_password]=$err_password;
                $_POST[err_reterypass]=$err_reterypass;
                $_POST[err_chek]=$err_chek;
                $_POST[err_reg]=$err_reg;
            }elseif(isset($this->button_auto)){
                $err_auto_email=!isset($this->email);
                $err_auto_name=!isset($this->name);
                $err_auto_password=!isset($this->password);
                $err_auto=1;
                $_POST[err_auto_email]=$err_auto_email;
                $_POST[err_auto_name]=$err_auto_name;
                $_POST[err_auto_password]=$err_auto_password;
                $_POST[err_auto]=$err_auto;
            }


            echo "Неусепешная регитсрация вход \n";
        }
}
private function registration($admin=0){
        try{
            $reg=$this->DB->DB->prepare("INSERT INTO `registred`(`email`,`name`,`password`,`admin`) VALUES('$this->email', '$this->name', '$this->password','$admin')");
            $reg->execute();
            echo 'Вы зарегестрированы';
        }catch(PDOException $e){
echo $e->getMessage();
        }

}
private function autorization(){

}
}

