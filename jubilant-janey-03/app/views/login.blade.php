<html>
<head>
	<title>Login</title>
	 {{ HTML::style('css/my.css'); }}
</head>
<body class="bg">
	<span style="margin-left:100px; font-size:30px; font-weight:bold;">Login Hotel Prototype</span>
	<br><br>
{{ Form::open(array('url' => 'login')) }}
{{ Form::text('uname')}}
{{ Form::password('upass')}}
{{ Form::submit('login')}}
{{ Form::close() }}
</div>
</body>
</html>