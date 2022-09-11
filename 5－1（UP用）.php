<?php
//記入例；以下はで挟まれるPHP領域に記載すること。
    //4-2以降でも毎回接続は必要。
    //$dsnの式の中にスペースを入れないこと！


    // DB接続設定
    $dsn = 'mysql:dbname=データベース名;host=localhost';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    $sql = "CREATE TABLE IF NOT EXISTS 5_Ctable"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT,"
    . "cdate datetime"
    .");";
    $stmt = $pdo->query($sql);


    //表示↓
    //$sql ='SHOW TABLES';
    //$result = $pdo -> query($sql);
    //foreach ($result as $row){
      //  echo $row[0];
        //echo '<br>';
    //}
    //echo "<hr>";
    
    

    if(!empty($_POST["text"]) && !empty($_POST["com"])){
        $text=$_POST["text"];
        $com=$_POST["com"];
        
    if(empty($_POST["n"])){
    //データ入力↓
    $sql = $pdo -> prepare("INSERT INTO 5_Ctable (name, comment,cdate) VALUES (:name, :comment,now())");
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    $name = $text;
    $comment = $com; //好きな名前、好きな言葉は自分で決めること
    $sql -> execute();
    //bindParamの引数名（:name など）はテーブルのカラム名に併せるとミスが少なくなります。最適なものを適宜決めよう。
    }
    
    
    if(!empty($_POST["n"])){
            $editnum=$_POST["n"];
            
    //編集の大元！！！↓
    //隠れているフォームとかに数字が出てくるようになったら！
       $id = $editnum; //変更する投稿番号
    $name = $text;
    $comment = $com; //変更したい名前、変更したいコメントは自分で決めること
    $sql = 'UPDATE 5_Ctable SET name=:name,comment=:comment,cdate=now() WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    }
    
    }
    
    //削除機能↓
    if(!empty($_POST["del"])){
        $del=$_POST["del"];
    $id = $del;
    $sql = 'delete from 5_Ctable where id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    }
    //}
    
    //編集機能↓
    if(!empty($_POST["edit"])){
                
        $edit=$_POST["edit"];
                
        $id = $edit ; // idがこの値のデータだけを抽出したい、とする
        $sql = 'SELECT * FROM 5_Ctable WHERE id=:id ';
        $stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
        $stmt->execute();                             // ←SQLを実行する。
        $results = $stmt->fetchAll(); 
            foreach ($results as $row){
                
                
                if($row[0]==$edit){
                        $newnum=$row[0];
                        $newname=$row[1];
                        $newcom=$row[2];
                
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].'<br><br>';
            echo "<hr>";
        }
                        
    }
    }
    //}
                    
                 
    
    
    
    //データ表示↓
    //$rowの添字（[ ]内）は、「カラム」の名称に併せる必要があります。
    $sql = 'SELECT * FROM 5_Ctable';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].',';
        echo $row["cdate"]."<br>";
    echo "<hr>";
    }
    
    ?>
    
    <form avition=""method="post">
        <input type="hidden" name="n" placeholder="隠す番号" value="<?php if(!empty($_POST["edit"])){ echo $id;}else{echo "";}?>"><br>
        <input type="text" name="text" placeholder="名前" value="<?php if(!empty($_POST["edit"])){ echo $newname;}else{echo "";}?>">
        <input type="com" name="com" placeholder="コメント" value="<?php if(!empty($_POST["edit"])){ echo $row['comment'];}else{echo "";}?>">
        <input type="submit" value="送信">
        <br>     
    <input type="delete" name="del" placeholder="削除対象番号">
        <input type="submit" value="削除">
        <br>
    <input type="edit" name="edit" placeholder="編集対象番号">
        <input type="submit" value="編集">
        <br><br>
    </form>
    
  
    
    
</body>
</html>



