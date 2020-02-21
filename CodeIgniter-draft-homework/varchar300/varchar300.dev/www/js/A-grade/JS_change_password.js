
$('#users_password_submit').live('click', function () {
    form_change_password	= $("#form_change_password").serialize();
	
	$.ajax({
		type:		"POST",
		url:		"/auth/change_password/",
		data:		'form_change_password='+form_change_password+'&csrf_token_name='+csrf_token_name,
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
							$('#password_old').after( result.password_old );
							$('#password_new').after( result.password_new );
							$('#password_new_confirm').after( result.password_new_confirm );
							
							$('#form_change_password').prev().after( result.password_error );
							
							$('#users_password_submit').after( result.submit );
						}
					}
	});
	
	return false;
});