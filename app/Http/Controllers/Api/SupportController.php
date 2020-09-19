<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Jobs\SendSupportContactNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;

class SupportController extends BaseController
{

    public function sendMessage (Request $request) {

        $input = $request->all();

        $validator = Validator::make($input, [
            'subject' => 'required',
            'message' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['sendingUser'] = User::where('id', $request->tenant_user_id)->get();

        $result = SendSupportContactNotification::dispatch($input);
        return $this->sendResponse($result, 'Message sent to trach.io admin, Thank you! We will review and revert in due course.');

    }


}
