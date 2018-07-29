<?php
/* Smarty version 3.1.30, created on 2018-07-29 01:55:31
  from "/Users/kinpowoo/Downloads/MVC/tpl/front/pc/result_list.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b5cae13d40872_37829091',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31695a970fcb92f61823b489ffec6981b8ad74e6' => 
    array (
      0 => '/Users/kinpowoo/Downloads/MVC/tpl/front/pc/result_list.html',
      1 => 1532637168,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:{$ROOT_DIR}tpl/front/common/result_slip_page.html' => 1,
  ),
),false)) {
function content_5b5cae13d40872_37829091 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />  
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<div style="margin-bottom:1%;">
<center>
<h1><a href="index.php?controller=index&method=index">mvgeeker</a>
<table>
	<form action="index.php?controller=curl&method=resultlist" method="POST">
	<tr>
		<td><span style="font-size: 14px;margin-right: 3px;">影视名:<span></td>
		<td><input type="text" name="keyword" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['keyword']->value)===null||$tmp==='' ? '' : $tmp);?>
" /> </td>
        <input type="hidden" name="t" value="r"/>
		<td><input type="submit" value="提交" /></td>
	</tr>
	</form>
</table>

</h1><title>影视剧管理系统</title>
</center>
</div>
<hr>

<link href="<?php echo $_smarty_tpl->tpl_vars['ROOT_DIR']->value;?>
img/css/default.css" rel="stylesheet" type="text/css" />

</head>
<body>

<!-- start page -->
<div style="width: 95%">

    <!-- start content -->
   
  <div>
   
    <center>
    <div style="width: 90%;">
    <table border="1" cellpadding="0" cellspacing="0" style="width: 75%;">
        <thead>
        <tr class="source_show">
            <td style="width: 40%;color: #A0522D;">电影名</td>
            <td style="width: 20%;color: #A0522D;">类型</td>
            <td style="width: 40%;color: #A0522D;">发布时间</td>
        </tr>
        </thead>
        <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?> 
            <tr class="source_show">

            <td style="color: #7AD000;"><a href='index.php?controller=curl&method=resultlink&target=<?php echo rawurlencode($_smarty_tpl->tpl_vars['value']->value['url']);?>
&name=<?php echo rawurlencode($_smarty_tpl->tpl_vars['value']->value['title']);?>
&from=<?php echo $_smarty_tpl->tpl_vars['value']->value['source'];?>
'> <?php echo $_smarty_tpl->tpl_vars['value']->value['title'];?>
 </a></td>   
            
            <td style="color: #7AD000;"><?php echo $_smarty_tpl->tpl_vars['value']->value['type'];?>
</td>
            <td style="color: #7AD000;"><?php echo $_smarty_tpl->tpl_vars['value']->value['publishTime'];?>
</td>
            </tr>
        <?php
}
} else {
?>

        <tr>
            <td  style="color: #7AD000;" colspan=3>
                没有搜索到数据
            </td>
        </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </tbody>
    </table>

    </div>    
 
    </center>

</div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:{$ROOT_DIR}tpl/front/common/result_slip_page.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>


</body>
</html><?php }
}
