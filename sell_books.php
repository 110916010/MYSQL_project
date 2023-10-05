<!--掛書的介面 -->

<h2 style="text-align:right"><span style="font-family:Comic Sans MS,cursive"><a href="http://localhost/buy_books.php">來去逛逛</a>&nbsp; &nbsp; 
							<a href="http://localhost/sell_books.php">我要掛書</a>&nbsp; &nbsp;
							<a href="http://localhost/shopping_cart.php">購物車</a>&nbsp; &nbsp;
							<a href="http://localhost/my_account.php">個人帳戶</a>&nbsp;&nbsp;
							</span></h2>
<h1 style="text-align:center"><span style="font-family:Comic Sans MS,cursive"><strong>歡迎來到阿佳の二手書交換站</strong></span></h1>

<h1 style="text-align:center"><span style="font-size:22px"><span style="font-family:Comic Sans MS,cursive"><strong>我要掛書</strong></span></span></h1>

<form action="handle_sell_book.php" method="POST" enctype="multipart/form-data" class="frmImageUpload">
<div class="center" style="margin-bottom:10px; margin-left:300px; margin-right:200px; margin-top:10px">
<h2><span style="font-size:22px"><span style="font-family:Comic Sans MS,cursive"><strong>一、輸入書籍基本資料</strong></span></span></h2>

<ol>
	<li><span style="font-family:Comic Sans MS,cursive"><span style="font-size:20px">書籍全名：<input name="book_name" required="required" type="text" /></span></span></li>
	<li><span style="font-family:Comic Sans MS,cursive"><span style="font-size:20px">書籍種類：</span><span style="font-size:18px"> <input name="book_type" required="required" type="radio" value="1" />言情 <input name="book_type" required="required" type="radio" value="2" />武俠 <input name="book_type" required="required" type="radio" value="3" />漫畫 <input name="book_type" required="required" type="radio" value="4" />輕小說 <input name="book_type" required="required" type="radio" value="5" />散文 <input name="book_type" required="required" type="radio" value="6" />報章雜誌</span><span style="font-size:20px"> </span></span></li>
	<li><span style="font-family:Comic Sans MS,cursive"><span style="font-size:20px">書籍作者：<input name="book_author" required="required" type="text" /></span></span></li>
	<li><span style="font-family:Comic Sans MS,cursive"><span style="font-size:20px">購買年代：<input name="book_age" required="required" type="text" /></span></span></li>
	<li><span style="font-family:Comic Sans MS,cursive"><span style="font-size:20px">購買原價：<input name="book_value" type="text" /></span></span></li>
</ol>

<h2><span style="font-family:Comic Sans MS,cursive"><span style="font-size:22px"><strong>二、書籍完整度</strong></span></span></h2>

<ol>
	<li><span style="font-family:Comic Sans MS,cursive"><span style="font-size:20px">書籍完整度評級：<input name="book_level" required="required" type="radio" value="1" />S+<input name="book_level" required="required" type="radio" value="2" />S <input name="book_level" required="required" type="radio" value="3" />A <input name="book_level" required="required" type="radio" value="4" />B <input name="book_level" required="required" type="radio" value="5" />B- </span></span></li>
	<li><span style="font-family:Comic Sans MS,cursive"><span style="font-size:20px">其它特殊狀況：<input name="book_note" type="text" /></span></span></li>
</ol>


<p>&nbsp;</p>

<h2><span style="font-size:22px"><span style="font-family:Comic Sans MS,cursive"><strong>三、決定預售愛書幣</strong></span></span></h2>

<p><span style="font-family:Comic Sans MS,cursive"><span style="font-size:20px">本著熱愛書籍及友善二手交換的心理，我欲將本書標為&nbsp;<input name="book_money" required="required" type="text" />&nbsp;愛書幣。</span></span></p>

<p>&nbsp;</p>

<p style="text-align:right"><input type="submit" value="掛書！" /></p>
</div>
</form>
