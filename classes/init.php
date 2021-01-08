<?php ob_start(); ?>
<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

//D:\xampp\htdocs\blog
define('SITE_ROOT', 'D:' . DS . 'xampp' . DS . 'htdocs' . DS . 'blog');

//D:\xampp\htdocs\blog\components
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS. 'classes');


require_once("functions.php");
require_once("databaseClass.php");
require_once("universalClass.php");
require_once("userClass.php");
require_once("postClass.php");
require_once("sessionClass.php");
require_once("commentClass.php");
require_once("paginateClass.php");

?>