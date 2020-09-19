<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Neb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class NebsController extends BaseController
{
    public function index()
    {
        return Neb::all();
    }

    public function latest()
    {
        return Neb::latest()->first();
    }

    public function show($id)
    {
        return Neb::find($id);
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
        $result = Neb::create($input);

        return $this->sendResponse($result->toArray(), 'Neb event recorded.');
    }

}
