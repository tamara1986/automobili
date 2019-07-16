		$(document).ready(function(){
			$(document).bind('keydown', function(event){ 
			  if(event.keyCode == 13){
			    event.preventDefault();		  
			    return false;
			  }
			});
			$("#login").on('click', function(){
				let username = $("#username").val();
				let password = $("#password").val();
				
				user={
					"username":username,
					"password":password
				}
				console.log(user);
				$.ajax({
					type : 'POST',
					url : 'http://localhost/automobili/login/signIn',					
					data : {
						insurance_form: 1,
            			form_data : user, 
					},
					success: function(response){
						var resp = JSON.parse(response);
						console.log(resp);

						if (resp=='false') {
							alert('Incorrect data!');
							location.reload();			
						}

						if(resp=='user') {
							window.location = 'http://localhost/automobili/user/index/';
						}

						if (resp == 'admin') {
							window.location = 'http://localhost/automobili/admin/index';
						}

						

						
					},
					dataType : 'text'
				});
			});
		});