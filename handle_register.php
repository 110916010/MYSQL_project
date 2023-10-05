<?php

$db_link= mysqli_connect("localhost", "root", "alice12345", "final_project")

or die("MySQL 伺服器連結失敗 <br>");


    $account = $_POST['account'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $address = $_POST['address'];


    $sql_query = "INSERT INTO user (account,password,telephone,sex,address,name,email,money) VALUES ('$account', '$password','$tel','$gender','$address','$name','$email',  '0')";

    mysqli_query($db_link, $sql_query);

    echo '<script>alert("註冊成功！")
    window.location.href="http://localhost/account_log_in.php"</script>';
    exit();

?>