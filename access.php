<?php
// 単純なアクセスログの場合
$time = date('H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
$data = "{$time}\t{$ip}\r\n";
// 追加書き込み専用　の設定：オープンモード
$file = @fopen('access.log','a') or die(',ファイルを開けませんでした。');
flock($file, LOCK_EX);
fwrite($file, $data);
flock($file, LOCK_UN);
fclose($file);

echo 'アクセスログを記録しました。';