<?php
include_once "../base.php";
$text=$_POST['text'];



//目前以解題為主，故不做檔案格式判斷，實際工作要

$data=['text'=>$text,'sh'=>1];

$Ad->save($data); //$data沒有id資料  新增語法

to('../back.php?do=ad'); //資料從哪來就回到哪裡
?>
