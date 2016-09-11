<?php
	/**
	*评论删除
	*/
	require './lib/init.php';
	$comment_id = $_GET['comment_id'];
	// 获取当前评论的 art_id
	$sql = 'SELECT art_id FROM comment WHERE comment_id=$comment_id';
	$art_id = myGetOne($sql);
	// 删除评论表这条评论
	$sql = 'DELETE FROM comment WHERE comment_id=' . $comment_id;
	$rs = myQuery($sql);
	// 如果获取 art_id  成功 更改 art 表的 comm  评论数
	if($art_id) {
	$sql = 'UPDATE art SET comm=comm-1 WHERE art_id=' . $art_id;
	myQuery($sql);
	}
	// 跳转到上一页 commlist.php
	$ref = $_SERVER['HTTP_REFERER'];
	header("Location: $ref");