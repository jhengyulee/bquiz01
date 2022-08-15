<?php
include_once "../base.php";

$DB=new DB($_POST['table']);


//有圖片資料上傳
$data=[];//宣告data為空陣列型態變數 PHP為動態語言 不設定也可以運作 但可能出問題
if(isset($_FILES['img']['tmp_name'])){  //有['tmp_name']表示檔案上傳成功
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);//從$_FILES['img']['tmp_name']移動到img資料夾裡，並且賦予檔名
    $data['img']=$_FILES['img']['name'];
}

//有文字資料上傳
if(isset($_POST['text'])){
    $data['text']=$_POST['text'];
}

//格式不同的三個頁面特別做設定
switch($_POST['table']){
    case 'title':
        $data['sh']=0;
    break;
    case 'admin':
        $data['acc']=$_POST['acc'];
        $data['pw']=$_POST['pw'];
    break;
    case 'menu':
        $data['text']=$_POST['text'];
        $data['href']=$_POST['href'];
        $data['sh']=1;
    break;
    default:
        $data['sh']=1;

}


$DB->save($data); //$data沒有id資料  新增語法

to("../back.php?do=$DB->table"); //資料從哪來就回到哪裡
?>
