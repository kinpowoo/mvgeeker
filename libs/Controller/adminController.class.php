<?php 
	date_default_timezone_set("Asia/Shanghai");
	
    class adminController{

        public $auth = "";
        public static $register_arr = array('register','validateusername','registeractive','getactivemail','getverify');


        public function __construct(){

            //判断是否已登录
            $authobj = M('auth');

            $this->auth = isset($_SESSION['auth'])?$_SESSION['auth']:'';

            if(in_array(engine::$method,self::$register_arr)){
                //$this->register();
            }else{
                //如果不是登录页，且没有登录，就要进行登录操作
                if(empty($this->auth)&&engine::$method!='login'){
                    $this->showmessage('请登录后再操作！','admin.php?controller=admin&method=login');
                }
            }
        }


        public function login(){

            if($_POST){
                /**
                进行登录处理
                登录处理的业务逻辑放在 admin  auth
                admin同表名的模型：从数据库中取用户信息
                auth模型 ： 进行用户信息的核对
                */
                $this->checklogin();
            }else{
                VIEW::display('tpl/back/login.html');
            }

        }


        function checklogin(){
            $authobj = M('auth');
            $authobj->loginsubmit();
        }
        

        public function logout(){
            $authobj = M('auth');
            $authobj->logout();
            $this->showmessage('退出登录成功！','admin.php?controller=admin&method=login');
        }


        function register(){   
            if(isset($_POST)&&!empty($_POST)){
                $authobj = M('auth');
                $authobj->register();
            }else{          
                VIEW::display('tpl/back/register.html');
            }   
        }

        function validateusername(){
            if(isset($_POST)&&!empty($_POST)){
                $username = $_POST['username'];
                $authobj = M('auth');
                if($authobj->validateusername($username)){
                    echo "用户名已存在，请重新输入";   //如果存在就直接输出提示
                    //echo "false";
                }else{
                    echo "true";   // 如果用户不存在就输出 字符串类型的 true
                }
            }else{
                return false;
            }
        }


        function registeractive(){
            if(isset($_GET)&&!empty($_GET)){
                $token = $_GET['token'];
                $authobj = M('auth');
                $authobj->registeractive($token);
            }
        }


        function getactivemail(){
            if(!isset($_POST)||empty($_POST)){
                VIEW::display('tpl/back/getmail.html');
            }else{
                $authobj = M('auth');
                $email = $_POST['email'];
                $authobj->getactivemail($email);
            }
        }



        public function getverify(){
            
            $verifyobj = M('verify');

            $verifyobj->addstr(4)->addpoint(300)->addline(10)->display();
        }



        public function index(){
            $sourceobj = M('source');
            $newsnum = $sourceobj->count('source');

            VIEW::assign(array('newsnum'=>$newsnum));
            VIEW::assign(array('admin'=>$this->auth['username']));
            VIEW::display('tpl/back/index.html');
        }



        public function sourceadd(){
            /**
             判断是否有POST数据
             如果没有POST数据，就显示添加，修改的界面   
            */
             if(empty($_POST)){
                //  读取旧信息,需要传递新闻id,$_GET['id']
                if(isset($_GET)&&!empty($_GET)){
                     
                    if($_GET['t']=='s'){
                        if(isset($_GET['id'])){
                            $_table = 'SOURCE';
                            $params = unserialize(constant('TABLE_'.$_table.'_COLUMN'));
                            $data = M('source')->findONE($_table,$params,intval($_GET['id']));
                            VIEW::assign(array('data'=>$data));
                        }
                        VIEW::display('tpl/back/sourceadd.html');
                    }
                    
                    if($_GET['t']=='r'){
                        if(isset($_GET['id'])){
                            $_table = 'REQUEST';
                            $params = unserialize(constant('TABLE_'.$_table.'_COLUMN'));
                            $data = M('source')->findONE($_table,$params,intval($_GET['id']));
                            VIEW::assign(array('data'=>$data));
                        }
                        VIEW::display('tpl/back/requestadd.html');
                    }  
                }

             }else{  //进入添加、修改的处理程序
                
                if(!empty($_POST['t'])&&$_POST['t']=='s'){
                    //die($_POST['t']);
                    $this->sourcesubmit('s');
                }
                if(!empty($_POST['t'])&&$_POST['t']=='r'){
                    $this->sourcesubmit('r');
                }

             }

        }


        private function showmessage($info, $url){
            echo "<script>alert('$info');window.location.href='$url'</script>";
            exit;
        }


        private function sourcesubmit($table){
            $sourceobj = M('source');
            $result = $sourceobj->sourcesubmit($table,$_POST);
            if($result == 0){
                $this->showmessage('操作失败！','index.php?controller=admin&method=sourceadd&t='.$table.'&id='.$_POST['id']);
            }

            if($result == 1){
                $this->showmessage('添加成功！','index.php?controller=admin&method=sourcelist&t='.$table);
            }

            if($result == 2){
                $this->showmessage('更新成功！','index.php?controller=admin&method=sourcelist&t='.$table);
            }
        }




        public function sourcelist(){
            
            $sourceobj = M('source');
            $pagenum;
			if(isset($_GET['pagenum'])){
				$pagenum = $_GET['pagenum'];
			}else{
				$pagenum = 0 ;
			}
            $table = T($_GET['t']);

            $params = 'TABLE_'.$table.'_COLUMN';
		
			$where = "1=1";
            $sourceobj->findAllByPage($pagenum,$table,unserialize(constant($params)),$where);
         
            if($table=='SOURCE'){
                VIEW::display('tpl/back/sourcelist.html');
            }
            if($table=='REQUEST'){
                VIEW::display('tpl/back/requestlist.html');
            }
        }




        public function sourcedel(){
            if(intval($_GET['id'])){
                $sourceobj = M('source');
                $t = $_GET['t'];
                $table = T($t);
                $sourceobj->del_by_id($table,intval($_GET['id']));
                $this->showmessage('删除成功！','index.php?controller=admin&method=sourcelist&t='.$t);
            }
        }


    }

 ?>