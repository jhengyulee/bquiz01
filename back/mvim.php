
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
    <!-- 用物件導向做文字管理 將不同頁面欄位文字變數化 -->
    <p class="t cent botli"><?=$Str->header;?></p>
    <form method="post" action="./api/edit.php">
        <table width="100%">
            <tbody>
                <tr class="yel">
                    <td width="70%"><?=$Str->tdHead[0];?></td>
                    <td width="10%">顯示</td>
                    <td width="10%">刪除</td>
                    <td></td>
                </tr>
                <?php
                    
                    $rows=$DB->all();
                    foreach($rows as $row){
                     
                ?>
                <tr>
                    <td >
                        <img src="./img/<?=$row['img'];?>" style="width:120px;height:80px">
                    </td>
                    
                    <td >
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=($row['sh']==1)?'checked':'';?>> <!-- 欄位為1 而顯示被勾選的判斷-->
                    </td>
                    <td >
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                    </td>
                    <td>
                        <input type="button" value="<?=$Str->updateImg;?>" 
                               onclick="op('#cover','#cvr','./modal/update_title.php?id=<?=$row['id'];?>')"> <!--按下按鈕時就給相對應的id-->
                    </td>
                </tr>
                <!-- 隱藏欄位放在迴圈內任一處都可以 -->
                <input type="hidden" name="id[]" value="<?=$row['id'];?>"> 
                <?php
                }
                
                ?>
            </tbody>
        </table>
        <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px">
                           <input type="button" onclick="op('#cover','#cvr','./modal/<?=$Str->table;?>.php?do=<?=$Str->table;?>')"  
                            value="<?=$Str->addBtn;?>"> 
                    </td>
                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
                </tr>
            </tbody>
        </table>
        <!-- 表單送出告知是哪張資料表 -->
        <input type="hidden" name="table" value="<?=$do;?>">
    </form>
</div>