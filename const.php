<?php 

$root = $_SERVER['DOCUMENT_ROOT'];   //获取当前目录
define('ROOT_DIR',$root);


$table_source_column = array('id','name','cloud','magnet','size','publishTime','pic1','pic2','pic3','description','createTime');
define('TABLE_SOURCE_COLUMN',serialize($table_source_column));
define('TABLE_SOURCE_POST_COLUMN',serialize(array_slice($table_source_column,1)));



$table_request_column = array('id','name','type','status','count','createTime','author');
define('TABLE_REQUEST_COLUMN',serialize($table_request_column));
define('TABLE_REQUEST_POST_COLUMN',serialize(array_slice($table_request_column,1)));


$table_user_column = array('id','username','password','email','token','token_exptime','status','regtime');
define('TABLE_USER_COLUMN',serialize($table_user_column));



 ?>