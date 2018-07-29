<?php 

    class sourceModel{

        

        function count($_table){
            return DB::count($_table);
        }



        public function findONE($_table,$params,$column_value){
            if(empty($column_value)){
                return array();
            }else{

                $data[] = array();
                
                if(is_integer($column_value)){

                    $data = DB::queryItemById($_table,$params,$column_value); 
                
                }

                if(is_string($column_value)){

                    $data = DB::queryItemByColumn($_table,$params,'name',$column_value);
                }

                return $data;
            }
        }


        public function findAll($_table){
            return DB::queryItemByPage($_table);
        }




        function sourcesubmit($_table,$data){
            extract($data);

            if(empty($name)){
                return 0;
            }

            $table = T($_table);

            if($table=='SOURCE'){
                $name = addslashes($name);
                $magnet = addslashes($magnet);
                $cloud = addslashes($cloud);
                $size = addslashes($size);
                $pic1 = addslashes($pic1);
                $pic2 = addslashes($pic2);
                $pic3 = addslashes($pic3);
                $description = addslashes($description);
                if(strlen($description)>500){
                    $description = substr($description,0,498);
                }

                $publishTime = addslashes($publishTime);
                $createTime = time();

                $data = array(
                    "name"=>$name,
                    "cloud"=>$cloud,
                    "magnet"=>$magnet,
                    "size"=>$size,
                    "publishTime"=>$publishTime,
                    "pic1"=>$pic1,
                    "pic2"=>$pic2,
                    "pic3"=>$pic3,
                    "description"=>$description,
                    "createTime"=>$createTime,
                    "author"=>$_SESSION['auth']['username']
                );
            
            }

            if($table=='REQUEST'){
                $name = addslashes($name);
                $type = addslashes($type);
                $status = addslashes($status);
                $createTime = time();

                $data = array(
                    'name'=>$name,
                    'type'=>$type,
                    'createTime'=>$createTime,
                    'author'=>$_SESSION['auth']['username']
                );
    
            }

            if($_POST['id']!=''){
                DB::update($table,$data,'id='.$id);
                return 2;
            }else{
                DB::insert($table,$data);
                return 1;
            }
        }



        function addsearch($name){
            DB::addQuery($name);
        }



        /**
           分页查询，并可以自定义排序规则
        */

        function findAllByPage(&$pagenum,$_table,$params,$where='1=1',$order='id'){

            $count = $this->count($_table);
            if($count%5==0){
                $endpage = $count/5;
            }else{
                $endpage = floor($count/5)+1;
            }

            if(!empty($pagenum)){
                if($pagenum>$endpage){
                    $pagenum = $endpage;
                }
                if($pagenum<1){
                    $pagenum = 1;
                }
                $data = DB::queryItemsByPage($_table,$params,$where,$pagenum-1,5,$order);
            }else{
                $pagenum = 1;

                $data = DB::queryItemsByPage($_table,$params,$where,0,5,$order);

            }
            VIEW::assign(array('data'=>$data));
            VIEW::assign(array('admin'=>$_SESSION['auth']['username']));
            VIEW::assign(array('pagenum'=>$pagenum,'endpage'=>$endpage));
        }



        function queryhotsearch(){
            return DB::queryHotSerach();
        }



        function del_by_id($_table,$id){
            DB::deleteItemById($_table,$id);
        }

    }

 ?>