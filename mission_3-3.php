<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset ="UTF-8">
        <title misson_3-3></title>
    </head>
<body>
    <form avition=""method="post">
        <input type="text" name="text" placeholder="名前">
        <input type="com" name="com" placeholder="コメント">
        <input type="submit" value="送信">
        <br>
    </from>
    <from>
        <input type="delete" name="del" placeholder="削除対象番号">
        <input type="submit" value="削除">
        <br>
    </form>
        
        <?php
        $filename = "mission_3-3.txt";
        //もし送信フォームに文字があり
            if(!empty($_POST["text"]) && !empty($_POST["com"] )){
        //POST送信
                $text=$_POST["text"];
                $com=$_POST["com"];
                $timestamp= date("Y/m/d H:i:s");
        
         //テキストを保存する
                    if(file_exists($filename)){
                    //配列にする
                    $nums=file($filename);
                    //最大値を取得する
                    $max=max($nums);
                    
                    $max=(int)$max;
                    
                    $num=$max+1;
                    
                 }else{
                     $num = 1;
                 }
                $coment = $num."<>".$text."<>".$com."<>".$timestamp;
                //テキストに追記する
                $fp = fopen($filename,"a");
                fwrite($fp,$coment.PHP_EOL);
                fclose($fp);
                
            }
                
            
            if(!empty($_POST["del"])){
                
                $delete=$_POST["del"];
        
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                
                $fp = fopen($filename, "w");
        
                foreach($lines as $list){
            
                    $date = explode("<>",$list);
                
                    $postnum = $date;
                
                    if($date[0] !=$delete ){
                        fwrite($fp, $list.PHP_EOL);
                    }
                }
        
                fclose($fp);
                
            }
        //表示
        if(file_exists($filename)){
                 $lines = file($filename,FILE_IGNORE_NEW_LINES);
                //取得したファイルデータを全て表示する（ループ処理）
                foreach($lines as $list){
                //関数で値を取得
                $date = explode("<>",$list);
                //表示する
                echo $date[0] . $date[1] . $date[2] . $date[3] ."<br>";
                }
        }
        ?>
</body>
</html>

