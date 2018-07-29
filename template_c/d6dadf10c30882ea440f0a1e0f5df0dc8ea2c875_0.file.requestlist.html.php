<?php
/* Smarty version 3.1.30, created on 2018-07-29 01:21:26
  from "/Users/kinpowoo/Downloads/MVC/tpl/back/requestlist.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b5ca616ca45b1_33403067',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd6dadf10c30882ea440f0a1e0f5df0dc8ea2c875' => 
    array (
      0 => '/Users/kinpowoo/Downloads/MVC/tpl/back/requestlist.html',
      1 => 1532637168,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./leftmenu.html' => 1,
  ),
),false)) {
function content_5b5ca616ca45b1_33403067 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8"/>
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
			<h1 class="site_title"><a href="#">后台管理面板</a></h1>
			<h2 class="section_title"></h2><div class="btn_view_site"><a href="index.php">查看网站</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo $_smarty_tpl->tpl_vars['admin']->value;?>
，欢迎回来~</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="admin.php?controller=admin">后台管理中心</a> <div class="breadcrumb_divider"></div> <a class="current">新闻管理列表</a></article>
		</div>
	</section><!-- end of secondary bar -->

	<?php $_smarty_tpl->_subTemplateRender("file:./leftmenu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


	<section id="main" class="column">
		
		<article class="module width_full">
		<header><h3 class="tabs_involved">新闻管理列表</h3>
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
				<table class="tablesorter" cellspacing="0" style="margin:0"> 
					<thead> 
						<tr>  
			    				<th>ID</th>
			    				<th>标题</th>
			    				<th>作者</th>
			    				<th>操作</th>
						</tr> 
					</thead>
					<tbody>
					<?php if (isset($_smarty_tpl->tpl_vars['data']->value)) {?>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
							<tr>
			    				<td><?php if (isset($_smarty_tpl->tpl_vars['value']->value['id'])) {
echo $_smarty_tpl->tpl_vars['value']->value['id'];
}?></td> 
			    				<td><?php if (isset($_smarty_tpl->tpl_vars['value']->value['name'])) {
echo $_smarty_tpl->tpl_vars['value']->value['name'];
}?></td> 
			    				<td><?php if (isset($_smarty_tpl->tpl_vars['value']->value['publishTime'])) {
echo $_smarty_tpl->tpl_vars['value']->value['publishTime'];
}?></td> 
			    				<td><input type="image" src="img/images/icn_edit.png" title="Edit" onclick="window.location.href='admin.php?controller=admin&method=sourceadd&t=r&id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
'"><input type="image" src="img/images/icn_trash.png" title="Trash" onclick="window.location.href='admin.php?controller=admin&method=sourcedel&t=r&id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
'"></td>
							</tr>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

					<?php } else { ?>
						<tr>
							<td  colspan=4>
								暂无资源
							</td>
						</tr>
					<?php }?>
					</tbody>
				</table>

			</div><!-- end of #tab1 -->

			<div id="tab2" class="tab_content">

			</div><!-- end of #tab2 -->
			
		</div><!-- end of .tab_container -->
	
		</article><!-- end of content manager article -->

	   <center>
			<div>
			<a href='index.php?controller=admin&method=sourcelist&t=r&pagenum=1'>首页</a>
			<a href='index.php?controller=admin&method=sourcelist&t=r&pagenum=<?php if ($_smarty_tpl->tpl_vars['pagenum']->value == 1) {?>1<?php } else {
echo $_smarty_tpl->tpl_vars['pagenum']->value-1;
}?>'>上一页</a>
	        <input style="width:50px" type='text' id='target_num' /><input type="button" onclick="javascript:goto(<?php echo $_smarty_tpl->tpl_vars['endpage']->value;?>
);" value="跳页"></input>

			<a href='index.php?controller=admin&method=sourcelist&t=r&pagenum=<?php if ($_smarty_tpl->tpl_vars['pagenum']->value == $_smarty_tpl->tpl_vars['endpage']->value) {
echo $_smarty_tpl->tpl_vars['endpage']->value;
} else {
echo $_smarty_tpl->tpl_vars['pagenum']->value+1;
}?>'>下一页</a>
			<a href='index.php?controller=admin&method=sourcelist&t=r&pagenum=<?php echo $_smarty_tpl->tpl_vars['endpage']->value;?>
'>尾页</a>
			</div>

	        <div style="color:#4682B4;margin-top: 15px;"> 一共<?php echo $_smarty_tpl->tpl_vars['endpage']->value;?>
页<span style="margin-left:20px;">当前页{ <?php echo $_smarty_tpl->tpl_vars['pagenum']->value;?>
 }</span></div>
		</center>
		
		<div class="spacer"></div>
	</section>
		
	


<?php echo '<script'; ?>
 type="text/javascript">
	function goto(a){
	  var target_page = document.getElementById('target_num').value;
      if(target_page>a){
          target_page = a;
       }
       if(target_page<1){
          target_page = 1;
       }
       window.location.href="index.php?controller=admin&method=sourcelist&t=r&pagenum="+target_page;
	}

<?php echo '</script'; ?>
>


</body>

</html><?php }
}
