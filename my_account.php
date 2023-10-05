<!--會員管理中心的介面 -->

<?php
error_reporting(E_ERROR);ini_set("display_errors","Off");
$db_link = mysqli_connect("localhost", "root","alice12345","final_project")
			or die("MySQL connection failed. ");

	$name = '';
	$address = '';
	$telephone = '';
	$sex = '';
	$email = '';
	$money = '';
	$exist_online = FALSE;

	function changed_method($method){
		if($method == '1'){
			$method = '郵局寄送';
		}
		else $method = '黑貓宅配';
		return $method;
	}

function show_online_detail_table($account_t){
	$nameArr = array('愛書幣','書籍資料','編號');
	$count = 1;
	$exist_online = FALSE;
	$r=3;
	$db_link = mysqli_connect('localhost', 'root','alice12345','final_project')
			or die('MySQL connection failed. ');

	$sql_query_online = "SELECT * FROM books";
	$result_online = mysqli_query($db_link,$sql_query_online);
	while($row_online=mysqli_fetch_row($result_online)){
		if($row_online[10] == $account_t){
			
			$type_find = find_type($row_online[0]);
			$changed_type = type_change($type_find);
			$changed_level = level_change($row_online[4]);
			$exist_online = TRUE;
			if($r>0){?><p><span style="font-size:22px"><span style="font-family:Comic Sans MS,cursive"><strong>二、目前上架之書籍</strong></span></span></p>
					<div class='center' style='margin-bottom:100px; margin-left:100px; margin-right:100px; margin-top:10px'>&nbsp;
					<table border='1' cellpadding='1' cellspacing='1' dir='ltr' style='table-layout:fixed;'>
					<tbody><tr><?php
				for($r=2;$r>0;$r--) {
					echo "<td align='center'><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'><strong>$nameArr[$r]</strong></span></span></td>";
				}
			}
		?></tr>
		<tr>
			<td width="50px" align="center"><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'><?php echo $count;?></span></span></td>
			<td width="250px" align="left"><ol>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>書籍全名：<?php echo $row_online[1];?></span></span></li>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>書籍種類：<?php echo $changed_type;?></span></span></li>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>書籍作者：<?php echo $row_online[9];?></span></span></li>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>購買年代：<?php echo $row_online[3];?></span></span></li>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>上架日期：<?php echo $row_online[8];?></span></span></li>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>購買原價：<?php echo $row_online[2];?></span></span></li>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>完整度評級：<?php echo $changed_level;?></span></span></li>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>其它特殊情況：<?php echo $row_online[7];?></span></span></li>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>愛書幣售價：<?php echo $row_online[6];?></span></span></li></ol>					</span></span></td>
		</tr><?php
		$count++;
		}
	}
		?></tbody></table></div><?php
return $exist_online;
}		

function show_order_detail_table(){
	$nameArr = array('書籍名稱','訂單資訊','編號');
	$r=3;
	$db_link = mysqli_connect('localhost', 'root','alice12345','final_project')
			or die('MySQL connection failed. ');

	$sql_query_order_date = "SELECT buildDate, COUNT(*) FROM orders GROUP BY buildDate HAVING COUNT(*) >= 1";
	$result_order_date = mysqli_query($db_link,$sql_query_order_date);
	$order_date = array();
	$order_count = array();
	while($row_order_date = mysqli_fetch_row($result_order_date)){
		array_push($order_date,$row_order_date[0]);
		array_push($order_count,$row_order_date[1]);
	}
	$sql_query_order_date_all = "SELECT * FROM orders";
	$result_order_date_all = mysqli_query($db_link,$sql_query_order_date_all);
	$record = 0;
	$count_index = 0;
	$date_index = 0;
	$count = 1;
	$name = array();
	$print = 0;

	while($order_date[$date_index]){ 
		for($record_count=$order_count[$record];$record_count>0;$record_count--){
			$row_order_date_all=mysqli_fetch_row($result_order_date_all);
			$bnum2 = $row_order_date_all[1]; // 找到那個書號了	
			$sql_query_bookss = "SELECT * FROM books WHERE number='$bnum2'";		
			$result_bookss = mysqli_query($db_link,$sql_query_bookss);		
			$row_bookss = mysqli_fetch_row($result_bookss);	
			array_push($name,$row_bookss[1]);
		} $date_index++;
	}
		?>
	<p><span style="font-family:Comic Sans MS,cursive"><span style="font-size:22px"><strong>三、訂單查詢</strong></span></span></p>
			<div class='center' style='margin-bottom:100px; margin-left:100px; margin-right:100px; margin-top:10px'>&nbsp;
			<table border='1' cellpadding='1' cellspacing='1' dir='ltr' style='table-layout:fixed;'>
			<tbody><tr><?php
			for($r=2;$r>0;$r--){
				echo "<td align='center'><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'><strong>$nameArr[$r]</strong></span></span></td>";
			}?>
	</tr><?php

		$count_total_index = count($order_date)*count($order_count)-1;
		$count_total = count($order_date)*count($order_count)-1;
		$sql_query_final = "SELECT * FROM orders";
		$result_final = mysqli_query($db_link,$sql_query_final);
		for($u1=count($order_date);$u1>0;$u1--){
			$row_final = mysqli_fetch_row($result_final);?>
			<tr><td width="50px" align="center"><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'><?php echo $count;?></span></span></td>
			<td  ><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'><ol>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>訂單生效日：<?php echo $row_final[0] ?></span></span></li>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>宅配方式：<?php $method = changed_method($row_final[2]); echo $method;  ?></span></span></li>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>賣家：<?php echo $row_final[4] ?></span></span></li>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>載具：<?php echo $row_final[5] ?></span></span></li>
				<li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>訂單總愛書幣：<?php echo $row_final[6] ?></span></span></li>
			</ol></td>
			<?php 
			$count++;?>
			</tr> <?php 
		}



	?>
			
				
	</tr></tbody></table></div><?php
}


