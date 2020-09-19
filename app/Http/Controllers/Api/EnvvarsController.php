<?php

namespace App\Http\Controllers\Api;

use App\Envvar;
use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class EnvvarsController extends BaseController
{
    public function index()
    {
        return Envvar::all();
    }

    public function latest()
    {
        return Envvar::latest()->first();
    }

    public function show($id)
    {
        return Envvar::find($id);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'owner_id' => 'required|numeric',
            'humidity' => 'required|numeric',
            'temperature' => 'required|numeric'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $result = Envvar::create($input);

        return $this->sendResponse($result->toArray(), 'Environment variables recorded.');

    }

}
