<?php
if(isset($_REQUEST['status'])){
    $status=$_REQUEST['status'];
    echo"<div class='container'>
<div class='row'>
    <div class='col-lg-12'>";

    if($status==="userexists"){
        echo"<p class='alert alert-warning'>Ошибка, пользователь с таким адресом электронной почты уже существует</p>";
    }

    elseif($status==="emaillong"){
        echo"<p class='alert alert-warning'>Ошибка, адрес почты слишком длинный</p>";
    }

    elseif($status==="emailformat"){
        echo"<p class='alert alert-warning'>Ошибка, адрес почты не соответствует требуемому формату</p>";
    }

    elseif($status==="emptyfield"){
        echo"<p class='alert alert-warning'>Ошибка, проверьте все ли поля заполнены</p>";
    }

    echo"</div>
</div>
</div>";
}

?>

<main class="container">
  <div class="row">
      <form id="auth_form" class="margin-clear" action="/appopen/vohr.php" method="post">

          <div class="row">
              <div class="col-lg-6">

                  <label>Адрес эл. почты</label>
                  <input id="email_auth" name="email" type="email" class="form-control" placeholder="Адрес эл. почты">
                  <input id="auth_id" name="auth_form" type="hidden" value="auth_form">


                  <label>Имя</label>
                  <input id="auth_name" name="name" type="text" class="form-control " placeholder="Имя">


                  <label class="mt-2">Фамилия</label>
                  <input id="auth_fn" name="fname" type="text" class="form-control " placeholder="Фамилия">




              </div>

              <div class="col-lg-6">

                  <label>Телефон</label>
                  <input id="phone" name="phone" type="tel" class="form-control" placeholder="+7(___)__-__-__">


                  <label>Пароль</label>
                  <input id="auth_pwd" name="password" type="password" class="form-control " placeholder="Пароль">

                  <button type="submit" class="btn btn-success mt-2" data-referral='main'> Отправить</button>
              </div>

          </div>

      </form>
  </div>
</main>
