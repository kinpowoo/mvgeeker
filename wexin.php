<?php
//设置时区
date_default_timezone_set("Asia/Shanghai");
//定义TOKEN常量，这里的"weixin"就是在公众号里配置的TOKEN
define("TOKEN", "kinpowoo");
 
require_once("Utils.php");
require_once("KeyQuery.php");
require_once("MusicAPI.php");


//打印请求的URL查询字符串到query.xml
Utils::traceHttp();

$wechatObj = new wechatCallBackapiTest();
	/**
	* 如果有"echostr"字段，说明是一个URL验证请求，
	* 否则是微信用户发过来的信息
	*/
if (isset($_GET["echostr"])){
		$wechatObj->valid();
}else {
		$wechatObj->responseMsg();
}
 
 
class wechatCallBackapiTest
{
    /**
     * 用于微信公众号里填写的URL的验证，
     * 如果合格则直接将"echostr"字段原样返回
     */
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if ($this->checkSignature()){
            echo $echoStr;
            exit;
        }else{
			echo $echoStr;
            exit;
		}
    }
 
    /**
     * 用于验证是否是微信服务器发来的消息
     * @return bool
     */
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
 
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature){
            return true;
        }else {
            return false;
        }
    }
 
	/**
     * 响应用户发来的消息
     */
    public function responseMsg()
    {
        //获取post过来的数据，它一个XML格式的数据
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
       
        //将数据打印到log.xml
        Utils::logger($postStr);
        if (!empty($postStr)){
            //将XML数据解析为一个对象
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            /**
            if(!empty($_SESSION['msgid'])&&$_SESSION['msgid']==$postObj->MsgId){
                file_put_contents("log.txt","msgid:".$postObj->MsgId."\n", FILE_APPEND);
                echo '';
                exit;
            }else{
                file_put_contents("log.txt","msgid已存:".$postObj->MsgId."\n", FILE_APPEND);
                $_SESSION['msgid']=$postObj->MsgId;
            }*/
           
            //消息类型分离
            switch($RX_TYPE){
                case "event": //事件
                    $result = $this->receiveEvent($postObj);
                    break;
                case "text": //文本
                    $result = $this->receiveText($postObj);
                    break;
                case "image": //图片
                    $result = $this->receiveImage($postObj);
                    break;
                case "voice": //语音
                    $result = $this->receiveVoice($postObj);
                    break;
                case "video": //视频
                    $result = $this->receiveVideo($postObj);
                    break;
                case "location": //地理位置
                    $result = $this->receiveLocation($postObj);
                    break;
                case "link": //链接
                    $result = $this->receiveLink($postObj);
                    break;
                default:
                    $result = "未知指令:".$RX_TYPE;
                    break;
            }
            //打印输出的数据到log.xml
            Utils::logger($result, '公众号');
            echo $result;
        }else{
            echo "";
            exit;
        }
    }
 
    /**
     * 接收事件消息
     */
    private function receiveEvent($object)
    {
        switch ($object->Event){
            //关注公众号事件
            case "subscribe":
                $content = "欢迎关注IMovie，可用带有mv和mu指令来请求电影和音乐资源,\n "
					."如: mv绣春刀 , mu丑八怪";
                break;
            default:
                $content = "";
                break;
        }
        $result = $this->transmitText($object, $content);
        return $result;
    }
 
 
