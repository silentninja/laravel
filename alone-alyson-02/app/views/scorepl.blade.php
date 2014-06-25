<html>
<head>
	<title>Score Players</title>
	 
</head>
<body class="bg">
	<span style="margin-left:100px; font-size:30px; font-weight:bold;">Control panel</span>
	<br><br>
	@if(Session::has('message'))
  {{ Session::get('message')}}
@endif
{{ Form::open(array('url' => 'scorepl')) }}
@foreach($dat as $key=>$val)
	{{$val['name']}}{{Form::text($val['name'])}}<br>
@endforeach
{{Form::submit('Submit')}}