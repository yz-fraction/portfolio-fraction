$('#loading').hide();

function beforeSend(){
    $("#response").remove();
	$('#loading').show();
}

function completeSend(){
	$('#loading').hide();
}