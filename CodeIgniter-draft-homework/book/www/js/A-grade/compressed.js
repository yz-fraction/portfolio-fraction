var log  = function(msg)
{
	console.log ? console.log(msg) : alert(msg);
};
var csrf_token_name = $("meta[name='csrf_token_name']").attr('content');

$(document).ready(function () {$('#loading').hide();

function beforeSend(){
    $("#response").remove();
	$('#loading').show();
}

function completeSend(){
	$('#loading').hide();
}var newURL = window.location.protocol + "://" + window.location.host + "/" + window.location.pathname;
var pathArray = window.location.pathname.split( '/' ),
	segment_3 = pathArray[3],
	segment_2 = pathArray[2];

if(segment_2  ==  "create") {
	action = 'new';
}
if(segment_3  ==  "edit") {
	action = 'update';
}

$('input[type=file]').hide();
$('#UploadButton').removeClass('hide');

$('#submit_book').click(function(){
	
	form_data	= $("#book").serialize();
	
	url			= '/book/'+action+'/';
	
	$.ajax({
		type:		"POST",
		url:		url,
		data:		form_data+'&csrf_token_name='+csrf_token_name,
		dataType:	"json",
		cache:		false,
		beforeSend:	function() {
						beforeSend();
					},
		complete:	function() {
						completeSend();
					},
		success:	function ( result )
					{
						if (parseInt( result ) != 0 )
						{
							$(".form_show_error").remove();
								
								$('#title').after( result.title );
								$('#author').after( result.author );
								$('#rubrics').after( result.rubrics );
							
							$('#submit_book').after( result.submit );
						}
					}
	});
	
	return false;
});


var ID	= $('input[name=ID]').val();
result	= 0;

$("#UploadButton").ajaxUpload({
	action:		"/book/upload_poster/"+ID+"/",
	name: 		"userfile",
	onSubmit:	function() {
					beforeSend();
				},
	onComplete:	function(result) {
					if (parseInt( result ) != 0 )
					{
						completeSend();
						$('#UploadButton').after( result.status );
					}
				}
});});