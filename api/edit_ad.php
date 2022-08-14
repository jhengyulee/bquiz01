<?php
include_once "../base.php";
// $text=$_POST['text'];    變數能少盡量少
// $id=$_POST['id'];


if(!empty($_POST['id'])){
    foreach($_POST['id'] as $idx => $id){
        if(isset($_POST['del']) && in_array($id,$_POST['del'])){
            $Ad->del($id);   
        }else{
            //多選
            $row=$Ad->find($id);
            //更新文字欄位
            $row['text']=$_POST['text'][$idx]; //附上不會因為刪除而變動的索引值
            $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0; //由edit title的單選 變成 多選 所以判斷式不同
            $Ad->save($row);
        }
    }


}


//2.更新顯示狀態




to('../back.php?do=ad'); //資料從哪來就回到哪裡
?>
