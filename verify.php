<?php
$access_token = 'Y9lT8odvaDUoVdplE56f4TY/Lp4mQ2breR7juXBxnzUUR1UErKpfEL5aNB3aSQ2lqtKhIgRbw5lsqmJEIctPxUUoCp9/Br9iggMKhN0uH87RxZF3+ZLNT2m4/BtfoRl8w8y/LlfU4EGO/yus8vVZDgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
