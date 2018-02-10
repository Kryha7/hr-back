<?php

namespace App\Http\Controllers;

use App\Pool;
use App\Raffle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $raffles = Raffle::where('end', 0)->get();
        $pools = Pool::where('end',0)->get();
//        session()->flash('status', 'kurwachuj');
//        session()->forget('status');
        return view('home', compact('pools', 'raffles'));
    }

    public function tickets()
    {
        return view('tickets');
    }
}
