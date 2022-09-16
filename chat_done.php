<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php

    error_reporting(E_ALL & ~E_NOTICE);

    session_start();

    if($_POST['csrf_token']===$_SESSION['csrf_token']){
        try{
            $last_name=$_POST['last_name'];
            $first_name=$_POST['first_name'];
            $gender=$_POST['gender'];
            $mail=$_POST['mail'];
            $comment=$_POST['comment'];
    
            $mail=htmlspecialchars($mail,ENT_QUOTES,'UTF-8');
    
        
            date_default_timezone_set('Asia/Tokyo');
            $date = date('m月d日 H時i分s秒') ;
    
    
            $dsn='mysql:dbname=chat;host=localhost;charset=utf8';
            $user='root';
            $password='pass';
            $dbh=new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    
            $sql = 'INSERT INTO info_sent (last_name, first_name, mail, comment, gender, date) VALUES (?, ?, ?, ?, ?, ?)';
            $stmt = $dbh->prepare($sql);
            $data[] =$last_name;
            $data[] =$first_name;
            $data[] =$mail;
            $data[] =$comment;
            $data[] =$gender;
            $data[] =$date;
            $stmt->execute($data);
    
            $dbh=null;
    
            echo"コメントを書き込みました。<br>";
        }

        catch(Exception $e){
            echo"ただいま障害により大変ご迷惑をお掛けしております。";
            exit();
        }
    } 


    else {
        echo"不正なアクセスです。";
        exit();
    }


    ?>

    <a href="chat.php">戻る</a>

</body>
</html>