<?php

namespace App\Http\Controllers\Api;

use \Auth;
use App\Http\Controllers\ApiController;
use App\Notifications\NewTenantUserAdded;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Route;
use Validator;

class UsersController extends BaseController
{
    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::with('role')->where('id', $id)->get();
    }

    public function store(Request $request)
    {

        if($this->checkPlanThreshold()){
            return response()->json([
                    'errors' => [
                        'exceed_plan_error' => ['You have exceeded your plans user count. You will need to upgrade your plan to add more users.']
                    ]
            ], 422);
        }

        $input = $request->all();

        // get subscription data from existing useer to mimic on new record, inc trial info
        $subdata = User::select('plan_id', 'trial_ends_at')->where('tenant_id', $request->tenant_id)->first();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required | unique:users,email| email',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['trial_ends_at'] = $subdata->trial_ends_at;
        $input['plan_id'] = $subdata->plan_id;
        $input['password'] = bcrypt($input['password']);
        $input['tenant_user_id'] = $input['tenant_user_id'];

        $newuser = User::create($input);

        $users = User::all();

        Notification::send($users, new NewTenantUserAdded($newuser));

        return $newuser;

    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['password'] = bcrypt($input['password']);
        $User = User::findOrFail($id);
        $User->update($input);

        return $User;
    }

    public function destroy(Request $request, $id)
    {
        $User = User::findOrFail($id);
        $User->delete();

        return 204;
    }

    private function checkPlanThreshold()
    {
        $user = auth()->user();
        $tenant_id = $user->tenant_id;
        //tenant user plan details
        $plan_details = auth()->user()->plan;
        $current_tenant_user_count = $this->getCurrentTenantUserCount($tenant_id);

        if($current_tenant_user_count >= auth()->user()->plan->user_count ){
            return true;
        }
    }

    private function getCurrentTenantUserCount($tenant_id)
    {
        $request = Request::create('/api/count-tenant-users', 'POST', array('tenant_id' => $tenant_id));
        $response = Route::dispatch($request);
        return $response->getContent();
    }

}
