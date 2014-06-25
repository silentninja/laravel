<html>
<head>
  <title>Accounts</title>
       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
      <script type="text/javascript" language="javascript">
      function del(i)
      {

          $.ajax( {
             type: 'GET',
             url:"delitem",
             data:{id:i},
             success:function(data) {
              if(data.st=='ok'){
                var id="#"+data.i;
                $('#log').html(data.message);
                
                $(id).remove();
                setTimeout(function(){$("#log").html("");},1000);
             }
             else{$('#log').html(data.message);}
         }
          });
        

      }
      

   </script>
   {{ HTML::style('css/my.css'); }}
</head>
<body class="bg">
<span style="margin-left:100px; font-size:30px; font-weight:bold;">Menu Items addition from Hotel Prototype</span>
  <br><br>

<div class="bigbox">
  <div id="log"></div>
{{ Form::open(array('url' => 'getitems','method' => 'get'))}}
{{ Form::select('cat', array('starter' => 'Starter', 'main' => 'Main Course','special' => 'Special','desserts' => 'Desserts','cocktails' =>'Cocktails','beer' => 'Beer'), 'starter');}}
{{ Form::submit('getitems')}}
{{ Form::close()}}
  <table><tr><td class="accounts">
 @foreach ($item as $key => $value)

 <div style="float:left; position:relative;"   id={{$value['id']}}  >
  
  
  {{$value["name"]}}-{{$value["price"]}}</div>
   <div style="float:right; position:relative; margin-right:10px;"> <button onclick="del({{$value["id"]}})" class="itemname" style="color:#f00;margin-left:200px;">Delete</button> </div></br>
  


  @endforeach
</td>
</tr>
</table>
</div