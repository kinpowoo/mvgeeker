<?php

class Utils
{
    public static function traceHttp()
    {
        $content = date('Y-m-d H:i:s')."\n\rremote_ip：".$_SERVER["REMOTE_ADDR"].
            "\n\r".$_SERVER["QUERY_STRING"]."\n\r\n\r";
        $max_size = 1000;
        $log_filename = "./query.xml";
        if (file_exists($log_filename) and (abs(filesize($log_filename))) > $max_size){
            unlink($log_filename);
        }else {
 
        }
        file_put_contents($log_filename, $content, FILE_APPEND);
    }
 
    public static function logger($log_content, $type = '用户')
    {
        $max_size = 3000;
        $log_filename = "./log.xml";
        if (file_exists($log_filename) and (abs(filesize($log_filename)) >
                $max_size)) {
            unlink($log_filename);
        }
        file_put_contents($log_filename, "$type  ".date('Y-m-d H:i:s')."\n\r".$log_content."\n\r",
            FILE_APPEND);
    }
	
	
	
	   /**
     * 获取access_token
     * @return mixed
     */
    public static function get_access_token()
    {
        $appid = "wxf9a2710995d96cb7"; //需替换成你的appID
        $appsecret = "b3129743246437a2f9a80a3a4e1bf469"; //需替换成你的appsecret
 
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&".
            "appid=".$appid."&secret=".$appsecret;
			
		echo $url."\n";
        $output = Utils::https_request($url);
		
		echo $output."\n";
        $jsoninfo = json_decode($output, true);
        return $jsoninfo["access_token"];
    }
 
    /**
     * 发送请求
     * @param $url：地址
     */
    public static function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
	}
}