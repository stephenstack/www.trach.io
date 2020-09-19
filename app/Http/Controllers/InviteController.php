<?php

namespace App\Http\Controllers;

use App\Jobs\NewInviteeSignupNotificationJob;
use App\User;
use App\TenantUser;
use Illuminate\Http\Request;

class InviteController extends Controller
{
    public function index($tenant_id)
    {
        return view('invitee_signup', compact('tenant_id'));
    }

    public function requestAccess(Request $request)
    {
        $input = $request->all();

        $validator = \Validator::make($input, [
            'tenant_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if($validator->fails()){
           return back()->with(['alert' =>'Validation Error: ' . $validator->errors()->first(), 'alert_type' => 'error']);
        }
        $input['tenant_id'] = $request->tenant_id;
        $input['password'] = bcrypt($request->password);
        $input['active_status'] = 3;
        $input['plan_id'] = User::where('tenant_id',$request->tenant_id)->first()->plan_id;
        $result = TenantUser::create($input);

        if($result){
            NewInviteeSignupNotificationJob::dispatch($request->tenant_id);
            $msg = "Great! Thanks for filling out the form. An admin is reviewing your submission and your will be notified via email when approved.";
            return back()->with(['alert' => $msg, 'alert_type' => 'success']);
        } else {
            return back()->with(['error' => 'Something went wrong, contact admin!']);
        }

    }
}
