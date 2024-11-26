<?php
$file = 'access.log';

// ファイルが存在し、読み取り可能か確認
if (file_exists($file) && is_readable($file)) {
    $access = json_decode(file_get_contents($file), true);

    if (is_array($access)) {
        echo "<h1>アクセスログ</h1>";
        echo "<ul>";
        foreach ($access as $entry) {
            // ログの各エントリを表示
            $colors = isset($entry['colors']) ? implode(', ', $entry['colors']) : '不明';
            $timestamp = isset($entry['timestamp']) ? $entry['timestamp'] : '不明';
            $ip = isset($entry['ip']) ? $entry['ip'] : '不明';

            echo "<li>色: {$colors} / 時刻: {$timestamp} / IP: {$ip}</li>";
        }
        echo "</ul>";
    } else {
        echo "ログが空または破損しています。";
    }
} else {
    echo "アクセスログが見つかりません。";
}
?>
