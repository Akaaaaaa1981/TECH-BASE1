<!DOCTYPE html>
<html lang = "ja">
    <hear>
        <meta charset = "UTF-8">
        <title>mission_3-1</title>
    </hear>
<body>
    <form avition=""method="post">
        <input type="text" name="text" placeholder="名前">
        <input type="com" name="com" placeholder="コメント">
        <input type="submit" value="送信">
    </form>
    <?php
        $filename="misson_3-2.txt";
        //テキストがから出ないとき
        if(!empty($_POST["text"])){
            //受信：変数にPOSTされたコメントを代入する
            $text=$_POST["text"];
            $com =$_POST["com"];
            $timestamp = date("Y/m/d H:i:s");
        
            //ファイルがあるか確認する
                 if(file_exists($filename)){
                    //数える
                    $num = count(file($filename)) + 1;
                 }else{
                     $num = 1;
                 }
                 $coment = $num."<>".$text."<>".$com."<>".$timestamp;
            //テキストに追記する
            $fp = fopen($filename,"a");
            fwrite($fp,$coment.PHP_EOL);
            fclose($fp);
        }
        if(file_exists($filename)){
        

        //配列に格納
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