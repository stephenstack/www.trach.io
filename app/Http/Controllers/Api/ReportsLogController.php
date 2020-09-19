<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class ReportsLogController extends BaseController
{

    protected $days;
    protected $chart_name;
    protected $color;
    protected $model;

    public function setModel($model_name)
    {
        $nameSpace = '\\App\\';

        $this->model = $nameSpace . $model_name;

    }

    public function get_all_log_data(Request $request)
    {
        $this->setModel($request->model);

        $rawdata = $this->model::orderBy('created_at', 'desc')->with('user')->get();

        return $rawdata;
    }

    public function get_curr_shift_logs(Request $request)
    {
        $this->setModel($request->model);

        $latest_record = $this->model::latest('created_at')->first();

        return $this->model::where('shift_id', $latest_record->shift_id)->orderBy('created_at', 'desc')->with('user')->get();
    }

    public function get_prev_shift_logs(Request $request)
    {
        $this->setModel($request->model);

        $latest_record = $this->model::latest('created_at')->first();

        return $this->model::where('shift_id', $latest_record->shift_id - 1)->orderBy('created_at', 'desc')->with('user')->get();
    }
}
