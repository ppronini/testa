<?php
//Авторизация по куки
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/app/dbconn.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/app/lib.php');

function cookieAuth(){
    $db=new db();
    if(PROJECT=="esepai"){
        list($selector, $authenticator) = explode(':', $_COOKIE['esepaisso']);
    }

    else{
        list($selector, $authenticator) = explode(':', $_COOKIE['ikeensso']);
    }

    $numcook=$db->query("SELECT * FROM auth_tokens WHERE selector=?","$selector")->numRows();

    if($numcook>0){
        $row=$db->query("SELECT * FROM auth_tokens WHERE selector=?","$selector")->fetchArray();
        $email=$row['login'];

        if (hash_equals($row['token'], hash('sha256', base64_decode($authenticator)))) {

            $sql=$db->query("SELECT * FROM users WHERE email=?","$email")->fetchArray();

            $_SESSION['email'] =$sql['email'];
            $_SESSION['fname'] = $sql['fname'];
            $_SESSION['name'] = $sql['name'];
            $_SESSION['role'] = $sql['role'];
            $_SESSION['phone'] = $sql['phone'];
            $_SESSION['ozcode'] = $sql['ozcode'];
            $_SESSION['email_pub'] = $sql['email_pub'];
            logme("vohrcookie.txt","Авторизация через куки", "Вошли через куки, $selector, $email.");
        }

    }

    else{
        $cookie=PROJECT;
        logme("vohrcookie.txt","!!! Неуспешная Авторизация через куки", "Не смогли войти через куки $cookie, $selector");
        header("location:/login");
    }
    $db->close();
}
////Авторизация по куки/////////////////////////////////
///
///

?>
