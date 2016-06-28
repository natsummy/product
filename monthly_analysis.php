<?php
$joy = 0;
$sad = 0;
$angry = 0;
$surprise = 0;
$total = 0;

$host   = 'localhost';
$username   = 'codecamp9292';
$passwd = 'UVTJHGPP';
$dbname = 'codecamp9292';

$link   = mysqli_connect($host, $username, $passwd, $dbname);

// 接続成功した場合
if ($link) {
    // 文字化け防止
    mysqli_set_charset($link, 'utf8');
    $select = "select joy, sad, angry, surprise from diary_table";
    // クエリを実行します
    $result = mysqli_query($link, $select);
     
    while($row = mysqli_fetch_array($result)) {
        $feeling_data[] = $row;
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
        <h2>過去分析</h2>
            <table>
                <tr>
                    <th>やりたいこと</th>
                    <th>環境に満足</th>
                    <th>感謝</th>
                    <th>スキル</th>
                </tr>
        <?php
        foreach ($feeling_data as $value) {
            $joy = $joy + $value['joy'];
            $sad = $sad + $value['sad'];
            $angry = $angry + $value['angry'];
            $surprise = $surprise + $value['surprise'];
            $total = $total + 4;
        }
        ?>
            <tr>
                <td><?php print $joy;?>/<?php print $total;?>点</td>
                <td><?php print $sad;?>/<?php print $total;?>点</td>
                <td><?php print $angry;?>/<?php print $total;?>点</td>
                <td><?php print $surprise;?>/<?php print $total;?>点</td>
            </tr>
            </table>

        <div id="chartContainer"></div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/canvasjs/1.7.0/canvasjs.min.js"></script>
        <script>
        
        var joy = <?php print $joy;?>;
        var sad = <?php print $sad;?>;
        var angry = <?php print $angry;?>;
        var surprise = <?php print $surprise;?>;
        //チャート用データ
        var dataPlot = [
          { label: "やりたいこと",   y: joy },
          { label: "環境に満足", y: sad },
          { label: "感謝",   y: angry },
          { label: "スキル", y: surprise },
        ];
        //========================================
        
        //チャートの生成
        var chart = new CanvasJS.Chart("chartContainer", {
          data: [{
            type: 'pie',
            dataPoints: dataPlot
          }]
        });
        chart.render();
    </script>
    </body>
</html>
