<html>
<head>
	<title>Fpl</title>
	 
</head>
<body class="bg">
	<span style="margin-left:100px; font-size:30px; font-weight:bold;">Fpl</span>
	<br><br>
	@if(Session::has('message'))
  {{ Session::get('message')}}
@endif

{{ Form::open(array('url' => 'fpl')) }}
@for ($i=0;$i<52;$i++)
<br>
{{Form::text($i)}}
<select name="typ{{$i}}">
       
       <option value="wicket">Wicket Keeper</option>
       <option value="bat">Batsman</option>
       <option value="bowl">Bowler</option>
       <option value="around">Allrounder</option>
   </select>
{{Form::text('cost'.$i)}}

  @endfor
  {{Form::submit("Submit")}}