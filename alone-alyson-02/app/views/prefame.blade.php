<html>
<head>
	<title>Hall of Fame</title>
	 
</head>
<body class="bg">
	<table>
		<tr><td>Ranking</td> <td> Name</td></tr>
	@foreach($list as $k=>$v)
	@if($v['name']=="mukesh")
	@else
		<tr>
		<td>{{$k+1}}.</td> <td> {{$v['name']}}<td>
	</tr>
	@endif
	@endforeach
</table>
</div>
</body>
</html>