<?php 

    class adminModel{

        // 定义表名
        public $_table = 'USER';

        //取用户信息，通过用户名
        function findOne_by_username($username){
            $params = unserialize(constant('TABLE_'.$this->_table.'_COLUMN'));
            //$sql = 'select '.$values.' from '.$this->_table." where username='".$username."'";
            //die($sql);
            
            $user = DB::queryItemByColumn($this->_table,$params,'username',$username);
            
            if(!empty($user)){
                return $user[1];
            }else{
                return null;
            }
        }


        function count(){
            return DB::count($this->_table);
        }

    }

 ?>