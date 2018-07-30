<?php
/* Smarty version 3.1.30, created on 2018-07-30 13:58:20
  from "C:\xampp\htdocs\tpl\back\leftmenu.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b5ea8fc3112e1_57287444',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ed379b28c782697daf6f619f98748530e23d5c54' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tpl\\back\\leftmenu.html',
      1 => 1532920113,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b5ea8fc3112e1_57287444 (Smarty_Internal_Template $_smarty_tpl) {
?>
<aside id="sidebar" class="column">
	<h3>资源管理</h3>
	<ul class="toggle">
		<li class="icn_new_article"><a href="admin.php?controller=admin&method=sourceadd&t=s">添加资源</a></li>
		<li class="icn_categories"><a href="admin.php?controller=admin&method=sourcelist&t=s">管理资源</a></li>
		<li class="icn_new_article"><a href="admin.php?controller=admin&method=sourceadd&t=r">添加请求</a></li>
		<li class="icn_categories"><a href="admin.php?controller=admin&method=sourcelist&t=r">管理请求</a></li>
	</ul>
	<h3>管理员管理</h3>
	<ul class="toggle">
		<li class="icn_jump_back"><a href="admin.php?controller=admin&method=logout">退出登录</a></li>
	</ul>
	
	<footer>
		
	</footer>
</aside><!-- end of sidebar --><?php }
}
