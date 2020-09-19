<?php

namespace App\Http\Controllers\Api;

use App\Eventaction;
use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class EventActionsController extends BaseController
{

    public function index()
    {
        return Eventaction::all();
    }

    public function indexEnabled()
    {
        return Eventaction::where('status', 1)->get();
    }

    public function indexDisabled()
    {
        return Eventaction::where('status', 0)->get();
    }

    public function showLatest(Request $request)
    {
        return Eventaction::orderBy('id', 'desc')->take(1)->get();
    }

    public function store_thresholds(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            $this->threshold_save($key, $value);
        }

        return 204;
    }

    private function threshold_save($card_name, $value)
    {
        $eventaction = Eventaction::where('card_name', '=', $card_name)->firstOrFail();
        $eventaction->thresholds = $value;
        $eventaction->save();
        return $eventaction;
    }

    public function store(Request $request)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'description' => 'required',
            'owner_id' => 'required',
            'owner_name' => 'required',
            'shift_start_time' => 'required',
            'shift_end_time' => 'required|not_in:'.$request->shift_start_time,
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $result = Eventaction::create($input);

        return $result;
    }

    public function show($id)
    {
        return Eventaction::where('id', $id)->get();
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'status' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $result = Eventaction::findOrFail($id);
        $result->update($input);

        return $result;
    }


    public function destroy(Request $request, $id)
    {
        $result = Eventaction::findOrFail($id);
        $result->delete();

        return 204;
    }
}
