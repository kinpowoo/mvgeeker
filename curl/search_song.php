<?php

    include_once('../libs/ORG/phpQuery/phpQuery.php');

    $params = $_GET['params'];
    $encSecKey = $_GET['encSecKey'];
    $page = $_GET['page'];
    $keyword = $_GET['keyword'];


    $proxy_url ="www.xicidaili.com";
    $host = "xicidaili.com";
    $con = curl_init($proxy_url,$host)；
    phpQuery::newDocumentHtml($con);

    $ips = pq("tr.odd td:nth-child(2)");
    $ports = pq("tr.odd td:nth-child(3)");

    $ip_arr = array();
    $port_arr = array();
    foreach($ips as $ip){
        $ip_arr[] = pq($ip)->text();
    }

    foreach($ports as $port){
        $port_arr[] = pq($port)->text();
    }



    $index = 0;

    start_search($index);

    function start_search($index){
    if($ip_arr.length>0){
        $search_result = search($ip_arr[index],$port_arr[index]);

        $obj = json_decode($search_result);
        
        
        if($obj==null&&$index<$ip_arr.length){
            $index = $index+1;
            start_search($index);
        }else{
            $songs = $obj->result->songs;
        }

        }
    }

    
    

   public function curl_init($url,$refer,$keyword='',$method='GET'){

            $ch  = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //返回数据不直接输出
            curl_setopt($ch, CURLOPT_REFERER, $refer);    //来路模拟
            curl_setopt($ch, CURLOPT_ENCODING, "gzip"); //指定gzip压缩

            if($method == 'POST'){
                curl_setopt($ch, CURLOPT_POST, 1);     //发送POST类型数据
                $post   = array(
                'wd'=> urlencode($keyword),
                );
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);  //POST数据，$post可以是数组，也可以是拼接
            }
           
            $content = curl_exec($ch);                    //执行并存储结果
            curl_close($ch);

            return $content;
        }




    function search($proxy,$port){
     $url = "http://music.163.com/weapi/cloudsearch/get/web?csrf_token=";
    //$url = "http://music.163.com/weapi/song/enhance/player/url?csrf_token=";
    $ch  = curl_init($url);
    $headers = array(
        'Origin: http://music.163.com',
        'Referer: http://music.163.com',
        'Content-Type: application/x-www-form-urlencoded',
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //返回数据不直接输出
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //curl_setopt($ch, CURLOPT_PROXY,$proxy[mt_rand(0,5)]);
    //curl_setopt($ch, CURLOPT_REFERER, "http://music.163.com");    //来路模拟
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_TIMEOUT,60);
    //curl_setopt($ch, CURLOPT_ENCODING, "gzip"); //指定gzip压缩
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);    //SSL 报错时使用

    curl_setopt($ch, CURLOPT_POST,true);     //发送POST类型数据
 
    $post = array(
        'params'=> $params,
        'encSecKey'=>$encSecKey,
    );

    $post = http_build_query($post);


    curl_setopt($ch, CURLOPT_POSTFIELDS,$post);  //POST数据，$post可以是数组，也可以是拼接

    $con = curl_exec($ch);                    //执行并存储结果
    curl_close($ch);
    return $con;

    }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Search Result</title>
        <script src="js/AES.js"></script>
        <script src="js/sha256.js"></script>
        <script src="js/Base64.js"></script>
        <script src="js/encrypt.js"></script>
        <script src="js/BigInt.js"></script>
        <script src="js/Barrett.js"></script>
        <script src="js/RSA.js"></script>
        <script src="js/core-min.js"></script>
        <script src="js/cipher-core-min.js"></script>  
        <script src="js/mode-ecb-min.js"></script>  
        <script src="js/aes-min.js"></script>  
        <script src="js/gen-params.js"></script>  

        <center style="color:#4682B4;padding: 5px;">
        <h2 >歌曲下载链接生成</h2>
        <a href="/index.php">回到首页</a>
        </center>
        <hr>
    </head>

 <body style="background-color:#ffe000;">
 
<center>
<div style="width:460px;">

    <table style="font-size: 24px;">
            <tr>
              <td style="color:#4682B4;">歌名</td>
              <td><input type="text" name="" id="keyword"/></td>
              <td style="height:50px;width:69px;"><input type="button" value="搜 索" onclick="javascript:encrypt()"/></td>
            </tr>
   </table>
   </div>
   <div id="param3"></div>
</center>

   <center>
    <table border="1" style="background-color:#fff000;"> 
        <tr>
            <td style="width:80px;text-align:center;">封面</td>
            <td style="width:240px;text-align:center;">歌名</td>
            <td style="width:120px;text-align:center;">歌手</td>
            <td style="width:300px;text-align:center;">专辑名称</td>
            <td style="width:140px;text-align:center;">发行日期</td>
            <td style="width:60px;text-align:center;">进入</td>
        <tr>
            <?php
            foreach($songs as $value){ ?>
            <tr>
                <td><img style="width:80px;height:80px;" src="<?php echo $value->al->picUrl ?>"/></td>
                <td style="width:240px;text-align:center;"><?php echo $value->name ?></td>
                <td style="width:120px;text-align:center;"><?php echo $value->ar[0]->name ?></td>
                <td style="width:300px;word-break:break-all;text-align:center;"><?php echo $value->al->name ?></td>
                <td style="width:140px;text-align:center;"><?php echo date('Y-m-d',$value->publishTime/1000) ?></td>
                <td style="width:140px;text-align:center;">
                    <span style="text-decoration: underline;cursor: pointer;" onclick="javascript:getsong(<?php echo $value->id ?>);">下载</span>
                </td>
            </tr>
            
            <?php } ?>
     </table>       
        <div>
        <span style="text-decoration: underline;cursor: pointer;" onclick="javascript:encrypt(1,'<?php echo $keyword ?>');">首页</span>
        <span style="text-decoration: underline;cursor: pointer;" onclick="javascript:encrypt(<?php echo $page-1 ?>,'<?php echo $keyword ?>');">上一页</span>
        <span style="text-decoration: underline;cursor: pointer;" onclick="javascript:encrypt(<?php echo $page+1 ?>,'<?php echo $keyword ?>');">下一页</span>
    </div>
</center>
</body>
</html> 