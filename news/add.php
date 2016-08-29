<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>新闻管理系统</title>
</head>
<body>
	<?php require './menu.php';?>
	<div align="center">
	<h3>发布新闻</h3>
	<form action="action.php?act=add" method="post">
		<table width="500" border="0">
			<tr>
				<td align="right">标题:</td>
				<td><input type="text" name="title"/></td>
			</tr>
			<tr>
				<td align="right">关键字:</td>
				<td><input type="text" name="keywords" /></td>
			</tr>
			<tr>
				<td align="right">作者:</td>
				<td><input type="text" name="author" /></td>
			</tr>
			<tr>
				<td align="right" valign="top">内容:</td>
				<td><textarea name="content" id="" cols="30" rows="10"></textarea></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="添加" />&nbsp;&nbsp;&nbsp;
					<input type="reset" value="重置"/>
				</td>
			</tr>
		</table>
	</form>
	</div>
	
</body>
</html>

