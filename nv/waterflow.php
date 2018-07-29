<?php 
header("content-type:text/html;charset=utf-8");
$page = $_GET["page"];

if(empty($page)){
	$page =1;
}


$photos =  more_photo($page);



  function more_photo($page){   
 
				$headers = array(
					'Host:gank.io',
					'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
					'Accept-Language:zh-CN,zh;q=0.8',
					'Cache-Control:max-age=0',
					'Proxy-Connection:keep-alive',
					'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36',
				);
				$url = 'http://gank.io/api/data/%E7%A6%8F%E5%88%A9/50/'.$page;
				
                $ch = curl_init($url);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //返回数据不直接输出
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				$data = curl_exec($ch);
	
				curl_close($ch);
				
                $origin = json_decode($data);
				
				
				$list = $origin->results;
				return $list;
            } 
?>



<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<script src="js/jquery.min.js"></script>
	<script src="js/sidebar.js"></script>

	<link rel="stylesheet" href="css/index.css" />
	<link rel="stylesheet" href="css/sidebar.css" />
	
	
    <title>美女瀑布流</title>
    
    <style>
    /*大层*/
    .container{width:81%;margin:0px 10px 20px 18%;}
    /*瀑布流层*/
    .waterfall{
        -moz-column-count:4; /* Firefox */
        -webkit-column-count:4; /* Safari 和 Chrome */
        column-count:4;
        -moz-column-gap: 1em;
      -webkit-column-gap: 1em;
      column-gap: 1em;
    }
    /*一个内容层*/
    .item{
      padding: 1em;
      margin: 0 0 1em 0;
      -moz-page-break-inside: avoid;
      -webkit-column-break-inside: avoid;
      break-inside: avoid;
     border: 1px solid #000;
    }
    .item img{
        width: 100%;
        margin-bottom:10px;
    }
    </style>
</head>
<body>



 <div class="container">
        <div class="waterfall">
		<?php if($photos!=null){ ?>
		<?php foreach($photos as $p){ ?>
            <div class="item">
                <a href="<?php echo $p->url ?>" target="_blank"><img src="<?php echo $p->url ?>" /></a>
                <p><?php echo $p->publishedAt ?></p>
           </div>
		<?php } ?>
		<?php } ?>
        </div>


<nav class="sidebar jsc-sidebar" id="jsi-nav" data-sidebar-options="">
	<ul class="sidebar-list">
		<li> <a href="./waterflow.php?page=<?php if($page>=2){echo $page-1;}else{echo 1;} ?>">上一页</a></li>
		<li><a href="./waterflow.php?page=<?php echo $page+1 ?>">下一页</a></li>
        <li><a href="../index.php?controller=index&method=index">回到首页</a></li>
	</ul>
</nav>


 
	
	
	
	<script>
			$('#jsi-nav').sidebar({
				trigger: '.jsc-sidebar-trigger',
				scrollbarDisplay: true,
				pullCb: function () { console.log('pull'); },
				pushCb: function () { console.log('push'); }
			});

			$('#api-push').on('click', function (e) {
				e.preventDefault();
				$('#jsi-nav').data('sidebar').push();
			});
			$('#api-pull').on('click', function (e) {
				e.preventDefault();
				$('#jsi-nav').data('sidebar').pull();
			});
		</script>
	
</body>
</html>