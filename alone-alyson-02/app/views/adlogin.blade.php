<html>
<head>
	<title>Admin Login</title>
	 
</head>
<body class="bg">
	<span style="margin-left:100px; font-size:30px; font-weight:bold;">Admin login</span>
	<br><br>
{{ Form::open(array('url' => 'adlogin')) }}
{{ Form::text('name')}}
{{ Form::password('pass')}}
{{ Form::submit('login')}}
{{ Form::close() }}
</div>
</body>
</html>