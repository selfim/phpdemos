<?php
header("Content-type:text/html;charset=utf-8");
#echo phpinfo();exit;
/**
 * @desc 方法一、生成word文档
 * @param $content
 * @param string $fileName
 */
function createWord($content='',$fileName='new_file.doc'){
    if(empty($content)){
        return;
    }
    $content='<html 
            xmlns:o="urn:schemas-microsoft-com:office:office" 
            xmlns:w="urn:schemas-microsoft-com:office:word" 
            xmlns="http://www.w3.org/TR/REC-html40">
            <meta charset="UTF-8" />'.$content.'</html>';
    if(empty($fileName)){
        $fileName=date('YmdHis').'.doc';
    }
    $fp=fopen($fileName,'wb');
    fwrite($fp,$content);
    fclose($fp);
}

$str = '<h1 style="color:red;">我是h1</h1><h2>我是h2</h2>';
#createWord($str);


$str ='a:5:{s:5:"adata";a:22:{i:0;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"6319";s:15:"from_branch_num";i:1854;s:13:"to_branch_num";i:102;s:3:"num";i:300;}i:1;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2197";s:15:"from_branch_num";i:2760;s:13:"to_branch_num";i:20;s:3:"num";i:100;}i:2;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2261";s:15:"from_branch_num";i:7600;s:13:"to_branch_num";i:40;s:3:"num";i:80;}i:3;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"5214";s:15:"from_branch_num";i:40;s:13:"to_branch_num";i:20;s:3:"num";i:20;}i:4;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2269";s:15:"from_branch_num";i:1320;s:13:"to_branch_num";i:30;s:3:"num";i:30;}i:5;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"7086";s:15:"from_branch_num";i:31760;s:13:"to_branch_num";i:200;s:3:"num";i:320;}i:6;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2442";s:15:"from_branch_num";i:900;s:13:"to_branch_num";i:50;s:3:"num";i:50;}i:7;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"7087";s:15:"from_branch_num";i:25320;s:13:"to_branch_num";i:200;s:3:"num";i:80;}i:8;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2192";s:15:"from_branch_num";i:600;s:13:"to_branch_num";i:60;s:3:"num";i:40;}i:9;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2181";s:15:"from_branch_num";i:240;s:13:"to_branch_num";i:20;s:3:"num";i:80;}i:10;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2238";s:15:"from_branch_num";i:760;s:13:"to_branch_num";i:40;s:3:"num";i:240;}i:11;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2194";s:15:"from_branch_num";i:6040;s:13:"to_branch_num";i:200;s:3:"num";i:120;}i:12;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"6896";s:15:"from_branch_num";i:1650;s:13:"to_branch_num";i:120;s:3:"num";i:150;}i:13;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2299";s:15:"from_branch_num";i:504;s:13:"to_branch_num";i:72;s:3:"num";i:24;}i:14;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2281";s:15:"from_branch_num";i:2750;s:13:"to_branch_num";i:130;s:3:"num";i:20;}i:15;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2196";s:15:"from_branch_num";i:1520;s:13:"to_branch_num";i:400;s:3:"num";i:200;}i:16;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2394";s:15:"from_branch_num";i:10620;s:13:"to_branch_num";i:120;s:3:"num";i:1020;}i:17;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"5456";s:15:"from_branch_num";i:840;s:13:"to_branch_num";i:60;s:3:"num";i:120;}i:18;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2196";s:15:"from_branch_num";i:1520;s:13:"to_branch_num";i:400;s:3:"num";i:80;}i:19;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"2463";s:15:"from_branch_num";i:11820;s:13:"to_branch_num";i:1440;s:3:"num";i:1800;}i:20;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"5420";s:15:"from_branch_num";i:720;s:13:"to_branch_num";i:40;s:3:"num";i:64;}i:21;a:8:{s:11:"from_pos_id";i:0;s:9:"to_pos_id";i:0;s:14:"from_branch_id";s:3:"221";s:12:"to_branch_id";s:3:"233";s:10:"product_id";s:4:"5222";s:15:"from_branch_num";i:4080;s:13:"to_branch_num";i:40;s:3:"num";i:80;}}s:18:"appropriation_type";i:2;s:4:"memo";s:27:"立仓猫超北京顺义库";s:8:"operator";s:6:"王芳";s:3:"msg";a:0:{}}';
#var_export(unserialize($str));

/**
 * @desc 方法二、生成word文档并下载
 * @param $content
 * @param string $fileName
 */
function downloadWord($content, $fileName='new_file.doc'){

    if(empty($content)){
        return;
    }

    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=$fileName");

    $html = '<html xmlns:v="urn:schemas-microsoft-com:vml"
         xmlns:o="urn:schemas-microsoft-com:office:office"
         xmlns:w="urn:schemas-microsoft-com:office:word" 
         xmlns:m="http://schemas.microsoft.com/office/2004/12/omml" 
         xmlns="http://www.w3.org/TR/REC-html40">';
    $html .= '<head><meta charset="UTF-8" /></head>';

    echo $html . '<body>'.$content .'</body></html>';

}

$str = '<h4>表头：</h4>
<table border="1">
<tr>
  <th>姓名</th>
  <th>电话</th>
  <th>电话</th>
</tr>
<tr>
  <td>Bill Gates</td>
  <td>555 77 854</td>
  <td>555 77 855</td>
</tr>
</table>';

#downloadWord($str, 'abc.doc');

