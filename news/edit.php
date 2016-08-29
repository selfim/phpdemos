<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>新闻管理系统</title>
</head>
<body>
	<?php 
	require './menu.php';
	//1.载入配置文件
	require './dbconfig.php';
	//2.连接数据库
	$link=new mysqli(HOST,USER,PASSWORD,DBNAME);
	$link->set_charset(CHARSET);
	//var_dump($link);exit();
	if(!$link){
	    exit('Connect ERROR'.$link->connect_error);
	}
	//3. 执行查询，并返回结果集
	$sql="SELECT * FROM news WHERE id={$_GET['id']}";
	$res=$link->query($sql);
	//4.判断是否获取到了要修改的信息
	if ($res && $res->num_rows){
	    $row=$res->fetch_assoc();
	}else{
	    exit('没有找到修改的信息');
	}
	?>
	<div align="center">
	<h3>编辑新闻</h3>
	<form action="action.php?act=update" method="post">
		<table width="500" border="0">
			<tr>
				<td align="right">标题:</td>
				<td><input type="text" name="title" value="<?php echo $row['title']; ?>"/></td>
			</tr>
			<tr>
				<td align="right">关键字:</td>
				<td><input type="text" name="keywords" value="<?php echo $row['keywords']; ?>" /></td>
			</tr>
			<tr>
				<td align="right">作者:</td>
				<td><input type="text" name="author" value="<?php echo $row['author']; ?>"/></td>
			</tr>
			<tr>
				<td align="right" valign="top">内容:</td>
				<td><textarea name="content" id="" cols="30" rows="10">"<?php echo $row['content']; ?>"</textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="修改" />&nbsp;&nbsp;&nbsp;
					<input type="reset" value="重置"/>
				</td>
			</tr>
			<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
		</table>
	</form>
	</div>
	
</body>
</html>

