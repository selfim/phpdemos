<?php
/**
 * Created by PhpStorm.
 * User: liam
 * Date: 2018/9/11
 * Time: 14:01
 */
ini_set('default_socket_timeout', -1);
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$strChannel = 'Test_liam_channel';

//发布
$redis->publish($strChannel, "come from {$strChannel} pub");
echo "---- {$strChannel} ----push success～ <br/>";
$redis->close();