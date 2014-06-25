<html>
<head>
	<title>CONTROL PANEL</title>
	 {{ HTML::style('css/my.css'); }}
</head>
<body class="bg">
	<span style="margin-left:100px; font-size:30px; font-weight:bold;">CONTROL PANEL -  Hotel Prototype</span>
	<br><br>

<div class="controlpan"><a href="{{url('showrcart')}}" style="text-decoration: none; color:#fff;font-family:'Century Gothic'; font-size:25px; color:#fff;">Show Restaurant orders</a></div>

<div class="controlpan"><a href="{{url('add')}}" style="text-decoration: none; color:#fff;font-family:'Century Gothic'; font-size:25px; color:#fff;">Add Items to the menu</a></div>
<div class="controlpan"><a href="{{url('getitems')}}" style="text-decoration: none; color:#fff;font-family:'Century Gothic'; font-size:25px; color:#fff;">Show menu</a></div>
<div class="controlpan"><a href="{{url('bill')}}" style="text-decoration: none; color:#fff;font-family:'Century Gothic'; font-size:25px; color:#fff;">Bills</a></div>
</body>
</html>