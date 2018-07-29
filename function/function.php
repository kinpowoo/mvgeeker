<?php 

/**
  建立一个通用控制器调用函数 C
*/

 function C($name,$method){     // 控制器调用方法
    require_once($_SERVER['DOCUMENT_ROOT'].'/libs/Controller/'.$name.'Controller.class.php'); 
    //先引入要调用的控制器
    // $testController = new testController();
    // $testController->show();

    //eval('$obj = new '.$name.'Controller();$obj->'.$method.'();');
    // eval 函数可以把字符串转化成可执行的代码

    $controller = $name.'Controller';

    $obj = new $controller();

    $obj->$method();

 }


/**
  建立一个通用模型调用函数 M
*/

  function M($name){
    require_once($_SERVER['DOCUMENT_ROOT'].'/libs/Model/'.$name.'Model.class.php');

    //eval('$obj = new '.$name.'Model();');
    // eval() 函数调用简单但是不安全,可以用下面代码代替
    $model = $name.'Model';

    $obj = new $model();

    return $obj;
  }


  /**
  建立一个通用视图调用函数 V
*/

  function V($name){
    require_once($_SERVER['DOCUMENT_ROOT'].'libs/View/'.$name.'View.class.php');

    $view = $name.'View';
    $obj = new $view();

    return $obj;
  }


  function ORG($path,$class_name,$params=array()){
    /**
      $path是类库的路径，
      $class_name是要调用的第三方类库主入口文件名
      $params 为调用主入口类后要进行的一系列的初始化操作
      格式为 array(属性名=>属性值，属性名2=>属性值2...)
    */

    require_once($_SERVER['DOCUMENT_ROOT'].'libs/ORG/'.$path.$class_name.'.class.php');

    $obj = new $class_name();

    if(!empty($params)){
      foreach ($params as $key => $value) {
        # code...
        # eval('$obj->'.$key.'=\''.$value.'\';');
        $obj->$key = $value;
      }
    }

    return $obj;

  }


  function T($table){
    if($table=='s'){
      return 'SOURCE';
    }
    if($table=='r'){
      return 'REQUEST';
    }
  }


  function daddslashes($str){    //对传过来的字符串进行转义

    return (!get_magic_quotes_gpc())?addslashes($str):$str;
  }

 ?>