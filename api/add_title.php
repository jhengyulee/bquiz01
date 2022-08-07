<?php
include_once "../base.php";
$text=$_POST['text'];

if(isset($_FILES['img']['tmp_name'])){  //有['tmp_name']表示檔案上傳成功
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);//從$_FILES['img']['tmp_name']移動到img資料夾裡，並且賦予檔名
    $img=$_FILES['img']['name'];
}

//目前以解題為主，故不做檔案格式判斷，實際工作要

$data=['img'=>$img,'text'=>$text,'sh'=>0];

$Title->save($data); //$data沒有id資料  新增語法

to('../back.php?do=title'); //資料從哪來就回到哪裡
?>
