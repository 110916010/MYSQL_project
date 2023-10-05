<!--處理買書之後所需寫入資料庫系統的資料-->

<?php
    $price = $_POST['price'];

    $db_link = mysqli_connect("localhost", "root","alice12345","final_project")
				or die("MySQL connection failed. ");
	$sql_query = "SELECT money FROM users";
	$result = mysqli_query($db_link,$sql_query);
    $row = mysqli_fetch_assoc($result);
    $money = $row['money'];

    if(($money-$price)>=0){
        
    }
    else{
        echo '<script>alert("失敗，您的帳戶餘額不足！")
    window.location.href = "http://localhost/buy_books.php"</script>';
    }


?>