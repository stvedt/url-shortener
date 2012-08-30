<?php
include 'func.inc.php';

if(isset($_GET['code']) && !empty($_GET['code'])){
	$code = $_GET['code'];
	redirect($code);
	die();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<head>
<title>Simple URL's @ tvdt.us</title>

<link href="style.css" rel="stylesheet" type="text/css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    //Submit events
	$('#button').click(getUrl);
	$('#url').keypress(function(e) {
		if(e.which == 13) {getUrl();}
	});
	
});
function getUrl(){
	var url = $('#url').val();
	if(!(new RegExp('http://')).test(url)){
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
			$('#url').val(data);
			$('#url').select();
			message.html('Successfully Shortened URL');
	}	
	});
}
</script>

</head>
<body>

<div id="container">
  <h1>Simple URL's @ tvdt.us</h1>
  <p>Go ahead, enter a long URL and have it shortened.</p>
  <p><input type="text" name="url" id="url" size="60" autofocus placeholder="http://" required /> <input id="button" type="button" value="Shorten" /></p>

  <div id="message"><p>&nbsp;</p></div>

</div>

</body>
</html>