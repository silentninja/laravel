<html>
<head>
	<title>Pending requests</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
			<script type="text/javascript" language="javascript">
      var id=-1;
      function call()
      {
 $.ajax( {
             type: 'GET',
             url:"pend",
             success:function(data) {
              if(data!=""){
              if(data[0].id>id){

                $( "#accs" ).empty();
                $.each( data, function( key, value ) {  
    var a="<div  id=\""+value.id+"\">"+value.name+"<input type=\"text\" id=\""+value.id+"name\" placeholder=\"room no\"><button  onclick=\"active('"+value.id+"')\">Activate the user</button>  </div>";
   
    $("#accs").append(a);
  });
  id=data[0].id;
  

             }
             
            
         }
       }
          }); 
      }
    $(document).ready(function() {
      
      call();

       
    });

			function active(i)
			{
				var det="#"+i+"name";
      		var n=$(det).val();
          $.ajax( {
          	 type: 'GET',
             url:"activate",
             data:{room:n,id:i},
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
  <span style="margin-left:100px; font-size:30px; font-weight:bold;">Check-In at Hotel Prototype</span>
  <br><br>
	<div id="log"></div>
 <div id="accs" class="checkin"></div>
 
</body>
</html>