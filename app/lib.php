<?php
require_once "dbconn.php";

//Main settings
define('DEBUG',true);

function curlsimple($url,$addheader){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    if($addheader==="no"){
        $headers = array(
            "Accept: text/html, application/json",
            "Content-Type: text/html, application/json",
        );
    } else{
        $headers = array(
            "Accept: text/html, application/json",
            "Content-Type: text/html, application/json",
            $addheader

        );
    }
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $resp = curl_exec($curl);
    curl_close($curl);

    return $resp;
}

function sendPost($url, $data, $addheader="no"){

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    if($addheader==="no"){
        $headers = array(
            "Accept: text/html, application/xhtml+xml",
            "Content-Type: multipart/form-data",
        );
    } else{
        $headers = array(
            "Accept: text/html, application/xhtml+xml",
            "Content-Type: multipart/form-data",
            $addheader
        );
    }

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    if($data!="no"){
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }

    $resp = curl_exec($curl);
    curl_close($curl);

    echo $resp;
}

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

function logmefast($write){
    $file="debug.txt";
    $itemname="Дебаггинг из фаст логгинга";
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

function logpost($for){
    $request=print_r($_REQUEST, true);
    logme("posts.txt","Запрос на пост: $for","$request");
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


//Write to console
function console_write($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Information from KGB: " . $output . "' );</script>";
}
//Write to console end

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



?>