<main class="container">
  <div class="row">
      <div class="col-lg-12">
      <h1>Добро пожаловать на сайт тестового задания Пронина Павла</h1>
          <?php

          if(isset($_REQUEST['loginfailed'])){
              echo"<p class='alert alert-danger'>Внимание! Не смогли вас авторизовать</p>";
          }

          elseif(isset($_REQUEST['youshallnotpass'])){
              echo"<p class='alert alert-danger'>Возникла серезная системная ошибка, немедленно позвоните нам и расскажите что произошло</p>";
          }

          elseif(isset($_REQUEST['success'])){
              echo"<p class='alert alert-success'>Поздравляем, мы успешно вставили новый объект, можете откинуться на спинку кресла и расслабиться.</p>";
          }

          elseif(isset($_REQUEST['smthwrong'])){
              echo"<p class='alert alert-danger'>Простите нас, у нас что-то сломалось и мы уже бросились это чинить, все наши силы направлены на скорейшее исправление проблемы.</p>";
          }

          elseif(isset($_REQUEST['delsuccess'])){
              echo"<p class='alert alert-success'>Успешно удалил Объект с кодом{$_REQUEST['delsuccess']}.</p>";
          }
          ?>

      </div>
  </div>

    <div class="row">
        <?php
        $db=new db();

        function printMe($code){
            global $db;

            $hasQ=$db->query("SELECT * FROM objects WHERE code=?",$code)->fetchArray();
            $hasChildren=$hasQ['haschild'];
            $name=$hasQ['name'];
            $descr=$hasQ['descr'];
            $date=$hasQ['date'];
            $level=$hasQ['level'];
            $parent=$hasQ['parent'];
            $addstring="";
            for($i=0;$i<$level;$i++){
                $addstring.=".";
            }

            $padding=$level*4;
            $fweight=$level*150;

            if($level===1){
                $bg="background-color:Gainsboro";
            } else{
                $bg="";
            }
            if($hasChildren==="no"){
                echo"<p style='padding-left: {$padding}px; font-weight:$fweight;$bg'>{$addstring}Код: $code, Уровень:$level Название: $name, Описание: $descr, Дата создания: $date (<a href='#' class='link-success addnewobjecta' data-code='$code' data-level='$level'>Добавить потомка</a> ||| <a href='#' class='link-danger deleteobject' data-code='$code' data-objname='$name'>Удалить</a>)(ОТЕЦ: $parent)</p>";
            } else{
                echo"<p style='padding-left: {$padding}px; font-weight:$fweight;$bg' >{$addstring}Код: $code, Уровень:$level Название: $name, Описание: $descr, Дата создания: $date (<a href='#' class='link-success addnewobjecta' data-code='$code' data-level='$level'>Добавить потомка</a> ||| <a href='#' class='link-danger deleteobject' data-code='$code' data-objname='$name'>Удалить</a>) (ОТЕЦ: $parent)</p>";
                $childrenQ=$db->query("SELECT * FROM objects WHERE parent=?",$code)->fetchAll();
                foreach ($childrenQ as $rowC){
                    $childCode=$rowC['code'];
                    echo"<p>";
                    printMe($childCode);
                    echo"</p>";
                }

            }


        }

            echo"<div class='col-lg-12'>
                 <a href='#' class='addnewobjecta' data-level=0 data-code='root'>Добавить новый корневой объект?</a>
                 </div>";

            echo"<h1>Дерево объектов</h1>";

            $mainQ=$db->query("SELECT * FROM objects WHERE level=?",1)->fetchAll();

            echo"<div class='col-lg-12'>";
            foreach ($mainQ as $row){
            $code=$row['code'];

            printMe($code);


            }

            echo"</div>";



        $db->close();
        ?>

    </div>

</main>


<!-- Modal -->
<div class="modal fade" id="modalobject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить новый объект?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="mbody">
                <form action="/app/script.php" method="post">
                    <input type="text" class="form-control" placeholder="Название" name="objName" id="objName">
                    <input type="text" class="form-control mt-2" placeholder="Описание" name="objDescr" id="objDescr">
                    <input type="hidden" name="objLevel" id="objLevel">
                    <input type="hidden" name="objParent" id="objParent">
                    <button class="btn btn-success mt-2">Отправить</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>

            </div>
        </div>
    </div>
</div>