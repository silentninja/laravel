<html>
<head>
	<title>Requests</title>
       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
			<script type="text/javascript" language="javascript">
      var id=-1;
      function call()
      {
        
 $.ajax( {
             type: 'GET',
             url:"showr",
             success:function(data) {
              if(data!="")
              {
              if(data[0].id>id){
                
                $( "#arequest" ).empty();
                $.each( data, function( key, value ) {  
   var a="<div  id="+value.id+">Request of room number"+value.room+" is"+value.request+" and status is"+value.status+"<button  onclick=\"status("+value.id+",'In Progress')\"  >Stage 1</button>  <button onclick=\"status("+value.id+",'Second Stage')\">Stage 2</button><button onclick=\"del("+value.id+")\">Delete</button>    </div>";
   
    $("#arequest").append(a);
  });
  id=data[0].id;
  

             }
             }
             setTimeout(call,5000);
         }
          }); 
      }
    $(document).ready(function() {
      
      call();

       
    });
			function status(i,sta)
			{
				 $.ajax( {
             type: 'GET',
             url:"update",
             data:{id:i,status:sta},
             success:function(data) {
              if(data.st=='ok'){
                var id="#"+data.i;
                $('#log').html(data.message);
                setTimeout(function(){$("#log").html("");},4000);
                

             }
             else{$('#log').html(data.message);}
         }
          });
      }
			function del(i)
      {
         $.ajax( {
             type: 'GET',
             url:"delete",
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
  <span style="margin-left:100px; font-size:30px; font-weight:bold;">Current Orders</span>
  <br><br>
  <div class="bigbox" style="font-size:20px; color:#f5f566; margin-bottom:10px;">
	<div id="log"></div>
 
 	
 		<div  id="arequest"></div>
	</div>
	
 
</body>
</html>