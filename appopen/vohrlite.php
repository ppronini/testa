<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/app/dbconn.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/app/lib.php');
$db=new db();

//Запрос на доступ со страницы welcome
if(isset($_POST['newuserposition'])){
    $user=$_SESSION['email'];
    $body=val($_POST['newuserposition'])."<br>".val($_POST['newucomment']);
    $date=datenow();
    if(SANDBOX==false){
        $body="<html><body>Запрос на демо доступ в Систему Дока: $user</body></html>";
        simplemail("Запрос на демо доступ в Систему Дока",$body,"doka@ikeen.com");
    }

    $db->query("INSERT INTO comms(email,body,type,date) VALUES (?,?,?,?)","$user","$body","newuserdemo","$date");
    logme("vohrlite.txt","Демо доступ",$body);

    header("location:/welcome?status=ok");
}


$db->close();