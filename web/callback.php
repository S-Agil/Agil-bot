<?php
require_once __DIR__ . "/../vendor/autoload.php";

// post取得 jsonへ
$postData = file_get_contents('php://input');
$json = json_decode($postData);

$event = $json->events[0];
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('LineMessageAPIChannelAccessToken'));
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('LineMessageAPIChannelSecret')]);

$replyMessage = null;
if ($event->message->type == "text") {
    // textなら返信
    $replyMessage = "こんぐら！";
}

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($replyMessage);
// メッセージ送信
$response = $bot->replyMessage($event->replyToken, $textMessageBuilder);
return;