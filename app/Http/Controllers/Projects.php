<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Projects extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['projects'] = DB::table('projects')->get()->toArray();
        return view('/home', $data);
    }


    public function master() {

        return view('/master', $data);
    }

    public function bachelor() {

        return view('/bachelor', $data);
    }

}
