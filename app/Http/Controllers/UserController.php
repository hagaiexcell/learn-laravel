<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(User $user){
        $data = $user->todos()->with('category','user')->get();
        // dd($data);
        return view('user.index',compact('data'));
    }
}
