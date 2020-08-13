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
        // $this->middleware('auth');
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
        $data['projects'] = DB::table('projects')
                                    ->where('degree', '=', 'master')
                                    ->orderBy('projects.id', 'desc')
                                    ->get()->toArray();

        return view('projects.master', $data);
    }

    public function bachelor() {
        $data['projects'] = DB::table('projects')
                                    ->orderBy('projects.id', 'desc')
                                    ->get()->toArray();

        return view('projects.bachelor', $data);
    }

    public function view($id) {

        $data['project'] = DB::table('projects')
                            ->where([
                                ['projects.id','=', $id]
                            ])
                            ->first();

        return view('projects.view', $data);


    }
}
