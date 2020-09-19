<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendActionSuggestionEmail;
use App\Jobs\SendNewNoteNotificationEmail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class NotificationController extends Controller
{

    public function sendActionSuggestion(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'subject' => 'required',
            'message' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['sendingUser'] = User::where('id', $request->tenant_user_id)->get();

        $result = SendActionSuggestionEmail::dispatch($input);
        return $this->sendResponse($result, 'Suggestion sent to trach.io admin, Thank you! We will review and revert in due course.');

    }

    public function sendNewNoteNotification(Request $request)
    {
        $input = $request->all();

        $recipients = User::where('role_id', 2)->where('tenant_id', $input['tenant_id'])->get();
        SendNewNoteNotificationEmail::dispatch($recipients, $input);
        $recipients = User::where('id', $input['user_id'])->get();
        SendNewNoteNotificationEmail::dispatch($recipients, $input);

    }

}