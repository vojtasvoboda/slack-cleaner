<?php

include_once 'vendor/autoload.php';

use Tracy\Debugger;
Debugger::enable();

/**
 * INIT
 * - get token from https://api.slack.com/methods/im.history/test
 * - get channel name from https://api.slack.com/methods/im.list/test
 */
$channelName = '<CHANNEL-NAME>';
$token = '<GENERATED-TOKEN>';
$deletedCountInOneCall = 1000;

// slack can get only 100 last messages in one call
for($i = 1; $i < ($deletedCountInOneCall / 10); $i++)
{
    // get messages
    $messagesCount = 100;
    $messagesUrl = "https://slack.com/api/im.history?token=$token&channel=$channelName&count=$messagesCount&pretty=1";
    $messagesJson = file_get_contents($messagesUrl);
    $messages = json_decode($messagesJson);

    // get message timestamps
    $ts = [];
    if (isset($messages->messages)) {
        foreach($messages->messages as $m) {
            $ts[] = $m->ts;
        }
    }

    // delete URL
    $deleteUrl = "https://slack.com/api/chat.delete?token=$token&channel=$channelName&pretty=1&ts=";

    // delete all messages
    foreach ($ts as $t) {
        $r = file_get_contents($deleteUrl . $t);
    }

    echo "deleted" . sizeof($ts) . " messages" . "<br />";
}

exit("end");