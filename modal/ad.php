<h3 style="text-align: center;">新增動態文字廣告</h3>
<hr>
<!-- enctype="multipart/form-data" 才能上傳圖片檔案 -->
<form action="./api/add_ad.php" method="post" enctype="multipart/form-data"> 
    <table>
        <tr>
            <td>動態文字廣告:</td>
            <td><input type="text" name="text"></td>
        </tr>
    
    </table>
    
    <div>
        <input type="submit" value="新增">
        <input type="reset" value="重置">
    </div>
</form>