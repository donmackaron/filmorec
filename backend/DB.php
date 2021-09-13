<?php
class DB{
    private $servername='';
    private $DBname='';
    private $DBusername='';
    private $DBpassword='';
    public $DaBa;
    function __construct(){
        try{
$this->servername='localhost';
$this->DBname='films';
$this->DBusername='don_mackaron';
$this->DBpassword='Bezborodov48';
$this->DaBa= new PDO("mysql:host=$this->servername;dbname=$this->DBname", $this->DBusername,$this->DBpassword);
$this->DaBa->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "connection ready\n";
        } catch (PDOException $e){
            echo 'connected faild'.$e->getMessage();
        }
    }

}
$DB=new db;