<?php
$joy = 0;
$sad = 0;
$angry = 0;
$surprise = 0;

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
        <title>分析</title>
    </head>
        <link rel="stylesheet" href="/product/table.css">
    <body>
        <div>
            <a href="/product/diary_list.php">日記一覧</a>
            <a href="/product/diary_input.php">日記を書く</a>
            <a href="/product/monthly_analysis.php">分析</a>
            <a href="/product/monthly_ranking.php">ランキング</a>
        </div>
        <h2>分析</h2>
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
        }
        ?>
            <tr>
                <td><?php print $joy;?></td>
                <td><?php print $sad;?></td>
                <td><?php print $angry;?></td>
                <td><?php print $surprise;?></td>
            </tr>
            </table>

        <div id="chartContainer"></div>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="Chart.js"></script>

    <!-- チャートが描画される場所-->
     <canvas id="canvas" width="300px" height="300px">
     </canvas>
    <script>
    (function() {
    // チャートの枠組み
      var radarChartData = {
        // 項目
        labels: ["やりたいこと", "環境に満足", "感謝", "スキル"],
        datasets: [
           {
           // 透明を使いたいのでRGBAで色を再現→rgba(xxx,xxx,xxx,0.5):透過度50%
           fillColor: "rgba(244,250,130,0.7)",  // チャート内の色
           strokeColor: "#111111",  // チャートを囲む線の色
           pointColor: "#111111",   // チャートの点の色
           pointStrokeColor: "#fff",    // 点を囲む線の色
           // 各項目の値
           data: [6,8,2,9]
           }
        ]
      };
       // レーダーチャートの目盛とかの設定
       var canvas = document.getElementById("canvas");
       var context = canvas.getContext("2d");
       var chart = new Chart(context);
       var rader = chart.Radar(radarChartData, {
           scaleShowLabels: true,  // 目盛を表示（true/false）
           pointLabelFontSize : 10, // ラベルのフォントサイズ
           scaleOverride : true, // 目盛の最大値を手動設定（true/false）
           scaleSteps : 10, // 目盛の数
           scaleStartValue : 0, // 目盛の最初の数
           scaleStepWidth : 1, // 目盛の間隔
           // 目盛の最大値の計算：scaleSteps（目盛の数）→5　scaleStepWidth（目盛の間隔）→2 だと5×2で最大値は10
       });
    });
    </script>
    </body>
</html>
