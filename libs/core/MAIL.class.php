<?php 

    class MAIL{

        public static $mailer;
        public static $mail_message;

        public static function init($config){
            extract($config);
            //die($server_host);
            // 配置邮件服务器，得到传输对象
            $transport = Swift_SmtpTransport::newInstance($server_host,$port);
            $transport->setUsername($server_email_address);
            $transport->setPassword($server_email_password);
            $transport->setEncryption($encryption);


            // 得到发送邮件对象Swift_Mailer对象
            $mailer = Swift_Mailer::newInstance($transport); 
            self::$mailer = $mailer;
            //得到邮件信息对象
            $message = Swift_Message::newInstance();
            
            // 将message对象赋给 mail_message对象
            self::$mail_message = $message;

        }

       public static function sendRegisterMail($custom_email,$custom_username,$token,$insert_id){
            self::$mail_message->useFileTransport=false;
            // 设置管理员---发件人信息
            self::$mail_message->setFrom(array('kinpowoo@outlook.com'=>'kinpowoo'));
            //设置收件人---注册用户信息
            self::$mail_message->setTo(array($custom_email=>$custom_username));
            //设置邮件主题
            self::$mail_message->setSubject('来自“mvgeeker“的激活邮件');

            $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?controller=admin&method=registeractive&token=".$token;
            $urlencode = urlencode($url);
            //设置激活邮件内容
            $str=<<<EOF
                亲爱的{$custom_username}您好~！感谢您注册我们网站.<br/>
                请点击此链接激活账号即可登陆！<br/>
                <a href="{$url}">{$urlencode}</a>
                <br/>
                如果点此链接无反映，可以将其复制到浏览器中来执行，链接的有效时间为24小时。
EOF;

            self::$mail_message->setBody("{$str}",'text/html','utf-8');

            try{
                //die("inside of try");
                if(self::$mailer->send(self::$mail_message)){
                    //die("send success");
                    $success_str=<<<SUC
                    恭喜您{$custom_username}注册成功，请到邮箱激活之后登陆。<br/>
                    5秒钟后跳转到<a href='index.php?controller=admin&method=login'>登陆</a>页面...
                    <meta http-equiv='refresh' content='5;url=index.php?controller=admin&method=login'/>
SUC;
                    echo $success_str;
                    
                }else{
                    DB::deleteItemById('USER',$insert_id);
                    echo "注册失败，请重新注册<br/>";
                    echo "5秒钟后跳转到<a href='index.php?controller=admin&method=register'>注册</a>页面...";
                    echo "<meta http-equiv='refresh' content='5;url=index.php?controller=admin&method=register'/>";
                }

            }catch(Swift_ConnectionException $e){
                echo '邮件发送错误'.$e->getMessage();
            }
        }




       public static function getactivemail($custom_email,$custom_username,$token){
            self::$mail_message->useFileTransport=false;
            // 设置管理员---发件人信息
            self::$mail_message->setFrom(array('kinpowoo@outlook.com'=>'kinpowoo'));
            //设置收件人---注册用户信息
            self::$mail_message->setTo(array($custom_email=>$custom_username));
            //设置邮件主题
            self::$mail_message->setSubject('来自“mvgeeker“的激活邮件');

            $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?controller=admin&method=registeractive&token=".$token;
            $urlencode = urlencode($url);
            //设置激活邮件内容
            $str=<<<EOF
                亲爱的{$custom_username}您好~！感谢您注册我们网站.<br/>
                请点击此链接激活账号即可登陆！<br/>
                <a href="{$url}">{$urlencode}</a>
                <br/>
                如果点此链接无反映，可以将其复制到浏览器中来执行，链接的有效时间为24小时。
EOF;

            self::$mail_message->setBody("{$str}",'text/html','utf-8');

            try{
                //die("inside of try");
                if(self::$mailer->send(self::$mail_message)){
                    //die("send success");
                    $success_str=<<<SUC
                    恭喜您{$custom_username}，激活邮件发送成功，请到邮箱激活之后登陆。<br/>
                    5秒钟后跳转到<a href='index.php?controller=admin&method=login'>登陆</a>页面...
                    <meta http-equiv='refresh' content='5;url=index.php?controller=admin&method=login'/>
SUC;
                    echo $success_str;
                    
                }else{
                    echo "<script>alert('发送激活邮件失败，请重新点击发送');</script>";
                    echo "<meta http-equiv='refresh' content='1;url=index.php?controller=admin&method=getactivemail'/>";
                }

            }catch(Swift_ConnectionException $e){
                echo '邮件发送错误'.$e->getMessage();
            }
        }


    }


 ?>