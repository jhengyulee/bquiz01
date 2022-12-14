<?php
date_default_timezone_set('Asia/Taipei');
session_start();

class DB
{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db24";
    protected $user='root';
    protected $pw='';
    // protected $table=""; //是指空字串 跟下方資料型態不同
    public $table; //這個class的table 空的東西
    protected $pdo;

    public function __construct($table) //設定一個必須給的參數  來自於外部
    {
         $this->table=$table; //$this->table(這個class的table)由外部指定
         $this->pdo=new PDO($this->dsn,$this->user,$this->pw);
    
        
    }

    // all() start-------------------------------------------------------------------------------------
    //取多筆資料
    public function all(...$arg){    //all()寫好用來發展後面其他函式就很快
        $sql="SELECT * FROM $this->table "; //最後要空格
        
        if(isset($arg[0])){    //判斷$arg[0]是不是存在
            if(is_array($arg[0])){    //不是陣列就是字串
                foreach($arg[0] as $key => $value){  //是陣列就迴圈一一取出
                    $tmp[]="`$key`='$value'";  //設一個暫存陣列存放 取出的key 和 value
                }
            
                $sql .= " WHERE " . join(" AND ", $tmp);  //組成sql語句，用AND表示所有條件都須符合AND串起的字串
                            // 舉例；上句會得到類似 WHERE `id`=1 AND `room`='vip'的字串
            }else{
                $sql .= $arg[0];
            } 
        }
    // -------------預設可能會有2個參數代入加的判斷 不一定會用到--------------
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
    // ----------------------------        

    // return $sql; 
    // 預備好  除錯用  希望別用到
    
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);  
    }
    // all() end------------------------------------------------------------------------------



    // find() start---------------------------------------------------------------------------
    //只取一筆資料
    //用all()修改
    public function find($id){    //固定參數$id
        $sql="SELECT * FROM $this->table "; //最後要空格
               
            if(is_array($id)){    //不是陣列就是字串
                foreach($id as $key => $value){  //是陣列就迴圈一一取出
                    $tmp[]="`$key`='$value'";  //設一個暫存陣列存放 取出的key 和 value
                }
            
                $sql .= " WHERE " . join(" AND ", $tmp);  //組成sql語句，用AND表示所有條件都須符合AND串起的字串
                            // 舉例；上句會得到類似 WHERE `id`=1 AND `room`='vip'的字串
            }else{
                $sql .= " WHERE `id` = '$id' "; //判斷為字串得到id後的固定寫法
            } 
    
   

    // return $sql;
    // 預備好  除錯用  希望別用到
    
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);  
    }
    // find() end-------------------------------------------------------------------------------    

    // del() start----------------------------------------------------------------------
    //用find()修改:sql語句以及不須回傳資料修改即可 其他不動
    public function del($id){    //固定參數$id
        $sql="DELETE FROM $this->table "; //最後要空格
               
            if(is_array($id)){    //不是陣列就是字串
                foreach($id as $key => $value){  //是陣列就迴圈一一取出
                    $tmp[]="`$key`='$value'";  //設一個暫存陣列存放 取出的key 和 value
                }
            
                $sql .= " WHERE " . join(" AND ", $tmp);  //組成sql語句，用AND表示所有條件都須符合AND串起的字串
                            // 舉例；上句會得到類似 WHERE `id`=1 AND `room`='vip'的字串
            }else{
                $sql .= " WHERE `id` = '$id' "; //判斷為字串得到id後的固定寫法
            } 
    
   

    // return $sql; 
    // 預備好  除錯用  希望別用到
    
        return $this->pdo->exec($sql);  
    }

    // del() end-------------------------------------------------------------------------


    // save() start----------------------------------------------------------------------------
    //由del()修改而成
    public function save($array){    //固定陣列參數$array

        
        if(isset($array['id'])){ //陣列中有id欄位 代表從資料庫撈出來的資料 做更新動作
            //更新
            foreach($array as $key => $value){  //是陣列就迴圈一一取出
                if($key!='id'){ //id不需要被更新 故不是id才存進$tmp 
                    $tmp[]="`$key`='$value'";  //
                }
            }
            
            $sql="UPDATE $this->table SET " . join(',',$tmp)." WHERE `id`='{$array['id']}'";//將上方取出的值接到原本的$sql後面
            // 等同於
            // $sql.="UPDATE $this->table SET ";
            // $sql.=join(',',$tmp);
            // $sql.=" WHERE `id`='{$array['id']}'";


        }else{ //沒有id欄位表示做新增動作
            //新增
            $sql="INSERT INTO $this->table (`".join("`,`",array_keys($array))."`) VALUES ('".join("','",$array)."')";//特別注意湊INSERT語法 提示: 大象
            //第一個括弧放要新增的欄位(key值)  第二個括弧放要新增的欄位值                                                                                                        

        }
    // return $sql; 
    // 預備好  除錯用  希望別用到
    
        return $this->pdo->exec($sql);  
    }




    // save() end----------------------------------------------------------------------------------- 

    // math() start-------------------------------------------------------------------------------
    //由all()修改而成
    public function math($math,$col,...$arg){    //必代參數$math,$col
        $sql="SELECT $math($col) FROM $this->table "; //$math($col)是一個計算結果 為單一數值 不會有多筆資料
        
        if(isset($arg[0])){    //判斷$arg[0]是不是存在
            if(is_array($arg[0])){    //不是陣列就是字串
                foreach($arg[0] as $key => $value){  //是陣列就迴圈一一取出
                    $tmp[]="`$key`='$value'";  //設一個暫存陣列存放 取出的key 和 value
                }
            
                $sql .= " WHERE " . join(" AND ", $tmp);  //組成sql語句，用AND表示所有條件都須符合AND串起的字串
                            // 舉例；上句會得到類似 WHERE `id`=1 AND `room`='vip'的字串
            }else{
                $sql .= $arg[0];
            } 
        }
    // -------------預設可能會有2個參數代入加的判斷 不一定會用到--------------
        if(isset($arg[1])){
            $sql .= $arg[1];
        }
    // ----------------------------        

    // return $sql; 
    // 預備好  除錯用  希望別用到
    
        return $this->pdo->query($sql)->fetchColumn();  
    }
    // math() end----------------------------------------------------------------------------------

    //q() start----------------------------------------------------------------------------------
    // 萬用語法 回傳二維陣列   
    public function q($sql){
            // return $sql
            return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
    //q() end----------------------------------------------------------------------------------


}


 //寫在物件導向外面 可有可無 節省時間

