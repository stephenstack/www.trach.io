<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\UserAction;
use Illuminate\Http\Request;

class UserActionsController extends BaseController
{

    public function index()
    {
        return UserAction::all();
    }

    public function latest($count)
    {
        return UserAction::latest()->take($count)->get();
    }

    public function show($id)
    {
        return UserAction::where('user_id', $id)->get();
    }

}
