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

function deleteObject($code){
    global $db;
    $childQ=$db->query("SELECT haschild FROM objects WHERE code=?",$code)->fetchArray();
    $haschild=$childQ['haschild'];
    $date=datenow();
    if($_SESSION['role']==="admin"){
        if($haschild==="no"){
            $db->query("UPDATE objects SET status=?,statusdate=?,statusby=? WHERE code=?","deleted",$date,$_SESSION['email'],$code);

        } else{
            $db->query("UPDATE objects SET status=?,statusdate=?,statusby=?,haschild=? WHERE code=?","deleted",$date,$_SESSION['email'],"no",$code);
            $childrenQ=$db->query("SELECT * FROM objects WHERE parent=?",$code)->fetchAll();

            foreach ($childrenQ as $rowch){
                $codeCh=$rowch['code'];
                deleteObject($codeCh);
            }
        }
    }
}

if(isset($_POST['deletemecode'])){
    $code2delete=val($_POST['deletemecode']);
    $checkQ=$db->query("SELECT haschild FROM objects WHERE code=?",$code2delete)->numRows();
    if($checkQ>0){
        deleteObject($code2delete);
        echo"delok";
    } else{
        echo"notexists";
    }

}


if(isset($_POST['objCodeEditMe'])){
    $code2edit=val($_POST['objCodeEditMe']);
    $objDescr2edit=val($_POST['objDescrEdit']);
    $objName2edit=val($_POST['objNameEdit']);

    $checkQ=$db->query("SELECT 1 FROM objects WHERE code=? AND status=?",$code2edit,"ok")->numRows();
    if($checkQ>0){
        if($_SESSION['role']==="admin"){
            $journalQ=$db->query("SELECT * FROM objects WHERE code=? AND status=?",$code2edit,"ok")->fetchArray();
            $jnameold=$journalQ['name'];
            $jdescrold=$journalQ['descr'];
            $date=datenow();

            $db->query("INSERT INTO editjournal (user,date,jnameold,jdescrold,objcode) VALUES(?,?,?,?,?)",$_SESSION['email'],$date,$jnameold,$jdescrold,$code2edit);
            $db->query("UPDATE objects SET name=?, descr=? WHERE code=?",$objName2edit,$objDescr2edit,$code2edit);
            header("location:/?successedit=$code2edit");
        }
    } else{
        header("location:/?failededit");
    }

}

if(isset($_POST['showmedescrobject'])){
    $codeshow=val($_POST['showmedescrobject']);

    $checkQ=$db->query("SELECT 1 FROM objects WHERE code=? AND status=?",$codeshow,"ok")->numRows();
    if($checkQ>0){
        $showQ=$db->query("SELECT descr FROM objects WHERE code=?",$codeshow)->fetchArray();
        $descr=$showQ['descr'];
        echo"$descr";
    } else{
        echo "cantshow";
    }
}

$db->close();
