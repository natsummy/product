<?php
$diary_data = array();
$order = 'DESC';

if (isset($_GET['order']) === TRUE) {
    $order = $_GET['order'];
}

$host   = 'localhost';
$username   = 'codecamp9292';
$passwd = 'UVTJHGPP';
$dbname = 'codecamp9292';

$link   = mysqli_connect($host, $username, $passwd, $dbname);

// 接続成功した場合
if ($link) {
    // 文字化け防止 文字コードセット
    mysqli_set_charset($link, 'utf8');
    $select = "SELECT diary_id, date, title FROM diary_table order by date $order";
    // クエリを実行します
    if ($result = mysqli_query($link, $select)) {
        while($row = mysqli_fetch_array($result)) {
            $diary_data[] = $row;
        }
    }
    mysqli_free_result($result);
    
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
    <title>一覧ページ</title>
    <link rel="stylesheet" href="/product/design.css">
</head>
<body>
<div class="wrapper">
    <div class="tab">
        <a class="head" href="/product/diary_list.php">日記一覧</a>
        <a class="head" href="/product/diary_input.php">日記を書く</a>
        <a class="head" href="/product/monthly_analysis.php">分析</a>
        <a class="head" href="/product/monthly_ranking.php">ランキング</a>
    </div>
    <h2>日記一覧 </h2>
    <form>
        <select name="order">
        <option value="DESC" <?php if ($order === 'DESC') {print 'selected';} ?>>新しい順</option>
        <option value="ASC"<?php if ($order === 'ASC') {print 'selected';} ?>>古い順</option>
        </select>
        <input type="submit" value="表示">
    </form>
    <table>
        <tr>
            <th>日付</th>
            <th>タイトル</th>
        </tr>
<?php
foreach ($diary_data as $value) {
?>
    <tr>
        <td><?php print htmlspecialchars($value['date'], ENT_QUOTES, 'UTF-8');?></td>
        <td><a href="/product/diary_detail.php?diary_id=<?php print $value['diary_id']?>"><?php print htmlspecialchars($value['title'], ENT_QUOTES, 'UTF-8');?></a></td>
    </tr>
<?php
}
?>
    </table>
</div>
</body>
</html>
