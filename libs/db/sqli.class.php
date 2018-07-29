<?php
header ( "Content-type:text/html;charset=utf-8" );

class sqli{

private static $sqli;

/**
  报错函数
*/
function err($error){
  die("对不起，您的操作有误，错误原因为: ".$error); 
//die 有两种作用，输出和终止，相当于echo和exit的组合

} 


function __construct($config){
  extract($config);

  $sqli = new mysqli($dbhost,$dbuser,$dbpsw,$dbname);


//$mysqli->select_db('imooc');  也可以建立连接后再选择数据库

// $mysqli->connect('localhost','root','root');  也可以先实例化mysqli的对象后再建立连接

  if($sqli->connect_errno){
    $this->err($sqli->connect_error);
  }


  $sqli->set_charset("utf-8");

  $sqli->query("SET NAMES utf8");

  self::$sqli = $sqli;
}


/**
  获得表里数据的总条数
*/

function count($_table){
  $sql = "select count(*) as num from ".$_table;
  $query = self::$sqli->query($sql);
  if($query!=null){
    $row = $query->fetch_array();
    return $row['num'];
  }
}


  /**
    查询一条数据，返回数组
  */ 
  
function findOne($sql){
  //die($sql);
  $result = self::$sqli->query($sql);
  $res = $result->fetch_assoc();
  //die(var_dump($res));
  return $res;
}


/**
返回指定行的指定字段的值
*/ 

function findResult($sql,$row=0,$field=0){
  $query = self::$sqli->query($sql);
  $res = mysqli_result($query,$row,$field);
  return $res;
}



function queryHotSearch(){
  $sql = 'select name from request where count>0 limit 4';
  $result = self::$sqli->query($sql);
  $data = array();
  /**
  while($res = $result->fetch_assoc()){
    $data[] = $res;
  }*/
  return $data;
}



function queryItemById($_table,$params,$id){

  foreach($params as $value){
      $value = mysqli_real_escape_string(self::$sqli,$value);
      $valueArr[]="`".$value."`";  
  }

  $values = implode(",",$valueArr);

	$sql = 'select '.$values.' from '.$_table.' where id=?';

  $mysqli_stmt = self::$sqli->prepare($sql); 

  if(!$mysqli_stmt) {
    $this->err(self::$sqli->error.$sql);
  } 
  
  // s i d 分别代表字符串，整形，浮点型
  $mysqli_stmt->bind_param('i',$id);

   
  

  if($mysqli_stmt->execute()){
    $result = $mysqli_stmt->get_result();
    

    if($result->num_rows>0){  

      $data = $result->fetch_assoc();
    }
  }
 
  $this->closeStmtConnection($mysqli_stmt);
  return $data;
}




function queryItemByColumn($_table,$params,$column_name,$column_value){
  
  foreach($params as $value){
    $value = mysqli_real_escape_string(self::$sqli,$value);
    $valueArr[]="`".$value."`";  
  }

  $values = implode(",",$valueArr);

  $sql = 'select '.$values.' from '.$_table.' where locate(?,'.$column_name.')>0';

  file_put_contents("/home/www/log.txt","完整 sql:".$sql."\n", FILE_APPEND);
  
  $mysqli_stmt = self::$sqli->prepare($sql); 

  if(!$mysqli_stmt) {
    $this->err(self::$sqli->error.$sql);
  } 
 
  if(is_float($column_value)){
    $type = 'd';
  }
  if(is_string($column_value)){
    $type = 's';
  }
  if(is_integer($column_value)){
    $type = 'i';
  }
 
  // s i d 分别代表字符串，整形，浮点型

  $mysqli_stmt->bind_param('s',$column_value);

  $data[] = array();
   
  if($mysqli_stmt->execute()){
    
    $result = $mysqli_stmt->get_result();
   
    if($result->num_rows>0){
      
      while($row = $result->fetch_assoc()){
        
        $data[] = $row;
        
      }
    }
  }
  
  $this->closeStmtConnection($mysqli_stmt);
  return $data;
}


function queryBySql($sql){

  $result =  self::$sqli->query($sql);
  $data[] = array();
  if($result&&$result->num_rows>0){
    while($row = $result->fetch_assoc()){
      $data[] = $row;  
    }
  }
  $this->closeMysqliConnection();
  return $data;
}


function insertBySql($sql){
  $result =  self::$sqli->query($sql);
  $this->closeMysqliConnection();
  return $result;
}


function queryItemsByPage($_table,$params,$where,$index=0,$offset=5,$order){

    $start_set = $index*$offset;

    foreach($params as $value){
      $value = mysqli_real_escape_string(self::$sqli,$value);
      $valueArr[]="`".$value."`";  
    }

    $values = implode(",",$valueArr);

    $sql = 'select '.$values.' from '.$_table.' where '.$where.' order by '.$order.' desc limit ?,?';

    $mysqli_stmt = self::$sqli->prepare($sql); 
    if(!$mysqli_stmt) {
      $this->err( self::$sqli->error );
    } 
   
    // s i d 分别代表字符串，整形，浮点型
    $mysqli_stmt->bind_param('ii',$start_set,$offset);


    $data[] = array();
    if($mysqli_stmt->execute()){
      
      $result = $mysqli_stmt->get_result();
      

      if($result->num_rows>0){


        while($row = $result->fetch_assoc()){
          $data[] = $row;
        }
      }


      $this->closeStmtConnection($mysqli_stmt);  
      return $data;
    }
}






function insertItem($_table,$params){

   $valueArr = array();
    foreach($params as $key=>$value){
        $value = mysqli_real_escape_string(self::$sqli,$value);
        $keyArr[]=$key; //把arr数组中的键值保存在$valueArr当中，
        $placeholder[] = "?";                      
        $valueArr[]=$value;  //当值为多个时，value需要加单引号
    }

    $keys = implode(",",$keyArr);
    $placeholders = implode(",",$placeholder);

    $len = count($params);

    $sql = 'insert '.$_table.'('.$keys.') value('.$placeholders.')';


    $mysqli_stmt = self::$sqli->prepare($sql); 
   
    if(!$mysqli_stmt) {
       $this->err( self::$sqli->error );
    } 

    $type = '';
    for($i=0;$i<$len;$i++){
      if(is_integer($valueArr[$i])){
        $type.='i';
      }
      if(is_float($valueArr[$i])){
        $type.='d';
      }
      if(is_string($valueArr[$i])){
        $type.='s';
      }
    }
     
    $params_arr = array();
    array_push($params_arr,$type);
    for($j=0;$j<$len;$j++){
      array_push($params_arr,$valueArr[$j]);
    }
    // s i d 分别代表字符串，整形，浮点型
    //$mysqli_stmt->bind_param($type,$id);
    
    //$result_code = $mysqli_stmt->execute($valueArr);

    //die(var_dump($params_arr));
    $result_code = $this->execute_stmt($mysqli_stmt,$params_arr);

    $this->closeStmtConnection($mysqli_stmt);

    return $result_code;
}
 



function addQuery($name,$type){
  $sql_if_exist = 'select * from request where name=?';
  $mysqli_stmt = self::$sqli->prepare($sql_if_exist); 
  $mysqli_stmt->bind_param('s',$name);
  $result_code = $mysqli_stmt->execute(); 
  if($result_code){
    $mysqli_stmt->store_result();
   
    if($mysqli_stmt->fetch()){

      $sql_update_count = 'update request set count=count+1 where name=?';
      $mysqli_stmt2 = self::$sqli->prepare($sql_update_count); 
      $mysqli_stmt2->bind_param('s',$name);
      $result_code2 = $mysqli_stmt2->execute();

      //die($sql_update_count.$name);
      $this->closeStmtConnection($mysqli_stmt2);
      return $result_code2; 

    }else{
      $sql_insert = 'INSERT into request(name,type) VALUES(?,?)';
      $mysqli_stmt3 = self::$sqli->prepare($sql_insert); 
      if(!$mysqli_stmt3) {
        $this->err(self::$sqli->error);
      } 
      // s i d 分别代表字符串，整形，浮点型
      $mysqli_stmt3->bind_param('ss',$name,$type);
      $result_code3 = $mysqli_stmt3->execute();  
      $this->closeStmtConnection($mysqli_stmt3);
      return $result_code3;
    }

  } 

 
}



/**

更新资源 
params : 表名，更新的字段和值，存在数组中  id
*/


function updateItemById($_table,$params,$id){

  $valueArr = array();
  foreach($params as $key=>$value){
      $value = mysqli_real_escape_string(self::$sqli,$value);
      $keyArr[]=$key.'=?'; //把arr数组中的键值保存在$valueArr当中，
                            
      $valueArr[]=$value;  //当值为多个时，value需要加单引号
  }

  $keys = implode(",",$keyArr);

  $len = count($params);

  $sql = 'update '.$_table.' SET '.$keys.' where id=?';


  $mysqli_stmt = self::$sqli->prepare($sql); 
 
  if(!$mysqli_stmt) {
     $this->err( self::$sqli->error );
  } 

  $type = '';
  for($i=0;$i<$len;$i++){
    if(is_integer($valueArr[$i])){
      $type.='i';
    }
    if(is_float($valueArr[$i])){
      $type.='d';
    }
    if(is_string($valueArr[$i])){
      $type.='s';
    }
  }
  $type.='i';
   
  $params_arr = array();
  array_push($params_arr,$type);
  for($j=0;$j<$len;$j++){
    array_push($params_arr,$valueArr[$j]);
  }
  array_push($params_arr,$id);
  // s i d 分别代表字符串，整形，浮点型
  //$mysqli_stmt->bind_param($type,$id);
  
  //$result_code = $mysqli_stmt->execute($valueArr);

  //die(var_dump($params_arr));
  $result_code = $this->execute_stmt($mysqli_stmt,$params_arr);

  $this->closeStmtConnection($mysqli_stmt);

  return $result_code;
}


// 循环绑定参数 
function execute_stmt($mysqli_stmt,$params){  
 
    if ($mysqli_stmt){  
        foreach($params as $k=>$v){  
            $array[] = &$params[$k]; //注意此处的引用  
        }  
        call_user_func_array(array($mysqli_stmt,'bind_param'), $array); // 魔术方法直接call  
        return $mysqli_stmt->execute();  
    }  
}




function deleteItemById($_table,$id){
	$sql = 'delete from '.$_table.' where id=?';

  $mysqli_stmt = self::$sqli->prepare($sql); 
 
  if(!$mysqli_stmt){
    $this->err(self::$sqli->error);
  } 
 
  // s i d 分别代表字符串，整形，浮点型
  $mysqli_stmt->bind_param('i',$id);

  $result_code = $mysqli_stmt->execute();
  
  if(!$result_code){
    $this->err($mysqli_stmt->errno.":".$mysqli_stmt->error);
  }

  $this->closeStmtConnection($mysqli_stmt);

  return $result_code;
}





