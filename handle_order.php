<!--處裡訂單資訊，把書本的上架變成下架，還要建出一個新的tupler進order-->

<?php

//error_reporting(E_ERROR);ini_set("display_errors","Off");
session_start();
$db_link = mysqli_connect("localhost", "root","alice12345","final_project")
                or die("MySQL connection failed. ");
$j = 0;
$bnumber = $_POST['bnumber'];
$method = $_POST['method'];
$sell_account = $_POST['account'];
$buy_account = $_SESSION['account'];
$carrier = $_POST['carrier'];
$price = $_POST['price'];
$date = date('Y/m/d H:i:s');
$buy_money;

$sql_query_books = "SELECT number,now FROM books";
$result_books = mysqli_query($db_link,$sql_query_books);

$sql_query_account = "SELECT account,money FROM user";
$result_account = mysqli_query($db_link,$sql_query_account);

while($row_account = mysqli_fetch_row($result_account)){
    if($row_account[0] == $buy_account){
        $buy_money = $row_account[1];
    }
}

$balance = $buy_money - $price; 
$get_money =0;


if($balance >= 0){
    while($row_book = mysqli_fetch_row($result_books)){
        while($bnumber[$j] && ($row_book[0] == $bnumber[$j])){echo "123";
            $db_link = mysqli_connect("localhost", "root","alice12345","final_project")
                    or die("MySQL connection failed. ");

            $sql_query_now = "UPDATE books SET now = 2 WHERE number = '$row_book[0]'";
            $result_now = mysqli_query($db_link,$sql_query_now);

            $sql_query_chargeback = "UPDATE user SET money = $balance WHERE account = '$buy_account' ";
            $result_chargeback = mysqli_query($db_link,$sql_query_chargeback);

            $sql_get_money = "SELECT money FROM user WHERE account = '$sell_account'";
            $result_get_money = mysqli_query($db_link,$sql_get_money);
            $row = mysqli_fetch_row($result_get_money);
            $get_money = $row[0] + $price;
            $sql_query_get_money = "UPDATE user SET money = $get_money WHERE account = '$sell_account'";
            mysqli_query($db_link,$sql_query_get_money);

            $sql_query_order = "INSERT INTO orders (buildDate,Bnumber,method,buy_account,sell_account,carrier,price)
                                VALUES ('$date','$bnumber[$j]','$method','$buy_account','$sell_account','$carrier','$price') ";
            $result_order = mysqli_query($db_link,$sql_query_order);

            
            $sql_query_delete = "DELETE FROM shopping_cart WHERE Bnumber = '$bnumber[$j]'";
            $result_delete = mysqli_query($db_link,$sql_query_delete);
            $j++;
        }
    }

    echo '<script>alert("訂單成立！")
            window.location.href = "http://localhost/buy_books.php"</script>';
            exit();

}   
else{
    echo '<script>alert("扣款失敗，您的愛書幣不足！")
            window.location.href = "http://localhost/buy_books.php"</script>';
            exit();
}







?>