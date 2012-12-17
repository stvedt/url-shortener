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
<script src="js/url.js"></script>
</head>
<body>
<div id="container">
	<h1><img src="images/tvdt.png" alt="tvdt.us logo"/></h1>
	<p>Enter an long url and make it hip!</p>
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
