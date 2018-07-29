<?php 
    
    class verifyModel{


       private $image;

       public function __construct(){
            $image = imagecreatetruecolor(150,60);
            $bgcolor = imagecolorallocate($image,255,255,255); 
                       //#ffffff , 为资源 $image 分配 白色 配色

            imagefill($image,0,0,$bgcolor);  //把白色底色铺满到$image整张图片 
            $this->image = $image;
       }


       public function addstr($strnum){
            $verify_str = '';
            $fontsize=12;
            $data = 'abcdefghigklmnopqrstuvwxyzABCDEFGHIGKLMNOPQRSTUVWXYZ123456789';
            //要控制好字体大小与分布，避免字体重叠或显示不全
            for($i=0;$i<$strnum;$i++){
                
                $fontcolor = imagecolorallocate($this->image,rand(0,120),rand(0,120),rand(0,120));
                
                $fontcontent = substr($data,rand(0,strlen($data)-1),1);  //生成内容

                $verify_str.=$fontcontent;

                $x = 37*$i +rand(10,20) ;

                $y = rand(10,35);

                imagestring($this->image,$fontsize,$x,$y,$fontcontent,$fontcolor);
                //在图片资源上画随机数字，$x,$y为字符串在图片上的位置，其它参数依次为
                //图片资源，字体大小，字符串内容，字体颜色
            }

            $_SESSION['verify'] = $verify_str;
            return $this;
       }



       public function addpoint($pointnum){

            for($i=0;$i<$pointnum;$i++){  //增加600个点干扰
                $pointcolor = imagecolorallocate($this->image,rand(50,200),rand(50,200),rand(50,200));
                            //为点分配随机颜色
                imagesetpixel($this->image,rand(1,149),rand(1,59),$pointcolor);
                // imagesetpixel($resource,$x,$y,$pointcolor);在图片资源的x,y位置添加指定颜色的点
                // 画一个单一元素
            }
            return $this;
       }


       public function addline($linenum){
            //控制好颜色，避免验证内容看不清
            for($i=0;$i<9;$i++){  //增加9条线的干扰
                $linecolor = imagecolorallocate($this->image,rand(60,220),rand(60,220),rand(60,220)); 
                             //为线分配颜色
                imageline($this->image,rand(1,149),rand(1,59),rand(1,149),rand(1,59),$linecolor);
                // imageline($resource,$x1,$y1,$x2,$y2,$linecolor); 参数分另为图片资源句柄，
                // 线的 点1(x1,y1) 和 点2(x2,y2) 的坐标，还有线的颜色 
            }
            return $this;
       }




       public function display(){
            header("content-type:image/png");  //输出图片前，必须提前输出图片信息 
            //$type = image_type_to_extension($this->info[2],false); 
            
            //$func = "image{$type}";
            //$func($this->image);
            imagepng($this->image);
       }

       public function __destruct(){
            imagedestroy($this->image);    //销毁image资源
       }

    }



 ?>