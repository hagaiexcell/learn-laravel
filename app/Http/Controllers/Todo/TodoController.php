<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(){
        $max_data = 5;
        if(request('search')){
            $data = Todo::with('user','category')->where('task', 'like', '%' . request('search') . '%')->paginate($max_data)->withQueryString();   

        }else{
            $data = Todo::with('user','category')->orderBy('task','asc')->paginate($max_data);
        }

        $categories = Category::all();
        return view('todo.index',compact('data','categories'));
    }

    public function store(Request $request){
       $request->validate([
        'task'=>'required|min:3',
        'description'=>'required|min:10'
       ],[
        'task.required'=>'required',
        'task.min'=>'Minimal Title adalah 3 character'
       ]);

       $data = [
        'task'=>$request->input('task'),
        'user_id'=>Auth::user()->id,
        'category_id'=>$request->input('category'),
        'description'=>$request->input('description')
       ];

       Todo::create($data);

       return redirect()->route('todo')->with('success','Berhasil Simpan Data!');
    }

    public function detail(string $id){
        $detail = Todo::where('id',$id)->first();
        // dd($detail);
        return view('todo.detail',compact('detail'));
    }

    public function update(Request $request, string $id){
        $request->validate([
        'task'=>'required|min:3',
        'description'=>'required|min:10'
        ],[
        'task.required'=>'required',
        'task.min'=>'Minimal isian adalah 3 character'
        ]);

        $data = [
        'task'=>$request->input('task'),
        'is_done'=>$request->input('is_done'),
        'description'=>$request->input('description')
        ];

        Todo::where('id',$id)->update($data);
        return redirect()->route('todo')->with('success','berhasil update data');
    }

    public function destroy(Request $request, string $id){
        Todo::where('id',$id)->delete();
        return redirect()->route('todo')->with('success', 'Berhasil menghapus data');
    }
}
