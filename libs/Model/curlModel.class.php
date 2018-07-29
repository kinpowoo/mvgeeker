<?php 


    class curlModel{

        

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



        /**
          获得搜索结果条目里的资源链接
        */
        function resultlink($target,$name,$from){

            $res = array();

            if(!empty($name)&& $name!=null && !empty($target)&& $target!=null){
                
                $refer = 'http://www.dyxia.com/';
                $url = $refer.$target;
              
                $content = $this->curl_init($url,$refer);
               
                phpQuery::newDocumentHtml($content);

                $items = pq("div.con4 ul.downurl li");
                $items2 = pq("div#bt ul li");
                

                foreach ($items as $item) {

                    $obj = pq($item)->find('a');     
                    
                    $title = pq($obj)->text();
                    $url = pq($obj)->attr('href');

                    
                    $ret = array('title' =>$title,'url' =>$url);
                    $res[] = $ret;
                }

                foreach ($items2 as $item2) {

                    $item = pq($item2);     
                    $objb = $item->find("a");
                    
                    $title2 = pq($objb)->text();
                    $url2 = pq($objb)->attr('href'); 
                    
                    $ret = array('title' =>$title2,'url'=>$url2);
                    $res[] = $ret;
                }

            }


                /**
                   btmilk参数入口处理逻辑
                */
                if(!empty($from)&&strcmp($from,'btmilk')==0){

                   $refer2 = 'http://btmilk.com';
                   $url2 = $refer2.$target;
                    
                   $content2 = $this->curl_init($url2,$refer2);

                   phpQuery::newDocumentHtml($content2);
                
                   $items2 = pq("div.container div.row div.col-md-8 div a:first");
 
                   $magnet2 = pq($items2)->attr('href'); 



                   $ret = array('title' =>$name,'url'=>$magnet2);
                   $res[] = $ret;

               }



                /**
                   sobt8参数入口处理逻辑
                */
               if(!empty($from)&&strcmp($from,'sobt')==0){
             
                    $refer3 = 'http://www.sobt8.com';
                    $url3 = $refer3.$target;
        
                    $content3 = $this->curl_init($url3,$refer3);
                    phpQuery::newDocumentHtml($content3);

                    $items3 = pq("div.fileDetail span:first");

                    $magnet3 = pq($items3)->text(); 

                    $ret = array('title' =>$name,'url'=>$magnet3);
                    $res[] = $ret;
                
               }

            return $res;       
        }




    /**
        根据关键字和页数获得搜索结果列表
    */    
        public function resultlist($keyword,$pagenum){



            if(empty($pagenum)){
                $pagenum = 1;
            } 

            $res = array();   //查询结果存放处


            /**
              此段全集网数据抓取
            */
            if($pagenum==1){

                $url = 'http://www.dyxia.com/index.php?s=vod-search';
                $refer = 'http://www.dyxia.com/';
          
                $content = $this->curl_init($url,$refer,$keyword,'POST');

                phpQuery::newDocumentHtml($content);
               
                $items = pq("ol");

                foreach ($items as $item) {

                    $item = pq($item);     
                    $obja = $item->find("label a");
                    $objb = $item->find("b");
                    $objc = $item->find("strong");

                    $title = pq($obja)->text();
                    $type = pq($objb)->text();
                    $updateTime = pq($objc)->text();
                    $url = pq($obja)->attr('href'); 

                    $target_url = substr($url,21);          

                    $ret = array('title' => $title,'type'=>$type,'publishTime' => $updateTime,'url' => $target_url,'source'=>"quanji");
                    $res[] = $ret;   
               
                }
             }



            /**
              此段btmilk数据抓取
            */

            $url2 = 'http://btmilk.com/index.php/search?keyword='.urlencode($keyword)."&page=".$pagenum;
            $refer2 = 'http://btmilk.com/';

            $content2 = $this->curl_init($url2,$refer2);

            phpQuery::newDocumentHtml($content2);        
            /**
            注意这里：
            first表示（所有父元素合并后的）第一个；first-child表示（每个父元素的）第一个
            $('ul li:first') 返回john所在的li。 查找所有ul下第一个li元素
            $("ul li:first-child") 返回 john glen。 查找每个ul下第一个元素是li元素dom元素。
            */

            // 获得发布时间数组
            $publishTimes = pq("div.panel-body table tr td:first-child");
            $timeArray = array();
            foreach ($publishTimes as $time) {
                $publicTime = pq($time)->find('b');
                $accurateTime = pq($publicTime)->text();
                $timeArray[] = $accurateTime;
            }

            //获得文件大小数组
            $sizes = pq("div.panel-body table tr td:nth-child(2)");
            $sizeArray = array();
            foreach ($sizes as $size) {
                $item_size = pq($size)->find('b');
                $file_size = pq($item_size)->text();
                $sizeArray[] = $file_size;
            }


            $items2 = pq("div.panel-body h5.item-title:first-child");

            $num = 0;
            foreach ($items2 as $item2) {

                $item = pq($item2);     
                $obja = $item->find("a");
                
                $title2 = pq($obja)->text();
                $url_magnet = pq($obja)->attr('href');

                $publishTime = $timeArray[$num];
                $total_size = $sizeArray[$num];

                if(strpos($title2,$keyword)!==false){

                    $ret = array('title' => $title2,'type'=>$total_size,'publishTime' => $publishTime,'url' => $url_magnet,'source'=>'btmilk');
                    $res[] = $ret;
                }

             $num++;
            }
            unset($timeArray);
            unset($sizeArray);


            /**
              此段sobt数据抓取
            */
            $url3 = 'http://www.sobt8.com/q/'.urlencode($keyword)."?sort=rel&page=".$pagenum;
            $refer3 = 'http://www.sobt8.com/';
            
            $content3 = $this->curl_init($url3,$refer3);
            phpQuery::newDocumentHtml($content3);


            // 获得发布时间数组
            $publishTime2 = pq("div.item-bar span:first-child");
            $timeArray2 = array();
            foreach ($publishTime2 as $time) {
                $post_time = pq($time)->find('b');
                $post_time2 = pq($post_time)->text();
                $timeArray2[] = $post_time2;
            }

            //获得文件大小数组
            $sizes2 = pq("div.item-bar span:nth-child(2) b");
            $sizeArray2 = array();
            foreach ($sizes2 as $size) {
                $file_size = pq($size)->text();
                $sizeArray2[] = $file_size;
            }



            $sobt8 = pq("div.item-title h3");
             
            $count2 = 0; 
            foreach ($sobt8 as $sobt) {
                 # code...
                $obja = pq($sobt)->find('a');
            
                $title3 = pq($obja)->text();
                $target_url = pq($obja)->attr('href');

            
                $total_size = $sizeArray2[$count2];
                $publishTime = $timeArray2[$count2];

                if(strpos($title3,$keyword)!==false){
                    $ret = array('title' => $title3,'type'=>$total_size,'publishTime' => $publishTime,'url' => $target_url,'source'=>"sobt");
                    $res[] = $ret;
                }

                $count2++;
             }

             unset($timeArray2);
             unset($sizeArray2);


             return $res;
        }



    }



 ?>