<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Note;
use App\NoteComment;
use App\User;
use Illuminate\Http\Request;
use Validator;

class NoteController extends BaseController
{
    public function getAllNotes(Request $request)
    {
        // return records that have permissions greater than current user only. Permissions field in `notes` matches role_ids
        $currentUserRoleId = User::find($request->requestingUserId);
        return Note::where('permissions', '>=', $currentUserRoleId->role_id)->with('category', 'comments')->orderby('id', 'desc')->get();
    }

    public function notesWhereCategory(Request $request)
    {
        // return records that have permissions greater than current user only. Permissions field in `notes` matches role_ids
        $currentUserRoleId = User::find($request->requestingUserId);
        return Note::where('notecategory_id', $request->id)->where('permissions', '>=', $currentUserRoleId->role_id)->with('category', 'comments')->get();
    }

    public function show($id)
    {
        return Note::with('comments')->where('id', $id)->get();
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'owner_id' => 'required',
            'owner_name' => 'required',
            'title' => 'required',
            'note' => 'required',
            'notecategory_id' => 'required',
            'permissions' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $resultId = Note::create($input)->id;

        $newNote = Note::where('id', $resultId)->with('category')->get();

        return $newNote;

    }

    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);
        $note->update($request->all());

        return $note;
    }

    public function destroy(Request $request, $id)
    {

        $note = Note::with('comments')->findOrFail($id);

        if(count($note->comments) > 0){
            // cascade soft delete related comments
            NoteComment::whereIn('id', $note->comments->pluck('id'))->delete();
        }
        $note->delete();

        return 204;
    }
}
