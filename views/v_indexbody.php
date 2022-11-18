<main class="container">
  <div class="row">
      <div class="col-lg-12">
      <h1>Студенты молодцы</h1>
      <?php
      $db=new db();

//     TODO: написать SQL запрос, в результате которого будет выведен список студентов, отстортированный по количеству просмотренный уроков.
//SELECT users.login, users.name, users.fname, users.role, COUNT(lesson2user.id) AS total FROM users LEFT JOIN lesson2user ON users.login=lesson2user.user WHERE users.role='student' GROUP BY users.login ORDER BY total DESC

//  TODO: написать SQL запрос, в результате которого будет выведен список уроков, отсортированный по количеству студентов его посмотревших.
//      SELECT lessons.id, lessons.lesson, COUNT(lesson2user.id) AS total FROM lessons LEFT JOIN lesson2user ON lessons.id=lesson2user.lessonid GROUP BY lessons.lesson ORDER BY total DESC

      $mainQ=$db->query("SELECT users.login, users.name, users.fname, users.role, COUNT(lesson2user.id) AS total FROM users LEFT JOIN lesson2user ON users.login=lesson2user.user WHERE users.role=? GROUP BY users.login ORDER BY total DESC","student")->fetchAll();


      echo"<table class='resp'>
          <thead>
            <tr>
              <th scope=\"col\">Эл. почта</th>
              <th scope=\"col\">Имя</th>
              <th scope=\"col\">Фамилия</th>
              <th scope=\"col\">Прогресс</th>
            </tr>
          </thead>
          <tbody>";

      foreach ($mainQ as $row){
        $login=$row['login'];
        $name=$row['name'];
        $fname=$row['fname'];
        $progress=round(($row['total']*100)/27,0);
          echo "
            <tr>
              <td data-label=\"Эл. почта\"><a href='#' class='clickme' data-login='$login'>$login</a></td>
              <td data-label=\"Имя\">$name</td>
              <td data-label=\"Фамилия\">$fname</td>
              <td data-label=\"Прогресс\">{$progress}%</td>

            </tr>";

      }
      echo"</tbody>
            </table>";

      $db->close();
      ?>

      </div>
  </div>
</main>


<!-- Modal -->
<div class="modal fade" id="modallessons" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Пройденные уроки</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="mbody">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>

            </div>
        </div>
    </div>
</div>