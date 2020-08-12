<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
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

        // var_dump($projects[0]->title); exit;
        // foreach ($data['projects'] as $i => $project) {
        //     var_dump($project->keywords);

        // } exit;


        return view('/home', $data);
    }
}
