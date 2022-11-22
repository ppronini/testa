
<main class="container">
  <div class="row">
      <form id="reg_form" class="margin-clear" action="/appopen/vohr.php" method="post">

          <div class="row">
          <div class="col-lg-6">
              <label>Эл. почта</label>
              <input id="email_reg" name="email_reg" type="email" class="form-control" placeholder="Адрес эл. почты">
              <input id="reg_id" name="reg_form" type="hidden" value="auth_form">
          </div>


          <div class="col-lg-6">
              <label>Пароль</label>
              <input id="reg_pwd" name="reg_pwd" type="password" class="form-control " placeholder="Пароль">
          </div>

        </div>

    <div>
        <button type="submit" class="btn btn-success btn-reg mt-2 float-end"> Войти</button>
    </div>

    </div>
    </form>

</main>
