<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use View;

class SpaController extends Controller {


    public function index()
    {
        return view('spa');
	}
}