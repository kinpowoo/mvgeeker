<?php
/* Smarty version 3.1.30, created on 2018-07-28 15:46:01
  from "/Users/kinpowoo/Downloads/MVC/tpl/front/pc/song_address.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b5c1f39834012_76691600',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c2f25a17325d466d78d98fece564de47346fed0' => 
    array (
      0 => '/Users/kinpowoo/Downloads/MVC/tpl/front/pc/song_address.html',
      1 => 1532637168,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b5c1f39834012_76691600 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>song address</title>
            <meta name="viewport" content="width=device-width">
        <center>
            <table style="width: 300px;"><tr>
            <td><h1><a href="index.php">回到首页</a></h1></td>
            <td><h1 ><a href="index.php?controller=curl&method=searchsong">继续搜索</a></h1></td>
            </tr></table>
        </center>


<link href="/img/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
<?php echo '<script'; ?>
 type="text/javascript" src="/img/js/jquery-3.2.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/img/js/jquery.jplayer.min.js"><?php echo '</script'; ?>
>




<?php echo '<script'; ?>
 type="text/javascript">
$(document).ready(function(){

    $("#jquery_jplayer_1").jPlayer({
        ready: function (event) {
            $(this).jPlayer("setMedia", {
                title: "Music",
                mp3: "<?php echo $_smarty_tpl->tpl_vars['data']->value;?>
"
            });
        },
        swfPath: "jquery.jplayer.swf",
        solution: "flash, html",
        supplied: "mp3,m4a",
        wmode: "window",
        useStateClassSkin: true,
        autoBlur: false,
        smoothPlayBar: true,
        keyEnabled: true,
        remainingDuration: true,
        toggleDuration: true
    });
});
//]]>
<?php echo '</script'; ?>
>

    </head>
    
    <body>
    <center>



<div id="jquery_jplayer_1" class="jp-jplayer"></div>
<div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
    <div class="jp-type-single">
        <div class="jp-gui jp-interface">
            <div class="jp-controls">
                <button class="jp-play" role="button" tabindex="0">play</button>
                <button class="jp-stop" role="button" tabindex="0">stop</button>
            </div>
            <div class="jp-progress">
                <div class="jp-seek-bar">
                    <div class="jp-play-bar"></div>
                </div>
            </div>
            <div class="jp-volume-controls">
                <button class="jp-mute" role="button" tabindex="0">mute</button>
                <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                <div class="jp-volume-bar">
                    <div class="jp-volume-bar-value"></div>
                </div>
            </div>
            <div class="jp-time-holder">
                <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                <div class="jp-toggles">
                    <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                </div>
            </div>
        </div>
        <div class="jp-details">
            <div class="jp-title" aria-label="title">&nbsp;</div>
        </div>
        <div class="jp-no-solution">
            <span>Update Required</span>
            To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
        </div>
    </div>
</div>


  <video controls autoplay name="media">
            <source src="<?php echo $_smarty_tpl->tpl_vars['data']->value;?>
" type="audio/mpeg">
        </video>


</center>
    </body>
</html>
<?php }
}
