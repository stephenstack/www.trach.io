<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\ShiftTask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class ShiftTasksController extends BaseController
{

    public function latestShiftTask(Request $request)
    {
        $result = ShiftTask::latest()->where('shift_id', $request->shift_id)->get();
        return $result;
    }

    public function SetShiftTasks(Request $request)
    {
        $input = $request->all();
        $result = ShiftTask::updateOrCreate(['shift_id' => $request->shift_id], $input);
        return $this->sendResponse($result->toArray(), 'Shift Task recorded.');
    }

}
