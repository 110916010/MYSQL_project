<!--購物車的連結，這裡會放所有加入購物車的書籍，可以選擇再逛逛或是跳到結帳頁面(decide_order_detail) -->
<?php
error_reporting(E_ERROR);ini_set("display_errors","Off");


    session_start();
    $nameArr = array('編號','書籍資料','愛書幣','取消'); //第二個放照片
    $account = $_SESSION['account'];
    $books = array();
    $book_i = 0; 
    $i=1;
    $type = '';
    $level = '';
    $count=1;
    $j=0;
    $total_money = 0;

    $db_link = mysqli_connect("localhost", "root","alice12345","final_project")
				or die("MySQL connection failed. ");

	$sql_query_cart = "SELECT * FROM shopping_cart";
	$result_cart = mysqli_query($db_link,$sql_query_cart);

    $sql_query_books = "SELECT * FROM books";
    $result_books = mysqli_query($db_link,$sql_query_books);

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
            print_r($sql_query_books);
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

?>

<h2 style="text-align:right"><span style="font-family:Comic Sans MS,cursive"><a href="http://localhost/buy_books.php">來去逛逛</a>&nbsp; &nbsp; 
							<a href="http://localhost/sell_books.php">我要掛書</a>&nbsp; &nbsp;
							<a href="http://localhost/shopping_cart.php">購物車</a>&nbsp; &nbsp;
							<a href="http://localhost/my_account.php">個人帳戶</a>&nbsp;&nbsp;
							</span></h2>

<h1 style="text-align:center"><span style="font-family:Comic Sans MS,cursive"><strong>歡迎來到阿佳の二手書交換站</strong></span></h1>

<h2 style="text-align:center"><span style="font-family:Comic Sans MS,cursive"><strong><span style="font-size:20px">購物車</span></strong></span></h2>

<div class="center" style="margin-bottom:100px; margin-left:100px; margin-right:100px; margin-top:10px">&nbsp;
    <table align="center" border="1" cellpadding="1" cellspacing="1" dir="ltr" style="table-layout:fixed;">
	<tbody>
		<tr><?php
			for($r=0;$r<4;$r++) {
				echo "<td align='center'><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'><strong>$nameArr[$r]</strong></span></span></td>";
			}
?></tr>
            <?php
            while($row_cart = mysqli_fetch_row($result_cart)){
                if($row_cart[0] == $account){
                    array_push($books,$row_cart[1]);
                }
            }


            while($row_book = mysqli_fetch_row($result_books)){ //找書
                while($books[$j] && ($row_book[0] == $books[$j])){
                    $type = find_type($row_book[0]);
                    $type = type_change($type);
                    $level = level_change($row_book[4]);
                        
                ?><tr>
                    <td width="50px" align="center"><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'><?php echo $count;?></span></span></td>
                    <td width="100px" align="center"><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'></span></span></td>
                    <td width="250px" align="left"><ol>
                        <li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>書籍全名：<?php echo $row_book[1];?></span></span></li>
                        <li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>書籍種類：<?php echo $type;?></span></span></li>
                        <li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>書籍作者：<?php echo $row_book[9];?></span></span></li>
                        <li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>購買年代：<?php echo $row_book[3];?></span></span></li>
                        <li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>上架日期：<?php echo $row_book[8];?></span></span></li>
                        <li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>購買原價：<?php echo $row_book[2];?></span></span></li>
                        <li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>完整度評級：<?php echo $level;?></span></span></li>
                        <li><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'>其它特殊情況：<?php echo $row_book[7];?></span></span></li>
                    </span></span></td>
                    <td width="50px" align="center"><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'><?php echo $row_book[6];?></span></span></td>
                    <td width="50px" align="center"><span style='font-size:16px'><span style='font-family:Comic Sans MS,cvarchar'>
                        <form method='POST' action='cancel_book_sure.php?>'><input type='hidden' name='bnumber' value=<?php echo $row_book[0];?>><input type='submit' value='取消'></form></sapn></span></td>
                    <?php
                    $count++;
                    $j++;
                    $total_money = $total_money + $row_book[6];
                    }?></tr><?php
                }
            ?>
        </tbody>
    </table>
    <h2 style="text-align:right"><span style="font-family:Comic Sans MS,cursive"><strong><span style="font-size:20px">總金額：<?php echo $total_money;?></span></strong></span></h2>
<h2 style="text-align:right">&nbsp;&nbsp;<form method='POST' action='decide_order_detail.php'><input type='submit' value='去結帳！'></form>
&nbsp;&nbsp;<form method='POST' action='buy_books.php'><input type='submit' value='再逛逛'></form></h2>
</div>
