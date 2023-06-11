<!DOCTYPE html>
<html>

<head>
    <title>プログラミング言語III及び演習</title>
    <meta http-equiv="content-type" charset="UTF-8">
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
    $result = $_POST['result'];

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
        $result .= "*0.01";
    } elseif (isset($_POST['KEY_+'])) {
        $result .= '+';
    } elseif (isset($_POST['KEY_-'])) {
        $result .= '-';
    } elseif (isset($_POST['KEY_*'])) {
        $result .= '*';
    } elseif (isset($_POST['KEY_/'])) {
        $result .= '/';
    } elseif (isset($_POST['KEY_='])) {
        if (strpos($result, '+') !== false) {
            $parts = explode('+', $result);
            if (count($parts) == 2) {
                $result = $parts[0] + $parts[1];
            }
        } elseif (strpos($result, '-') !== false) {
            $parts = explode('-', $result);
            if (count($parts) == 2) {
                $result = $parts[0] - $parts[1];
            }
        } elseif (strpos($result, '*') !== false) {
            $parts = explode('*', $result);
            if (count($parts) == 2) {
                $result = $parts[0] * $parts[1];
            }
        } elseif (strpos($result, '/') !== false) {
            $parts = explode('/', $result);
            if (count($parts) == 2 && $parts[1] != 0) {
                $result = $parts[0] / $parts[1];
            }
        }
    }

    function output_result($str)
    {
        return $str;
    }
    ?>

    <form method="post" action="./kadai08_1.php">
        <input type="hidden" name="result" value="<?php echo $result; ?>" />

        <button class="calc-button" type="submit" value="KEY_AC" name="KEY_AC"> AC </button>
        <button class="calc-button" type="submit" value="KEY_BS" name="KEY_BS"> BS </button>
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
        <button class="calc-button" type="submit" value="KEY_." name="KEY_."> . </button>
        <button class="calc-button" type="submit" value="KEY_=" name="KEY_="> = </button>

    </form>

    <!-- 計算結果の出力 -->
    <p>
        入力式: <?php echo $result; ?>
    </p>

    <p>
        計算結果: <?php echo output_result($result); ?>
    </p>

</body>

</html>
