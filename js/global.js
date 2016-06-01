jQuery(document).ready(function($){
	$('#submit-mpr').on('click', function(event){
		event.preventDefault();
		/*Ajax funkció hivása mpr_reset_all_pass (Megtalálható a multipass-reset-admin.php file-ban)*/
		$.ajax({
			url: ajaxurl,
			beforeSend: function(){
					$('#mprpreloader').show();
			},
			type: 'POST',
			data: {action: 'mpr_reset_all_pass'},
		})
		.done(function(msg) {
			setTimeout(function(){
					$('#mprpreloader').hide();
					$('.success-message-wrapper').html(msg);
			}, 600);
			
		})
		.fail(function(a,b,c) {
			console.log(a+b+c);
		})
		.always(function() {
		
		});
		
	});
});