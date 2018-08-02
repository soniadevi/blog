$(document).ready(function(){


	$('#login').submit(function(event) {

		event.preventDefault();
		
		var username = $('#username').val();

		var password = $('#password').val();

		var is_error = 0;

		if(username.length < 1){
			$('#error-username').html('Please enter username');
			is_error = 1;
		} else{
			$('#error-username').html('');
		}

		if(password.length < 1){
			$('#error-password').html('Please enter password');
			is_error = 1;
		} else{
			$('#error-password').html('');
		}

		if (is_error) {return};


		$.ajax({
			url : './phps/login.php',
			type : 'post',
			dataType : 'text',
			data : $(this).serialize(),
			success : function(res){

				var result = JSON.parse(res);

				if (result.code === 200) {
					$('#msg').html('<div class="alert alert-success">'+result.message+'</div>');
					setTimeout(function(){
						window.location = './dashboard.php';
					}, 2000)
				} else{
					$('#msg').html('<div class="alert alert-danger">'+result.error+'</div>');
				}

			}
		}); 


	});

});