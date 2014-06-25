<html>
<head>
	<title>Accounts</title>
       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
			<script type="text/javascript" language="javascript">
			function del(i)
			{

          $.ajax( {
             type: 'GET',
             url:"accdel",
             data:{id:i},
             success:function(data) {
              if(data.st=='ok'){
                var id="#"+data.i;
                $('#log').html(data.message);
                
                $(id).remove();
                setTimeout(function(){$("#log").html("");},4000);

             }
             else{$('#log').html(data.message);}
         }
          });
				

      }
			

   </script>
   {{ HTML::style('css/my.css'); }}
</head>
<body class="bg">
<span style="margin-left:100px; font-size:30px; font-weight:bold;">Check Out from Hotel Prototype</span>
	<br><br>

<div class="bigbox">
  <div id="log"></div>
  <table><tr><td class="accounts">
 @foreach ($users as $key => $value)
 @if($value["name"]!='you')
 <div id={{$value['id']}}>
  {{$value["name"]}}
    <button onclick="del({{$value["id"]}})" class="createevent" style="color:#f00;">Delete the user</button>  </div>
  
  @endif
  @endforeach
</td>
</tr>
</table>
</div