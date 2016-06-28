<?php
$diary_data = array();

$host   = 'localhost';
$username   = 'codecamp9292';
$passwd = 'UVTJHGPP';
$dbname = 'codecamp9292';

$link   = mysqli_connect($host, $username, $passwd, $dbname);
$url = 'http://codecamp9292.lesson4.codecamp.jp/product/diary_list.php';

// 接続成功した場合
if ($link) {
    // 文字化け防止
    mysqli_set_charset($link, 'utf8');
    $id = $_GET['diary_id'];
    $select_diary = "SELECT date, title, do, problem, plan, memo, joy, sad, angry, surprise FROM diary_table where diary_id = '$id'";
    $delete_diary = "DELETE from diary_table where diary_id = '$id'";

    // クエリを実行します
    if (mysqli_query($link, $select_diary) === false) {
        print 'diary select失敗';
    }

    $result_diary = mysqli_query($link, $select_diary);
    $diary_data = mysqli_fetch_array($result_diary);

    if (isset($_POST["button"])) {
        $kbn = htmlspecialchars($_POST["button"], ENT_QUOTES, "UTF-8");
        switch ($kbn) {
            case "削除する": mysqli_query($link, $delete_diary); header("Location: {$url}"); exit;
            default:  echo "エラー"; exit;
        }
    }

    mysqli_free_result($result_diary);

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
    <h2>日記詳細</h2>
    <table>
      <tr>
        <th>日付</th>
        <td>
        <?php print htmlspecialchars($diary_data['date'], ENT_QUOTES, 'UTF-8');?>
        </td>
      </tr>
      <tr>
        <th>タイトル</th>
        <td>
        <?php print htmlspecialchars($diary_data['title'], ENT_QUOTES, 'UTF-8');?>
        </td>
      </tr>
      <tr>
        <th>やりたいことができた？</th>
        <td>
        <?php print htmlspecialchars($diary_data['joy'], ENT_QUOTES, 'UTF-8');?>点
        </td>
      </tr>
      <tr>
        <th>環境に満足してる？</th>
        <td>
        <?php print htmlspecialchars($diary_data['sad'], ENT_QUOTES, 'UTF-8');?>点
        </td>
      </tr>
      <tr>
        <th>感謝できた？</th>
        <td>
        <?php print htmlspecialchars($diary_data['angry'], ENT_QUOTES, 'UTF-8');?>点
        </td>
      </tr>
      <tr>
        <th>スキルは伸ばせた？</th>
        <td>
        <?php print htmlspecialchars($diary_data['surprise'], ENT_QUOTES, 'UTF-8');?>点
        </td>
      </tr>
      <tr>
        <th>やったこと、良かったことは？</th>
        <td>
        <?php print htmlspecialchars($diary_data['do'], ENT_QUOTES, 'UTF-8');?>
        </td>
      </tr>
      <tr>
        <th>問題は？</th>
        <td>
        <?php print htmlspecialchars($diary_data['problem'], ENT_QUOTES, 'UTF-8');?>
        </td>
      </tr>
      <tr>
        <th>次にやりたいことは？</th>
        <td>
        <?php print htmlspecialchars($diary_data['plan'], ENT_QUOTES, 'UTF-8');?>
        </td>
      </tr>
      <tr>
        <th>メモ</th>
        <td>
        <?php print htmlspecialchars($diary_data['memo'], ENT_QUOTES, 'UTF-8');?>
        </td>
      </tr>
    </table>
    <form method="POST" action="">
        <input type="submit" name="button" value="戻る" onClick="form.action='diary_list.php';return true">
        <input type="submit" name="button" value="削除する" onClick="window.confirm('削除してよろしいですか？')">
    </form>
</body>
</html>