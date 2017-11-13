<?php
$access_token = 'Y9lT8odvaDUoVdplE56f4TY/Lp4mQ2breR7juXBxnzUUR1UErKpfEL5aNB3aSQ2lqtKhIgRbw5lsqmJEIctPxUUoCp9/Br9iggMKhN0uH87RxZF3+ZLNT2m4/BtfoRl8w8y/LlfU4EGO/yus8vVZDgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
            $replyToken = $event['replyToken'];
            //Get UserId
            $userId = $event['userid'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text.' replytoken = '.$replyToken.' userID = '.$userId
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";