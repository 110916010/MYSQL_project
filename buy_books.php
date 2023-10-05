<!--瀏覽已掛上去的書籍的介面 -->

<?php
	$nameArr = array('書名','作者','完整度評級','愛書幣');
	$BnumName = 0;
	$db_link = mysqli_connect("localhost", "root","alice12345","final_project")
				or die("MySQL connection failed. ");
	$sql_query = "SELECT number,name,author,level,price,now FROM books";
	$result = mysqli_query($db_link,$sql_query);
	$keyword='';
	if(isset($_POST["search"])){
		$keyword = $_POST["search"];
	}

	$sql_query_search = "SELECT number,name,author,level,price,now FROM books WHERE name = '$keyword' OR author = '$keyword'";
	$result_search = mysqli_query($db_link,$sql_query_search);
?>

<h2 style="text-align:right"><span style="font-family:Comic Sans MS,cursive"><a href="http://localhost/buy_books.php">來去逛逛</a>&nbsp; &nbsp; 
							<a href="http://localhost/sell_books.php">我要掛書</a>&nbsp; &nbsp;
							<a href="http://localhost/shopping_cart.php">購物車</a>&nbsp; &nbsp;
							<a href="http://localhost/my_account.php">個人帳戶</a>&nbsp;&nbsp;
							</span></h2>
<h1 style="text-align:center"><span style="font-family:Comic Sans MS,cursive"><strong>歡迎來到阿佳の二手書交換站</strong></span></h1>

<p>&nbsp;</p>

<p ><span style="font-size:16px"><span style="font-family:Comic Sans MS,cursive">搜尋：
	<form method="post" action="http://localhost/buy_books.php"><input type="search" placeholder="書名或作者"  name = 'search'/><input type="submit" value="送出" ></form></span></span></p>

<p>&nbsp;</p>

<table align="center" border="1" cellpadding="1" cellspacing="1" dir="ltr" style="table-layout:fixed; width:500px">
	<tbody>
		<tr><?php
			for($i=0;$i<4;$i++) {
				echo "<td><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'><strong>$nameArr[$i]</strong></span></span></td>";
			}
?></tr>
		<tr>
			<?php 
			if($keyword == ''){
				while($meta = mysqli_fetch_row($result)){
				if($meta[5] == "1"){
					$Bnum = $meta[0];
				echo "<tr>";
				for($j=1;$j<mysqli_num_fields($result);$j++) {
					if($j==3){
						switch($meta[$j]){
							case 1:
								$meta[$j] = 'S+';
								break;
							case 2:
								$meta[$j] = 'S';
								break;
							case 3:
								$meta[$j] = 'A';
								break;
							case 4:
								$meta[$j] = 'B';
								break;
							case 5:
								$meta[$j] = 'B-';
								break;
						}
					}
					?><form method="POST" action='buy_book_sure.php'><?php
					if($j==1){
						echo "<td><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'><input type='hidden' name='Bnumber' value=$Bnum>$meta[$j]</span></span></td>";
					}
					else if($j==5){
						echo "<td><input type='submit' value='去看看'> </td>";
					}
					else
						echo "<td><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>$meta[$j]</span></span></td>";
					}
					?></form><?php
				}
				
			}
		}else{
			while($meta_search = mysqli_fetch_row($result_search)){
				if($meta_search[5] == "1"){
					$Bnum = $meta_search[0];
				echo "<tr>";
				for($j=1;$j<mysqli_num_fields($result_search);$j++) {
					if($j==3){
						switch($meta_search[$j]){
							case 1:
								$meta_search[$j] = 'S+';
								break;
							case 2:
								$meta_search[$j] = 'S';
								break;
							case 3:
								$meta_search[$j] = 'A';
								break;
							case 4:
								$meta_search[$j] = 'B';
								break;
							case 5:
								$meta_search[$j] = 'B-';
								break;
						}
					}
					?><form method="POST" action='buy_book_sure.php'><?php
					if($j==1){
						echo "<td><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'><input type='hidden' name='Bnumber' value=$Bnum>$meta_search[$j]</span></span></td>";
					}
					else if($j==5){
						echo "<td><input type='submit' value='去看看'> </td>";
					}
					else
						echo "<td><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>$meta_search[$j]</span></span></td>";
					}
					?></form><?php
				}
				
			}
		}
			?>
		</tr>
	</tbody>
</table>
<td>
<p>&nbsp;</p>
