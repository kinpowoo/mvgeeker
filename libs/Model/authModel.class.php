<?php 

    class authModel{

        private $auth = "";  //当前管理员的信息


        public function __construct(){
            if(isset($_SESSION['auth'])&&(!empty($_SESSION['auth']))){
                $this->auth = $_SESSION['auth'];
            }
        }


        public function loginsubmit(){

            if(empty($_POST['username'])||empty($_POST['password'])){
                return false;
            }

            $username = addslashes($_POST['username']);
            $password = addslashes($_POST['password']);
            $verify = $_POST['verify'];
            if(empty($_SESSION['verify'])||empty($verify)){
                $this->showmessage('验证码未填写，请重试','admin.php?controller=admin&method=login');
            }else{
                if(strtolower($_SESSION['verify'])!==strtolower($verify)){
                    $this->showmessage('验证码填写不正确，请重试','admin.php?controller=admin&method=login');
                }
            }

            if($this->auth = $this->checkuser($username,$password)){
                $_SESSION['auth'] = $this->auth;

                if($this->auth['status']==0){
                    $this->showmessage('登录失败，账号未激活，请先去激活！','admin.php?controller=admin&method=login');
                }else{
                    $_SESSION['ROOT'] = $_SESSION['auth']['username'];
                    $this->showmessage('登录成功！','admin.php?controller=admin&method=index');
                }
            }else{
                 $this->showmessage('登录失败，用户名或密码错误！','');
            }

        }


        function checkuser($username,$password){
            $adminobj = M('admin');
            $auth = $adminobj->findOne_by_username($username);
			
            if((!empty($auth))&&$auth['password'] == md5($password)){
                return $auth;
            }else{
                return false;
            }
        }


        public function getauth(){
            return $this->auth;
        }


        public function logout(){
            unset($_SESSION['auth']);
            $this->auth = '';
        }


        function register(){
            $username = addslashes($_POST['username']);
            if(empty($username)||strlen($username)<5||strlen($username)>15){
                $this->showmessage('用户名不符合规范，请重新输入！','admin.php?controller=admin&method=register');
            }
            //if($this->validateusername($username)){
              //  $this->showmessage('用户名已存在，请重新输入！','admin.php?controller=admin&method=register');
            //}
            $password = addslashes($_POST['password']);
            $rule1 = '^[A-Za-z0-9_/?@.]+';
            if(!ereg($rule1,$password)){
                $this->showmessage('密码不符合规范，请重新填写！','admin.php?controller=admin&method=register');
            }
            $email = $_POST['email'];
            if(!ereg('^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,5}$',$email)){
                $this->showmessage('邮箱格式不正确，请重新输入！','admin.php?controller=admin&method=register');
            }
            if($this->validateemail($email)){
                $this->showmessage('该邮箱已被占用，请选择其它邮箱进行注册！','admin.php?controller=admin&method=register');
            }
            $password2 = addslashes($_POST['password2']);
            if($password!==$password2){
                $this->showmessage('两次密码输入不一致，请重新输入！','admin.php?controller=admin&method=register');
            }
            $regTime = time();
            $token = md5($username.$password.$regTime);
            $token_exptime = $regTime+24*3600;
            $password = md5($password);
            $data = compact('username','password','email','token','token_exptime','regTime');

        
            $insert_id = DB::insert('USER',$data);
            if($insert_id){
                MAIL::sendRegisterMail($email,$username,$token,$insert_id); 
           }else{
                echo "注册失败，5秒后跳转到注册页面";
                echo '<meta http-equiv="refresh" content="5;url=index.php?controller=admin&method=register"/>';
           }
            
        }


        function validateusername($username){
            $sql="select * from user where username='".$username."'";

            $auth = DB::findOne($sql);

            //die(var_dump($auth));
            if(!empty($auth)&&$auth!=null){
                return true;
            }else{
               return false;
            }
        }


        private function validateemail($email){
            $sql="select * from user where email='".$email."'";

            $auth = DB::findOne($sql);

            //die(var_dump($auth));
            if(!empty($auth)&&$auth!=null){
                return true;
            }else{
               return false;
            }
        }


        public function registeractive($token){
            $sql = "select id,token_exptime from USER where status=0 and token='".$token."'";

            $registerUser = DB::findOne($sql);

            $now = time();

            if(!empty($registerUser)&&$registerUser!=null){
                //die("exec here");
                if($registerUser['status']==1){
                    $this->showmessage('该邮箱已激活，无需重复激活','admin.php?controller=admin&method=login');
                }
                 
                if($now>$registerUser['token_exptime']){

                    echo "激活时间过期，请重新获取激活邮件";
                    echo "5秒钟后跳转到<a href='index.php?controller=admin&method=login'>登录</a>页面...";
                    echo "<meta http-equiv='refresh' content='5;url=index.php?controller=admin&method=login'/>";
                }else{

                    //die("have been exec");
                    $res = DB::updateItemById('USER',array('status'=>1),$registerUser['id']);
                    if($res){
                        echo "激活成功，跳转到登录页面";
                    }else{
                        echo "激活失败，请重新获取激活邮件<br/>";
                    }
                    echo "5秒钟后跳转到<a href='index.php?controller=admin&method=login'>登录</a>页面...";
                    echo "<meta http-equiv='refresh' content='5;url=index.php?controller=admin&method=login'/>";
                }
            }else{
               return false;
            }
        }



        function getactivemail($email){
            $sql="select * from user where email='".$email."'";
            $auth = DB::findOne($sql);
            if(!empty($auth)&&$auth!=null){
                if($auth['status']==1){
                    $this->showmessage('该邮箱已激活，无需再次激活','admin.php?controller=admin&method=getactivemail');
                }else{
                    date_default_timezone_set('Asia/Shanghai');
                    $token_exptime = time()+24*3600;
                    DB::updateItemById('USER',array('token_exptime'=>$token_exptime),$auth['id']);
                    MAIL::getactivemail($email,$auth['username'],$auth['token']);
                }
            }else{
               $this->showmessage('该邮箱尚未注册','admin.php?controller=admin&method=getactivemail');
            }
        }



        private function showmessage($info, $url){
            echo "<script>alert('$info');window.location.href='$url'</script>";
            exit;
        }

    }

 ?>