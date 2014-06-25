<html>
<head>
	<title>Player Selection</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	 <script>
   var total = 600000;
   var players = 0;
   var wicket = new Array();
   var bat = new Array();
   var bowl = new Array();
   var allrounder = new Array();
   function addpla(name){
    var player = $("#"+name).val();
    var pname =  player.split('-');
    pname = pname[0];

    if(players>11)
    {

      $('#message').append("Sorry cannot add more than one Wicket keeper");
        setTimeout(function(){$('#message').html("");},3000);
    }
    else{

    switch(name)
    {
      case 'wicket':
      if(wicket.length>0)
      {
        $('#message').append("Sorry cannot add more than one Wicket keeper");
        setTimeout(function(){$('#message').html("");},3000);
      }
      else{
        players++;
       wicket.push(pname);
     }
        break;
      case 'bat':
       
      players++;
        bat.push(pname);
      
        break;
      case 'bowl':
  players++;
      bowl.push(pname);
    
        break;
      case 'allrounder':
       players++;
      
      allrounder.push(pname);
    
        break;

    }
  }

   
   genteam();
   player = player.split('.');
   total -= parseInt(player[1]);
   $("#cash").html(total);
}
function genteam()
{
  $("#list").html("");
  $("#list").append("<b>Wicket Keeper<br>");
  $.each( wicket, function( k, v ) {
    $("#list").append("<div onclick=dele('wicket','"+v+"')>"+v+"</div>");
    
  });
  $("#list").append("<b>Batsman<br>");
  $.each( bat, function( k, v ) {
    $("#list").append("<div onclick=dele('bat','"+v+"')>"+v+"</div>");
  });
  $("#list").append("<b>Bowlers<br>");
  $.each( bowl, function( k, v ) {
    $("#list").append("<div onclick=dele('bowl','"+v+"')>"+v+"</div>");
  });
  $("#list").append("<b>Allrounder<br>");
  $.each( allrounder, function( k, v ) {
    $("#list").append("<div onclick=dele('allrounder','"+v+"')>"+v+"</div>");
  });

}
function dele(name,pname)
{
  
   switch(name)
    {
      case 'wicket':
        var index = wicket.indexOf(pname);
        wicket.splice(index,1);
        break;
      case 'bat':
       var index = bat.indexOf(pname);
       bat.splice(index,1);
        break;
      case 'bowl':
      var index = bowl.indexOf(pname);
      bowl.splice(index,1);
      case 'allrounder':
       var index = allrounder.indexOf(pname);
       allrounder.splice(index,1);
        break;

    }
    genteam();

}
function create()
{
  
  if(total>0 && wicket.length==1 && bat.length>4 && allrounder.length>1 && bowl.length>2 && players==11)
  {
  wicket=JSON.stringify(wicket);
  bat=JSON.stringify(bat);
  bowl=JSON.stringify(bowl);
  allrounder=JSON.stringify(allrounder);
  
  $.ajax({
      url : 'http://localhost/' + 'addteam',
      cache : false,
      type: 'POST',
      data:{w:wicket,b:bat,bo:bowl,al:allrounder},
      success : function(data, status, xhr) {
        
        k(data);
      }
    });
}
else{
      $('#message').append("Your team has inconsistent number of players");
        setTimeout(function(){$('#message').html("");},3000);


}
}
 function k(res)
 {

  if(res.mes=="sucess")
  {

    $('#message').append("Your team has been sucessfully created");
        setTimeout(function(){$('#message').html("");},3000);
  }
  else
  {
    $('#message').append(res.mes);
        setTimeout(function(){$('#message').html("");},3000);
  }

 



}
   </script>
</head>
<body class="bg">
	<span style="margin-left:100px; font-size:30px; font-weight:bold;">Fpl</span>
	<br><br>
	@if(Session::has('message'))
  {{ Session::get('message')}}
@endif
Current Match :{{$gname}}
<div id="message"></div>
<div>Cash Left:Rs.<span id="cash">600000</span></div>
{{Form::label('wicket','Wicket Keeper')}}<br>
<select id="wicket">
  
@foreach ($wicket as $key => $value)
 <option>{{$value["name"]}}-RS.{{$value["cost"]}}</option>
@endforeach 
</select><button onclick="addpla('wicket')">Add</button><br>
{{Form::label('bat','Batsman')}}<br>
<select id="bat">
  
@foreach ($bat as $key => $value)
 <option>{{$value["name"]}}-RS.{{$value["cost"]}}</option>
@endforeach 
</select><button onclick="addpla('bat')">Add</button><br>
  
  {{Form::label('wicket','Bowler')}}<br>
<select id="bowl">
  
@foreach ($bowl as $key => $value)
 <option>{{$value["name"]}}-RS.{{$value["cost"]}}</option>
@endforeach 
</select><button onclick="addpla('bowl')">Add</button><br>
{{Form::label('allrounder','All Rounder')}}<br>
<select id="allrounder">
  
@foreach ($around as $key => $value)
 <option>{{$value["name"]}}-RS.{{$value["cost"]}}</option>
@endforeach 
</select><button onclick="addpla('allrounder')">Add</button><br>
<div id="list"></div>
<button onclick="create()">Create Team</button>
  
  