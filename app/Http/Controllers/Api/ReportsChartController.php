<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsChartController extends BaseController
{

    protected $days;
    protected $chart_name;
    protected $color;
    protected $model;

    public function create_graph(Request $request)
    {
        $nameSpace = '\\App\\';

        $this->days = $request->days;
        $this->chart_name = $request->chart_name;
        $this->color = $request->color;
        $this->model = $nameSpace . $request->model;

        return $this->getData();
    }


    public function getData()
    {

        $rawdata = $this->model::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))->groupBy("date")->orderBy('created_at', 'desc')->where('created_at', '>=', DB::raw('DATE(NOW()) - INTERVAL '.$this->days.' DAY'))->get();
// ddd($rawdata);
        $data = collect();
        $data->put('labels', $rawdata->pluck('date'));
        $data->put('title', $this->chart_name . ' Graph - Last ' . $this->days . ' days');
        $data->put('color', $this->color);
        $data->put('backgroundcolor', "rgb(238, 238, 238)");
        $data->put('data', $rawdata->pluck('count'));

        return $data;
    }
}
