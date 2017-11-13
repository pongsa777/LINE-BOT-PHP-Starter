<?php
$access_token = 'Y9lT8odvaDUoVdplE56f4TY/Lp4mQ2breR7juXBxnzUUR1UErKpfEL5aNB3aSQ2lqtKhIgRbw5lsqmJEIctPxUUoCp9/Br9iggMKhN0uH87RxZF3+ZLNT2m4/BtfoRl8w8y/LlfU4EGO/yus8vVZDgdB04t89/1O/w1cDnyilFU=';
$push_to_id = $_GET['id'];

if($push_to_id != ''){
    
    // Build message to push
    $messages = [
        'type' => 'text',
        'text' => 'Test push message'
    ];


    // Make a POST Request to Messaging API to reply to sender
    $url = 'https://api.line.me/v2/bot/message/push';
    $data = [
        'to' => $push_to_id,
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

}else{
    echo "id is NULL";
}
echo "ok";


    curl -X POST \
    -H 'Content-Type:application/json' \
    -H 'Authorization: Bearer {ENTER_ACCESS_TOKEN}' \
    -d '{
        "to": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "messages":[
            {
                "type":"text",
                "text":"Hello, user"
            },
            {
                "type":"text",
                "text":"May I help you?"
            }
        ]
    }' https://api.line.me/v2/bot/message/push
