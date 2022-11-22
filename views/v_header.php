<?php
require_once (realpath($_SERVER["DOCUMENT_ROOT"])."/app/lib.php");

$siteurl=getUrl();
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
        <a class="navbar-brand" href="/">КИзИ</a>
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Домой</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/login">Вход</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/registration">Регистрация</a>
                </li>
            </ul>

            <?php
            if(isset($_SESSION['email'])){
            echo"<ul class=\"navbar-nav ms-auto mb-2 mb-lg-0\">
                  <li class=\"nav-item\">
                    <a class=\"nav-link\" aria-current=\"page\" href=\"/appopen/vohr.php?logout\">Выйти</a>
                </li>
                
                <li class=\"nav-item\">
                    <a class=\"nav-link\" aria-current=\"page\" href=\"/\">Приветствую {$_SESSION['name']}</a>
                </li>
            </ul>";
            }
            ?>

        </div>
    </div>
</nav>


