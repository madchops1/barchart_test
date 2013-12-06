$(document).ready(function() {
	$(document).on("focus","input",function(e){
		if($(this).val == "please enter a note"){
			$(this).val("");
		}
	});
});