function to($url){
    header("location:".$url);
}  

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

//利用物件導向管理標題文字
class Str{
    public $header; 
    // public $imgHead;
    // public $textHead; tdHead取代
    public $tdHead;
    public $updateImg;
    public $acc;
    public $pw;
    public $mainText;
    public $mainHref;
    public $subText;
    public $subHref;
    public $addBtn;
    public $addModalHeader;
    public $addModalcol;//用陣列方式處理
    public $table;

    public function __construct($table)
    {
        $this->table=$table;
        switch($table){
            case 'title':
                $this->header="網站標題管理";              
                $this->tdHead=["網站標題","替代文字"];
                $this->updateImg="更新圖片";
                $this->addBtn="新增網站標題圖片";
                $this->addModalHeader="新增標題區圖片";
                $this->addModalcol=["標題區圖片","標題區替代文字"];
                break;
            case 'ad':
                $this->header="動態文字廣告管理";
                $this->tdHead=["動態文字廣告"];
                $this->addBtn="新增動態文字廣告";
                $this->addModalHeader="新增動態文字廣告";
                $this->addModalcol=["動態文字廣告"];
                break;
            case 'image':
                $this->header="校園映象資料管理";
                $this->tdHead=["校園映象資料圖片"];
                $this->updateImg="更換圖片";
                $this->addBtn="新增校園映象圖片";
                $this->addModalHeader="新增校園映象圖片";
                $this->addModalcol=["校園映象圖片"];
                break; 
            case 'mvim':
                $this->header="動畫圖片管理";
                $this->tdHead=["動畫圖片"];
                $this->updateImg="更換動畫";
                $this->addBtn="新增動畫圖片";
                $this->addModalHeader="新增動畫圖片";
                $this->addModalcol=["動畫圖片"];
                break;
            case 'total':
                $this->header="進站總人數管理";
                $this->tdHead=["進站總人數"];
                break;
            case 'bottom':
                $this->header="頁尾版權資料管理";
                $this->tdHead=["頁尾版權資料"];
                break;
            case 'news':
                $this->header="最新消息資料管理";
                $this->tdHead=["最新消息資料內容"];
                $this->addBtn="新增最新消息資料";
                $this->addModalHeader="新增最新消息資料";
                $this->addModalcol=["最新消息資料"];
                break;
            case 'admin':
                $this->header="管理者帳號管理";
                $this->tdHead=["帳號","密碼"];
                $this->addBtn="新增管理者帳號";
                $this->addModalHeader="新增管理者帳號";
                $this->addModalcol=["帳號","密碼","確認密碼"];
                break;
            case 'menu':
                $this->header="選單管理";
                $this->tdHead=["主選單名稱","選單連結網址","次選單數"];
                $this->addBtn="新增主選單";
                $this->addModalHeader="新增主選單 ";
                $this->addModalcol=["主選單名稱","選單連結網址"];
                break;
           
        }
    }
    
}


//宣告$Bottom為new DB
$Bottom= new DB('bottom');//直接把bottom丟進$arg[] 請參考上面所設定的物件導向
$Total= new DB('total');//直接把bottom丟進$arg[] 請參考上面所設定的物件導向
$Title=new DB('title');
$Ad=new DB('ad');
$Image=new DB('image');
$Mvim=new DB('mvim');
$News=new DB('news');
$Admin=new DB('admin');
$Menu=new DB('menu');

$Str=new Str($do);

// print_r($Bottom->all("WHERE `id`='1'")); //不代參數、陣列型態、字串型態都可呈現想要的結果


//判斷訪客進站後到各頁面也不重複計算拜訪人數
if(empty($_SESSION['view'])){
    $view=$Total->find(1);
    $view['view']++;
    $Total->save($view);
    $_SESSION['view']=1;
}
?> 