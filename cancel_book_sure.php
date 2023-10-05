<!-- 給使用者確認取消該書之介面 -->


<?php
	$bnum = $_POST['bnumber'];
	$book_table = array('books_type_comics','books_type_gonfu','books_type_light','books_type_love','books_type_newspaper','books_type_prose');
	$i = 0;
	$name = '';
	$author = '';
	$era = '';
	$value = '';
	$price = '';
	$level = '';
	$note = '';
	$type = '';
	$row_type = '';

	$db_link = mysqli_connect("localhost", "root","alice12345","final_project")
				or die("MySQL connection failed. ");
	$sql_query = "SELECT * FROM books";
	$result = mysqli_query($db_link,$sql_query);

	while($i<6 && $type == ''){
		$sql_query_type = "SELECT Bnumber FROM $book_table[$i]";
		$result_book_type = mysqli_query($db_link,$sql_query_type);
		$row_num = mysqli_num_rows($result_book_type);
		while($row_num>0){
			$row_type = mysqli_fetch_assoc($result_book_type);
			if($row_type['Bnumber']==$bnum){
				$type = $i;
			}
			$row_num--;
		}
		$i++;
	}



	while($row = mysqli_fetch_assoc($result)){
		if($row['number']==$bnum){
			$name = $row['name'];
			$author = $row['author'];
			$era = $row['era'];
			$value = $row['value'];
			$price = $row['price'];
			$level = $row['level'];
			$note = $row['note'];
		}
	}

	switch($type){
		case 0:
			$type = '漫畫';
			break;
		case 1:
			$type = '武俠小說';
			break;
		case 2:
			$type = '輕小說';
			break;
		case 3:
			$type = '言情小說';
			break;
		case 4:
			$type = '報章雜誌';
			break;
		case 5:
			$type = '散文';
			break;
	}

	switch($level){
		case 1:
			$level = 'S+';
			break;
		case 2:
			$level = 'S';
			break;
		case 3:
			$level = 'A';
			break;
		case 4:
			$level = 'B';
			break;
		case 5:
			$level = 'B-';
			break;
	}

?>


<h2 style="text-align:right"><span style="font-family:Comic Sans MS,cursive"><a href="http://localhost/buy_books.php">來去逛逛</a>&nbsp; &nbsp; 
							<a href="http://localhost/sell_books.php">我要掛書</a>&nbsp; &nbsp;
							<a href="http://localhost/shopping_cart.php">購物車</a>&nbsp; &nbsp;
							<a href="http://localhost/my_account.php">個人帳戶</a>&nbsp;&nbsp;
							</span></h2>

<h1 style="text-align:center"><span style="font-family:Comic Sans MS,cursive"><strong>歡迎來到阿佳の二手書交換站</strong></span></h1>

<h1 style="text-align:center"><span style="font-family:Comic Sans MS,cursive"><span style="font-size:22px"><strong>取消書籍</strong></span></span></h1>

<form action="handle_cancel_book.php" method="POST">
<div class="center" style="margin-bottom:10px; margin-left:300px; margin-right:200px; margin-top:10px">
<p><strong><span style="font-size:22px"><span style="font-family:Comic Sans MS,cursive">一、書籍基本資料</span></span></strong></p>

<ol>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">書籍全名：<?php echo $name?></span></span></li>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">書籍種類：<?php echo $type?></span></span></li>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">書籍作者：<?php echo $author?></span></span></li>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">購買年代：<?php echo $era?></span></span></li>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">購買原價：<?php echo $value?></span></span></li>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">愛書幣：<?php echo $price?></span></span></li>
</ol>

<p><strong><span style="font-family:Comic Sans MS,cursive"><span style="font-size:22px">二、書籍完整度</span></span></strong></p>

<ol>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">書籍完整度評級：<?php echo $level?></span></span></li>
	<li><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">其它特殊情況：<?php echo $note?></span></span></li>
</ol>


<p>&nbsp;</p>

<input type="hidden" name="bnumber" value=<?php echo $bnum?> >

<p style="text-align:right"><input type="submit" value="確定取消" /></p>
</div>
</form>
