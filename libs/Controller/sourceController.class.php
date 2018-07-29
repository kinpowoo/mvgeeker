<?php 

    class sourceController{


        private static $isMobile;

        function __construct(){
            self::$isMobile = M('client')->isMobile();
        }


        public function getitem(){
            if(isset($_GET)&&!empty($_GET)){
                $column_value = empty($_GET['id'])?addslashes($_GET['column']):intval($_GET['id']);
                $table = $_GET['t'];
                $params = array();
                
                if(!empty($table)){
                    if($table == 's'){
                        $params = unserialize(TABLE_SOURCE_COLUMN);
                    }

                    if($table == 'r'){
                        $params = unserialize(TABLE_REQUEST_COLUMN);
                    }
                    $table = T($table);
                }   

                $sourceobj = M('source');
                $data = $sourceobj->findONE($table,$params,$column_value);
                VIEW::assign(array('data'=>$data));

            
                
                if(self::$isMobile){
                    
                    if(is_integer($column_value)){
                        VIEW::display('tpl/front/mobile/item.html');
                    }
                    if(is_string($column_value)){
                        VIEW::display('tpl/front/mobile/post_search_result.html');
                    }
                }else{
                
                    if(is_integer($column_value)){

                        VIEW::display('tpl/front/pc/item.html');
                    }
                    if(is_string($column_value)){
                        
                        VIEW::display('tpl/front/pc/post_search_result.html');
                    }
                }
            }
        }

       
       public function postlist(){

            $newsobj = M('source');
            $pagenum = $_GET['pagenum'];
            $_table = $_GET['t'];

            if(!empty($_table)){
                if($_table=='s'){
                    $_table = 'SOURCE';
                }
                if($table=='r'){
                    $_table = 'REQUEST';
                }
            }
            
            $params = 'TABLE_'.$_table.'_COLUMN';
            $where = "author='".$_SESSION['auth']['username']."'";
            // constant($const)  可以将字符串中已定义的常量转换成对应的常量值
 
            $newsobj->findAllByPage($pagenum,$_table,unserialize(constant($params)),$where);

            if(self::$isMobile){
                
                VIEW::display('tpl/front/mobile/post_list.html');
            }else{
                
                VIEW::display('tpl/front/pc/post_list.html');
            }

       }





    }



 ?>