function find_type($bnum) {
	$db_link = mysqli_connect("localhost", "root","alice12345","final_project")
	or die("MySQL connection failed. ");
	$book_table = array('books_type_comics','books_type_gonfu','books_type_light','books_type_love','books_type_newspaper','books_type_prose');
	$type = '';
	$row_type = '';    
	$index = 0;
	while($index<6 && $type == ''){
		$sql_query_type = "SELECT Bnumber FROM $book_table[$index]";
		$result_book_type = mysqli_query($db_link,$sql_query_type);
		$row_num = mysqli_num_rows($result_book_type);
		while($row_num>0){
			$row_type = mysqli_fetch_assoc($result_book_type);
			if($row_type['Bnumber']==$bnum){
				$type = $index;
			}
			$row_num--;
		}
		$index++;
	}
	return $type;
}

function type_change($type) {
	switch($type){
		case 0:
			$type = '漫畫';
			return $type;
			break;
		case 1:
			$type = '武俠小說';
			return $type;
			break;
		case 2:
			$type = '輕小說';
			return $type;
			break;
		case 3:
			$type = '言情小說';
			return $type;
			break;
		case 4:
			$type = '報章雜誌';
			return $type;
			break;
		case 5:
			$type = '散文';
			return $type;
			break;
	}
}

function level_change($level) {
	switch($level){
		case 1:
			$level = 'S+';
			return $level;
			break;
		case 2:
			$level = 'S';
			return $level;
			break;
		case 3:
			$level = 'A';
			return $level;
			break;
		case 4:
			$level = 'B';
			return $level;
			break;
		case 5:
			$level = 'B-';
			return $level;
			break;
	}
}

function sex ($sex){
	if($sex == 1){
		$sex = '男';
	}
	else{
		$sex = '女';
	}
	return $sex;
}

function change_mrthod($method){

}

session_start();
$account = $_SESSION['account'];

	$sql_query_account = "SELECT name,account,telephone,sex,email,address,money FROM user";
	$result_account = mysqli_query($db_link,$sql_query_account);
	while($row_account=mysqli_fetch_row($result_account)){
		if($row_account[1] == $account){
			$name = $row_account[0];
			$telephone = $row_account[2];
			$sex = sex($row_account[3]);
			$address = $row_account[4];
			$email = $row_account[5];
			$money = $row_account[6];
		}
	}

	
	
?>



<h2 style="text-align:right"><span style="font-family:Comic Sans MS,cursive"><a href="http://localhost/buy_books.php">來去逛逛</a>&nbsp; &nbsp; 
							<a href="http://localhost/sell_books.php">我要掛書</a>&nbsp; &nbsp;
							<a href="http://localhost/shopping_cart.php">購物車</a>&nbsp; &nbsp;
							<a href="http://localhost/my_account.php">個人帳戶</a>&nbsp;&nbsp;
							</span></h2>
<h1 style="text-align:center"><span style="font-family:Comic Sans MS,cursive"><strong>歡迎來到阿佳の二手書交換站</strong></span></h1>

<h1 style="text-align:center"><span style="font-size:22px"><span style="font-family:Comic Sans MS,cursive"><strong>個人帳戶</strong></span></span></h1>

<div class="center" style="margin-bottom:10px; margin-left:300px; margin-right:200px; margin-top:10px">
<p><span style="font-size:22px"><span style="font-family:Comic Sans MS,cursive"><strong>一、個人資料</strong></span></span></p>

<ol>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">名字：<?php echo $name;?></span></span></li>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">帳號：<?php echo $account;?></span></span></li>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">電話號碼：<?php echo $telephone;?></span></span></li>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">性別：<?php echo $sex;?></span></span></li>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">電子郵件：<?php echo $email;?></span></span></li>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">地址：<?php echo $address;?></span></span></li>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">目前擁有的愛書幣：<?php echo $money;?></span></span></li>
</ol>
<?php


	$check = show_online_detail_table($account);
	if(!$check){
		echo "&nbsp; &nbsp;&nbsp;<span style='font-size:px'><span style='font-family:Comic Sans MS,cursive'>無上架書籍。</span></span>";
	}


	show_order_detail_table();
			


?>

<p>&nbsp;</p>
</div>
