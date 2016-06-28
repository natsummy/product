<?php
$joy_before = 0;

$host   = 'localhost';
$username   = 'codecamp9292';
$passwd = 'UVTJHGPP';
$dbname = 'codecamp9292';

$link   = mysqli_connect($host, $username, $passwd, $dbname);

// 接続成功した場合
if ($link) {
    // 文字化け防止
    mysqli_set_charset($link, 'utf8');
    $select_good = "select diary_id, date, title, joy + sad + angry + surprise as total from diary_table order by total desc limit 3";
    $select_bad = "select diary_id, date, title, joy + sad + angry + surprise as total from diary_table order by total asc limit 3";
    // クエリを実行します
    $result_good = mysqli_query($link, $select_good);
    $result_bad = mysqli_query($link, $select_bad);

    while($row_good = mysqli_fetch_array($result_good)) {
        $data_good[] = $row_good;
    }

    while($row_bad = mysqli_fetch_array($result_bad)) {
        $data_bad[] = $row_bad;
    }

   mysqli_free_result($result_good);
   mysqli_free_result($result_bad);

    //接続を閉じる
    mysqli_close($link);

//接続失敗した場合
}else {
    print 'DB接続失敗';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>もやもや日記</title>
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
        <h2>ランキング</h2>
        <p>トータルよかった日(`･ω･´)</p>
        <table>
            <tr>
                <th>ベスト順位</th>
                <th>日付</th>
                <th>タイトル</th>
                <th>総合点</th>
            </tr>
            <?php
            $n = 1;
            foreach ($data_good as $value) {
            ?>
            <tr>
                <td><?php print $n ?>位</td>
                <td><?php print htmlspecialchars($value['date'], ENT_QUOTES, 'UTF-8');?></td>
                <td><a href="/product/diary_detail.php?diary_id=<?php print $value['diary_id']?>"><?php print htmlspecialchars($value['title'], ENT_QUOTES, 'UTF-8');?></a></td>
                <td><?php print $value['total']?>点</td>
            </tr>
            <?php
            $n++;
            } ?>
        </table>
        <p>うまくいかなかった日(´･ω･`)</p>
        <table>
            <tr>
                <th>ワースト順位</th>
                <th>日付</th>
                <th>タイトル</th>
                <th>総合点</th>
            </tr>
            <?php
            $n = 1;
            foreach ($data_bad as $value) {
            ?>
            <tr>
                <td><?php print $n ?>位</td>
                <td><?php print htmlspecialchars($value['date'], ENT_QUOTES, 'UTF-8');?></td>
                <td><a href="/product/diary_detail.php?diary_id=<?php print $value['diary_id']?>"><?php print htmlspecialchars($value['title'], ENT_QUOTES, 'UTF-8');?></a></td>
                <td><?php print $value['total']?>点</td>
            </tr>
            <?php
            $n++;
            } ?>
        </table>
    </body>
</html>