<html>
<head>
	<title>Add Items</title>
  {{ HTML::style('css/my.css'); }}
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
			<script type="text/javascript" language="javascript">
			function add()
			{
          var n=$("#name").val();
          var p=$("#price").val();
          var c=$("#cat").val();
          $.ajax( {
             type: 'GET',
             url:"additem",
             data:{name:n,price:p,cat:c},
             success:function(data) {
              if(data.st=='ok'){
                
                $('#log').html(data.message);
                setTimeout(function(){$("#log").html("");},1000);

             }
             else{$('#log').html(data.message);}
         }
          });
				

      }
			

   </script>

</head>
<body class="bg">
  <span style="margin-left:100px; font-size:30px; font-weight:bold;">Add Items</span>
  <div id="log"></div>
  <input type="text" id="name" placeholder="item name">
  <input type="text" id="price" placeholder="price">
  <select id="cat">
    <option value="starter">Starter</option>
    <option value="main">Main Course</option>
    <option value="special">Special</option>
    <option value="desserts">Desserts</option>
    <option value="beverages">Beverages</option>
    
  </select>
  <button onclick="add()">Add</button>
</body>
</html>