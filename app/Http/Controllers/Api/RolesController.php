<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Role;
use Illuminate\Http\Request;

class RolesController extends BaseController
{

    public function index()
    {
        return Role::all();
    }

    public function nonGlobalRoles()
    {
        return Role::where('id', '!=' , 1)->get();
    }

}
