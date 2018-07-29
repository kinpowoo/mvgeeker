
var modulus = '00e0b509f6259df8642dbc35662901477df22677ec152b5ff68ace615bb7b725152b3ab17a876aea8a5aa76d2e417629ec4ee341f56135fccf695280104e0312ecbda92557c93870114af6c9d05c4f7f0c3685b7a46bee255932575cce10b424d813cfe4875d3e82047b97ddef52741d546b8e289dc6935b3ece0462db0a22b8e7';
var nonce = '0CoJUm6Qyw8W8jud';
var pubKey = '010001';


function createSecretKey(size) {
    var keys = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    var key = "";
    for (var i = 0; i < size; i++) {
        var pos = Math.random() * keys.length;
        pos = Math.floor(pos);
        key = key + keys.charAt(pos)
    }
    return key;
}


    
     function encrypt(page,keyword){
        var content;
        if(keyword==null){
            content = document.getElementById('keyword').value;
        }else{
            content = keyword;
        }

        if(page==null||page<1){
            page = 1;
        }

        var obj = {
            s: content,
            type: 1,
            limit: 20,
            offset: (page-1)*20
        };

        
        var secretKey = createSecretKey(16);

        var a = aesEncryptForNetease(JSON.stringify(obj),nonce);
       
        var b = aesEncryptForNetease(a,secretKey);
     
        var key = bodyRSA();
        var c = encryptedString(key, encodeURIComponent(secretKey));
        var params ='params='+encodeURIComponent(b)+'&encSecKey='+c;

        var url ='index.php?controller=curl&method=searchsong&'+'keyword='+content+'&page='+page+"&"+params;
        
        window.location.href=url;
        //var response = '<a href="'+url+'">结果已生成</>';
        //document.getElementById('param3').innerHTML=response;
        /**
        ajaxPost(url,params,function(response){
            console.log(response);
            document.getElementById('param3').innerHTML=response;
        },function(err){
            console.log(err);
        },function(){
            console.log("requesting ...");
        });
        */
      
       // document.getElementById('param3').value=param;


    }


    function judge(){
        var code = event.keyCode;
        if(code === 13){
            encrypt();
        }
    }


    function getsong(id){

        var obj = {
            'ids': [id],
            'br': 999000,
            'csrf_token': ''
        };

        console.log(id);

        var secretKey = createSecretKey(16);

        var a = aesEncryptForNetease(JSON.stringify(obj),nonce);
       
        var b = aesEncryptForNetease(a,secretKey);
     
        var key = bodyRSA();
        var c = encryptedString(key, encodeURIComponent(secretKey));



        var param = 'params='+encodeURIComponent(b)+'&encSecKey='+c;


        //var url = 'http://music.163.com/weapi/cloudsearch/get/web?csrf_token=';
        var url = 'index.php?controller=curl&method=getsong&'+param;
       
        window.open(url,"song address");
       // document.getElementById('param3').value=param;


    }



    function decrypt(){
        var enc = document.getElementById('encrypted').value;

        var a = aesDecryptForNetease(enc,nonce);

        document.getElementById('param4').value = a;
    }
  

// ajax 对象
function ajaxObject() {
    var xmlHttp;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
        xmlHttp.withCredentials = true;
        } 
    catch (e) {
        // Internet Explorer
        try {
                xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
                xmlHttp.withCredentials = true;
            } catch (e) {
            try {
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                xmlHttp.withCredentials = true;
            } catch (e) {
                alert("您的浏览器不支持AJAX！");
                return false;
            }
        }
    }
    return xmlHttp;
}
 
// ajax post请求：
function ajaxPost (url,data,fnSucceed , fnFail , fnLoading ) {
    var ajax = ajaxObject();
    ajax.open( "get" , url , true );

    ajax.onreadystatechange = function () {
        if( ajax.readyState == 4 ) {
            if( ajax.status == 200 ) {
                fnSucceed( ajax.responseText );
            }
            else {
                fnFail( "HTTP请求错误！错误码："+ajax.status );
            }
        }
        else {
            fnLoading();
        }
    }
    ajax.send(null);
 
}


function bodyRSA(){  
    setMaxDigits(130);  
    return new RSAKeyPair(pubKey,"",modulus);   
}
  

