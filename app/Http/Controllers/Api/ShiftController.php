<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShiftController extends BaseController
{

    public function index()
    {
        return Shift::with('user')->get();
    }

    public function latest($count)
    {
        return Shift::latest()->take($count)->get();
    }

    public function show($id)
    {
        return Shift::where('user_id', $id)->with('user')->get();
    }

    public function latestShift()
    {
        $shift = Shift::latest()->with('user')->get();
        return $shift[0];
    }

    public function shiftSignIn(Request $request)
    {

        $dt = Carbon::now();
        $shift = new Shift;
        $shift->user_id = auth()->user()->id;
        $shift->time_in = Carbon::now()->toDateTimeString();
        $shift->expected_time_out = $dt->next($request->expected_time_out_hours.':'.$request->expected_time_out_minutes);
        $shift->status = 1;
        $shift->save();

        return $this->sendResponse($shift->toArray(), 'You have signed in. Thanks!');
    }

    public function shiftSignOut(Request $request)
    {
        $last_shift = Shift::where('id', $request->current_shift_id)->get();
        if($last_shift->count() === 0){ // do this incase shift ID is missing and need to pull direct
            $last_shift = Shift::where('status', 1)->latest()->get();
        }
        $now = Carbon::now()->toDateTimeString();
        $diff1 = strtotime($now) - strtotime($last_shift[0]->time_in);
        $diff = gmdate("H:i", $diff1);

        $shift = new Shift;
        $shift->user_id = auth()->user()->id;
        $shift->actual_time_out = $now; // times are recorded in UTC and updated to tentant timezone in UI
        $shift->duration = $diff;
        $shift->status = 0;
        $shift->save();

        return $this->sendResponse($shift->toArray(), 'You have signed out. Thanks for all your help today!!');
    }


}
