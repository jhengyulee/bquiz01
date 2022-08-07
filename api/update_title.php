<?php
include_once "../base.php";

//只會有圖片檔傳過來
if(isset($_FILES['img']['tmp_name'])){  //有['tmp_name']表示檔案上傳成功
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);//從$_FILES['img']['tmp_name']移動到img資料夾裡，並且賦予檔名
    $img=$_FILES['img']['name'];
}

//目前以解題為主，故不做檔案格式判斷，實際工作要

$id=$_POST['id'];
$row=$Title->find($id);
$row['img']=$img;//上面帶的img
$Title->save($row); //$data沒有id資料  新增語法

echo $id;
print_r($row);

to('../back.php?do=title'); //資料從哪來就回到哪裡
?>
