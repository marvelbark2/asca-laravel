<?php

namespace App\Http\Controllers;

use App\Cities;
use PDF;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index(Request $request)
    {
        $cities = Cities::all();
        return view('cities.map', compact('cities'));
    }
    public function create()
    {
        return view('cities.acc');
    }
    public function store(Request $request)
    {
        $city = new Cities;
        $arr = $request->all();
        $city->create($arr);

        return $arr;
    }
    public function pdf()
    {
        $pdf = PDF::loadView('report', [
            'title' => 'report test'
          ]);
        return $pdf->stream('repors.pdf');
    }
}
