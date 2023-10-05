<?php
// Homework2 : 資二甲 石悅佳 110916010
// 操作說明 : 依照平常使用計算機之方式使用計算機即可正常操作
// 自評 : 100分 
//  1. 支援整數加減乘除計算 (+70%) (完成)
//	2. 支援小數 (+20%)(完成)
//	3. 其他特別有用功能 (+10%)(完成)：有分數，平方，分數，刪除，清除，%，變號
//  4. 檔案格式命名正確 (-0%)
//  5. 主程式包含作者資訊、操作說明即符合的作業評分標準等資訊 (-0%)
//  6. 程式含有註解 (-0%)
//  7. 無抄襲 (-0%)
?>


<?php
    //------------宣告變數區------------//
    $num = 0.0 ; // 現在做運算的數字
    $num0 = 0.0 ; // 儲存上一次做運算的結果
    $num1 = 0.0 ; // 儲存下一次做運算的結果
    $floated ;
    $floatNum = 0 ; // 代表輸入時已進入到小數mode
    $floatResult = 1.0; // 紀錄小數點的基數
    $display = 0; // 顯示在計算機上的數字
    $record = 0; // 紀錄運算子
    //------------宣告變數區------------//

    //------------宣告函式區------------//
    function comNum($numNew,$numOld){ // 組合數字的函數，分為numOld(原數字)為"小數點時組合數字"和"整數時組合數字"
        global $floated;              // 因為變數宣告在函式外面，所以函式裡要用變數就需要宣告global
        if($floated == 0){            // 沒有進入小數mode，整數運算
            $numOld = $numOld * 10 + $numNew ; // 整數的組合方法即為舊數字乘以10後加上新數字，即組合成功
        }
        else{                         // numOld(原數字)為小數點時，組合數字的情況  
            global $floatResult;      // 因為變數宣告在函式外面，所以函式裡要用變數就需要宣告global
            $floatResult = $floatResult * 0.1; // 先將小數點的基數乘好
            $numOld = $numOld + $numNew * $floatResult; // 再乘上新增的數字後，加上原本的數字，即組合成功
        }
        return $numOld;
    }

    function mix($numOld,$numNew,$record){ // 四則運算
        if($record == 1){                  // 紀錄等於1時，做加法運算 
            $numOld = $numOld + $numNew;
        }
        if($record == 2){                  // 紀錄等於2時，做減法運算
            $numOld = $numOld - $numNew;
        }
        if($record == 3){                  // 紀錄等於3時，做乘法運算
            $numOld = $numOld * $numNew;
        }
        if($record == 4){                  // 紀錄等於4時，做除法運算
            $numOld = $numOld / $numNew;
        }
        return $numOld;
    }

    //--------------讀取上一個表單的值------------//
    if(isset($_GET["ex_num"])){
       $num = $_GET["ex_num"]; 
    }
    if(isset($_GET["ex_num0"])){
        $num0 = $_GET["ex_num0"]; 
    }
    if(isset($_GET["ex_num1"])){
        $num1 = $_GET["ex_num1"]; 
    }
    if(isset($_GET["ex_floated"])){
        $floated = $_GET["ex_floated"]; 
    }
    if(isset($_GET["ex_floatResult"])){
        $floatResult = $_GET["ex_floatResult"]; 
    }
    if(isset($_GET["ex_record"])){
        $record = $_GET["ex_record"]; 
    }
    //--------------讀取上一個表單的值------------//


    //-------------讀取表單送回的值---------------//
    $Btn = isset($_GET["btn"]);
    $btn = $_GET["btn"];
    if($Btn!=NULL){
        if($btn=="1"){ // 偵測 1 的數值
            $num = comNum("1",$num);
            $display = $num;
        }
        if($btn=="2"){ // 偵測 2 的數值
            $num = comNum("2",$num);
            $display = $num;
        }
        if($btn=="3"){ // 偵測 3 的數值
            $num = comNum("3",$num);
            $display = $num;
        }
        if($btn=="4"){ // 偵測 4 的數值
            $num = comNum("4",$num);
            $display = $num;
        }   
        if($btn=="5"){ // 偵測 5 的數值
            $num = comNum("5",$num);
            $display = $num;
        }
        if($btn=="6"){ // 偵測 6 的數值
            $num = comNum("6",$num);
            $display = $num;
        }
        if($btn=="7"){ // 偵測 7 的數值
            $num = comNum("7",$num);
            $display = $num;
        }
        if($btn=="8"){ // 偵測 8 的數值
            $num = comNum("8",$num);
            $display = $num;
        }
        if($btn=="9"){ // 偵測 9 的數值
            $num = comNum("9",$num);
            $display = $num;
        }
        if($btn=="0"){ // 偵測 0 的數值
            $num = comNum("0",$num);
            $display = $num;
        }
        if($btn=="%"){ // 偵測 % 之後即做 % 的運算
            $num1 = $num * 0.01;    // 如同計算機把輸入的數字化為原先數字的小數點運算後
            $num = $num0 * $num1;   // 乘上原先數字即得到結果
            $display = $num;        // 在計算機上顯示數字
        }
        if($btn=="CE"){ // 按下ce時，當下數字清零
            $num = 0.0;
            $display = $num;
            $floatResult = 1.0;
            $num1 = 0.0;
            $floated = 0;
        }
        if($btn=="C"){ // 按下c時，所有數值重置
            $num = 0.0;
            $num0 = 0.0;
            $num1 = 0.0; 
            $floated = 0; 
            $display = 0;
            $floatResult =1.0;
        }
        if($btn=="back"){ //刪除一個數字，分為整數情況即小數情況
            if(ceil($num)==$num){       // 1.整數情況
                $num = $num/10;
                $num = (int)$num;
            }
            else{                       // 2.小數時
                do{                     // 計算目前的小數點有幾位
                    $floatNum++;        // 每當計算一次floatNum就+1
                    $num = $num * 10;   // 再乘上10進一位
                }while(strstr($num,'.')); // 用PHP內建函數判斷是否有小數，有小數點時，就再進入迴圈，直到迴圈結束，floatNum即為小數點後__位
                $num = $num/10;         // numOld現在為一整數，除以10
                $num = (int)$num;       // 可以利用型態轉換把小數點去掉
                for($i = 1 ; $i <= $floatNum-1 ; $i++){ // 令numOld乘上剛才乘以10的次數-1，即會代表原數字去掉最後一個小數點的狀況
                    $num = $num * 0.1;
                }
                $floatResult = $floatResult * 10; // back一次代表接下來組合數字時的小數位數往前一位
                if(!strstr($num,'.')){  // 判斷若是numOld被刪除到已經不是小數點型態，須將所有浮點數的變數重置
                    $floated = 0;
                    $floatResult = 1.0;
                }
                $floatNum = 0;          // floatNum等於0以利下一次back計算時判斷小數點位數
            }
            $display = $num;
        }
        if($btn=="1/x"){ // 按下 1/x 後，即會對該數做分數運算
            $num = pow($num,-1); // 呼叫fraction函數
            $display = $num;     // 在計算機上顯示數字
        }
        if($btn=="x^2"){ //按下 x^2 後，即可對該數做平方計算
            $num = pow($num,2);
            $display = $num;
        }
        if($btn=="x^(1/2)"){ // 按下 x^(1/2) 後，即可對該數做根號計算
            $num = pow($num,0.5);
            $display = $num;
        }
        if($btn=="+"){ // 加法運算
            if($num0==0.0 && $num1==0.0){  // 第1次操作(即為只有第一組數字)
                $num0 = $num;              // 把第一組數字存入num0
                $display = $num0;          // 在計算機上顯示數字
                $num = 0.0;                // 顯示完畢，讓num歸零
            }
            else{                          // 非第1次操作(即前面已有數字待作運算)
                $num1 = $num;              // 讓此次的數字內容存入num1
                $num = mix($num0,$num1,$record); // 將上一次儲存的值和此次儲存的值作運算
                $display = $num;           // 在計算機上顯示數字
                $num0 = $num;              // 計算完畢，將計算結果存入num0以待下次計算
                $num1 = 0.0;               // 計算完畢，將下次需做運算的值清零
                $num = 0.0;                // 讓現在的num等於零等待下次輸入值
            }
            $record = 1;                   // 標記：使用加法運算
            $floated = 0;                  // 每完成一次comNum按下運算子時，須重置所有浮點數所需紀錄的值
            $floatResult = 1.0;
        }
        if($btn=="-"){ // 減法運算(和加法原理相同)
            if($num0==0.0 && $num1==0.0){
                $num0 = $num;
                $display = $num0;
                $num = 0.0;
            }
            else{
                $num1 = $num;
                $num = mix($num0,$num1,$record);
                $display = $num;
                $num0 = $num;
                $num1 = 0.0;
                $num = 0.0;
            }
            $record = 2;
            $floated = 0;
            $floatResult = 1.0;
        }
        if($btn=="*"){ // 乘法運算(原理同加法運算)
            if($num0==0.0 && $num1==0.0){
                $num0 = $num;
                $display = $num0;
                $num = 0.0;
            }
            else{
                $num1 = $num;
                $num = mix($num0,$num1,$record);
                $display = $num;
                $num0 = $num;
                $num1 = 0.0;
                $num = 0.0;
            }
            $record = 3;
            $floated = 0;
            $floatResult = 1.0;
        }
        if($btn=="/"){ // 除法運算(原理同加法運算)
            if($num0==0.0 && $num1==0.0){
                $num0 = $num;
                $display = $num0;
                $num = 0.0;
            }
            else{
                $num1 = $num;
                $num = mix($num0,$num1,$record);
                $display = $num;
                $num0 = $num;
                $num1 = 0.0;
                $num = 0.0;
            }
            $record = 4;
            $floated = 0;
            $floatResult = 1.0;
        }
        if($btn=="."){ // 按下 . 後，即可繼續輸入數字，成為小數組合
            $floated++;         // 進入小數點的狀態
            $display = $num ;   // 在計算機上顯示數字
        }
        if($btn=="="){ // 按下 = 即會做等於的計算
            $num1 = $num;       // 令前一組組合的數字存放在num1
            $num = mix($num0,$num1,$record); // 做計算，並用record判別前面輸入的運算子為何
            $display = $num;// 在計算機上顯示數字
            $num0 = $num;
            $num1 = 0.0;
            $record = 0;
        }
        if($btn=="+/-"){ // 按下 +/- 後，即可對該數做變號
            $num0 = $num0;      // 把目前的數字儲存到num0
            $num = $num * -1;   // 將num0變號後的數字儲存到num
            $num0 = $num;       // 將num的數字儲存到num0供計算
            $display = $num;    // 在計算機上顯示數字
        }
    }
    //-------------讀取表單送回的值---------------//

