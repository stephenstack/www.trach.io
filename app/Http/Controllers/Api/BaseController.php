<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{

    public function __construct()
	{
		// $this->middleware('auth:api');

	}
	
}
