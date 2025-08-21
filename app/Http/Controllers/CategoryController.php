<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Category $category){
        $todos =  $category->todos()->with('user')->get();
        return view('category.index',compact('todos','category'));
    }
}
