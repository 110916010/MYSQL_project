<!--加入購物車的資料表處理程序 -->

<?php
    session_start();
    $account = $_SESSION['account'];
    $bnumber = $_POST['bnumber'];
    $price = $_POST['price'];

	$db_link = mysqli_connect("localhost", "root","alice12345","final_project")
                or die("MySQL connection failed. ");

    $sql_query = "INSERT INTO shopping_cart (Uaccount,Bnumber,price) VALUES ('$account','$bnumber','$price')";
    //$sql_query_modify = "UPDATE books SET now='2' WHERE number = $bnumber"; 
    $sql_query_online = "SELECT * FROM books";
    $result_online = mysqli_query($db_link,$sql_query_online);
    while($row_online = mysqli_fetch_assoc($result_online)){
		if($row_online['number']==$bnumber && $row_online['now']==1 ){
            mysqli_query($db_link,$sql_query);
           // mysqli_query($db_link,$sql_query_modify);
		}
	}


    echo '<script>alert("書籍成功加入購物車")
    window.location.href = "http://localhost/shopping_cart.php"</script>';
    exit();

?>