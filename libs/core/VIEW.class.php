<?php 

class VIEW{

    public static $view;

    public static function init($viewtype,$config){

        self::$view = new $viewtype;

        foreach ($config as $key => $value) {
            # code...
            self::$view->$key = $value;
        }
    }

    
    public static function assign($data){
        foreach($data as $key=>$value){
            self::$view->assign($key,$value);
        }
    }


    public static function display($template){
        self::$view->assign('ROOT_DIR',ROOT_DIR);
        self::$view->display($template);
    }



}

 ?>