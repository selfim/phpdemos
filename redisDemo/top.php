<?php
/**
 * Created by PhpStorm.
 * User: liam
 * Date: 2018/9/11
 * Time: 14:12
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$strKey = 'Test_liam_top';

//存储数据
$redis->zadd($strKey, '50', json_encode(['name' => 'Tom']));
$redis->zadd($strKey, '70', json_encode(['name' => 'John']));
$redis->zadd($strKey, '90', json_encode(['name' => 'Jerry']));
$redis->zadd($strKey, '30', json_encode(['name' => 'Job']));
$redis->zadd($strKey, '100', json_encode(['name' => 'LiMing']));

$dataOne = $redis->ZREVRANGE($strKey, 0, -1, true);
echo "{$strKey}";
print_r($dataOne);

$dataTwo = $redis->ZRANGE($strKey, 0, -1, true);
#echo "<br /><br />---- {$strKey}由小到大的排序 ---- <br /><br />";
#print_r($dataTwo);

