<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Suction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class SuctionsController extends BaseController
{
    public function index()
    {
        return Suction::all();
    }

    public function latest()
    {
        return Suction::latest()->first();
    }

    public function show($id)
    {
        return Suction::find($id);
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

        $result = Suction::create($input);

        return $this->sendResponse($result->toArray(), 'Suction event recorded.');

    }

}
