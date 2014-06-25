<?php

class RequestsController extends BaseController {
function login()
{
$uname=Input::get("uname");
$pass=Input::get("upass");

$log=array("username"=>$uname,"password"=>$pass);
if(Auth::attempt($log)) {
	if(Auth::user()->canEdit())
	{
		return View::make('control');


	}
	else{
	$usr=Auth::user()->name;
	$data=array('mes' => "sucess",'usr'=>"$usr");
	$response = Response::json($data);
	$response->header('Content-Type', 'application/json');
	$response->header('charset', 'utf-8');
	return $response;
}

}
else{
	$data=array('mes' => "Wrong password or username");
	$response = Response::json($data);
	$response->header('Content-Type', 'application/json');
	$response->header('charset', 'utf-8');
	return $response;}
}
function getprof()
{
	$his=Auth::user()->history;
	$points=Auth::user()->points;
	$data=array('mes'=>"sucess",'his'=>"$his",'points'=>"$points");
	$response = Response::json($data);
	$response->header('Content-Type', 'application/json');
	$response->header('charset', 'utf-8');
	return $response;
}
function register()
{


	$user = new Huser;
$name =Input::get("uname");
$pass=Input::get("upass");
$phone=Input::get("ph");
$user->name=$phone;
$user->username=$name;
$user->points=50;
$user->password=Hash::make($pass);
$rules = array('username' => 'unique:husers');

$validator = Validator::make(array('username'=>"$user->username"), $rules);
if ($validator->fails()) {
   
	return Response::json(array('mes' => "name already registered"));

}
else if($user->save())
{
	return Response::json(array('mes' => "Thank you for registering"));
}
else
{
	return Response::json(array('mes' => "Unknown failure"));
}
}
function getitems()
{

		if(!Input::get('cat'))
		{
			$c="starter";
		}
		else{
			$c=Input::get('cat');
		}
		if(Auth::user()->canEdit())
		{
			$item = Item::where('category','=',"$c")->get(array('id','name','price'));
			return View::make('idel')->with('item',$item);
			

		}
		else{
		$item = Item::where('category','=',"$c")->get(array('name','price'));
			$response = Response::json($item);
	$response->header('Content-Type', 'application/json');
	$response->header('charset', 'utf-8');
	return $response;
}
}
function addcart(){

	if (Auth::check()) 
	{
	$cart=array();
	$ca=Input::get('car');
	$tab=Input::get('table');
	$ord= new Resorder;
	
	$ord->tablen=$tab;
	$ord->orders=$ca;
	$ord->save();
 	$response = Response::json(array('message'=>'Orders sent','st'=>'ok'));
	$response->header('Content-Type', 'application/json');
	$response->header('charset', 'utf-8');
	return $response;
}
}
function rdel()
	{

		$id=Input::get("id");
		$tdel=Input::get("tdel");

			if(Auth::user()->canEdit())
			{
				if($tdel=='all'){	
				$requests = Resorder::find($id);
				if($requests->delete())
				{
					return Response::json(array( 'message' => "Deleted sucessfully",'st'=>"ok"));
				}
			}
			else{

					$requests = Resorder::find($id)->toArray();
					
						$ord=$requests["orders"];
				
						$ord=json_decode($ord,true);
						if(array_key_exists($tdel, $ord))
						{
							unset($ord[$tdel]);							
							$ord=json_encode($ord);
							
							$ide=$requests["id"];
							$requ = Resorder::find($ide);
							$requ->orders=$ord;
							$requ->save();


						}
						return Response::json(array( 'message' => "Deleted sucessfully",'st'=>"ok"));
					
		
					}

			

			}
			else
			{
				return Response::json(array( 'message' => "This is not your request"));
			}
	
	
	}

