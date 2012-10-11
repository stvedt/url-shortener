<?php
include 'func.inc.php';

if(isset($_GET['code']) && !empty($_GET['code'])){
	$code = $_GET['code'];
	redirect($code);
	die();
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Tvdt.us - Clean, Short, URLs</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="//use.typekit.net/uzk6kjm.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">
var opSys, tip;
$(document).ready(function() {
    //Submit events
	$('#button').click(getUrl);
	var url = $('#url');
	tip = $('#tip p');
	opSys = getOs();
	
	url.keypress(function(e) {
		if(e.which == 13) {getUrl();}
	});
	
	url.blur( function(){
		tip.fadeOut();	
	});
	url.focus( function(){
		if (url.val().match(/tvdt.us/)){
			tip.fadeIn();					
			url.select();
		}
	}).mouseup(function(e){ e.preventDefault(); });
	
	
	
});
function getUrl(){
	var url = $('#url').val();
	var urlBox = $('#url');
	
	if(!(new RegExp('^(http|https)://')).test(url)){
		url = 'http://' + url;
	}
	$.post('url.php', {url:url}, function(data){
	
		var message = $('#message p');
		
		switch (data)
		{
			case 'error_no_url':
				message.html('No Url');
				break;
			case 'error_invalid_url':
				message.html('Invalid Url');
				break;
			case 'error_is_min':
					message.html('Already Shortened');
				break;			
			default:
				urlBox.val(data);
				message.html('Successfully Shortened URL');
		}
		tip.html(opSys);
		urlBox.select();
	});
}

function getOs(){
	var os =  navigator.platform;
	return (os.match(/Mac/)) ? '⌘ + C to copy' : 'Ctrl + C to copy';
}
</script>
</head>
<body>
<div id="container">
	<h1><img src="tvdt.png" align="tvdt.us logo"/></h1>
	<p>Enter an uncool link and make it hip!</p>
	<p>
		<input type="url" name="url" id="url" size="60" autofocus placeholder="http://" required />
		<input id="button" type="button" value="Shorten" />
	</p>
	<div id="tip"><p>Press Ctrl + C to copy.</p></div>
	<div id="message">
		<p>&nbsp;</p>
	</div>
	<p class="copyright">Brought to you by: <a href="http://www.stephentvedt.com">Stephen Tvedt</a></p>
</div>
</body>
</html>