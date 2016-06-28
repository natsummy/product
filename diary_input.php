<?php 
session_start();
$_SESSION['execute'] = false;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
        <title>Remind me</title>
    <style>
        form div {
            text-align:center;
            display:inline;
        }
    </style>    
    <link rel="stylesheet" href="/product/design.css">
</head>
<body>
    <h1>もやもや日記</h1>
    <div class="tab">
        <a class="head" href="/product/diary_list.php">日記一覧</a>
        <a class="head" href="/product/diary_input.php">日記を書く</a>
        <a class="head" href="/product/monthly_analysis.php">過去分析</a>
        <a class="head" href="/product/monthly_ranking.php">ランキング</a>
</div>
    <h2>日記を書く</h2>
    <form method="get" action="diary_update.php">
        <p>日付：　　
        <input type="date" name="date" value="YYYY-MM-DD">
        </p>
        <p>タイトル：
        <input type="text" name="title">
        </p>
        <p>やりたいことができた？</p>
        <div class="radio-class">
            <div>1</div>
            <div class="radio">
            <input type="radio" name="joy" value="1">
            </div>
            <div>2</div>
            <div class="radio"><input type="radio" name="joy" value="2"></div>
            <div>3</div>
            <div class="radio"><input type="radio" name="joy" value="3"></div>
            <div>4</div>
            <div class="radio"><input type="radio" name="joy" value="4"></div>
        </div>
        </br>
        <p>環境に満足してる？：</p>
        <div>1</div>
        <div class="radio"><input type="radio" name="sad" value="1"></div>
        <div>2</div>
        <div class="radio"><input type="radio" name="sad" value="2"></div>
        <div>3</div>
        <div class="radio"><input type="radio" name="sad" value="3"></div>
        <div>4</div>
        <div class="radio"><input type="radio" name="sad" value="4"></div>
        </br>
        <p>感謝できた？：</p>
        <div>1</div>
        <div class="radio"><input type="radio" name="angry" value="1"></div>
        <div>2</div>
        <div class="radio"><input type="radio" name="angry" value="2"></div>
        <div>3</div>
        <div class="radio"><input type="radio" name="angry" value="3"></div>
        <div>4</div>
        <div class="radio"><input type="radio" name="angry" value="4"></div>
        </br>
        <p>スキルは伸ばせた？：</p>
        <div>1</div>
        <div class="radio"><input type="radio" name="surprise" value="1"></div>
        <div>2</div>
        <div class="radio"><input type="radio" name="surprise" value="2"></div>
        <div>3</div>
        <div class="radio"><input type="radio" name="surprise" value="3"></div>
        <div>4</div>
        <div class="radio"><input type="radio" name="surprise" value="4"></div>
        </br>
        <p>
        やったこと、良かったことは？：</br>    
        <textarea name="do" rows="3" cols="50"></textarea></br>
        </p>
        <p>
        問題は？：</br>    
        <textarea name="problem" rows="3" cols="50"></textarea></br>
        </p>
        <p>
        次にやりたいことは？：</br>    
        <textarea name="plan" rows="3" cols="50"></textarea></br>
        </p>
        <p>
        メモ：</br>    
        <textarea name="memo" rows="5" cols="50"></textarea>
        </p>
        <input type="submit" name="submit" value="登録">
    </form>
    <form action="<?php echo $_SERVER['HTTP_REFERER'] ?>">
        <input type="submit" name="return" value="戻る">
    </form>
</body>
</html>