<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPERATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'mate_api');
defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
defined('CORE_PATH') ? null : define('CORE_PATH',SITE_ROOT.DS.'core');

include_once('config.php');

include_once('post.php');

?>