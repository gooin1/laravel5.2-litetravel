<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
        // Home 视图传入Post模型的数据
        return view('home')->withPosts(\App\Post::all());
    }

    // 热度图
    public function hotmap()
    {
        // Home 视图传入Post模型的数据
        return view('map.hotmap');
    }

    public function model() {
        $data = \App\Post::get();
        dd($data);
    }
}
