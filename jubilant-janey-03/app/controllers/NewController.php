<?php

class NewController extends BaseController {

	function geti()
	{

			$response = Response::json(array('message'=>'hello'));
	$response->header('Content-Type', 'application/json');
	$response->header('charset', 'utf-8');
	return $response;



	}
}