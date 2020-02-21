
$('#messages_add_submit').live('click', function () {
    messages_add_form	= $("#messages_add_form").serialize();
	
	log("/messages/add/");
	
	$.ajax({
		type:		"POST",
		url:		"/messages/add/",
		data:		'messages_add_form='+messages_add_form+'&csrf_token_name='+csrf_token_name,
		dataType:	"json",
		cache:		false,
		beforeSend:	function() {
						$("#response").remove();
						$('#loading').html('Получаем контент');
					},
		complete:	function() {
						$("#loading").html('');
					},
		success:	function ( result )
					{
						if (parseInt( result ) != 0 )
						{
							$(".form_show_error").remove();
							$('#messages_add_message').after( result.message );
							
							$('#messages_add_submit').after( result.submit );
						}
					}
	});
	
	return false;
});