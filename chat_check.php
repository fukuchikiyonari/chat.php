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

    if($_SESSION['csrf_token'] === $_POST['csrf_token']){

        $last_name=$_POST['last_name'];
        $first_name=$_POST['first_name'];
        $mail=$_POST['mail'];
        $comment=$_POST['comment'];
        $gender=$_POST['gender'];
    
        $mail=htmlspecialchars($mail,ENT_QUOTES,'UTF-8');
    
        $okflg=true;
    
        if($last_name==""){
            echo"苗字が入力されていません!<br><br>";
            $okflg=false;
         }
        else{
            echo 'セイ<br>';
            echo $last_name;
            echo '<br><br>';
        }
        if($first_name==""){
            echo"名前が入力されていません!<br><br>";
            $okflg=false;
        }
        else{
            echo 'メイ<br>';
            echo $first_name;
            echo '<br><br>';
        }

        if($gender==""){
            echo"性別を選択してください!<br><br>";
            $okflg=false;
        }
        else{
            echo '性別<br>';
            echo $gender;
            echo '<br><br>';
        }
    
        if(preg_match("/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/", $mail)==0){
             echo"メールアドレスを正確に入力してください!<br><br>";
            $okflg=false;
        }
        else{
            echo 'メールアドレス<br>';
            echo $mail;
            echo '<br><br>';
        }
        if($comment==''){
            echo"コメントが入力されていません!<br><br>";
            $okflg=false;
        }
        else{
            echo 'コメント<br>';
            echo $comment;
            echo '<br><br>';
        }
        
        if($okflg==true){    
            echo '<form method="post" action="chat_done.php">';
            echo'<input type="hidden" name="last_name" value="'.$last_name.'">';
            echo'<input type="hidden" name="first_name" value="'.$first_name.'">';
            echo'<input type="hidden" name="mail" value="'.$mail.'">';
            echo'<input type="hidden" name="comment" value="'.$comment.'">';
            echo'<input type="hidden" name="gender" value="'.$gender.'">';
            echo'<input type="hidden" name="csrf_token" value="'.$_POST['csrf_token'].'">';
            echo '<input type="button" onclick="history.back()" value="戻る">';
            echo '<input type="submit" value="ＯＫ"><br />'; 
            echo '</form>';  
        }
        else{
            print '<form>';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '</form>';
        }
    
    }   
    
    
else {
         echo"不正なリクエストです。";
         exit();
    }
         
    ?>
    
</body>
</html>