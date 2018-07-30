<?php
/* Smarty version 3.1.30, created on 2018-07-30 11:11:54
  from "C:\xampp\htdocs\tpl\front\pc\song_result.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b5e81faf06217_80819055',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2325570e11eb1eaf96dd4de7d14ac65dac1ba80' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tpl\\front\\pc\\song_result.html',
      1 => 1532920113,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b5e81faf06217_80819055 (Smarty_Internal_Template $_smarty_tpl) {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Search Result</title>
        <?php echo '<script'; ?>
 src="/img/js/AES.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/img/js/sha256.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/img/js/Base64.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/img/js/encrypt.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/img/js/BigInt.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/img/js/Barrett.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/img/js/RSA.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/img/js/core-min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/img/js/cipher-core-min.js"><?php echo '</script'; ?>
>  
        <?php echo '<script'; ?>
 src="/img/js/mode-ecb-min.js"><?php echo '</script'; ?>
>  
        <?php echo '<script'; ?>
 src="/img/js/aes-min.js"><?php echo '</script'; ?>
>  
        <?php echo '<script'; ?>
 src="/img/js/gen-params.js"><?php echo '</script'; ?>
>  

        <center style="color:#4682B4;padding: 5px;">
        <h2 >歌曲下载链接生成</h2>
        <a href="index.php">回到首页</a>
        </center>
        <hr>
    </head>

 <body style="background-color:#ffe000;">
 
<center>
<div style="width:460px;">

    <table style="font-size: 24px;">
            <tr>
              <td style="color:#4682B4;">歌名</td>
              <td><input type="text" name="" id="keyword"/></td>
              <td style="height:50px;width:69px;"><input type="button" value="搜 索" onclick="javascript:encrypt()"/></td>
            </tr>
   </table>
   </div>
   <div id="param3"></div>
</center>

   <center>
    <table border="1" style="background-color:#fff000;"> 
        <tr>
            <td style="width:80px;text-align:center;">封面</td>
            <td style="width:240px;text-align:center;">歌名</td>
            <td style="width:120px;text-align:center;">歌手</td>
            <td style="width:300px;text-align:center;">专辑名称</td>
            <td style="width:140px;text-align:center;">发行日期</td>
            <td style="width:60px;text-align:center;">进入</td>
        <tr>
		<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?> 
            <tr>
                <td><img style="width:80px;height:80px;" src="<?php echo $_smarty_tpl->tpl_vars['value']->value->al->picUrl;?>
"/></td>
                <td style="width:240px;text-align:center;"><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</td>
                <td style="width:120px;text-align:center;"><?php echo $_smarty_tpl->tpl_vars['value']->value->ar[0]->name;?>
</td>
                <td style="width:300px;word-break:break-all;text-align:center;"><?php echo $_smarty_tpl->tpl_vars['value']->value->al->name;?>
</td>
                <td style="width:140px;text-align:center;"><?php echo date("Y-m-d",$_smarty_tpl->tpl_vars['value']->value->pulishTime);?>
</td>
                <td style="width:140px;text-align:center;">
                    <span style="text-decoration: underline;cursor: pointer;" onclick="javascript:getsong(<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
);">下载</span>
                </td>
            </tr>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

		<?php }?>
       
     </table>

     <div>
        <span style="text-decoration: underline;cursor: pointer;" onclick="javascript:encrypt(1,'<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
');">首页</span>
        <span style="text-decoration: underline;cursor: pointer;" onclick="javascript:encrypt(<?php echo $_smarty_tpl->tpl_vars['page']->value-1;?>
,'<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
');">上一页</span>
        <span style="text-decoration: underline;cursor: pointer;" onclick="javascript:encrypt(<?php echo $_smarty_tpl->tpl_vars['page']->value+1;?>
,'<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
');">下一页</span>
    </div>
</center>
</body>
</html> <?php }
}
