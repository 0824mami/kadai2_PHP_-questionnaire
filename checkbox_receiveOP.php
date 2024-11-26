<?php
$colors = isset($_POST['colors']) ? $_POST['colors'] : [];
// $selectedColor = $_POST['colors'];
$file = 'access.log';
if (file_exists($file)){
    $access = json_decode(file_get_contents($file), true) ?? [];
}
// POSTデータを追記（タイムスタンプとIPアドレスを含む）
if (!empty($colors)) {
    $entry = [
        'colors' => $colors, //変数 $colorsの値を 'colors' というキーを持つ配列要素として、配列 $entry の中に格納
        'timestamp' => date('Y-m-d H:i:s'), 
        'ip' => $_SERVER['REMOTE_ADDR'],   // アクセス元
    ];
    $access[] = $entry;
    file_put_contents($file, json_encode($access, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)); // JSON形式で保存
}
?>

<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<h1>受信ページ</h1>
<h3>好きな色</h3>
<ul>
<?php foreach ($colors as $var) { ?>
<li><?php echo htmlspecialchars($var, ENT_QUOTES, 'UTF-8'); ?></li>
<?php } ?>
</ul>

<p>あなたの好きな色は<?php echo htmlspecialchars(implode('と', $colors), ENT_QUOTES, 'UTF-8'); ?>です。</p>
<a href="read1.php">アクセスログ一覧</a>
</body>
</html>

