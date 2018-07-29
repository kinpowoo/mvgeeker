<?php 

    class curlController{

        private static $isMobile;

        function __construct(){
            self::$isMobile = M('client')->isMobile();
        }


        function resultlist(){
            if(isset($_POST)&&!empty($_POST)||isset($_GET)&&!empty($_GET)){

                $keyword = $_POST['keyword']==null?$_GET['keyword']:$_POST['keyword'];
                $pagenum = $_POST['pagenum']==null?$_GET['pagenum']:$_POST['pagenum'];

                if(!empty($keyword)){
                    //M('source')->addsearch($keyword);
                    $curlobj = M('curl');
                    $data = $curlobj->resultlist($keyword,$pagenum);

                    VIEW::assign(array('data' => $data));
                    VIEW::assign(array('keyword'=>$keyword));
                    VIEW::assign(array('pagenum'=>$pagenum));
 
                    if(self::$isMobile){
                        VIEW::display('tpl/front/mobile/result_list.html');
                    }else{
                        VIEW::display('tpl/front/pc/result_list.html');
                    }
                }

            }
        }



        function resultlink(){
           if(isset($_GET)&&!empty($_GET)){

                $target= $_GET['target'];
                $name = $_GET['name'];
                $site = $_GET['from'];


                $curlobj = M('curl');
                $data = $curlobj->resultlink($target,$name,$site);
                VIEW::assign(array('data' => $data));

                
                if(self::$isMobile){
                    VIEW::display('tpl/front/mobile/result_link.html');
                }else{
                    VIEW::display('tpl/front/pc/result_link.html');
                }
            }
        }


        function searchsong(){

            if(!empty($_GET['params'])&&!empty($_GET['encSecKey'])){
                $params = $_GET['params'];
                $encSecKey = $_GET['encSecKey'];
                $page = $_GET['page'];
                $keyword = $_GET['keyword'];

                $url = "http://music.163.com/weapi/cloudsearch/get/web?csrf_token=";
                //$url = "http://music.163.com/weapi/song/enhance/player/url?csrf_token=";
                $ch  = curl_init($url);
                $headers = array(
                    'Origin: http://music.163.com',
                    'Referer: http://music.163.com',
                    'Content-Type: application/x-www-form-urlencoded',
                );

                
                $proxy = array(
                    '106.39.179.9:80',
                    '116.199.115.79:80',
                    '116.199.115.78:82',
                    '147.94.81.119:8888',
                    '101.53.101.172:9999',
                    '121.196.226.246:84',
                );
                
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //返回数据不直接输出
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                //curl_setopt($ch, CURLOPT_PROXY,'106.39.179.9');
                //curl_setopt($ch, CURLOPT_PROXYPORT,'80');
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
                $obj = json_decode($con);
                $arr = $obj->result->songs;
                curl_close($ch);
                VIEW::assign(array('data' => $arr));
                VIEW::assign(array('page' => $page));
                VIEW::assign(array('keyword'=>$keyword));
                VIEW::display('tpl/front/pc/song_result.html');
            }else{
                VIEW::display('tpl/front/pc/song_result.html');
            }
        }



        function getsong(){

             if(isset($_GET)&&!empty($_GET)){
                
                $params = $_GET['params'];
                $encSecKey = $_GET['encSecKey'];

                $url = "http://music.163.com/weapi/song/enhance/player/url?csrf_token=";
                $ch  = curl_init($url);
                
                $headers = array(
                    'Origin: http://music.163.com',
                    'Referer: http://music.163.com',
                    'Content-Type: application/x-www-form-urlencoded',
                );
                /**
                $proxy = array(
                    '106.39.179.9:80',
                    '116.199.115.79:80',
                    '116.199.115.78:82',
                    '147.94.81.119:8888',
                    '101.53.101.172:9999',
                    '121.196.226.246:84',
                );
                */
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //返回数据不直接输出
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                //curl_setopt($ch, CURLOPT_REFERER, "http://music.163.com");    //来路模拟
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                //curl_setopt($ch, CURLOPT_PROXY,'106.39.179.9');
                //curl_setopt($ch, CURLOPT_PROXYPORT,'80');
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

                $con = curl_exec($ch);                    //执行并存储结果
                $obj = json_decode($con);
              
                
                curl_close($ch);
              
                $songs = $obj->data[0];
                $song_url;
                foreach ($songs as $key=>$value) {
                    if($key=='url'){
                        VIEW::assign(array('data' => $value));
                        VIEW::display('tpl/front/pc/song_address.html');
                    } 
                }
            }

        }

}


 ?>