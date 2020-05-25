$(document).ready(function(){
	$('#close').on('click', function(){
		$("#modalmessage").removeClass("show");
		$("#modalmessage").css("display", "none");
	});
})