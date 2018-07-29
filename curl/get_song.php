<?php

    $params = $_GET['params'];
    $encSecKey = $_GET['encSecKey'];



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
        $songs = $obj->data[0];
        $song_url;
        foreach ($songs as $key=>$value) {
         if($key=='url'){
             $song_url = $value;
         } 
        }
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



    function curl($proxy,$port){
    $url = "http://music.163.com/weapi/song/enhance/player/url?csrf_token=";
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
    //curl_setopt($ch, CURLOPT_REFERER, "http://music.163.com");    //来路模拟
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    //curl_setopt($ch, CURLOPT_PROXY,$proxy[mt_rand(0,5)]);
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

    $con = curl_exec($ch);  

    curl_close($ch);
    return $con;
    }
                      //执行并存储结果


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>song address</title>
            <meta name="viewport" content="width=device-width">
        <center>
            <table style="width: 300px;"><tr>
            <td><h1><a href="index.php">回到首页</a></h1></td>
            <td><h1 ><a href="/curl_song/search_song.php">继续搜索</a></h1></td>
            </tr></table>
        </center>
    </head>
    
    <body>

        <center>
        <video controls autoplay name="media">
            <source src="<?php echo $song_url ?>" type="audio/mpeg">
        </video>
        </center>
    </body>
</html>
