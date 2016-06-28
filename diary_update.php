<?php
session_start();

$host   = 'localhost';
$username   = 'codecamp9292';
$passwd = 'UVTJHGPP';
$dbname = 'codecamp9292';

$link   = mysqli_connect($host, $username, $passwd, $dbname);

$date = $_GET['date'];
$title = $_GET['title'];
$do = $_GET['do'];
$problem = $_GET['problem'];
$plan = $_GET['plan'];
$memo = $_GET['memo'];
$joy = $_GET['joy'];
$sad = $_GET['sad'];
$angry = $_GET['angry'];
$surprise = $_GET['surprise'];

// 接続成功した場合
if ($link) {
    // 文字化け防止
    mysqli_set_charset($link, 'utf8');
    $insert_diary= "INSERT INTO diary_table(date, title, do, problem, plan, memo, joy, sad, angry, surprise) VALUES('$date' ,'$title', '$do', '$problem','$plan', '$memo', '$joy', '$sad', '$angry', '$surprise')";

    // クエリを実行します
    if($_SESSION['execute'] == false) { 
        if ((mysqli_query($link, $insert_diary) === TRUE)) {
            $msg = $date . 'の日記を追加しました(>u< )';
            $_SESSION['execute'] = true;
        } else {
            $msg = '日記登録失敗';
        }
    } else {
        header("Location: http://codecamp9292.lesson4.codecamp.jp/product/diary_list.php");
    }
    //接続を閉じる
    mysqli_close($link);

//接続失敗した場合
}else {
    print 'DB接続失敗';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>もやもや日記</title>
    <link rel="stylesheet" href="/product/design.css">
</head>
<body>
    <h1>もやもや日記</h1>
    <dev><?php print htmlspecialchars($msg, ENT_QUOTES,'UTF-8');?></dev>
    <form>
        <input type="submit" name="submit" value="日記一覧に戻る" onClick="form.action='diary_list.php';return true">
    </form>
</body>
</html>