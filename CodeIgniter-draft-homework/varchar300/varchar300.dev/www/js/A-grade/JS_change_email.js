
$('#users_email_submit').live('click', function () {
    form_change_email	= $("#form_change_email").serialize();
	
	log("/messages/add/");
	
	$.ajax({
		type:		"POST",
		url:		"/auth/change_email/",
		data:		'form_change_email='+form_change_email+'&csrf_token_name='+csrf_token_name,
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
							$(".label-important").remove();
							
							$('#email').after( result.email );
							$('#password').after( result.password );
							
							$('#users_email_submit').after( result.submit );
						}
					}
	});
	
	return false;
});