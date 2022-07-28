<div style="width:1024px; left:0px; position:relative; background:#FC3; margin-top:4px; height:123px; display:block;">
                	<span class="t" style="line-height:123px;">
					<?php
					// $bottom= new DB('bottom');//給定一個參數bottom給$table bottom是資料表名稱
					echo $Bottom->find(1)['bottom']; //show出index=1的bottom這個欄位的值
					//上述find(1)的回傳值為pdo->query($sql)->fetch(PDO::FETCH_ASSOC)可存進$rows  則echo $rows['bottom']
					?>
					</span>
</div>