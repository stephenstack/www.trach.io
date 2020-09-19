<?php

namespace App\Http\Controllers\Api;

use App\Awakesleep;
use App\Http\Controllers\ApiController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class AwakesleepsController extends BaseController
{
    public function index()
    {
        return Awakesleep::all();
    }

    public function awakeLatestStatus()
    {
        return Awakesleep::latest()->first();
    }

    public function show($id)
    {
        return Awakesleep::find($id);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'owner_id' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $awakestatus = $this->setAwakestatus($this->awakeLatestStatus());
        if($awakestatus == 1){
            // o2 was turned off so must calc diff and add to DB
            $sleep_on_time = $this->get_sleep_on_time();
            $input['sleep_time'] = $this->time_diff($sleep_on_time, Carbon::now()->toTimeString());
        }
        $input['status'] = $awakestatus;

        $result = Awakesleep::create($input);

        return $this->sendResponse($result->toArray(), 'Awake/Sleep event recorded.');

    }

    private function setAwakestatus($Awakestatus){
        if($Awakestatus->status == 1){
            $Awakestatus->status = 0;
        } else {
            $Awakestatus->status = 1;
        }
        return $Awakestatus->status;
    }

    private function get_sleep_on_time(){
        $lastAwakeOnstatus = Awakesleep::orderBy('created_at', 'DESC')->first();
        return $lastAwakeOnstatus->created_at;
    }

    private function time_diff($start_time, $end_time){
        $sst = strtotime($start_time);
        $eet =  strtotime($end_time);
        $diff = $eet-$sst;
        return ceil(round(abs($eet - $sst) / 60,0));
    }

}
