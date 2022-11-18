<main class="container">

<div class="row">
    <div class="col-lg-12">
    <h1>Погода в Мурманске</h1>
      <?php
      $weather=curlsimple("https://api.weather.yandex.ru/v2/forecast?lat=68.9792&lon=33.0925","X-Yandex-API-Key: 56a44869-68fd-43a6-935d-2056a57e717b");
      $resp=json_decode($weather,true);

      $tempr=$resp['fact']['temp'];

      echo"Температура в Мурманске сегодня: $tempr";
//      nicePrint($resp);
      ?>
    </div>
</div>

</main>


