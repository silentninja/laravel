<html>
<head>
	<title>Control panel</title>
	 
</head>
<body class="bg">
	<span style="margin-left:100px; font-size:30px; font-weight:bold;">Control panel</span>
	<br><br>
	@if(Session::has('message'))
  {{ Session::get('message')}}
@endif
<a href="fpl">Fpl</a>
<a href="scorepl">Score players</a>
<a href="scoreteam">Score Team</a>
{{ Form::open(array('url' => 'control')) }}
<a href="close">Close this game</a>
<a href="check">Check the answers</a><br>
{{ Form::label('game name','Match Name')}}<br>
{{ Form::text('gname')}}<br>
@for ($i=1;$i<=20;$i++)
{{ Form::label('ques',"Question $i")}} <br>
{{ Form::text("q$i")}}<br>
{{ Form::label('ques',"Enter choices")}} <br>
{{ Form::text("o$i a")}}<br>
{{ Form::text("o$i b")}}<br>
{{ Form::text("o$i c")}}<br>
{{ Form::text("o$i d")}}<br>
@endfor
{{ Form::submit('Update Details')}}<br>
{{ Form::close() }}<br>
</body>
</html>