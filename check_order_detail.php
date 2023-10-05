<!--讓使用者確認訂單所有細節的頁面-->

<?php
error_reporting(E_ERROR);ini_set("display_errors","Off");
session_start();
    $nameArr = array('編號','書籍資料','愛書幣'); //第二個放照片
    $account = $_SESSION['account'];
    $books = array();
    $book_i = 0; 
    $i=1;
    $type = '';
    $level = '';
    $count=1;
    $j=0;
    $total_money = 0;
    $method = $_POST['method'];
    $carrier = $_POST['carrier'];
    $carrier_is = $_POST['carrier_is'];
    $coupon = $_POST['coupon'];
    $method_show;

    if($method == 1)
        $method_show = '郵局寄送';
    else if($method == 2)
        $method_show = '黑貓宅配';



    $db_link = mysqli_connect("localhost", "root","alice12345","final_project")
				or die("MySQL connection failed. ");

	$sql_query_cart = "SELECT * FROM shopping_cart";
	$result_cart = mysqli_query($db_link,$sql_query_cart);

    $sql_query_books = "SELECT * FROM books";
    $result_books = mysqli_query($db_link,$sql_query_books);

    $sql_query_account = "SELECT account,address FROM user";
	$result_account = mysqli_query($db_link,$sql_query_account);
   
    while($row_account = mysqli_fetch_row($result_account)){ 
        if($row_account[0] == $account){
            $address = $row_account[1] ;
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

<h2 style="text-align:right"><span style="font-family:Comic Sans MS,cursive"><a href="http://localhost/buy_books.php">來去逛逛</a>&nbsp; &nbsp; <a href="http://localhost/sell_books.php">我要掛書</a>&nbsp; &nbsp; <a href="http://localhost/shopping_cart.php">購物車</a>&nbsp; &nbsp; <a href="http://localhost/my_account.php">個人帳戶</a>&nbsp;&nbsp; </span></h2>

<h1 style="text-align:center"><span style="font-family:Comic Sans MS,cursive"><strong>歡迎來到阿佳の二手書交換站</strong></span></h1>

<h2 style="text-align:center"><span style="font-family:Comic Sans MS,cursive"><strong><span style="font-size:20px">購物車</span></strong></span></h2>

<div class="center" style="margin-bottom:100px; margin-left:400px; margin-right:200px; margin-top:10px">
<p><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive"><srtong>一、訂單細節</strong></span></span></p>

    <table  border="1" cellpadding="1" cellspacing="1" dir="ltr" style="table-layout:fixed;">
	<tbody>
		<tr><?php
			for($r=0;$r<3;$r++) {
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
                    $owner = $row_book[10];
                        
                ?><tr>
                    <td width="50px" align="center"><span style='font-size:16px'><span style='font-family:Comic Sans MS,cursive'><?php echo $count;?></span></span></td>
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
                    <?php
                    $count++;
                    $j++;
                    $total_money = $total_money + $row_book[6];
                }?></tr><?php
                }
            ?>
        </tbody>
    </table>

<p><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive"><strong>二、運送方式</strong></span></span></p>

<p><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">&nbsp; &nbsp; &nbsp;您選擇了<?php echo $method_show?>，將送到地址如下：</span></span></p>

<p><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;地址：<?php echo $address;?></span></span></p>

<p><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive"><strong>三、結帳</strong></span></span></p>

<p><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">&nbsp; &nbsp; &nbsp;價格：<?php echo $total_money;?></span></span></p>

<?php 
/*
    if($coupon != NULL){
    //handle_coupon
    } 
*/
    if($carrier == 'Y'){
        $carrier = $carrier_is;?>
        <p><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">載具號碼：<?php echo $carrier;?></span></span></p>
    <?php }
    else{
        $carrier = "  ";?>
        <p><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">未使用載具</span></span></p><?php } ?>
        

<form action="handle_order.php" method="POST"><span style="font-family:Comic Sans MS,cursive">
<?php for($e=0;$e<count($books);$e++) {
    echo "<input type='hidden'  name='bnumber[]' value='$books[$e]'> ";
}?>


<input type="hidden" name="account" value='<?php echo $owner;?>' >
<input type="hidden" name="method" value='<?php echo $method;?>'>
<input type="hidden" name="carrier" value='<?php echo $carrier;?>' >
<input type="hidden" name="price" value='<?php echo $total_money;?>'>
<input type="submit" value="下單！" /></span>

<p>&nbsp;</p>
</form>
</div>
