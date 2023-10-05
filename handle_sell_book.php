<!-- 處理掛書資訊填寫完畢之後，把資料寫入資料庫裡面的程序 -->
<?php

//error_reporting(E_ERROR);ini_set("display_errors","Off");

$db_link= mysqli_connect("localhost", "root", "alice12345", "final_project")

or die("MySQL 伺服器連結失敗 <br>");


    $name = $_POST['book_name'];
    $type = $_POST['book_type'];
    $author = $_POST['book_author'];
    $era = $_POST['book_age'];
    $value = $_POST['book_value'];
    $level = $_POST['book_level'];
    $note = $_POST['book_note'];
    $price = $_POST['book_money'];
    $date = date('Y/m/d');
    session_start();
    $account = $_SESSION['account']; 
    $sql_query2 = '';

    

    $sql_query = "INSERT INTO books 
    (name,value,era,level,now,price,note,date,author,owner) 
    VALUES ('$name', '$value','$era','$level','1','$price','$note','$date','$author','$account')";
    mysqli_query($db_link, $sql_query);echo "123";

    $sql_query_number = "SELECT MAX(number) FROM books";
    $result = mysqli_query($db_link,$sql_query_number);
    $row = mysqli_fetch_assoc($result);
    $finalBnum =  $row['MAX(number)'];

    
    switch ($type) {
    case 1:
        $sql_query2 = "INSERT INTO books_type_love (Bnumber) VALUES ('$finalBnum')";
        break;
    case 2:
        $sql_query2 = "INSERT INTO books_type_gonfu (Bnumber) VALUES ('$finalBnum')";
        break;
    case 3:
        $sql_query2 = "INSERT INTO books_type_comics (Bnumber) VALUES ('$finalBnum')";
        break;
    case 4:
        $sql_query2 = "INSERT INTO books_type_light (Bnumber) VALUES ('$finalBnum')";
        break;
    case 5:
        $sql_query2 = "INSERT INTO books_type_prose (Bnumber) VALUES ('$finalBnum')";
        break;
    case 6:
        $sql_query2 = "INSERT INTO books_type_newspaper (Bnumber) VALUES ('$finalBnum')";
        break;

    }

    mysqli_query($db_link, $sql_query2);



    

    echo '<script>alert("您的書籍已成功上架！")
   window.location.href = "http://localhost/buy_books.php"</script>';
   exit();

?>