<?php
include_once "../base.php";
// $text=$_POST['text'];    變數能少盡量少
// $id=$_POST['id'];


if(!empty($_POST['id'])){
    foreach($_POST['id'] as $idx => $id){
        if(isset($_POST['del']) && in_array($id,$_POST['del'])){
            $Title->del($id); 
        }else{
            $row=$Title->find($id);
            //更新文字欄位
            $row['text']=$_POST['text'][$idx]; //附上不會因為刪除而變動的索引值
            $row['sh']=(isset($_POST['sh']) && $_POST['sh']==$id)?1:0;
            $Title->save($row);
        }
    }


}


//2.更新顯示狀態




to('../back.php?do=title'); //資料從哪來就回到哪裡
?>