	function recommend()
	{
		$i=0;
		$his=Auth::user()->history;
		$his=json_decode($his,true);
		$hc=count($his);
		if($hc<1){

				$item=Item::take((3))->orderBy(DB::raw('RAND()'))->get(array('name'))->toArray();

		}
		else{
		$item = Item::take(($hc+1))->orderBy(DB::raw('RAND()'))->get(array('name'))->toArray();
		foreach ($item as $key => $value) {
				foreach ($value as $k => $v) {
					if(array_key_exists($v, $his))
					{
						unset($item[$key]);
					}
				}
		}
		$item=array_values($item);
		if(count($item)>5)
		{

			$item=array_splice($item,4);
		}
	}
		$response = Response::json($item);
	$response->header('Content-Type', 'application/json');
	$response->header('charset', 'utf-8');
	return $response;
		



	}
function showrcart()
{
	


	
	if(Auth::user()->canEdit())
	{
		
		
		return View::make('rreq');
	}
	
	else
	{
		return Response::json(array( 'status' => "Unauthorized acess"));
	}


}
function rcart()
{
	if(Auth::user()->canEdit())
	{

		$requests = Resorder::orderBy('id', 'DESC')->get()->toArray();
	$response = Response::json($requests);
	$response->header('Content-Type', 'application/json');
	$response->header('charset', 'utf-8');
	return $response;

	}


}
function add()
	{

		if(Auth::user()->canEdit())
		{

			return View::make('itemadd');

	}
}
	function addi()
	{
		$item=new Item;
		$item->name=Input::get('name');
		$item->price=Input::get('price');
		$item->category=Input::get('cat');
		$item->save();
		return Response::json(array('message'=>'Added','st'=>'ok'));
	}
	function delitem()
	{
		if(Auth::user()->canEdit())
		{
		$id=Input::get('id');
		$item=Item::find($id);
		if($item->delete())
			{return Response::json(array('message'=>'Deleted','st'=>'ok'));}

	}

}
function gettab()
	{



		$tab=Input::get('table');
		
		$requests = Resorder::onlyTrashed()->where('tablen','=',"$tab")->get(array('orders'));
		$left=Resorder::where('tablen','=',"$tab")->get(array('orders'));
		$rc=count($requests);
		$lc=count($left);
		
		if(($lc>0) || ($rc<1))
		{
			
			$response = Response::json(array('st'=>'err'));
		
	}
	else{

		$rules = array('table' => 'unique:bill');

$validator = Validator::make(array('table'=>"$tab"), $rules);
if($validator->fails())
{
	$response = Response::json(array('st'=>'err'));
}
else{
		$bil=new bill();
		$bil->table=$tab;
		$bil->save();
		$response = Response::json($requests);
	}
}
		
	$response->header('Content-Type', 'application/json');
	$response->header('charset', 'utf-8');
	return $response;

	}


function rat()
{
	$rati=Input::get('rating');
	$his=Input::get('to');
	$points=0;
	$rati=json_decode($rati);
	if(!($rati=="")){

	foreach ($rati as $key => $value) {
	$rat = Item::where('name','=',$key)->get(array('id','rating'));
	foreach($rat as $k=>$v){
		
		$ite = Item::find($v["id"]);
		
		$ite->increment('rating',$value);
		$ite->increment('no',1);
		$ite->save();
	}

	}
}


	
	$history=Auth::user()->history;
	$id=Auth::user()->id;
	$usr=Huser::find($id);
	if($history=="")
	{
		$points=count($his)*20;
		$usr->increment('points',$points);
		$usr->history=$his;
		
	}
	else{

		$history=json_decode($history,true);
		$his=json_decode($his);
		
		foreach($his as $k=>$v)
		{

			if(!(array_key_exists($k, $history)))
			{
				$points+=20;

				$history[$k]=$v;
			}
			else{

				$history[$k]+=$v;
			}

		}
		$history=json_encode($history);
		$usr->history=$history;


	}
	if($points!=0)
		{

			$usr->increment('points',$points);
		}
		
		$usr->save();
		Auth::logout();
	return Response::json(array('mes' => "Thank you.You have been logged out"));
}
function cbill()
{

	$bill=Bill::all()->toArray();
	$response = Response::json($bill);
	$response->header('Content-Type', 'application/json');
	$response->header('charset', 'utf-8');
	return $response;
}
function tabdel()
	{

		if(Auth::user()->canEdit())
		{
			$tab=Input::get('tabl');
		$r=Bill::where('table','=',"$tab")->delete();
		$res = Resorder::withTrashed()->where('tablen','=',"$tab")->forceDelete();
		
		
		return Response::json(array('message'=>'Deleted','st'=>'ok'));
	}
	}
	function genbill()
	{

		$tab=Input::get('tabl');
		$ord=array();
		$tot=0;
		

		$res = Resorder::withTrashed()->where('tablen','=',"$tab")->get(array('orders'))->toArray();
	
		foreach ($res as $key => $value) {

			foreach ($value as $k => $v) {
				$v=json_decode($v);
				foreach ($v as $ke => $ve){
				if(array_key_exists($ke, $ord))
				{

					$ord[$ke]["value"]+=$ve;
					$ord[$ke]["amount"]+=($ve*$ord[$ke]["price"]);
					$tot+=($ve*$ord[$ke]["price"]);
				}
				else{
					$price=Item::take(1)->where('name','=',"$ke")->get(array('price'))->toArray();
					foreach ($price as $pr => $pric) {
						foreach ($pric as $rp => $tprice) {
							
							$ord[$ke]=array("value"=>$ve,"price"=>$tprice,"amount"=>($tprice*$ve));
							$tot+=($tprice*$ve);
						}
						
					}
					

				}
			}
		}

			
		}

		$savbill=json_encode($ord);
		$bil=new billhistory;
		$bil->orders=$savbill;
		$bil->save();
		return View::make('genbill')->with('orders',$ord)->with('table',$tab)->with('total',$tot);
	}

	
	function bill()
	{

		if(Auth::user()->canEdit())
		{

			return View::make('bill');

	}
	}
	function isea()
{
	$na=Input::get('name');
	$item = Item::take(4)->where('name','LIKE',"%$na%")->get(array('name','price'));
$response = Response::json($item);
	$response->header('Content-Type', 'application/json');
	$response->header('charset', 'utf-8');
	return $response;
}
}