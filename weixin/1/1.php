<?php
	$array =array('id'=>1,'username'=>'leo');
	$json = json_encode($array);
	//var_dump($json);
	$obj = json_decode($json);
	//var_dump($obj);

	$xml = <<<xml
<?xml version='1.0' encoding='utf-8' ?>
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName> 
<CreateTime>1348831860</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[this is a test]]></Content>
<MsgId>1234567890123456</MsgId>
</xml>

xml;

	$obj =simplexml_load_string($xml);
	//var_dump($obj);

	//echo'<pre>';var_dump($GLOBALS);
	phpinfo();