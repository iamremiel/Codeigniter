/*$(function () {
	$('#add_users').click(function()){
		$('a').hide();
	}
	console.log()
});*/
$(document).ready(function() {
  $('select').material_select();
  // $('.modal-trigger').leanModal();
   $("#add_users").click(function(){
        $("#form_add").slideToggle();
    });
});
