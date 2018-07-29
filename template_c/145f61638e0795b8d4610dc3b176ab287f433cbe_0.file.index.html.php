<?php
/* Smarty version 3.1.30, created on 2018-07-28 15:45:25
  from "/Users/kinpowoo/Downloads/MVC/tpl/front/pc/index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b5c1f15cba966_15698793',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '145f61638e0795b8d4610dc3b176ab287f433cbe' => 
    array (
      0 => '/Users/kinpowoo/Downloads/MVC/tpl/front/pc/index.html',
      1 => 1532637168,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b5c1f15cba966_15698793 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Movie Search</title>

        <center style="color:#4682B4;padding: 5px;">
        <h2 >迅雷链接在线搜索</h2>
        </center>
        <hr>
    </head>
             
      
    <body style="background-image:url(<?php echo $_smarty_tpl->tpl_vars['ROOT_DIR']->value;?>
img/images/bg.png);">
    <center>
	  <p style="color:#4682B4;margin-top: 30px;font-size:30px;">电影名/电视剧名</p>
    <table style="font-size: 24px;">
    	<form action="index.php?controller=curl&method=resultlist" method="POST">
    		<tr>
    		  <td ><input type="text" name="keyword"/></td>
              <input type="hidden" name="t" value="r"/>
    		  <td style="height:33px;width:69px;"><input type="submit" value="点击搜索"/></td>
            </tr>
    	</form>

   </table>
    </center>
    <div style="margin-top: 20px;">
    	<center>
                <a style="margin-left: 20px;color:#4682B4;" href="index.php?controller=curl&method=searchsong">搜索歌曲</a>
				<a style="margin-left: 20px;color:#4682B4;" href="/nv/waterflow.php">图片流</a>
        </center>

    </div>
   
</body>
</html>
<?php }
}
