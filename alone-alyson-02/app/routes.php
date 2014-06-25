<?php




Route::get('login/fb', function() {
    $facebook = new Facebook(Config::get('facebook'));    
    $params = array(
        'redirect_uri' => url('/login/fb/callback'),
        'scope' => 'email',
    );
    
    return Redirect::to($facebook->getLoginUrl($params));
});
Route::get('adlogin', function(){
    return View::make('adlogin');
});
Route::post('addph', function() {

$pho=Input::get('phno');
$rules = array('phno' => 'numeric');

$validator = Validator::make(array('phno'=>"$pho"), $rules);
if ($validator->fails()) {

return Redirect::to('/')->with('message', 'Enter a valid phone number');


}
else{


    $usr=Auth::user();
    $usr->phno=$pho;
    $usr->save();
    return Redirect::to('/')->with('message', 'Saved your phone number');
}});
Route::post('adlogin', function(){


  $uname=Input::get("name");
$pass=Input::get("pass");

$log=array("email"=>$uname,"password"=>$pass);
if(Auth::attempt($log)) {
  if(Auth::user()->canEdit())
  {
    return View::make('control');


  }
  else{
    return Redirect::to('logout');
  }
}
});
Route::post('control', 'DetailsController@control');

Route::get('login/fb/callback', function() {
    $code = Input::get('code');
   
    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');
 
    $facebook = new Facebook(Config::get('facebook'));
    $uid = $facebook->getUser();


    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');
 
    $me = $facebook->api('/me');
 
  $profile = Profile::whereUid($uid)->first();
    if (empty($profile)) {
 
      $user = new User;
      $user->name = $me['first_name'].' '.$me['last_name'];
      $user->email = $me['email'];
      $user->photo = 'https://graph.facebook.com/'.$me['username'].'/picture?type=large';
 
        $user->save();
 
        $profile = new Profile();
        $profile->uid = $uid;
      $profile->username = $me['username'];
      $profile = $user->profiles()->save($profile);
    }
 
    $profile->access_token = $facebook->getAccessToken();
    $profile->save();
 
    $user = $profile->user;
  
      
    Auth::login($user);
   

  return Redirect::to('/')->with('message', 'Logged in with Facebook');
});
Route::post('subans', function(){

$i=Input::except('_token');

$usrans=Auth::user()->ans;
if($usrans=="")
{

  $i=json_encode($i);
  $usr=Auth::user();
  $usr->ans=$i;
  $usr->save();
  return Redirect::to('/')->with('message', 'Saved your answers');
}
else{

  $usrans=json_decode($usrans,true);
  foreach ($i as $key => $value) {
    if($value!="")
    {
  $usrans[$key]=$value;
    }
  }
$usr=Auth::user();
$usr->ans=json_encode($usrans);
$usr->save();
return Redirect::to('/')->with('message', 'Updated your answers');
}

});
Route::get('scorepl', 'DetailsController@scorepl');
Route::get('sellist','DetailsController@sellist');
Route::post('scorepl','DetailsController@scorep');
Route::get('fplfame','DetailsController@fplfame');
Route::get('scoreteam','DetailsController@scoreteam');
Route::get('prefame','DetailsController@prefame');
Route::get('userdetails','DetailsController@userdetails');
Route::get('/', function()
{
    $data = array();
  
    if (Auth::check()) {
    
      $sta=Detail::first();
    if(!$sta["status"] || Auth::user()->canEdit())
    {
      $data = Auth::user();
        $deta= Detail::all();
         foreach($deta as $details)
    {
      $gname=$details['gname'];
      $list=json_decode($details['list']);
    }
    return View::make('user', array('data'=>$data))->with('list',$list)->with('gname',$gname);
  }
    else
    {
         $data = Auth::user();
         
      return View::make('user', array('data'=>$data))->with('list',"");

}
}



        
    
    else{
  return View::make('user', array('data'=>$data));
  }
  
});
Route::get('fpl', function(){if(Auth::user()->canEdit())
  return View::make('fpl');});
Route::post('fpl', 'DetailsController@ifpl');
 Route::get('close', 'DetailsController@close');
Route::get('logout', function() {
    Auth::logout();
    return Redirect::to('/');
});
Route::get('check', 'DetailsController@check');
Route::get('delplayer', 'DetailsController@delplayer');
Route::post('addteam', 'DetailsController@addteam');