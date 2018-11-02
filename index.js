$.Mustache.load('template/template.html').done(function() {
	$('#header').mustache('navbar');

	function transition() {
		$('#canvas').empty();
	}

	Path.map('#/login').to(function() {
		$('#canvas').mustache('login');

		$('#SubmitLogin').on('click', function(e) {
			e.preventDefault();	
			var username = $('#loginusername').val();
			var password = $('#loginpassword').val();
			//change this into alternative

			$.post('includes/login_handler.php',{username: username, password: password}, function(response) {
					if(response == 'Please complete everything' || response == 'Please go to "Register Teacher"' || response == 'Incorrect Details') {
						alert(response);
						$('#loginusername').val('');
						$('#loginpassword').val('');
					}
					else {
						alert(response);
					}
			});
			// $.ajax({
			// 	method: 'post',
			// 	data: {
			// 		username: username,
			// 		password: password
			// 	},
			// 	url: 'includes/login_handler.php',
			// 	success: function(response) {
			// 		if(response == 'Please enter something' || response == 'Please go to "Register Teacher"') {
			// 			alert(response);
			// 			$('#loginusername').val('');
			// 			$('#loginpassword').val('');
			// 		}
			// 		else {
			// 			alert(response);
			// 		}
			// 	}
			// });

		});

	}).exit(transition);

	Path.map('#/add_student').to(function() {
		$('#canvas').mustache('add_student');
		
	}).exit(transition);

	Path.map('#/delete_student').to(function() {
		$('#canvas').mustache('delete_student');		
	}).exit(transition);

	Path.map('#/register_teacher').to(function() {
		$('#canvas').mustache('register_teacher');	

		$('#SubmitRegisterTeacher').on('click', function(e) {
			e.preventDefault();

			var fullname = $('#register_teacherfullname').val();
			var username = $('#register_teacherusername').val();
			var password = $('#register_teacherpassword').val();
			var id = $('#register_teacherid').val();

			$.ajax({
				method: 'post',
				data: {
					fullname: fullname,
					username: username,
					password: password
				},
				url: 'includes/register_teacher.php',
				success: function(response) {
					if(response == 'Please complete all details' || response == 'Username already taken') {
						alert(response);
						$('#register_teacherfullname').val('');
						$('#register_teacherusername').val('');
						$('#register_teacherpassword').val('');
					}
					else {
						alert(response);
					}
				}
			});
		});	
	}).exit(transition);

	Path.root('#/login')
	Path.listen();

});