<?php 
// $explode_uri = explode("/",dirname($_SERVER['PHP_SELF'])); 
// $link = 'http://unionalarmtronic.com/'.dirname($_SERVER['PHP_SELF']) . '/';
// if(in_array('cp',$explode_uri))
// {
// 	$implode = implode("/",$explode_uri); 
// 	$test = str_replace("/cp","",$implode);
// 	$link = 'http://localhost'.$test."/";  
// }
$link = "http://unionalarmtronic.com/divvee/";
define('BASE', $link); 
define('BASE_IMG', $link."images-2/"); 
define('APP_TITLE',"DIVVEE WIRELESS"); 
$live = true;
?>