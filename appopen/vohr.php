<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/app/dbconn.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/app/lib.php');

//Выход с сайта

if (isset($_GET['logout'])){

    unset($_SESSION['fname']);
    unset($_SESSION['name']);
    unset($_SESSION['role']);
    unset($_SESSION['email']);
    unset($_SESSION['email_pub']);
    unset($_SESSION['email_pub']);
    unset($_SESSION['phone']);

    header("location:/");
}


//Выход с сайта...

//Регистрация на сайте

if (isset($_POST['auth_form'])) {
    $db=new db();
    if (!empty($_POST)) {
            $email = val($_POST['email']);
            $fname = val($_POST['fname']);
            $name = val($_POST['name']);
            $phone = val($_POST['phone']);
            $password = val($_POST['password']);
            $date=datenow();

//            check if user exists
            $usersql=$db->query("SELECT email FROM users WHERE email=?","$email")->numRows();

            if($usersql==1){
                header("location:/registration?status=userexists");
            }
            elseif (strlen($email) > 100) {
                header("location:/registration?status=emaillong");
            }
            elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
                header("location:/registration?status=emailformat");
            }

            elseif($fname===""){
                header("location:/registration?status=emptyfield");
            }

            elseif($name===""){
                header("location:/registration?status=emptyfield");
            }

            elseif($phone===""){
                header("location:/registration?status=emptyfield");
            }

            else {
//    DATABASE
                $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
                $sql=$db->query("INSERT INTO users(email, password, fname, name, phone, date_create, email_pub,role) VALUES (?,?,?,?,?,?,?,?)","$email","$password","$fname","$name","$phone","$date","$email","user");

//                Сразу войти
                $newusersql=$db->query("SELECT * from users WHERE email=?","$email")->fetchArray();
                $_SESSION['fname'] = $newusersql['fname'];
                $_SESSION['name'] = $newusersql['name'];
                $_SESSION['role'] = $newusersql['role'];
                $_SESSION['phone'] = $newusersql['phone'];
                $_SESSION['email'] = $newusersql['email'];
                $_SESSION['email_pub'] =$newusersql['email_pub'];


                header("location:/");

//    END DATABASE

            }
        }

    $db->close();
    }
//Операции Регистрация на сайте конец


//Операции Входим на сайт (Авторизация)
if (isset($_POST['reg_form'])){
    $db=new db();
    $email=val($_POST['email_reg']);
    $password=val($_POST['reg_pwd']);
    $logid=rand(0,255);

    $num_rows=$db->query("SELECT * FROM users WHERE email=?","$email")->numRows();

    if($num_rows>=1) {
        $row=$db->query("SELECT * FROM users WHERE email=?","$email")->fetchArray();
        $role=$row['role'];
        logme("vohr.txt","$logid- Входим на сайт","Входит $email с ролью $role");

        if (password_verify($password, $row['password'])){
            logme("vohr.txt","$logid - Входим на сайт","Прошел проверку на пароль: $email с ролью $role");

            if($role>0){
                $_SESSION['email'] =$row['email'];
                $_SESSION['email_pub'] =$row['email_pub'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['phone'] = $row['phone'];

                logme("vohr.txt","$logid- Входим на сайт","Прошел проверку на Роль и пароль: $email с ролью $role");


                    header("location:/?success");


            }

            else{
                logme("vohr.txt","$logid - !!Ошибка входа!!","$email с ролью $role НЕ прошел проверку на роль");

                header("location:/?loginfailed");
            }

        }

        else {
            logme("vohr.txt","!!!Ошибка входа на сайт Пароль не прошел проверку","Входит $email с ролью $role");
            header("location:/login?loginfailed");
        }


        $db->close();
    }

    else { header("location:/login?loginfailedall");
    }

}
