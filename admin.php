<?php 

header('Content-type:text/html;charset=utf-8');

require_once('config.php');

require_once('framework/engine.php');

engine::run($config);



 ?>