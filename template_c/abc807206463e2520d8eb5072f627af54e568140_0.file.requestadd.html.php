<?php
/* Smarty version 3.1.30, created on 2018-07-30 14:02:01
  from "C:\xampp\htdocs\tpl\back\requestadd.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b5ea9d9a5e702_84961043',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'abc807206463e2520d8eb5072f627af54e568140' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tpl\\back\\requestadd.html',
      1 => 1532920113,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./leftmenu.html' => 1,
  ),
),false)) {
function content_5b5ea9d9a5e702_84961043 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>后台管理系统</title>
	
	<link rel="stylesheet" href="img/css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="img/css/ie.css" type="text/css" media="screen" />
	<?php echo '<script'; ?>
 src="img/js/html5.js"><?php echo '</script'; ?>
>
	<![endif]-->
	<?php echo '<script'; ?>
 src="img/js/jquery-1.5.2.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="img/js/hideshow.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="img/js/jquery.tablesorter.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="img/js/jquery.equalHeight.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function() 
	{ 
  	  $("#description").ckeditor(); 
	 } 
	);	
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
<?php echo '</script'; ?>
>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="admin.html">后台管理面板</a></h1>
			<h2 class="section_title"></h2><div class="btn_view_site"><a href="index.php">查看网站</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>admin</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="admin.php？controller=admin">后台管理系统</a> <div class="breadcrumb_divider"></div> <a class="current">资源发布</a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<?php $_smarty_tpl->_subTemplateRender("file:./leftmenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	
	<section id="main" class="column">
		<form id="form1" name="form1" method="post" action="admin.php?controller=admin&method=sourceadd">
			<article class="module width_full">
				<header><h3>发布新资源</h3></header>
					<div class="module_content">
							<fieldset style="width:48%; float:left; margin-right: 3%;">
								<label>电影名</label>
								<input type="text" name="name" style="width:92%;" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['name'])===null||$tmp==='' ? '' : $tmp);?>
">
							</fieldset>
							<fieldset style="width:48%; float:left;">
								<label>状态</label><div class="clear"></div>
								<div style="padding:0.6%;padding-left: 10px;">
								未解决	
								<input style="width:10%;" type="radio" checked="<?php if ($_smarty_tpl->tpl_vars['data']->value['status'] == '0') {?>true<?php } else { ?>false<?php }?>" name="status" value='0' />
								已解决
								<input style="width:10%;" type="radio" checked="<?php if ($_smarty_tpl->tpl_vars['data']->value['status'] == '1') {?>true<?php } else { ?>false<?php }?>" name="status" value='1' />
								</div>
							</fieldset><div class="clear"></div>

							<fieldset style="width:48%;">
								<label>类型：</label>
								百度云
								<input type="radio" checked="<?php if ($_smarty_tpl->tpl_vars['data']->value['type'] == '百度云') {?>true<?php } else { ?>false<?php }?>" name="type" value="百度云"> 
								迅雷
								<input type="radio" checked="<?php if ($_smarty_tpl->tpl_vars['data']->value['type'] == '迅雷') {?>true<?php } else { ?>false<?php }?>" name="type" value="迅雷">
							</fieldset>
					</div>
				<footer>
					<div class="submit_link">
						<input type="hidden" name="id" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['id'])===null||$tmp==='' ? '' : $tmp);?>
">

						<input type="hidden" name="t" value="r">
						<input type="submit" name="submit" value="发布" class="alt_btn">
					</div>
				</footer>
			</article>
		</form>
		<div class="spacer"></div>
	</section>


</body>

</html><?php }
}
