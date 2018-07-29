<?php 

global $root = $_SERVER['DOCUMENT_ROOT'];

class mysql{


  /**
    报错函数
  */
  function err($error){
    //die("对不起，您的操作有误，错误原因为: ".$error); 
  //die 有两种作用，输出和终止，相当于echo和exit的组合
    file_put_contents($root."/log.txt","对不起，您的操作有误，错误原因为: ".$error."\n", FILE_APPEND);
  } 
  


  /**
    配置数组 array($dbhost,$dbuser,$dbpsw,$dbname,$dbcharset)
    return bool  连接成功或不成功
    extract(把配置文件中的字符串还原成变量)
  */
  function connect($config){
    extract($config);
    if(!($con = mysql_connect($dbhost,$dbuser,$dbpsw))){
        $this->err(mysql_error());
    }

    if(!mysql_select_db($dbname,$con)){
        $this->err(mysql_error());
    }

    mysql_query("set names ".$dbcharset);
  }


  function close(){
      mysql_close();
  }

  /**
    执行sql语句
  */ 
 
   function query($sql){
      $query = mysql_query($sql);
      if(empty($query)){
          $this->err($sql."<br/>".mysql_error());
      }
      else{
          return $query;
      }
   }


  /**
    查询所有数据，返回数组
  */ 
 
  function findAll($sql){
    $query = mysql_query($sql);
    $list[] = array();
    while($res = mysql_fetch_array($query,MYSQL_ASSOC)){
        $list[] = $res;
    }
    return isset($list)?$list:"";
  }

  
  /**
    查询一条数据，返回数组
  */ 
  
   function findOne($sql){
        $query = $this->query($sql);
        $res = mysql_fetch_row($query);
        return $res;
   }


  /**
    返回指定行的指定字段的值
  */ 

   function findResult($query,$row=0,$field=0){
        $res = mysql_result($query,$row,$field);
        return $res;
   }


  /**
    insert 插入数据
    $table 要插入数据的表名
    $arr, 添加数据的数组，包含字段和值的一维数组
  */ 
   
   function insert($table,$arr){
        foreach($arr as $key=>$value){
            $value = mysql_real_escape_string($value);
            $keyArr[]="`".$key."`"; //把arr数组中的键值保存在$valueArr当中，
                                    //前后加 ` 这个符号的作用是防止键值中有php的关键字
            $valueArr[]="'".$value."'";  //当值为多个时，value需要加单引号
        }

        $keys = implode(",",$keyArr);
        $values = implode(",",$valueArr);
        $sql = "insert into ".$table."(".$keys.") values(".$values.")";

        $this->query($sql);
        return mysql_insert_id();

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
            $value = mysql_real_escape_string($value);
            // 将传进来的值进行过滤，对有害字符进行过滤
            $keyAndvalueArr[] = "`".$key."`='".$value."'";
        }

        $keyAndvalues = implode(",",$keyAndvalueArr);
        $sql = "update ".$table."set ".$keyAndvalues." where ".$where;
        
        $this->query($sql);

   }


  /**
    delete 删除数据
    $table 要删除数据的表名
    $where 条件
  */ 

    function del($table,$where){
        $sql = "delete from ".$table." where ".$where;

        $this->query($sql);
    }


}