function arr2str ($arr)
{
    foreach ($arr as $v)
    {
        $v = join(",",$v); //可以用implode将一维数组转换为用逗号连接的字符串
        $temp[] = $v;
    }
    $t="";
    foreach($temp as $v){
        $t.="'".$v."'".",";
    }
    $t=substr($t,0,-1);
    return $t;
}
 
 
    /**
     * 接收文本消息,通过发送指定文本，
     * 让服务器回复相应类型的信息
     */
    private function receiveText($object)
    {
        $keyword = $object->Content;
		
		if(strpos($keyword,"mv")!==false){
			$requestMovieName = str_replace("mv","",$keyword);
            $requestMovieName = str_replace(" ","",$requestMovieName);
            
			$resultArr = findONE($requestMovieName);
         
			if(count($resultArr)>1){
                $finalArr = array_slice($resultArr,1);
                $buffer = "";
                foreach($resultArr as $item){
                    $buffer.=("电影名:".$item['name'].",\n 链接: ".$item['cloud'].",\n 迅雷:".$item['magnet']."\n");
                }
                file_put_contents("log.txt","fromUser:".($object->FromUserName).";ToUser:".($object->ToUserName)."\n", FILE_APPEND);
				$result = $this->transmitText($object,$buffer);
			}else{
				$content = "Sorry,未找到您查询的电影资源，\n可以发送指令 request:电影名来提醒小编添加相关资源";
			    $result = $this->transmitText($object, $content);
            }
		}else if(strpos($keyword,"insert")!==false){

            $result = $this->transmitText($object,"插入命令执行");
            
            $insertName = str_replace("insert","",$keyword);
            $insertParams= str_replace(" ","",$insertName);

            $arrStr = explode("|",$insertParams);
            
            if(count($arrStr)==2){
                $mvName = addslashes($arrStr[0]);

                $linkStr = addslashes($arrStr[1]);
                
        

                $res = insertONE($mvName,$linkStr);
                if($res){
                    $result = $this->transmitText($object,"插入资源成功");
                }else{
                    $result = $this->transmitText($object,"插入资源失败");
                }
                
            }else{
                $result = $this->transmitText($object,"插入命令不合法");
            }

        }else if(strpos($keyword,"mu")!==false){
            $requestMusicName = str_replace("mv","",$keyword);
            $requestParams = str_replace(" ","",$requestMusicName);
			file_put_contents("./log.txt","参数 :".$requestParams."\n", FILE_APPEND);
            //参数数组
            $params = explode("|",$requestParams);

            $api = new MusicAPI();
            $res = "";
            if(count($params)==2){
                $res = $api->search($params[0],$params[1]);
            }
            if(count($params)==1){
                $res = $api->search($params[0]);
            }

            $objJson = json_decode($res);
            $songArr = $objJson->result->songs;
            //file_put_contents("log.txt","返回的数组长度 :".count($songArr)."\n", FILE_APPEND);
	
            $content = array();
           
            foreach($songArr as $item){
                $mp3str = $api->mp3url($item->id);
                $mp3obj = json_decode($mp3str);
                $mp3url = $mp3obj->data[0]->url;
                /**
                $results .= "歌曲名: ".$item->name."-".$item->ar[0]->name."\n";
                $results .= "链接: ".$mp3url."\n";
                */

                //$musicStr=$this->transmitMusic($object,$arr);
                $content[] = array("Title"=>$item->name, 
                                "Description"=>$item->ar[0]->name,
                                "PicUrl"=>$item->al->picUrl,
                                "Url"=>$mp3url
                            );
            }

            //$result = $this->transmitText($object,$results);
            $result = $this->transmitNews($object,$content);
            //$result = $this->transmitMusic($object,$arr);
		}else if (strstr($keyword, "文本")){
            $content = "这是个文本消息";
            //回复文本
            $result = $this->transmitText($object, $content);
        }else if (strstr($keyword, "单图文")){
            $content = array();
            $content[] = array("Title"=>"单图文标题", "Description"=>"单图文内容",
                               "PicUrl"=>"http://weiweiyi.duapp.com/images/img1.jpg", "Url"=>"http://weiweiyi.duapp.com/test.php");
            //回复单图文
            $result = $this->transmitNews($object, $content);
        }else if (strstr($keyword, "多图文")){
            $content = array();
            $content[] = array("Title"=>"多图文1标题", "Description"=>"多图文1描述",
                               "PicUrl"=>"http://weiweiyi.duapp.com/images/img1.jpg", "Url"=>"http://weiweiyi.duapp.com/test.php");
            $content[] = array("Title"=>"多图文2标题", "Description"=>"多图文2描述",
                               "PicUrl"=>"http://weiweiyi.duapp.com/images/img2.jpg", "Url"=>"http://weiweiyi.duapp.com/test.php");
            $content[] = array("Title"=>"多图文3标题", "Description"=>"多图文3描述",
                               "PicUrl"=>"http://weiweiyi.duapp.com/images/img3.jpg", "Url"=>"http://weiweiyi.duapp.com/test.php");
            //回复多图文
            $result = $this->transmitNews($object, $content);
        }else if (strstr($keyword, "音乐")){
            $content = array("Title"=>"好想你", "Description"=>"歌手：朱主爱",
                             "MusicUrl"=>"http://weiweiyi.duapp.com/music/missyou.mp3",
                             "HQMusicUrl"=>"http://weiweiyi.duapp.com/music/missyou.mp3");
            //回复音乐
            $result = $this->transmitMusic($object, $content);
        }else{
            $content ="可用带有mv:和mu:指令来请求电影和音乐资源,\n "
                    ."如: mv:绣春刀 , mu:丑八怪|页数";
            $result = $this->transmitText($object, $content);
        }
        return $result;
    }
 
    /**
     * 接收图片消息，通过MediaId回复相同的图片给用户
     */
    private function receiveImage($object)
    {
        $content = array("MediaId"=>$object->MediaId);
        $result = $this->transmitImage($object, $content);
        return $result;
    }
 
    /*
     * 接收语音消息，通过MediaId回复相同的语音给用户
     */
    private function receiveVoice($object)
    {
        $content = array("MediaId"=>$object->MediaId);
        $result = $this->transmitVoice($object, $content);
        return $result;
    }
 
    /**
     * 接收视频消息，通过MediaId回复相同的视频给用户，
     * 这个会失败，好像是腾讯的视频需要经过审核才能发送，
     * 避免那种***的视频传播
     */
    private function receiveVideo($object)
    {
        $content = array("MediaId"=>$object->MediaId, "ThumbMediaId"=>$object->ThumbMediaId,
                         "Title"=>"自拍视频", "Description"=>"一个自拍视频");
        $result = $this->transmitVideo($object, $content);
        return $result;
    }
 
    /**
     * 接收位置消息
     */
    private function receiveLocation($object)
    {
        $content = "你发送的是位置，纬度为：".$object->Location_X."；经度为：".
            $object->Location_Y."；缩放级别为：".$object->Scale."；位置为：".$object->Label;
        $result = $this->transmitText($object, $content);
        return $result;
    }
 
    /**
     * 接收链接消息
     */
    private function receiveLink($object)
    {
        $content = "你发送的是链接，标题为：".$object->Title."；内容为：".
            $object->Description."；链接地址为：".$object->Url;
        $result = $this->transmitText($object, $content);
        return $result;
    }
 

 
 /**
     * 回复文本消息
     */
    private function transmitText($object, $content)
    {
        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime><![CDATA[%s]]></CreateTime>
    <MsgType><![CDATA[text]]></MsgType>
    <Content><![CDATA[%s]]></Content>
    </xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }
 
    /**
     * 回复图文消息
     */
    private function transmitNews($object, $newsArray)
    {
        if (!is_array($newsArray)){
            return;
        }
        $itemTpl = "<item>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
    <PicUrl><![CDATA[%s]]></PicUrl>
    <Url><![CDATA[%s]]></Url>
</item>";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= sprintf($itemTpl, $item["Title"], $item["Description"],
                $item["PicUrl"], $item["Url"]);
        }
        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime><![CDATA[%s]]></CreateTime>
    <MsgType><![CDATA[news]]></MsgType>
    <ArticleCount>%s</ArticleCount>
    <Articles>$item_str</Articles>
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(),
            count($newsArray));
        return $result;
    }
 
    /**
     * 回复音乐消息
     */
    private function transmitMusic($object, $musicArray)
    {
        $itemTpl = "<Music>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
    <MusicUrl><![CDATA[%s]]></MusicUrl>
    <HQMusicUrl><![CDATA[]]></HQMusicUrl>
</Music>";
        
        $item_str=sprintf($itemTpl, $musicArray["Title"], $musicArray["Description"],
                $musicArray["MusicUrl"]);
        $xmlTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[music]]></MsgType>
    $item_str;
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
 
    /**
     * 回复图片消息
     */
    private function transmitImage($object, $imageArray)
    {
        $itemTpl = "<Image>
    <MediaId><![CDATA[%s]]></MediaId>
</Image>";
 
        $item_str = sprintf($itemTpl, $imageArray['MediaId']);
 
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
$item_str
</xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName,
            time());
        return $result;
    }
 
    /**
     * 回复语音消息
     */
    private function transmitVoice($object, $voiceArray)
    {
        $itemTpl = "<Voice>
    <MediaId><![CDATA[%s]]></MediaId>
	</Voice>";
 

        $item_str = sprintf($itemTpl, $voiceArray['MediaId']);
 
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
$item_str
</xml>";
 
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
}
	