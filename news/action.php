<?php
    /*
     * 信息增、删和改操作的处理
     */
    //1.载入配置文件
    require './dbconfig.php';
    //2.连接数据库
    $link=new mysqli(HOST,USER,PASSWORD,DBNAME);
    $link->set_charset(CHARSET);
    //var_dump($link);exit();
    if(!$link){
        exit('Connect ERROR'.$link->connect_error);
    }
    //3.根据获取的act值，判断所属操作并执行
    switch ($_GET['act']){
        case "add"://添加操作
            //获取添加信息
            $title=trim($_POST['title']);
            $keywords=trim($_POST['keywords']);
            $author=trim($_POST['author']);
            $content=trim($_POST['content']);
            $addtime=time();
            //拼接SQL语句
            $sql="INSERT INTO news(title,keywords,author,addtime,content)
                VALUES('$title','$keywords','$author','$addtime','$content')";
            //echo $sql;exit;
            $res=$link->query($sql);
            if ($link->insert_id>0){
                echo "<h3>添加成功！</h3>";
            }else {
                echo "<h3>添加失败！</h3>";
            }
            echo "<a href='javascript:window.history.back();'>返回</a>&nbsp;&nbsp;&nbsp;";
            echo "<a href='index.php'>浏览新闻</a>";
            break;
        case "del"://删除操作
            //1、获取id
            $id=$_GET['id']+0;
            //2、拼接SQL 并执行删除操作
            $sql="DELETE FROM news WHERE id=$id";
            $res=$link->query($sql);
            if ($res){
                echo "<h3>删除成功</h3>";
                header("Location:index.php");
            }
            break;
        case "update"://更新操作
            //1.获取更新的内容
            $title=trim($_POST['title']);
            $keywords=trim($_POST['keywords']);
            $author=trim($_POST['author']);
            $content=trim($_POST['content']);
            $id = $_POST['id']+0;
            
            //2.拼接SQL 并执行更新操作
            $sql="UPDATE news SET title='{$title}',keywords='{$keywords}',author='{$author}',content='{$content}' WHERE id={$id}";
            //echo $sql;exit();
            $res=$link->query($sql);
            if ($res){
                echo "<h3>更新成功</h3>";
                header("Location:index.php");
            }
            break;
    }
    //4.关闭数据资源
    $link->close();