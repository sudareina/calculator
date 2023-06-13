<!DOCTYPE html>
<html>

<head>
    <title>プログラミング言語III及び演習</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <style>
        .calc-button {
            width: 50px;
            height: 50px;
            font-size: 20px;
            background-color: #f2f2f2;
            border: none;
            border-radius: 5px;
            margin: 5px;
        }

        .calc-button:hover {
            background-color: #e6e6e6;
            cursor: pointer;
        }

        .calc-button:active {
            background-color: #d9d9d9;
        }
    </style>
</head>

<body>
    <center>
        <h1>プログラミング言語III 及び演習　PHP 基礎</h1>
    </center>

    <h2> 電卓アプリ </h2>

    <?php
    $result = isset($_POST['result']) ? $_POST['result'] : '';
    $result2 = isset($_POST['result2']) ? $_POST['result2'] : '';

    if (isset($_POST['KEY_1'])) {
        $result .= '1';
    } elseif (isset($_POST['KEY_2'])) {
        $result .= '2';
    } elseif (isset($_POST['KEY_3'])) {
        $result .= '3';
    } elseif (isset($_POST['KEY_4'])) {
        $result .= '4';
    } elseif (isset($_POST['KEY_5'])) {
        $result .= '5';
    } elseif (isset($_POST['KEY_6'])) {
        $result .= '6';
    } elseif (isset($_POST['KEY_7'])) {
        $result .= '7';
    } elseif (isset($_POST['KEY_8'])) {
        $result .= '8';
    } elseif (isset($_POST['KEY_9'])) {
        $result .= '9';
    } elseif (isset($_POST['KEY_00'])) {
        $result .= '00';
    } elseif (isset($_POST['KEY_0'])) {
        $result .= '0';
    } elseif (isset($_POST['KEY_BS'])) {
        if (strlen($result) > 0) {
            $result = substr($result, 0, -1);
        }
    } elseif (isset($_POST['KEY_AC'])) {
        $result = "";
    } elseif (isset($_POST['KEY_%'])) {
        $result .= '*0.01';
    } elseif (isset($_POST['KEY_+'])) {
        $result .= '+';
    } elseif (isset($_POST['KEY_-'])) {
        $result .= '-';
    } elseif (isset($_POST['KEY_*'])) {
        $result .= '*';
    } elseif (isset($_POST['KEY_/'])) {
        $result .= '/';
    } elseif (isset($_POST['KEY_('])) {
        $result .= '(';
    } elseif (isset($_POST['KEY_)'])) {
        $result .= ')';
    } elseif (isset($_POST['KEY_syn'])) {
        $result .= '^';
    } elseif (isset($_POST['KEY_log'])) {
        $result .= 'log(';
    } elseif (isset($_POST['KEY_comma'])) {
        $result .= ',';
    } elseif (isset($_POST['KEY_deci'])) {
        if (strlen($result) > 0 && !in_array(substr($result, -1), array('*', '/', '+', '-', '.'))) {
            $result .= ".";
        } elseif (strlen($result) == 0) {
            $result = '0.';
        }
    } elseif (isset($_POST['KEY_='])) {
        // 入力式のパースと評価
        $result2 = evaluateExpression($result);
    }

    function evaluateExpression($expression)
    {
        // logの場合の処理
        while (strpos($expression, 'log(') !== false) {
            $logStart = strpos($expression, 'log('); // log関数の開始位置を取得
            $logEnd = strpos($expression, ')', $logStart); // log関数の終了位置を取得

            // log関数の引数を取得
            $logArgs = substr($expression, $logStart + 4, $logEnd - $logStart - 4);
            $logArgs = explode(',', $logArgs);

            // log関数の計算結果を取得
            $logResult = log($logArgs[1], $logArgs[0]);

            // 式中のlog関数を計算結果に置換
            $expression = substr_replace($expression, $logResult, $logStart, $logEnd - $logStart + 1);
        }

        // 相乗を実行する
        $expression = str_replace('^', '**', $expression);

        // 不正な文字や式を排除するための正規表現パターン
        $pattern = '/[^0-9+\-.*\/()%^,]/';

        // 正規表現パターンにマッチする文字が含まれている場合はエラーとして処理する
        if (preg_match($pattern, $expression)) {
            return "エラー";
        }

        // 計算結果を返す
        try {
            eval('$result = ' . $expression . ';');
            return $result;
        } catch (Throwable $e) {
            return "エラー";
        }
    }

    function format_expression($expression)
    {
        $expression = str_replace('*', '&times;', $expression);
        $expression = str_replace('/', '&divide;', $expression);
        return $expression;
    }

    function format_result($result)
    {
        if (is_numeric($result)) {
            $result = (float) $result;  // 文字列を浮動小数点数にキャストする
            $decimalPlaces = strlen(substr(strrchr($result, "."), 1)); // 入力された桁数を取得
            return number_format($result, $decimalPlaces); // 入力された桁数まで計算結果を表示
        } else {
            return "";
        }
    }
    ?>

    <form method="post" action="./kadai08_1.php">
        <input type="text" name="result" value="<?php echo $result; ?>" />
        <h3>
            入力式: <?php echo format_expression($result); ?>
        </h3>
        <button class="calc-button" type="submit" value="KEY_AC" name="KEY_AC"> AC </button>
        <button class="calc-button" type="submit" value="KEY_BS" name="KEY_BS"> BS </button>
        <button class="calc-button" type="submit" value="KEY_(" name="KEY_("> （ </button>
        <button class="calc-button" type="submit" value="KEY_)" name="KEY_)"> ） </button>

        <br>
        <button class="calc-button" type="submit" value="KEY_log" name="KEY_log"> log </button>
        <button class="calc-button" type="submit" value="KEY_syn" name="KEY_syn"> ^ </button>
        <button class="calc-button" type="submit" value="KEY_%" name="KEY_%"> ％ </button>
        <button class="calc-button" type="submit" value="KEY_/" name="KEY_/">&divide;</button>
        <br>
        <button class="calc-button" type="submit" value="KEY_7" name="KEY_7"> 7 </button>
        <button class="calc-button" type="submit" value="KEY_8" name="KEY_8"> 8 </button>
        <button class="calc-button" type="submit" value="KEY_9" name="KEY_9"> 9 </button>
        <button class="calc-button" type="submit" value="KEY_*" name="KEY_*">&times;</button>
        <br>
        <button class="calc-button" type="submit" value="KEY_4" name="KEY_4"> 4 </button>
        <button class="calc-button" type="submit" value="KEY_5" name="KEY_5"> 5 </button>
        <button class="calc-button" type="submit" value="KEY_6" name="KEY_6"> 6 </button>
        <button class="calc-button" type="submit" value="KEY_-" name="KEY_-"> - </button>
        <br>
        <button class="calc-button" type="submit" value="KEY_1" name="KEY_1"> 1 </button>
        <button class="calc-button" type="submit" value="KEY_2" name="KEY_2"> 2 </button>
        <button class="calc-button" type="submit" value="KEY_3" name="KEY_3"> 3 </button>
        <button class="calc-button" type="submit" value="KEY_+" name="KEY_+"> + </button>
        <br>
        <button class="calc-button" type="submit" value="KEY_0" name="KEY_0"> 0 </button>
        <button class="calc-button" type="submit" value="KEY_00" name="KEY_00"> 00 </button>
        <button class="calc-button" type="submit" value="KEY_deci" name="KEY_deci"> . </button>
        <button class="calc-button" type="submit" value="KEY_comma" name="KEY_comma"> , </button>
        <br>
        <button class="calc-button" style="width: 245px" type="submit" value="KEY_=" name="KEY_="> = </button>
    </form>

    <!-- 計算結果の出力 -->
    <h3>
        計算結果: <?php echo format_result($result2); ?>
    </h3>

</body>

</html>