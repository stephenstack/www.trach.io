<?php

namespace App\Http\Controllers\Api;

use \Auth;
use App\Http\Controllers\ApiController;
use App\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class TenantController extends BaseController
{
    public function index()
    {
        return Tenant::all();
    }

    public function show($id)
    {
        return Tenant::with('roles', 'tenants')->where('id', $id)->get();
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

        $result = Tenant::create($input);

        return $this->sendResponse($result->toArray(), 'Tenant event recorded.');

    }

    public function update(Request $request, $id)
    {
        $Tenant = Tenant::findOrFail($id);
        $Tenant->update($request->all());

        return $Tenant;
    }

    public function destroy(Request $request, $id)
    {
        $Tenant = Tenant::findOrFail($id);
        $Tenant->delete();

        return 204;
    }
}
