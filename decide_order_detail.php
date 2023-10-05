<!--決定訂單資訊，決定運送方式、確認優惠券、是否使用載具以及錢是否足夠 -->

<h2 style="text-align:right"><span style="font-family:Comic Sans MS,cursive"><a href="http://localhost/buy_books.php">來去逛逛</a>&nbsp; &nbsp; <a href="http://localhost/sell_books.php">我要掛書</a>&nbsp; &nbsp; <a href="http://localhost/shopping_cart.php">購物車</a>&nbsp; &nbsp; <a href="http://localhost/my_account.php">個人帳戶</a>&nbsp;&nbsp; </span></h2>

<h1 style="text-align:center"><span style="font-family:Comic Sans MS,cursive"><strong>歡迎來到阿佳の二手書交換站</strong></span></h1>

<h2 style="text-align:center"><span style="font-family:Comic Sans MS,cursive"><strong><span style="font-size:20px">購物車</span></strong></span></h2>
<form action="check_order_detail.php" method="POST">
<div class="center" style="margin-bottom:100px; margin-left:300px; margin-right:200px; margin-top:10px">


<p><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">一、使用載具</span></span></p>

<p>&nbsp; &nbsp;&nbsp;<span style="font-size:18px"><span style="font-family:Comic Sans MS,cursive"><input name="carrier" type="radio" value="N" />否</span></span></p>

<p>&nbsp; &nbsp;&nbsp;<span style="font-size:18px"><span style="font-family:Comic Sans MS,cursive"><input name="carrier" type="radio" value="Y" />是，載具為&nbsp;<input name="carrier_is" type="text" /></span></span></p>

<p><span style="font-size:20px"><span style="font-family:Comic Sans MS,cursive">二、運送方式</span></span></p>

<p>&nbsp; &nbsp;&nbsp;<span style="font-size:18px"><span style="font-family:Comic Sans MS,cursive"><input name="method" type="radio" value="1" />郵局寄送</span></span></p>

<p>&nbsp; &nbsp;&nbsp;<span style="font-size:18px"><span style="font-family:Comic Sans MS,cursive"><input name="method" type="radio" value="2" />黑貓宅配</span></span></p>

<p style="text-align:right">&nbsp;</p>

<span style="font-family:Comic Sans MS,cursive"><input type="submit" value="確認訂單資訊" /></span>

<p>&nbsp;</p>
</form>
</div>
