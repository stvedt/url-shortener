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