  /**
    insert 插入数据
    $table 要插入数据的表名
    $arr, 添加数据的数组，包含字段和值的一维数组
  */ 
   
   function insert($table,$arr){

        foreach($arr as $key=>$value){
            //$value = mysqli_real_escape_string(self::$sqli,$value);
            $keyArr[]="`".$key."`"; //把arr数组中的键值保存在$valueArr当中，
                                    //前后加 ` 这个符号的作用是防止键值中有php的关键字
            
            preg_match_all ('/^[\d]+$/s', $value, $out, PREG_PATTERN_ORDER);
            if(!empty($out[0])){
              $valueArr[]=$value;
            }else{
              $valueArr[]="'".$value."'";   //当值为字符型时，value需要加单引号
            }              
        }

        $keys = implode(",",$keyArr);
        $values = implode(",",$valueArr);

        $sql = "insert into ".$table."(".$keys.") values(".$values.")";

        //die($sql);

        //$sql ="insert into request(name,type,createTime,author) values('fucnkyou','百度云',25455455,'kinpowang')";
        self::$sqli->query($sql);
  
        return self::$sqli->insert_id;

        //die($sql);
   }


  /**
    update 更新数据
    $table 要更新数据的表名
    $arr  修改数组，包含字段和值
    $where 条件
  */ 

   function update($table,$arr,$where){
        $keyAndvalueArr = array();
        foreach ($arr as $key => $value) {
            # code...
            $value = mysqli_real_escape_string(self::$sqli,$value);
            // 将传进来的值进行过滤，对有害字符进行过滤
            preg_match_all ('/^[\d]+$/s', $value, $out, PREG_PATTERN_ORDER);
            if(!empty($out[0])){
              $keyAndvalueArr[] = $key.'='.$value;
            }else{
              $keyAndvalueArr[]= $key."='".$value."'";   //当值为字符型时，value需要加单引号
            }  
        }


        $keyAndvalues = implode(",",$keyAndvalueArr);
        $sql = "update ".$table." set ".$keyAndvalues." where ".$where;
        
        //die($sql);
        self::$sqli->query($sql);

   }



  function closeStmtConnection($mysqli_stmt){
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
  }



  function closeMysqliConnection(){
    self::$sqli->close();
  }


}

?>