<html>
<head>
	<title>Requests</title>
       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
      
       <link rel="stylesheet" type="text" href="css/my.css" />
			<script type="text/javascript" language="javascript">

      var id=-1;
      var a="";
      function call()
      {
        
 $.ajax( {
             type: 'GET',
             url:"scart",
             success:function(data) {
              if(data!="")
              {
              if(data[0].id>id){
                
                $( "#arequest" ).empty();
              
                $.each( data, function( key, value ) {  
 a="<tr id=\""+value.id+"\"><td  style=\"width:60px;height:60px;border-bottom:2px solid #7f462c;border-right:2px solid #7f462c; text-align:center;\"></td><td style=\"width:300px;height:60px;text-align:center; border-right:2px solid #7f462c;border-bottom:2px solid #7f462c;\">";
 var temp=JSON.parse(value.orders);
   $.each( temp, function( orkey, orvalue ){

    a=a+orkey+"-"+orvalue+"</br>";
   });
   a=a+"</td><td class=\"createevent\"> <button onclick=del("+value.id+")>Delete</button></td></tr>";
   alert(a);
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
			
			function del(i)
      {
         $.ajax( {
             type: 'GET',
             url:"sdel",
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
</head>
<body>
  
	<div id="log"></div>
 
 	
 	<h2>Table name and Quantity</h2>
	<table class="controlpanner" id="arequest">



  </table>
	
 
</body>
</html>