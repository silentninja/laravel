@if(Session::has('message'))
  {{ Session::get('message')}}
@endif
<br>
@if (!empty($data))
@if (empty($data["phno"]))
{{ Form::open(array('url' => 'addph')) }}
	{{"Please enter your phone number"}}
	{{ Form::text('phno')}}
	{{ Form::submit('Add phone')}}
{{ Form::close() }}

@else
    Hello, {{{ $data['name'] }}}-{{{ $data['score']}}} <a href="logout">Logout</a>
   
    <br>
    @if(!(empty($list)))
    
      Current Match is :  {{$gname}}
      <a href="sellist">Play Premier League</a>
      <a href="fplfame">Premier League Hall of Fame</a>
      <a href="prefame">Prediction Hall of Fame</a>
    {{ Form::open(array('url' => 'subans')) }}
        <?php $i=0 ?>
     
      @foreach( $list as $ques=>$ans)
     <br>{{Form::label('ques',$ques)}}
      
<?php $i+=1 ?>
       <select name="{{$i}}">

       <option value=""></option>
       @foreach( $ans as $opt=>$v)
       <option value="{{$v}}">{{$v}}</option>
     
       @endforeach
   </select>
   
  
        @endforeach

        {{ Form::submit('Submit Answers')}}
{{ Form::close() }}
    @else
        Sorry no matches are played now 
    @endif
    <br>
    
 @endif
@else
    Hi! Would you like to <a href="login/fb">Login with Facebook</a>?
@endif