<?php
session_start();
require "DB.php";
class polz{
    private $com='';
    private $add_com='';
    private $id_obz='';

protected $DatBas='';
function __construct()
{
    $this->DatBas=new DB;
}
public function set_polz($id_obz,$com,$add_com){
    $this->com=$com;
    $this->add_com=$add_com;
    $this->id_obz=$id_obz;
    $this->validate();
}
private function validate(){
    if(isset($this->add_com) && isset($this->com) && strlen($this->com) < 500){
        $this->comment();
    }

}
private function comment(){
    $id_polz=$_SESSION['id'];
    $today=date("y.m.d");
    $COMadd=$this->DatBas->DaBa->prepare("INSERT INTO `comment` ( `id_polz`, `id_obz`,`Commnet`,`time`) VALUES ('$id_polz','$this->id_obz','$this->com','$today')");
    $COMadd->execute();
}
}

class admin extends polz{
    private $id='';
    private $name_obzor='';
    private $obzor='';
    private $image='';
    private $video='';
    private $add='';
    private $chek_image=false;
    private $chek_video=false;
    private $allow_image=array('png','jpg','tiff','bmp');
    private $allow_video=array('avi','flv','mkv','mov','mp4','mpeg','mpg','webm');
    private $polz;
    public $error_image='';
    public $error_video='';
    public $error_name_obzer='';
    public $error_obzer='';
    public function set_admin($name_obzor, $obzor, $image, $video, $add){
        $this->name_obzor=$name_obzor;
        $this->obzor=$obzor;
        $this->image=$image;
        $this->video=$video;
        $this->add=$add;
        $this->validate();
    }
    private function validate()
    {
        if (isset($this->name_obzor) && strlen($this->name_obzor) < 50 && strlen($this->obzor) < 1000 && isset($this->obzor) && isset($this->image) && isset($this->video) && strlen($this->image['name']) < 150 && strlen($this->video['name']) < 150) {

            if (!empty($this->image['error']) || empty($this->image['tmp_name'])) {
                switch (@$this->image['error']) {
                    case 1:
                    case 2:
                        $this->error_image = 'Превышен размер загружаемого изображения.';
                        break;
                    case 3:
                        $this->error_image = 'изображение было получен только частично.';
                        break;
                    case 4:
                        $this->error_image = 'изображение не было загружен.';
                        break;
                    case 6:
                        $this->error_image = 'изображение не загружено - отсутствует временная директория.';
                        break;
                    case 7:
                        $this->error_image = 'Не удалось записать изображение на сервер.';
                        break;
                    case 8:
                        $this->error_image = 'PHP-расширение остановило загрузку изображения.';
                        break;
                    case 9:
                        $this->error_image = 'изображение не было загружен - директория не существует.';
                        break;
                    case 10:
                        $this->error_image = 'Превышен максимально допустимый размер изображения.';
                        break;
                    case 11:
                        $this->error_image = 'Данный тип изображения запрещен.';
                        break;
                    case 12:
                        $this->error_image = 'Ошибка при копировании изображеня.';
                        break;
                    default:
                        $this->error_image = 'изображение не было загружено - неизвестная ошибка.';
                        break;
                }
            } elseif ($this->image['tmp_name'] == 'none' || !is_uploaded_file($this->image['tmp_name'])) {
                $this->error_image = 'Не удалось загрузить изображение.';
            }  else {
                $pattern_image = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
                $name_image = mb_eregi_replace($pattern_image, '-', $this->image['name']);
                $name_image = mb_ereg_replace('[-]+', '-', $name_image);
                $converter_image = array(
                    'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
                    'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k',
                    'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
                    'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
                    'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '',
                    'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

                    'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
                    'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K',
                    'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R',
                    'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
                    'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
                    'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
                );
                $name_image = strtr($name_image, $converter_image);
                $parts_image = pathinfo($name_image);
                if (empty($name_image) || empty($parts_image['extension'])) {
                    $this->error_image = 'Недопустимый тип изображения';
                } elseif (!in_array(strtolower($parts_image['extension']), $this->allow_image)) {
                    $this->error_image = 'Недопустимый тип изображения';
                } elseif ($this->image[size] > 83886080) {
                    $this->error_image = 'превышен размер изображения';
                } else {
                    $this->chek_image = true;
                }
            }
                    if(!empty($this->video['error']) || empty($this->video['tmp_name'])) {
                        switch (@$this->video['error']) {
                            case 1:
                            case 2:
                                $this->error_video = 'Превышен размер загружаемого видео.';
                                break;
                            case 3:
                                $this->error_video = 'видео было получен только частично.';
                                break;
                            case 4:
                                $this->error_video = 'видео не было загружен.';
                                break;
                            case 6:
                                $this->error_video = 'видео не загружено - отсутствует временная директория.';
                                break;
                            case 7:
                                $this->error_video = 'Не удалось записать видео на сервер.';
                                break;
                            case 8:
                                $this->error_video = 'PHP-расширение остановило загрузку видео.';
                                break;
                            case 9:
                                $this->error_video = 'видео не было загружен - директория не существует.';
                                break;
                            case 10:
                                $this->error_video = 'Превышен максимально допустимый размер видео.';
                                break;
                            case 11:
                                $this->error_video = 'Данный тип видео запрещен.';
                                break;
                            case 12:
                                $this->error_video = 'Ошибка при копировании видео.';
                                break;
                            default:
                                $this->error_video = 'видео не было загружено - неизвестная ошибка.';
                                break;
                        }
                    } elseif ($this->video['tmp_name'] == 'none' || !is_uploaded_file($this->video['tmp_name'])) {
                        $this->error_video = 'Не удалось загрузить изображение.';
                    }else{
                    $pattern_video = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
                    $name_video = mb_eregi_replace($pattern_video, '-', $this->video['name']);
                    $name_video = mb_ereg_replace('[-]+', '-', $name_video);
                    $converter_video = array(
                        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
                        'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k',
                        'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
                        'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
                        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '',
                        'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

                        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
                        'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K',
                        'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R',
                        'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
                        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
                        'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
                    );
                    $name_video = strtr($name_video, $converter_video);
                    $parts_video = pathinfo($name_video);
                    if (empty($name_video) || empty($parts_video['extension'])) {
                        $this->error_video = 'Недопустимый тип видео1';
                    } elseif (!in_array(strtolower($parts_video['extension']), $this->allow_video)) {
                        $this->error_video = 'Недопустимый тип видео2';
                    } elseif ($this->video[size] > 6442450944) {
                        $this->error_video = 'превышен размер видео';
                    } else {
                        $this->chek_video = true;
                        if (strlen($this->name_obzor) < 50 && strlen($this->obzor) < 1000 && $this->chek_image && $this->chek_video) {
                            $this->loadfiles($parts_image, $parts_video);
                        }
                    }
                }
        }else{
            if(!isset($this->name_obzor)){
                $this->error_name_obzer="не введно имя обзора";
            }
            if(strlen($this->name_obzer)>50){
                $this->error_name_obzer="Слишком большое имя обзора";
            }
            if(!isset($this->obzor)){
                $this->error_obzer="Не введён обзор";
            }
            if(strlen($this->obzer)>1000){
                $this->error_name_obzer="Слишком большой текст";
            }
            if(strlen($this->image['name']) > 150){
                $this->error_image="Слишком большое имя рисунка";
            }
            if(!isset($this->image)){
                $this->error_image="отсутствует рисунок";
            }
            if(!isset($this->video)){
                $this->error_video="отсутствует Видео";
            }
            if(strlen($this->video['name']) > 150){
                $this->error_video="Слишком большое имя видео";
            }
        }
    }
    private function loadfiles($parts_image,$parts_video){
        $this->id=$_SESSION['id'];
        $this->polz=new polz;
        $path_image="C:/OpenServer/domains/localhost/server_image/";
        $i = 0;
        $prefix = '';
        while (is_file($path_image . $parts_image['filename'] . $prefix . '.' . $parts_image['extension'])) {
            $prefix = '(' . ++$i . ')';
        }
        $name_image = $parts_image['filename'] . $prefix . '.' . $parts_image['extension'];
        move_uploaded_file($this->image['tmp_name'], $path_image.$name_image);
        $path_video="C:/OpenServer/domains/localhost/server_video/";
        $i = 0;
        $prefix = '';
        while (is_file($path_video . $parts_video['filename'] . $prefix . '.' . $parts_video['extension'])) {
            $prefix = '(' . ++$i . ')';
        }
        $name_video = $parts_video['filename'] . $prefix . '.' . $parts_video['extension'];
        move_uploaded_file($this->video['tmp_name'], $path_video.$name_video);
        $today=date("y.m.d");
        echo $today."\n";
        $DBadd=$this->polz->DatBas->DaBa->prepare("INSERT INTO `obzor` ( `id_admin`, `name_obzor`, `text`, `files_pic`, `files_vid`, `time`) VALUES ('$this->id', '$this->name_obzor', '$this->obzor', '$name_image', '$name_video', '$today')");
        $DBadd->execute();
    }
}
?>