$.Mustache.load('template/template.html').done(function() {
	$('#header').mustache('navbar');
	function transition() {
		$('#canvas').empty();
	}
//****************LOGIN
	Path.map('#/login').to(function() {
		if(localStorage.hasOwnProperty('Username') == true) {
			window.location.href = '#/login_teacher';
		}	
		else {
			$('#canvas').mustache('login');
			$('#SubmitLogin').on('click', function(e) {
				e.preventDefault();	
				var username = $('#loginusername').val();
				var password = $('#loginpassword').val();
				$.post('includes/login_handler.php',{username: username, password: password}, function(response) {
						if(response == 'Please complete everything' || response == 'Please go to "Register Teacher"' || response == 'Incorrect Details') {
							alert(response);
							$('#loginusername').val('');
							$('#loginpassword').val('');
						}
						else {
							alert(response);
							localStorage.setItem('Username', username);
							window.location.href= '#/login_teacher';
						}
				});

			});
		}

	}).exit(transition);
//****************REGISTER STUDENT
	Path.map('#/add_student').to(function() {
		try{
			$('#header').empty();
			$('#header').mustache('navbar_login_teacher');
			$('#canvas').mustache('add_student');
			if(performance.navigation.type == 1) { //check if browser refresh
				window.location.href = '#/login_teacher';
			}
			$.get('includes/student_handler/show_student_list.php',{username: window.obj['username']}, function(response) {
				var objs = JSON.parse(response);
				var arrList = [];
				for(var i = 0; i<objs.length;i++) {
					if(i%2) {
						if(objs[i-1] == undefined) {
							alert('Please put username to ' + objs[i-1]);
						}
						arrList.push(objs[i-1]);
						var appendHere = "<tr><th scope='row'></th><td>" + objs[i-1] +"</td><td>" + objs[i] + "</td><td></td></tr>";
						$('#add_student_list_here').append(appendHere);
					}
				}
			});
			$('#SubmitAddStudent').on('click', (e) => {
				e.preventDefault();
				var fullname = $('#add_studentfullname').val();
				var username = $('#add_studentusername').val();
				var password = $('#add_studentpassword').val();
				$.post('includes/student_handler/register_student.php',{fullname: fullname, username: username, password: password, teacher: window.obj['username']}, function(response) {
					alert(response);
				});
			});

			$('#SubmitUpdateStudent').on('click', function() {
				var fullname = $('#update_studentfullname').val();
				var username = $('#update_studentusername').val();
				var password = $('#update_studentpassword').val();
				$.post('includes/updated_profile.php',{fullname: fullname,username: username,password: password}, function(response) {
					alert(response);
				});
			});

			$('#SubmitDeleteStudent').on('click', function() {
				var username = $('#delete_studentusername').val();
				$.post('includes/student_handler/delete_student.php',{username: username}, function(response) {
					alert(response);
				});
			});
		}
		catch(err) {//at first refresh window.obj is not found
			if (err instanceof TypeError) {}
		}	
			
	}).exit(transition);

//****************REGISTER TEACHER ONLY
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
//****************TEACHER LOGIN
	Path.map('#/login_teacher').to(function() {
			$('#header').empty();
			$('#header').mustache('navbar_login_teacher');
			$('#canvas').mustache('login_teacher');
			var username = localStorage.getItem('Username');
			$.get('includes/edit_profile_handler.php',{username: username}, function(response) {
				var obj = JSON.parse(response);
				$('#login_teacherfullname').val(obj.fullname);
				$('#login_teacherusername').val(obj.username);
				$('#login_teacherpassword').val(obj.password);
				//global login credentials
				window.obj = obj;
			});
			$('#SubmitLoginTeacher').on('click', function(e) {
				e.preventDefault();
				var fullname = $('#login_teacherfullname').val();
				var username = $('#login_teacherusername').val();
				var password = $('#login_teacherpassword').val();
				fetch('includes/updated_profile.php',{fullname: fullname,username: username,password: password}, function(response) {
					alert(response);
				});
			});
	}).exit(transition);
//****************LOGOUT
	Path.map('#/logout_teacher').to(function() {
		$('#header').empty();
		window.location.href= '#/login';		
		localStorage.removeItem('Username');
		window.obj = null;
		window.location.reload();
	}).exit(transition);

	Path.root('#/login')
	Path.listen();

});