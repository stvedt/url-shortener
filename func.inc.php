<?php

include 'db.inc.php';

function is_min($url){
	return (preg_match("/stephentvedt\.com\/u\//i", $url)) ? true : false;	
}

function gen_code(){
	$charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	return substr(str_shuffle($charset), 0, 6);
}

function code_exists($code){
	$code = mysql_real_escape_string($code); //security against injection
	$code_exists = mysql_query("SELECT COUNT(`url_id`) FROM `urls`  WHERE `code`='$code' LIMIT 1");
	return(mysql_result($code_exists, 0) == 1) ? true : false;
}

function shorten($url, $code){
	$url = mysql_real_escape_string($url);//security against injection
	$code = mysql_real_escape_string($code);
	//mysql_query("INSERT INTO `urls`(`url_id`, `url`, `code`) VALUES ('','test','test')");
	mysql_query("INSERT INTO `urls` VALUES ('','$url','$code','')");	
	return $code;
}

function redirect($code){
	$code = mysql_real_escape_string($code);
	if(code_exists($code)){
		$url_query = mysql_query("SELECT * FROM `urls` WHERE `code`='$code'");
		$url = mysql_result($url_query,0,'url');
		$hits = mysql_result($url_query,0,'hits');
		$hits++;
		mysql_query("UPDATE urls SET hits= ' ".$hits." ' WHERE code = '".$code."'");	
		header('Location: ' .$url);
	}
	
}

?>