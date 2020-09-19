<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\NoteCategory;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class NoteCategoriesController extends BaseController
{
    public function index()
    {

        return NoteCategory::all();
    }

    public function show($id)
    {
        return NoteCategory::find($id);
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

        $result = NoteCategory::create($input);

        return $this->sendResponse($result->toArray(), 'NoteCategory event recorded.');

    }

    public function update(Request $request, $id)
    {
        $NoteCategory = NoteCategory::findOrFail($id);
        $NoteCategory->update($request->all());

        return $NoteCategory;
    }

    public function destroy(Request $request, $id)
    {
        $NoteCategory = NoteCategory::findOrFail($id);
        $NoteCategory->delete();

        return 204;
    }
}
