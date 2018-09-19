<?php
/**
 * Created by PhpStorm.
 * User: liam
 * Date: 2018/9/11
 * Time: 14:05
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$strKey = 'Test_liam_comments';

//设置初始值
$redis->set($strKey, 0);

$redis->INCR($strKey);  //+1
$redis->INCR($strKey);  //+1
$redis->INCR($strKey);  //+1

$strNowCount = $redis->get($strKey);

echo "{$strNowCount}";
