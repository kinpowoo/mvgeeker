<?php 
session_start();

if(isset($_SESSION)&&!empty($_SESSION)){
    if(!empty($_SESSION['auth'])){
        $auth = $_SESSION['auth'];
    }
}

include_once('const.php');
include_once('include.list.php');
foreach ($include_arr as $path) {
    # code...
    include_once(ROOT_DIR.$path);
}


class engine{
    public static $controller;
    public static $method;
    private static $config;

    private static function init_db(){
        DB::init('sqli',self::$config['dbconfig']);
    }


    private static function init_view(){
        VIEW::init('Smarty',self::$config['viewconfig']);
    }


    private static function init_controller(){
        $controller = null;
		if(isset($_GET['controller'])){
			$controller = $_GET['controller'];
		}else if(isset($_POST['controller'])){
			$controller = $_POST['controller'];
		}
        self::$controller = ($controller!=null)?$controller:'index';
    }


    private static function init_method(){
        $method = null;
		if(isset($_GET['method'])){
			$method = $_GET['method'];	
		}else if(isset($_POST['method'])){
			$method = $_POST['method'];
		}

        self::$method = (!empty($method)||$method!=null)?$method:'index';
    }


    public static function run($config){
        self::$config = $config;
        self::init_db();
        self::init_view();
        self::init_controller();
        self::init_method();
        C(self::$controller,self::$method);
    }




}


 ?>