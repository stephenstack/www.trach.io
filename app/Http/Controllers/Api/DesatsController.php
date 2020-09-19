<?php

namespace App\Http\Controllers\Api;

use App\Desat;
use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class DesatsController extends BaseController
{
    public function index()
    {
        return Desat::all();
    }

    public function latest()
    {
        return Desat::latest()->first();
    }

    public function show($id)
    {
        return Desat::find($id);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'owner_id' => 'required|numeric',
            'desat_value' => 'required|numeric'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $result = Desat::create($input);

        return $this->sendResponse($result->toArray(), 'Desat event recorded.');

    }

}
