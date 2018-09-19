<?php
/**
 * Created by PhpStorm.
 * User: liam
 * Date: 2018/9/11
 * Time: 14:03
 */
ini_set('default_socket_timeout', -1);
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$strChannel = 'Test_liam_channel';


//订阅
echo "---- {$strChannel}，wait msg send...----  <br/><br/>";
$redis->subscribe([$strChannel], 'callBackFun');
function callBackFun($redis, $channel, $msg)
{
    print_r([
        'redis'   => $redis,
        'channel' => $channel,
        'msg'     => $msg
    ]);
}

