<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チャット</title>
    <style type="text/css"> 
        *{margin: 0;padding: 0;list-style: none;}
        .wrap{
            width: 600px;
            margin: 0 auto;
            padding: 20px 0 100px 0;
            background: #f1f1f2;
            min-height: 100vh;
        }
        .comment{
            position: relative;
            padding: 10px 20px;
            margin: 0 10px 10px 10px;
            background-color: #fff;
            border-radius: 5px;
        }
        .CommentInDate{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 10px;
            font-size: 12px;
            color: #ccc;
        }
        .CommentInPersonal{
            transform: translateY(40%);
            font-size: 12px;  
        }
        form{
            position: fixed;
            top: 10%;
            left: 5vw;
        }
        .last_name_input{
            display: inline-block;
        }
        .first_name_input{
            display: inline-block;
        }


    </style>
</head>
<body>

    <?php
    session_start();
 
    $token_byte = openssl_random_pseudo_bytes(16);
    $csrf_token = bin2hex($token_byte);
    $_SESSION['csrf_token'] = $csrf_token;
    ?>    


    <form method="post" action="chat_check.php">
    <div class="last_name_input">        
    セイ<br>
    <input type="text" name="last_name"  style="width: 140px"><br>
    </div>
    <div class="first_name_input">
    メイ<br>
    <input type="text" name="first_name"  style="width: 140px"><br>
    </div><br>
    性別　　　男性
    <input type="radio" name="gender" value="男性">
    女性
    <input type="radio" name="gender" value="女性"><br>
    メールアドレス<br>
    <input type="text" name="mail"  style="width: 290px"><br> 
    コメント<br>
    <input type="text" name="comment"  style="width: 290px ; height: 290px;"><br>
    <input type="hidden" name="csrf_token" value="<?php  echo $_SESSION['csrf_token']; ?>">
    
    <input type="submit" value="送信">
    </form>
    
  
    <div class="wrap">

    <?php

    try{
        $dsn='mysql:dbname=chat;host=localhost;charset=utf8';
        $user='root';
        $password='';
        $dbh=new PDO($dsn,$user,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT last_name, first_name, mail, comment, gender, date FROM info_sent WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh=null;

    while(true){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false){
            break;
        }
        echo'<div class="comment">'; 
        echo $rec['comment'];
        echo'<br>';

        echo'<div class="CommentInDate">';
        echo $rec['date'];
        echo'</div>';

        echo'<div class="CommentInPersonal">';
        echo $rec['last_name'];
        
        echo $rec['first_name'];
        echo "　";

        echo $rec['gender'];
        echo "　";

        echo $rec['mail'];
        echo'<br>'; 
        echo'</div>';
        
        echo'</div>';
    }
}
catch(Exception $e){
    echo"ただいま障害により大変ご迷惑をお掛けしております。";
    exit();
}

?>
</div>

</body>
</html>