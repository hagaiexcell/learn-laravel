<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HaloController extends Controller
{
    public function index(){
        $data = ['nama'=>'excell'];
        return view('welcome', $data);
    }
}
