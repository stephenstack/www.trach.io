<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\NoteComment;
use Illuminate\Http\Request;
use Validator;

class NoteCommentController extends BaseController
{

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'owner_id' => 'required',
            'owner_name' => 'required',
            'comment' => 'required',
            'note_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $result = NoteComment::create($input);

        return $result;

    }

}
