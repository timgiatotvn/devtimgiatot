<?php
$base_url = (empty($_SERVER['HTTPS']) OR strtolower($_SERVER['HTTPS']) === 'off') ? 'http' : 'https';
$base_url .= '://' . $_SERVER['HTTP_HOST'];
$base_url_tiny = $base_url;
$script_name = substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], basename($_SERVER['SCRIPT_FILENAME'])));
$base_url .= $script_name;
define('UPLOAD_DIR', $base_url_tiny.'/editor');
define('UPLOAD_PATH', '../../../editor');
define('ACTIVE_FILE','./editor/source');

$HTTP = !empty($_SERVER['HTTPS'])?'https':'http';
define("HTTP",$HTTP);
define('APPLICATION_URL',$base_url);
define('SCRIPT_URL', $base_url);
