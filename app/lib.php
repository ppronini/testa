<?php
require_once "dbconn.php";

//Main settings
define('DEBUG',true);

function logme($file,$itemname,$write){
    $filename=SITE_ROOT."/logs/$file";

    if(DEBUG==true){
        $file2write=fopen($filename,'ab');
        date_default_timezone_set('Asia/Almaty');
        $time = '['.date('Y-m-d H:i:s').'] ';
        fwrite($file2write,"\n"."=============$itemname======================="."\n");
        fwrite($file2write,$time.$write."\n");
        fwrite($file2write,"****************$itemname КОНЕЦ**********************"."\n");
        fclose($file2write);
    }


}

//URL check for the menu
function getUrl(){
    $link=$_SERVER['REQUEST_URI'];
    return $link;
}
//URL check for the menu end

//Вычищаем левые символы
function val($data){

    $data=trim($data);
    $data=stripcslashes($data);
    $data=htmlspecialchars($data);
    return $data;

}

function valadm($data){

    $data=trim($data);
    $data=stripcslashes($data);
    return $data;

}

//Дата сейчас
function datenow(){
date_default_timezone_set('Asia/Almaty');
$date = date('Y-m-d H:i:s', time());
return $date;
}

function datenowobject(){
    $datenow=new DateTime(null, new DateTimeZone('Asia/Almaty'));
    return $datenow;
}

function reformatDate($datestr){

    $newdate=new DateTime($datestr, new DateTimeZone('Asia/Almaty'));
    $newdatestr=$newdate->format('d-m-Y H:i');
    return $newdatestr;
}

function nicePrint($print){
    echo '<pre>' . print_r($print, TRUE) . '</pre>';
}

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


?>