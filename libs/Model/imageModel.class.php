<?php 

    class image{

        private $image;  //内存中的图片

        private $info;


        public function __construct($src=""){
            $info = getimagesize($src);   // 获取图片信息
            $this->info = array(
                'width'=>$info[0];
                'height'=>$info[1];
                'type'=>image_type_to_extension($this->info[2],false);
                'mime'=>$info['mime'];
            );

            // 在内存中建一张与图片类型相同的图片
            $createimgfunc = "imagecreatefrom{$this->info['type']}";
            $this->image = $fun($src);
        }


        /**
            操作图片（压缩）
        */
        public function thumb($width,$height){
            // 建立一张真色彩图片，并自定宽高
            $image_thumb = imagecreatetruecolor($width,$height);
            // 把原图放到真色彩图片上，并进行压缩
            imagecopyresampled($image_thumb,$this->image,0,0,0,0,$width,$height,$this->info['width'],$this->info['height']);
            // 销毁内存中的图片
            imagedestroy($this->image);
            $this->image = $image_thumb; 

        }    


        /**
            操作图片（添加文字水印）
        */
        public function addstr($content,$font_url,$size,$color,$alpha,$local,$angle){

            $col = imagecolorallocatealpha($this->image, $color[0], $color[1], $color[2], $alpha);
            imagettftext($this->image,$size,$angle,$local['x'],$local['y'],$col,$font_url,$content);

        }


        /**
            操作图片（添加图片水印）
        */
        public function addwatermark($watermark_source,$local,$alpha){

            $watermark_info = getimagesize($watermark_source);
            $watermark_type = image_type_to_extension($watermark_info[2],false);
            //在内存中创建一张图片
            $func = "imagecreatefrom{$watermark_type}";
            $watermark = $func($watermark_source);  //把水印图片加载到内存中
            // 把水印图片合并到原图上
            imagecopymerge($this->image,$watermark,$local['x'],$local['y'],0,0,$watermark_info[0],$watermark_info[1],$alpha);
            imagedestroy($watermark);   //销毁内存中的水印图片
        }



        /**
            在浏览器中输出图片
        */
        public function show(){
            header('Content-type:'.$this->info['mime']);
            $func = "image{$this->info['type']}";
            $func($this->image);
        }   


        /**
            把图片保存在硬盘里
        */
        public function save($newname){
            $func = "image{$this->info['type']}";
            $func($this->image,$newname.'.'.$this->info['type']);
        }


        /**
            销毁图片
        */
        public function __destruct(){
            imagedestroy($this->image); 
        }

    }


 ?>