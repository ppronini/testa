<?php
require_once "lib.php";
$db=new db();
$date=datenow();

if(isset($_POST['objLevel'])){
    $role=$_SESSION['role'];

    if($role==="admin"){

        $objName=val($_POST['objName']);
        $objDescr=val($_POST['objDescr']);
        $levelNow=(int)val($_POST['objLevel'])+1;
        $objParent=val($_POST['objParent']);
        $date=datenow();

//        Если будет прям много запросов могу загнать код в цикл while, чтобы обеспечить уникальность
        $code=generateRandomString(5).rand(1,255);

        if($db->query("INSERT INTO objects(name,descr,level,date,code,parent) VALUES(?,?,?,?,?,?)",$objName,$objDescr,$levelNow,$date,$code,$objParent)){
            if($objParent!="root"){
                $db->query("UPDATE objects SET haschild=? WHERE code=?","yes",$objParent);
            }

              header("location:/?success");
        } else{
            header("location:/?smthwrong");
        }

    } else{
        header("location:/?youshallnotpass");
    }
}


if(isset($_POST['deletemecode'])){
    $code2delete=val($_POST['deletemecode']);

    $checkQ=$db->query("SELECT haschild FROM objects WHERE code=?",$code2delete)->numRows();
    if($checkQ>0){
        $childQ=$db->query("SELECT haschild FROM objects WHERE code=?",$code2delete)->fetchArray();
        $haschild=$childQ['haschild'];
        if($_SESSION['role']==="admin"){
            if($haschild==="no"){
                $db->query("DELETE FROM objects WHERE code=?",$code2delete);
                echo"delok";
            } else{
                $db->query("DELETE FROM objects WHERE code=?",$code2delete);
                $db->query("DELETE FROM objects WHERE parent=?",$code2delete);
                echo"delallok";
            }


        }
    } else{
        echo"notexists";
    }

}

$db->close();
