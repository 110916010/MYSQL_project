<!-- 對應帳號和密碼是否儲存在資料庫裡，若有則順利導入buy_books.php，若無則跳回登入畫面並且顯示帳號或密碼錯誤 -->

<?php
    $account = $_POST['account'];
    $password = $_POST['password'];
    $correct = 0;

    //build connect
    $db_link = mysqli_connect('localhost','root','alice12345','final_project') 
                or die(mysqli_error());

    //query db
    $result = mysqli_query($db_link,"SELECT * FROM user");

    //get query result
    if(mysqli_num_rows($result) > 0){
        while(($row = mysqli_fetch_assoc($result)) && $correct == 0){
            if($row['account'] == $account && $row['password'] == $password){
                $correct = 1;
            }
        }
    }

    session_start();

    if($correct == 1){
        $_SESSION['account'] = $account;
        header("Location: http://localhost/buy_books.php"); 
        exit;
    }
    else{
        $_SESSION['account'] = 1;
        echo '<script>alert("帳號或密碼輸入錯誤，請重新輸入！")
        window.location.href = "http://localhost/account_log_in.php"</script>';
    }
?>