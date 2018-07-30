<?php
/* Smarty version 3.1.30, created on 2018-07-30 14:17:23
  from "C:\xampp\htdocs\tpl\back\sourceadd.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b5ead7307b541_00276503',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '53c7c1dc9dda99330418ede9aba8dd53b3df598f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tpl\\back\\sourceadd.html',
      1 => 1532931437,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./leftmenu.html' => 1,
  ),
),false)) {
function content_5b5ead7307b541_00276503 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php
	';?>date_default_timezone_set("Asia/Shanghai");
<?php echo '?>';?>

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
 type="text/javascript" src="libs/ORG/ckeditor/ckeditor.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="libs/ORG/ckeditor/adapters/jquery.js"><?php echo '</script'; ?>
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
							<input type="hidden" name="t" value='s'/>
							<fieldset>
								<label>电影名</label>
								<input type="text" name="name" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['name'])===null||$tmp==='' ? '' : $tmp);?>
">
							</fieldset>
							<fieldset style="width:48%; float:left; margin-right: 3%;">
								<label>发布日期</label>
								<input type="text" name="publishTime" style="width:92%;" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['publishTime'])===null||$tmp==='' ? date("Y-m-d h:m:s") : $tmp);?>
">
							</fieldset>
							<fieldset style="width:48%; float:left;">
								<label>文件大小</label>
								<input type="text" name="size" style="width:92%;" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['size'])===null||$tmp==='' ? '' : $tmp);?>
">
							</fieldset><div class="clear"></div>
							<fieldset style="width:48%; float:left; margin-right: 3%;">
								<label>迅雷链接</label>
								<input type="text" name="magnet" style="width:92%;" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['magnet'])===null||$tmp==='' ? '' : $tmp);?>
">
							</fieldset>
							<fieldset style="width:48%; float:left;">
								<label>百度云盘</label>
								<input type="text" name="cloud" style="width:92%;" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['cloud'])===null||$tmp==='' ? '' : $tmp);?>
">
							</fieldset><div class="clear"></div>
							<fieldset>
								<label>图片链接1</label>
								<input type="text" name="pc1" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['pc1'])===null||$tmp==='' ? '' : $tmp);?>
">
							</fieldset>
							<fieldset>
								<label>图片链接2</label>
								<input type="text" name="pc2" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['pc2'])===null||$tmp==='' ? '' : $tmp);?>
">
							</fieldset>
							<fieldset>
								<label>图片链接3</label>
								<input type="text" name="pc3" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['pc3'])===null||$tmp==='' ? '' : $tmp);?>
">
							</fieldset>
							<fieldset>
								<label style="display: none">描述</label>
								<textarea rows="12" name="description" maxlength="500" id="description"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['description'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
							</fieldset>
					</div>
				<footer>
					<div class="submit_link">
						<input type="hidden" name="id" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['id'])===null||$tmp==='' ? '' : $tmp);?>
">
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
