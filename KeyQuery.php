<?php
	
	require_once("libs/db/sqli.class.php");
	
	
	function findONE($column_value){

		$config = array('dbhost'=>'127.0.0.1','dbuser'=>'root','dbpsw'=>'3344???a','dbname'=>'imooc','dbcharset'=>'utf8');
		
		$db = new sqli($config);

		file_put_contents("log.txt","搜索的关键字".$column_value."\n", FILE_APPEND);
		if(empty($column_value)){
			return array();
		}else{

			$data[] = array();
			$params = ["name","cloud","magnet"];

			//$sql = "select name,cloud,magnet from source where locate(".$column_value.",'name')>0";	
			$data = $db->queryItemByColumn("source",$params,'name',$column_value);
			//file_put_contents("log.txt","查询sql:".$sql."\n", FILE_APPEND);
			//$data = $db->queryBySql($sql);
			file_put_contents("log.txt","查出来的数组大小".(count($data))."\n", FILE_APPEND);

			return $data;
		}	
	}


	function insertONE($name,$cloud){

		$config = array('dbhost'=>'127.0.0.1','dbuser'=>'root','dbpsw'=>'3344???a','dbname'=>'imooc','dbcharset'=>'utf8');
		$db = new sqli($config);

		$sql = "insert into source(name,cloud) value('".$name."','".$cloud."')";
		file_put_contents("log.txt","sql:".$sql."\n", FILE_APPEND);
	
		$res = $db->insertBySql($sql);
		
		return $res;
	}
