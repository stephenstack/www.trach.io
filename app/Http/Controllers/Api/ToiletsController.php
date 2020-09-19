<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Toilet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class ToiletsController extends BaseController
{
    public function index()
    {
        return Toilet::all();
    }


    public function latest()
    {
        return Toilet::latest()->first();
    }


    public function show($id)
    {
        return Toilet::find($id);
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

        $result = Toilet::create($input);

        return $this->sendResponse($result->toArray(), 'Toilet event recorded.');

    }

}
