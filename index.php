<?php
require_once (realpath($_SERVER["DOCUMENT_ROOT"])."/app/dbconn.php");
function val($data){

    $data=trim($data);
    $data=stripcslashes($data);
    $data=htmlspecialchars($data);
    return $data;

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Тестовый сайт Паши</title>


    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/offcanvas.css" rel="stylesheet">
    <link href="/css/newstyle.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Auslogics</a>
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Домой</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<main class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Добро пожаловать на сайт тестового задания Пронина Павла</h1>
            <form action="index.php" method="post">
                <label for="wantdate">Пожалуйста выберите дату</label>
                <input type="date" class="form-control" name="wantdate" id="date">
                <button>Отправить</button>
            </form>


            <?php
            if(isset($_POST['wantdate'])) {
                $db = new db();
                $utctimezone = 4; //Можно получать это из БД

                $date = val($_POST['wantdate']);

                $datenow = new DateTime($date, new DateTimeZone('UTC'));
                $timezoneName = timezone_name_from_abbr("", $utctimezone * 3600, false);
                $modified = $datenow->setTimezone(new DateTimezone($timezoneName));
                $date = $modified->format("Y-m-d");

                $userActivity4CacheNum = $db->query("SELECT * FROM user_activity WHERE DATE(user_time)=?", $date)->numRows();

                if ($userActivity4CacheNum > 0) {
                    $userActivity4Cache = $db->query("SELECT user_id, user_time, SUM(duration) as sum_duration,SUM(activity) as sum_activity FROM user_activity WHERE DATE(user_time)=? GROUP BY user_id;", $date)->fetchAll();

                    foreach ($userActivity4Cache as $row) {
                        $iduser = $row['user_id'];
                        $usertime = $row['user_time'];
                        $duration = $row['sum_duration'];
                        $activity = $row['sum_activity'];

                        $checkN = $db->query("SELECT 1 FROM user_activity_cache WHERE user_id=? AND user_date=? AND duration=? AND activity=?", $iduser, $date, $duration, $activity)->numRows();

                        if ($checkN > 0) {
                            echo "<p>Уже вставлено для пользователя $iduser на дату $date</p>";
                        } else {

                            $check4updates=$db->query("SELECT 1 FROM user_activity_cache WHERE user_id=? AND user_date=?",$iduser, $date)->numRows();
                            if($check4updates>0){
                                $checkDuration=$db->query("SELECT duration FROM user_activity_cache WHERE user_id=? AND user_date=?",$iduser, $date)->fetchArray();
                                if($checkDuration['duration']!==$duration){
                                    $db->query("UPDATE user_activity_cache SET duration=? WHERE user_id=? AND user_date=?",$duration,$iduser, $date);
                                    echo"<p>Обновили значение duration</p>";
                                }
                                $checkActivity=$db->query("SELECT activity FROM user_activity_cache WHERE user_id=? AND user_date=?",$iduser, $date)->fetchArray();
                                if($checkActivity['activity']!==$activity){
                                    $db->query("UPDATE user_activity_cache SET activity=? WHERE user_id=? AND user_date=?",$activity,$iduser, $date);
                                    echo"<p>Обновили значение activity</p>";
                                }
                            }

                            else{
                                $db->query("INSERT INTO user_activity_cache(user_id,user_date,duration,activity) VALUES(?,?,?,?)", $iduser, $date, $duration, $activity);
                                echo "<p>Успешно вставили</p>";
                            }

                        }

                    }
                } else {
                    echo "<p>Извините на выбранную вами дату ($date) активности нет.</p>";
                }
            }




            ?>


        </div>
    </div>
</main>


<script src="js/bootstrap.js"></script>
<script src="/js/offcanvas.js"></script>

</body>
</html>