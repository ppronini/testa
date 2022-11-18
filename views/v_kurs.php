<main class="container">
  <div class="row">
      <div class="col-lg-12">
      <h1>Курс как привлечь мужчину 20 разных способов</h1>
      <?php
      $db=new db();


      $mainQ=$db->query("SELECT * FROM LESSONS")->fetchAll();


      echo"<table class='resp'>
          <thead>
            <tr>
              <th scope=\"col\">Урок</th>

            </tr>
          </thead>
          <tbody>";

      foreach ($mainQ as $row){
        $lesson=$row['lesson'];
        $lessonid=$row['id'];

          echo "
            <tr>
              <td data-label=\"Эл. почта\"><a href='#' class='clickmelesson' data-lessonid='$lessonid'>$lesson</a></td>

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