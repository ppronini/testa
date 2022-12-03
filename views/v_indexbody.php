<main class="container">
  <div class="row">
      <div class="col-lg-12">

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

          elseif(isset($_REQUEST['successedit'])){
              echo"<p class='alert alert-success'>Успешно редактировали Объект с кодом: {$_REQUEST['successedit']}.</p>";
          }

          elseif(isset($_REQUEST['failededit'])){
              echo"<p class='alert alert-danger'>Внимание ошибка редактирования ОР-1</p>";
          }
          ?>

      </div>
  </div>



    <div class="row">
        <?php
        $db=new db();
        function printMe($code, $mode="admin"){
            global $db;

            $hasQ=$db->query("SELECT * FROM objects WHERE code=? AND status=?",$code,"ok")->fetchArray();
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

            if($level<5){
                $fweight=$level*150;
            } else{
                $fweight=5*150;
            }


            if($level===1){
                $bg="background-color:Gainsboro";
            } else{
                $bg="";
            }

            if($level>1){
                $classhide='hidden';
            } else{
                $classhide="";
            }

            if($hasChildren==="no"){
                if($mode==="admin"){
                    echo"
                <div style='padding-left: {$padding}px; font-weight:$fweight;$bg' class='treediv $parent'>
                {$addstring}Название: <span id='idname{$code}'>$name</span>,
                 Описание: <span id='iddescr{$code}'>$descr</span>, Код: $code, Уровень:$level, Дата создания: $date (<a href='#' class='link-success addnewobjecta' data-code='$code' data-level='$level'>Добавить потомка</a> ||| <a href='#' class='link-warning editobject' data-code='$code'>Редактировать</a> ||| <a href='#' class='link-danger deleteobject' data-code='$code' data-objname='$name'>Удалить</a>)(ОТЕЦ: $parent)
                 </div>
                ";
                } else{
                    echo"
                <div style='padding-left: {$padding}px; font-weight:$fweight;$bg' class='$classhide treediv $parent'>
                {$addstring}Название: <a href='#' class='showdescruser' data-code='$code'>$name</a>
                </div>
                ";
                }

            } else{
                if($mode==="admin"){
                    echo"
                <div style='padding-left: {$padding}px; font-weight:$fweight;$bg' class='treediv $parent'>
                {$addstring}Название: <span id='idname{$code}'>$name</span>, Описание: <span id='iddescr{$code}'>$descr</span>, Код: $code, Уровень:$level, Дата создания: $date (<a href='#' class='link-success addnewobjecta' data-code='$code' data-level='$level'>Добавить потомка</a> ||| <a href='#' class='link-warning editobject' data-code='$code'>Редактировать</a> ||| <a href='#' class='link-danger deleteobject' data-code='$code' data-objname='$name'>Удалить</a>) (ОТЕЦ: $parent)
                </div>
                ";
                    $childrenQ=$db->query("SELECT * FROM objects WHERE parent=? AND status=?",$code,"ok")->fetchAll();
                    foreach ($childrenQ as $rowC){
                        $childCode=$rowC['code'];
                        printMe($childCode);

                    }
                } else{
                    echo"
                <div style='padding-left: {$padding}px; font-weight:$fweight;$bg' class='$classhide treediv $parent'>
                {$addstring}Название: <a href='#' class='showdescruser' data-code='$code'>$name</a> <a href='#' class='btn btn-sm btn-success showmore' data-2show='$parent' data-level='$level' data-code='$code'>+</a></div>
                ";
                    $childrenQ=$db->query("SELECT * FROM objects WHERE parent=? AND status=?",$code,"ok")->fetchAll();
                    foreach ($childrenQ as $rowC){
                        $childCode=$rowC['code'];

                        printMe($childCode,"user");

                    }
                }


            }


        }
        if(isset($_SESSION['email']) AND $_SESSION['role']==="admin"){


            echo"<div class='col-lg-12'>
                 <a href='#' class='addnewobjecta' data-level=0 data-code='root'>Добавить новый корневой объект?</a>
                 </div>";

            echo"<h1>Дерево объектов (Режим администратора)</h1>";

            $mainQ=$db->query("SELECT * FROM objects WHERE level=? AND status=?",1,"ok")->fetchAll();

            echo"<div class='col-lg-12'>";
            foreach ($mainQ as $row){
                $code=$row['code'];

                printMe($code);


            }

            echo"</div>";
        } else{
            $mainQ=$db->query("SELECT * FROM objects WHERE level=? AND status=?",1,"ok")->fetchAll();
            echo"<h1>Добро пожаловать на сайт тестового задания Пронина Павла</h1>
                 <div class='col-lg-8'>";

            foreach ($mainQ as $row){
                $code=$row['code'];

                printMe($code,"user");


            }
                 echo"</div>";

            echo"<div class='col-lg-4'>
                 <label for='showDescrFromObj' class='b'>Описание объекта</label>
                 <textarea id='showDescrFromObj' rows='11' class='form-control'>Пожалуйста выберите описание объекта, нажав на его Название в колонке слева</textarea>
                 </div>";
        }




        $db->close();
        ?>

    </div>

</main>


<!-- Modal new object-->
<div class="modal fade" id="modalobject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавить новый объект?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="mbody">
                <form action="/app/script.php" method="post">
                    <label for="objName">Название объекта</label>
                    <input type="text" class="form-control" placeholder="Название" name="objName" id="objName">
                    <label for="objDescr" class="mt-2">Описание объекта</label>
                    <input type="text" class="form-control" placeholder="Описание" name="objDescr" id="objDescr">
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
<!-- Modal new object!!!-->

<!-- Modal edit object-->
<div class="modal fade" id="modaleditobject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabele">Редактировать объект<span id="editmeobject"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="mbodyedit">
                <form action="/app/script.php" method="post">
                    <label for="objNameEdit">Название объекта</label>
                    <input type="text" class="form-control" name="objNameEdit" id="objNameEdit">
                    <label for="objDescrEdit" class="mt-2">Описание объекта</label>
                    <input type="text" class="form-control" name="objDescrEdit" id="objDescrEdit">
                    <label for="objDescrEdit" class="mt-2">Код объекта (только чтение)</label>
                    <input type="text" class="form-control" name="objCodeEditMe" id="objCodeEditMe" readonly>

                    <button class="btn btn-success mt-2">Отправить</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>

            </div>
        </div>
    </div>
</div>
<!-- Modal new object!!!-->