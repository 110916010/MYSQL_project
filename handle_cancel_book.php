<!--取消放入購物車裡的書-->

<?php
    $bnumber = $_POST['bnumber'];

    $db_link = mysqli_connect("localhost", "root","alice12345","final_project")
                or die("MySQL connection failed. ");
    $sql_query = "DELETE FROM shopping_cart WHERE Bnumber = '$bnumber'";
    $result = mysqli_query($db_link,$sql_query);

    echo '<script>alert("取消成功！")
    window.location.href = "http://localhost/shopping_cart.php"</script>';





?>