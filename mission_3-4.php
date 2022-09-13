<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset ="UTF-8">
        <title misson_3-4></title>
    </head>
<body>
    
        <?php
        $filename="mission_3-4.txt";
        //もし送信フォームに文字があり
            if(!empty($_POST["name"]) && !empty($_POST["com"] ) ){
        //POST送信
                $name=$_POST["name"];
                $com=$_POST["com"];
                $timestamp= date("Y/m/d H:i:s");
                
        if(empty($_POST["n"])){
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
                $coment = $num."<>".$name."<>".$com."<>".$timestamp;
                //テキストに追記する
                $fp = fopen($filename,"a");
                fwrite($fp,$coment.PHP_EOL);
                fclose($fp);
                
            }
        if(!empty($_POST["n"])){
            $edit=$_POST["n"];
            $lines = file($filename, FILE_IGNORE_NEW_LINES);
            $fp=fopen($filename,"w");
            foreach($lines as $line){
                $data=explode("<>",$line);
            //編集の内容を送ったファイルを開く
                    //番号（＄date[0]とedit番号が一緒だったら
                    if($data[0]==$edit){
                       // $data[1]=$name;
                        //$data[2]=$com;
                        //$data[3]=$timestamp;
                    
                    fwrite($fp,$edit."<>".$name."<>".$com."<>".$timestamp.PHP_EOL);
                    }else{
                        fwrite($fp,$line.PHP_EOL);
                    }
            }
                    fclose($fp);
                    
                    }
            }
        
                
        
            //削除について    
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
            //編集について
            if(!empty($_POST["edit"])){
                
                $edit=$_POST["edit"];
                
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                
                 foreach($lines as $list){
                     
                    $date = explode("<>",$list);
                    //掲示板にある番号と編集番号が一致した場合
                    if($date[0]==$edit){
                        $newnum=$date[0];
                        $newname=$date[1];
                        $newcom=$date[2];
                        
                    }
                    
                    
            }
            }
       
            if(file_exists($filename)){
                $lines = file($filename,FILE_IGNORE_NEW_LINES);
                
                foreach($lines as $line){
                    
                    $date = explode("<>",$line);
                    
                    echo $date[0]. $date[1]. $date[2]. $date[3] ."<br>";
                }
            }
            ?>
            
        <!--投稿フォーム-->
    <form avition=""method="post">
        <input type="hidden" name="n" value="<?php if(!empty($_POST["edit"])){ echo $newnum;}else{echo "";}?>">
        <input type="text" name="name" placeholder="名前" value="<?php if(!empty($_POST["edit"])){ echo $newname;}else{echo "";}?>">
        <input type="com" name="com" placeholder="コメント" value="<?php if(!empty($_POST["edit"])){ echo $newcom;}else{echo "";}?>">
        <input type="submit" value="送信">
        <br>
    
    <!--削除フォーム-->
    
        <input type="delete" name="del" placeholder="削除対象番号">
        <input type="submit" value="削除">
        <br>
    
    <!--編集フォーム-->
    
        <input type="edit" name="edit" placeholder="編集対象番号">
        <input type="submit" value="編集">
        <br><br>
    </from>
        
        
</body>
</html>

