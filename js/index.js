$.Mustache.load('template/template.html').done(function() {
	$('#header').mustache('navbar');

	function transition() {
		$('#canvas').empty();
	}

	Path.map('#/login').to(function() {
		$('#canvas').mustache('login');		
	}).exit(transition);

	Path.map('#/add_student').to(function() {
		$('#canvas').mustache('add_student');		
	}).exit(transition);

	Path.map('#/delete_student').to(function() {
		$('#canvas').mustache('delete_student');		
	}).exit(transition);

	Path.map('#/register_teacher').to(function() {
		$('#canvas').mustache('register_teacher');		
	}).exit(transition);

	Path.root('#/login')
	Path.listen();

});