<?php

namespace App\Http\Controllers\Api;

use App\Cough;
use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class CoughsController extends BaseController
{
    public function index()
    {
        return Cough::all();
    }

    public function latest()
    {
        return Cough::latest()->first();
    }

    public function show($id)
    {
        return Cough::find($id);
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

        $result = Cough::create($input);

        return $this->sendResponse($result->toArray(), 'Cough Assist event recorded.');

    }

}
