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
        // 要求登录
       // $this->middleware('auth');
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

     public function baidumap()
    {
        // $apistring = "http://api.map.baidu.com/location/ip?ak=";
        // // 填写你的apikey
        // $apikey = "OjDVDaIyfqZGehQG2moe8nb9xvgoBWPp";
        // // $coor = ""; //不填默认使用百度墨卡托坐标
        // $coor = "&coor=bd09ll";//百度经纬度坐标
        // // $coor = "&coor=gcj02";//国测局坐标
        // $jsonurl= $apistring . $apikey .  $coor;

        // $json = json_decode(file_get_contents($jsonurl));
        // foreach($json->address as $key){
        //       $address = $key->address;  
        // }
        

        // var_dump($json);
        // var_dump($address);
        return view('map.baidu');
        
    }
    public function road() {
        return view('map.road');
    }


}
