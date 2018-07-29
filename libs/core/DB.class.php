<?php 

class DB{

    public static $db;


    // 初始化数据库类，获得数据库连接对象
    public static function init($dbtype,$config){
        self::$db = new $dbtype($config);
    }


    // 得到一张里所有记录的条数
    public static function count($table){
        return self::$db->count($table);
    }



    // 返回一条结果，存放在 $res里，如果没有结果则数组为空
    public static function findOne($sql){
        return self::$db->findOne($sql);
    }


    // 返回一条结果，存放在 $res里，如果没有结果则数组为空
    public static function findResult($sql,$row=0,$field=0){
        return self::$db->findResult($query,$row,$field);
    }


    // 得到最新插入的一条数据的id
    public static function insert($table,$arr){
        return self::$db->insert($table,$arr);
    }


    // 不返回数据
    public static function update($table,$arr,$where){
        return self::$db->update($table,$arr,$where);
    }


    // 获得最近热门搜索
    public static function queryHotSerach(){
        return self::$db->queryHotSearch();
    }

    // 返回一条结果，存放在 $data[]数组里，如果没有结果则数组为空
    public static function queryItemById($table,$params,$id){
        return self::$db->queryItemById($table,$params,$id);
    }


    // 返回5条结果，存放在 $data[]数组里，如果没有结果则数组为空
    public static function queryItemsByPage($table,$params,$where,$index=0,$offset=5,$order){
        return self::$db->queryItemsByPage($table,$params,$where,$index,$offset,$order);
    }

    // 返回一条结果，存放在 $data[]数组里，如果没有结果则数组为空
    public static function queryItemByColumn($table,$params,$column_name,$column_value){
        return self::$db->queryItemByColumn($table,$params,$column_name,$column_value);
    }

    // 返回stmt->execute()执行结果，不为0则为执行成功
    public static function addSource($table,$params){
        return self::$db->addSource($table,$params);
    }

    // 返回stmt->execute()执行结果，不为0则为执行成功
    public static function addQuery($name,$type="迅雷"){
        return self::$db->addQuery($name,$type);
    }


    // 返回stmt->execute()执行结果，不为0则为执行成功
    public static function updateItemById($table,$params,$id){
        return self::$db->updateItemById($table,$params,$id);
    }

    // 返回stmt->execute()执行结果，不为0则为执行成功
    public static function deleteItemById($table,$id){
        return self::$db->deleteItemById($table,$id);
    }
}


 ?>