<?php
require_once "lib.php";
$db=new db();
$date=datenow();

if(isset($_POST['login'])){
    $user=val($_POST['login']);
    $mainQ=$db->query("SELECT users.login, users.name, users.fname, users.role, lesson2user.*,lessons.* FROM users LEFT JOIN lesson2user ON users.login=lesson2user.user LEFT JOIN lessons ON lesson2user.lessonid=lessons.id WHERE users.login=?",$user)->fetchAll();


    echo"<table class='resp'>
          <thead>
            <tr>
              <th scope=\"col\">Урок</th>
              <th scope=\"col\">Дата</th>

            </tr>
          </thead>
          <tbody>";

    foreach ($mainQ as $row){
        $lesson=$row['lesson'];
        $date=reformatDate($row['date']);

        echo "
            <tr>
              <td data-label=\"Урок\">$lesson</td>
              <td data-label=\"Дата\">$date</td>
            </tr>";

    }
    echo"</tbody>
            </table>";

}

elseif(isset($_POST['lesson'])){
    $lessonid=val($_POST['lesson']);
    $mainQ=$db->query("SELECT users.login, users.name, users.fname, users.role, lesson2user.*,lessons.* FROM users LEFT JOIN lesson2user ON users.login=lesson2user.user LEFT JOIN lessons ON lesson2user.lessonid=lessons.id WHERE lessons.id=?",$lessonid)->fetchAll();


    echo"<table class='resp'>
          <thead>
            <tr>
              <th scope=\"col\">Почта</th>
              <th scope=\"col\">Имя</th>
              <th scope=\"col\">Фамилия</th>
              <th scope=\"col\">Дата</th>

            </tr>
          </thead>
          <tbody>";

    foreach ($mainQ as $row){
        $email=$row['login'];
        $name=$row['name'];
        $fname=$row['fname'];
        $date=reformatDate($row['date']);

        echo "
            <tr>
              <td data-label=\"Почта\">$email</td>
              <td data-label=\"Имя\">$name</td>
              <td data-label=\"Фамилия\">$fname</td>
              <td data-label=\"Дата\">$date</td>
            </tr>";

    }
    echo"</tbody>
            </table>";

}

else{

    $checkU=$db->query("SELECT 1 FROM users")->numRows();

    if($checkU>0){
        echo"Уже добавляли пользователей<br><br>";
    } else{

        for ($i=0;$i<2000;$i++){
            $db->query("INSERT INTO users(login,name,fname,role,date) VALUES (?,?,?,?,?)","user$i@email.com","Артур$i","Пирожков$i","student",$date);
        }

        for ($i=0;$i<4;$i++){
            $db->query("INSERT INTO users(login,name,fname,role,date) VALUES (?,?,?,?,?)","admin$i@email.com","Сам$i","Самыч$i","admin",$date);
        }

        echo"Вставили админов и пользователей<br><br>";
    }

    $checkL=$db->query("SELECT 1 FROM lessons")->numRows();

    if($checkL>0){
        echo"Уже добавляли уроки<br><br>";
    } else {
        for ($i = 0; $i < 21; $i++) {
            $db->query("INSERT INTO lessons(lesson) VALUES (?)", "УРОК_$i");
        }
        echo"Вставили уроки<br><br>";
    }

    $checkL2=$db->query("SELECT 1 FROM lesson2user")->numRows();

    if($checkL2>0){
        echo"Уже заканчивали уроки<br><br>";
    } else{

        $usersQ=$db->query("SELECT login FROM users")->fetchAll();

        foreach ($usersQ as $row){
            $rand=rand(1,20);

            $usernow=$row['login'];

            for($i=1;$i<$rand;$i++){
                $db->query("INSERT INTO lesson2user(lessonid,user,date) VALUES(?,?,?)",$i,$usernow,$date);

            }
            echo"Закончили уроки<br><br>";
        }

    }
}


$db->close();