?>

    <BODY>
        <CENTER>
        <FORM Action="cal-110916010.php" Method=get>
        <h1>Calculator</h1>
        <INPUT name = "cal" value="<?php echo $display ?>" style="width:250px;height:35px">
            <table width = "300px" height = "300px">
            <tr><td>
                    <INPUT type="submit" value="%" name="btn" style="width:55px;height:40px;background-color:#87cefa"></td>
                <td>
                    <INPUT type="submit" value="CE" name="btn" style="width:55px;height:40px;background-color:#87cefa"></td>
                <td>
                    <INPUT type="submit" value="C" name="btn" style="width:55px;height:40px;background-color:#87cefa"></td>
                <td>
                    <INPUT type="submit" value="back" name="btn" style="width:55px;height:40px;background-color:#87cefa"></td>
            </tr>
            <tr><td>
                    <INPUT type="submit" value="1/x" name="btn" style="width:55px;height:40px;background-color:#87cefa"></td>
                <td>
                    <INPUT type="submit" value="x^2" name="btn" style="width:55px;height:40px;background-color:#87cefa"></td>
                <td>
                    <INPUT type="submit" value="x^(1/2)" name="btn" style="width:55px;height:40px;background-color:#87cefa"></td>
                <td>
                    <INPUT type="submit" value="/" name="btn" style="width:55px;height:40px;background-color:#87cefa"></td>
            </tr>
            <tr><td>
                    <INPUT type="submit" value="7" name="btn" style="width:55px;height:40px;background-color:#e0ffff"></td>
                <td>
                    <INPUT type="submit" value="8" name="btn" style="width:55px;height:40px;background-color:#e0ffff"></td>
                <td>
                    <INPUT type="submit" value="9" name="btn" style="width:55px;height:40px;background-color:#e0ffff"></td>
                <td>
                    <INPUT type="submit" value="*" name="btn" style="width:55px;height:40px;background-color:#87cefa"></td>
            <tr><td>
                    <INPUT type="submit" value="4" name="btn" style="width:55px;height:40px;background-color:#e0ffff"></td>
                <td>
                    <INPUT type="submit" value="5" name="btn" style="width:55px;height:40px;background-color:#e0ffff"></td>
                <td>
                    <INPUT type="submit" value="6" name="btn" style="width:55px;height:40px;background-color:#e0ffff"></td>
                <td>
                    <INPUT type="submit" value="-" name="btn" style="width:55px;height:40px;background-color:#87cefa"></td>
            <tr><td>
                    <INPUT type="submit" value="1" name="btn" style="width:55px;height:40px;background-color:#e0ffff"></td>
                <td>
                    <INPUT type="submit" value="2" name="btn" style="width:55px;height:40px;background-color:#e0ffff"></td>
                <td>
                    <INPUT type="submit" value="3" name="btn" style="width:55px;height:40px;background-color:#e0ffff"></td>
                <td>
                    <INPUT type="submit" value="+" name="btn" style="width:55px;height:40px;background-color:#87cefa"></td>
            <tr><td>
                    <INPUT type="submit" value="+/-" name="btn" style="width:55px;height:40px;background-color:#e0ffff"></td>
                <td>
                    <INPUT type="submit" value="0" name="btn" style="width:55px;height:40px;background-color:#e0ffff"></td>
                <td>
                    <INPUT type="submit" value="." name="btn" style="width:55px;height:40px;background-color:#e0ffff"></td>
                <td>
                    <INPUT type="submit" value="=" name="btn" style="width:55px;height:40px;background-color:#87cefa"></td>
            </tr>
        </table>
        </CENTER>
        <input type="hidden" name="ex_num" value="<?php echo $num ?>">
        <input type="hidden" name="ex_num0" value="<?php echo $num0 ?>">
        <input type="hidden" name="ex_num1" value="<?php echo $num1 ?>">
        <input type="hidden" name="ex_floated" value="<?php echo $floated ?>">
        <input type="hidden" name="ex_floatResult" value="<?php echo $floatResult ?>">
        <input type="hidden" name="ex_record" value="<?php echo $record ?>">
</FORM>
    </BODY>