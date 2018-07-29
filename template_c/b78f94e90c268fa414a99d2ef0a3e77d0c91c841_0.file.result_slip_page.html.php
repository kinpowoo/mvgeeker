<?php
/* Smarty version 3.1.30, created on 2018-07-29 01:55:31
  from "/Users/kinpowoo/Downloads/MVC/tpl/front/common/result_slip_page.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b5cae13d635c6_94217359',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b78f94e90c268fa414a99d2ef0a3e77d0c91c841' => 
    array (
      0 => '/Users/kinpowoo/Downloads/MVC/tpl/front/common/result_slip_page.html',
      1 => 1532637168,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b5cae13d635c6_94217359 (Smarty_Internal_Template $_smarty_tpl) {
?>
<center>
<div>
<a href='index.php?controller=curl&method=resultlist&keyword=<?php echo rawurlencode($_smarty_tpl->tpl_vars['keyword']->value);?>
&pagenum=1'>首页</a>
<a href='index.php?controller=curl&method=resultlist&keyword=<?php echo rawurlencode($_smarty_tpl->tpl_vars['keyword']->value);?>
&pagenum=<?php if ($_smarty_tpl->tpl_vars['pagenum']->value == 1) {?>1<?php } else {
echo $_smarty_tpl->tpl_vars['pagenum']->value-1;
}?>'>上一页</a>
<a href='index.php?controller=curl&method=resultlist&keyword=<?php echo rawurlencode($_smarty_tpl->tpl_vars['keyword']->value);?>
&pagenum=<?php echo $_smarty_tpl->tpl_vars['pagenum']->value+1;?>
'>下一页</a>
</div>
</center>

<?php }
}
