//  Andy Langton's show/hide/mini-accordion @ http://andylangton.co.uk/jquery-show-hide

// this tells jquery to run the function below once the DOM is ready
$(document).ready(function() {
 

    var validator = $("#form1").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 5,
                    maxlength: 15,
                    remote:{
                       url:"index.php",//传值到后台比较的url
                       type:"post",
                       data:{
                          username:function(){return $("#username").val();},//后台要接受的bgtNumber参数取值
                          controller:'admin',
                          method:'validateusername'
                       },
                       dataType: "text"    // 这里dataType选择 text 类型要与服务器端传回的值类型一致
                    }
                },
                password: {
                    required: true,
                    psw: true,   // 自定义的规则放在 additional-method.js里面，规则的命名
                                 // 必须遵循变量命名规则，不能是关键字，用 jQuery.validator.addMethod为佳
                    minlength: 6,
                    maxlength: 18
                },
                email:{
                    required: true,
                    type: false,
                    email: true  
                },
                password2:{
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                username: {
                    required: "必须填写用户名",
                    minlength: "用户名至少为5位",
                    maxlength: "用户名至多为15"
                },
                password: {
                    required: "必须填写密码",
                    minlength: "密码至少为6位",
                    maxlength: "密码至多为18"
                },
                
                email:{
                    required: "必须填写邮箱",
                    email: "邮箱格式不正确"
                },
                
                password2: {
                    required: "密码栏不能为空",
                    equalTo: "两次输入的密码不一致"
                }
            }
    
        });



        /** 
         * 移除validate的缓存数据 
         */  
        function clearPreviousValue(){  
            if($(".remote").data("previousValue")){  
                $(".remote").removeData("previousValue");  
            }  
        }; 

        /** 
         * 移除validate的缓存数据 
        
        function clearPreviousValue(){  
            if($(".remote").data("previousValue")){  
                $(".remote").data("previousValue").old = null;  
            }  
        };
        */  


        $("#username").change(function(){  
            clearPreviousValue();  
        }); 



        // 添加自定义规则，第一个参数为方法名
        // this.optional(element)不加的话 输入框为空也会触发较验规则
        /**
        $.validator.addMethod("type", function(value, element, params){
            var rule = /^[0-9a-zA-Z_]{6,15}$/;
            return this.optional(element) || (rule.test(value));
        },"只能为数字和英文字符");
        
        */


});

