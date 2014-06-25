<?php

class DetailsController extends BaseController {


function control()
{
	if(Auth::user()->canEdit())
	{
	$x=Input::all();
	$gname=$x['gname'];
	$a=1;
	$list=array();
	for($i=1;$i<=20;$i++)
	{
		if($x['q'.$i]=="")
			{


			}

		else
			{
				$ques=$x['q'.$i];
			
			$o1=$x['o'.$i.'_a'];
			$o2=$x['o'.$i.'_b'];
			$o3=$x['o'.$i.'_c'];
			$o4=$x['o'.$i.'_d'];
			$list[$ques]=array('o1'=>$o1,'o2'=>$o2,'o3'=>$o3,'o4'=>$o4);


		}
	}
	$list=json_encode($list);
	$deta=new Detail();
	$deta->gname=$gname;
	$deta->list=$list;
	$deta->save();
	}


}
function scorepl()
{
	if(Auth::user()->canEdit())
	{

	$dat=Player::all()->toArray();
	return View::make('scorepl')->with("dat",$dat);
}
}
function fplfame()
{
	$list=Team::take(50)->orderBy('score','Desc')->get();
	
	return View::make('fplfame')->with('list',$list);


}
function prefame()
{
	$list=User::take(50)->orderBy('score','Desc')->get();
	
	return View::make('prefame')->with('list',$list);


}
function ifpl()
{
	$sta=Detail::first();
	if(!$sta["status"] && Auth::check())
	{
	$a=Input::all();
	for ($i=0;$i<52;$i++)
	{
		$nam=$a["$i"];
		$typ=$a['typ'.$i];
		$c=$a['cost'.$i];
		
		$pla=new Player();
		$pla->name=$nam;
		$pla->type=$typ;
		$pla->cost=$c;
		$pla->save();
	}
}


}
function delplayer()
{
	if(Auth::user()->canEdit()){
	Player::truncate();
}

}

function close()
{

	if(Auth::user()->canEdit())
	{


		$det=Detail::take(1)->update(array('status'=>true));

	}


}
function check()
{

	if(Auth::user()->canEdit())
	{


		$ans=Auth::user()->ans;
		$ans=json_decode($ans,true);
		$otherans=User::where('isadmin','=','0')->get(array('id','ans'))->toArray();
		foreach($otherans as $key=>$value)
		{
			$id=$value["id"];
			$points=0;
			$oans=json_decode($value["ans"],true);
			foreach ($oans as $key => $value) {
				if($ans[$key]==$oans[$key])
				{

					$points+=20;
				}
			}
			$usr=User::find($id);
			$usr->increment('score',$points);
			$usr->ans="";
			$usr->save();

		}
	}
}
function sellist()
{	$sta=Detail::first();
	if(!$sta["status"] && Auth::check())
	
	{
		 
         foreach($sta as $details)
    {
      $gname=$details['gname'];
  }
	$wicket=Player::where('type','=','wicket')->get(array('name','cost'))->toArray();
	$bat=Player::where('type','=','bat')->get(array('name','cost'))->toArray();
	$bowl=Player::where('type','=','bowl')->get(array('name','cost'))->toArray();
	$around=Player::where('type','=','around')->get(array('name','cost'))->toArray();
	return View::make('sellist')->with('gname',$gname)->with('wicket',$wicket)->with('bat',$bat)->with('bowl',$bowl)->with('around',$around);
}
else{
echo "The match has been close or you have not logged in";
	}
}
function scorep()
{
	if(Auth::user()->canEdit())
	{
	$a=Input::except('_token');
	foreach ($a as $key => $value) {
		$player=Player::where('name','=',$key)->first();
		$player->score=$value;
		$player->save();
	}
}



}
function userdetails()
{

	if(Auth::user()->canEdit())
	{
		$list = User::all();
		foreach($list as $key=>$value)
		{
			$name=$value['name'];
			$ph=$value['phno'];
			print "$name-$ph<br>";
		}
		}
	
}
function scoreteam()
{
	if(Auth::user()->canEdit()){
	$teams = Team::all();
	$pl= Player::all();
	$list = array();
	foreach ($pl as $key => $value) {

		$list[$value['name']] = $value['score'];
	}
	foreach ($teams as $key => $value) {
		$points=0;
		$id=$value['id'];
		$team=json_decode($value['team']);
		foreach ($team as $k => $v) {
			$points+=$list[$v];
		}
		print $points;
		$pla= Team::find($id);
		$pla->increment('score',$points);
		$pla->save();
	}

}

}
function addteam()
{
	if(!$sta["status"] && Auth::check())
	
	{
 	if(Team::where('user','=',Auth::user()->nam())->count()>0)
 		{$data=array('mes' => "Your already have a team");
	$response = Response::json($data);
	return $response;}
	else{
	$w=json_decode(Input::get('w'));
	$bat=json_decode(Input::get('b'));
	$bowl=json_decode(Input::get('bo'));
	$al=json_decode(Input::get('al'));
	$players = array();
	$total=count($w)+count($bat)+count($bowl)+count($al);
	if($total==11 && count($w)==1 && count($bat)>4 && count($al)>1 && count($bowl)>2)
	{
		foreach ($w as $key => $value) {
			array_push($players,$value);
		}
		foreach ($bat as $key => $value) {
			array_push($players,$value);
		}
		foreach ($bowl as $key => $value) {
			array_push($players,$value);
		}
		foreach ($al as $key => $value) {
			array_push($players,$value);
		}
		$players=json_encode($players);
		$team = new Team;
		$team->team = $players;
		$team->user = Auth::user()->nam();
		$team->save();
		$data=array('mes' => "Your team has been sucessfully added");
	$response = Response::json($data);
	return $response;
	}
	else
	{
			$data=array('mes' => "Your team has inconsistent number of players");
	$response = Response::json($data);
	return $response;
	}
}
}
else{
	echo "The match has been close or you have not logged in";
}
}

}