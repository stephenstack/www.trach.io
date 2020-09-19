<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\O2;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class O2sController extends BaseController
{
    public function index()
    {
        return O2::all();
    }

    public function latest()
    {
        return O2::latest()->first();
    }

    public function show($id)
    {
        return O2::find($id);
    }

    public function o2LatestStatus()
    {
        $o2status = O2::latest()->first();
        if(!$o2status) { // we have to check if any records are return and default to 0 if not.
            $o2status = collect();
            $o2status->status = 0;
        }
        return $o2status;
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'owner_id' => 'required',
            'status' => 'required',
            'value' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $o2status = $this->setO2status($this->o2LatestStatus());
        if($o2status == 0){
            // o2 was turned off so must calc diff and add to DB
            $treatment_on_time = $this->get_treatment_on_time();
            $input['treatment_time'] = $this->time_diff($treatment_on_time, Carbon::now()->toTimeString());
        }
        $input['status'] = $o2status;

        $result = O2::create($input);

        return $this->sendResponse($result->toArray(), 'O2 event recorded.');

    }

    private function setO2status($o2status){
        if($o2status->status == 0 ){
            $o2status->status = 1;
        } else {
            $o2status->status = 0;
        }
        return $o2status->status;
    }

    private function get_treatment_on_time(){
        $lastO2Onstatus = O2::orderBy('created_at', 'DESC')->first();
        return $lastO2Onstatus->created_at;
    }

    private function time_diff($start_time, $end_time){
        $sst = strtotime($start_time);
        $eet =  strtotime($end_time);
        $diff = $eet-$sst;
        return ceil(round(abs($eet - $sst) / 60,0));
    }

}
