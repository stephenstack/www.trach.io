<?php

namespace App\Http\Controllers\Api;

use App\TenantUser;
use App\Http\Controllers\ApiController;
use App\Jobs\InviteeApprovalNotificationJob;
use App\Jobs\NewInviteeNotificationJob;
use Illuminate\Http\Request;
use Validator;


class TenantUsersController extends BaseController
{

    public function getThisTenantsUsers(Request $request)
    {
        return TenantUser::where('tenant_id', $request->tenant_id)->whereIn('active_status', [0, 1])->with('role')->get();
    }

    public function countPendingApprovals(Request $request)
    {
        return TenantUser::where('active_status', 3)->where('tenant_id', $request->tenant_id)->count();
    }

    public function usersPendingApproval(Request $request)
    {
        return TenantUser::where('active_status', 3)->where('tenant_id', $request->tenant_id)->get();
    }

    public function notifyApprovedUser(Request $request)
    {

        $user = TenantUser::where('id', $request->id)->get();
        $user->sender = auth()->user()->email;
        InviteeApprovalNotificationJob::dispatch($user, 'You’ve been approved to join trach.io by ' . $user->sender);

        return 204;
    }


    public function inviteUser(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'recipient_email' => 'required| email',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        NewInviteeNotificationJob::dispatch($input, 'You’ve been invited to trach.io by ' . $request->sender_email);

        return 204;
    }

    public function countTenantUsers(Request $request)
    {
        return TenantUser::where('tenant_id', $request->tenant_id)->count();
    }

    public function getTenantUsers(Request $request)
    {
        return TenantUser::where('tenant_id', $request->tenant_id)->with('role')->get();
    }

    public function setUserStatus(Request $request)
    {
        $user = TenantUser::findOrFail($request->id);
        $user->active_status = (int)$request->status;
        $user->save();
        return $user;
    }

    public function destroy(Request $request, $id)
    {
        $user = TenantUser::findOrFail($id);
        $user->delete();
        return 204;
    }
}
