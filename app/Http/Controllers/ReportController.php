<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Sale;
use App\Models\Stock;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {

        $startDate = $request->input('begin') ?? date("Y-m-01");
        $endDate = $request->input('end') ?? date("Y-m-d");

        $saleDatas = Sale::with('total')->whereBetween('date', [$startDate, $endDate])->get();
        $stockDatas = Stock::with('product')->whereBetween('created_at', [$startDate, $endDate])->get();
        return view('report.index', ["saleDatas" => $saleDatas, "stockDatas" => $stockDatas, "startDate" => $startDate, "endDate" => $endDate]);
    }

}
