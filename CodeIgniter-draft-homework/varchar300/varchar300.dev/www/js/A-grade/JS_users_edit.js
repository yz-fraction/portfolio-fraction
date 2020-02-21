
$('#users_edit_submit').live('click', function () {
    users_edit_form	= $("#users_edit_form").serialize();
	
	log("log");
	
	$.ajax({
		type:		"POST",
		url:		"/auth/edit/",
		data:		'users_edit_form='+users_edit_form+'&csrf_token_name='+csrf_token_name,
		dataType:	"json",
		cache:		false,
		beforeSend:	function() {
						beforeSend();
					},
		complete:	function() {
						$("#loading").html('EMPTY');
					},
		success:	function ( result )
					{
						if (parseInt( result ) != 0 )
						{
							$(".form_show_error").remove();
								
								$('#users_edit_name').after( result.name );
								$('#users_edit_surname').after( result.surname );
								$('#users_edit_age').after( result.age );
								$('#users_edit_city').after( result.city );
								$('#users_edit_socium').after( result.socium );
								
								$('#users_edit_female').after( result.sex );
								
								$('#users_edit_country').after( result.country );
							
							$('#users_edit_submit').after( result.submit );
						}
					}
	});
	
	return false;
});