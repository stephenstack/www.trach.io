<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Med;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class MedsController extends BaseController
{
    public function index()
    {
        return Med::all();
    }


    public function latest()
    {
        return Med::latest()->first();
    }

    public function show($id)
    {
        return Med::find($id);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'owner_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $result = Med::create($input);

        return $this->sendResponse($result->toArray(), 'Med event recorded.');

    }

}
