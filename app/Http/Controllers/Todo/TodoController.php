<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(){
        $max_data = 5;
        if(request('search')){
            $data = Todo::where('task','like','%'.request('search').'%')->paginate($max_data)->withQueryString();
        }else{
            $data = Todo::orderBy('task','asc')->paginate($max_data);
        }
        return view('todo.index',compact('data'));
    }

    public function store(Request $request){
       $request->validate([
        'task'=>'required|min:3'
       ],[
        'task.required'=>'required',
        'task.min'=>'Minimal isian adalah 3 character'
       ]);

       $data = [
        'task'=>$request->input('task'),
        'user_id'=>Auth::user()->id
       ];

       Todo::create($data);

       return redirect()->route('todo')->with('success','Berhasil Simpan Data!');
    }

    public function update(Request $request, string $id){
        $request->validate([
        'task'=>'required|min:3'
        ],[
        'task.required'=>'required',
        'task.min'=>'Minimal isian adalah 3 character'
        ]);

        $data = [
        'task'=>$request->input('task'),
        'is_done'=>$request->input('is_done')
        ];

        Todo::where('id',$id)->update($data);
        return redirect()->route('todo')->with('success','berhasil update data');
    }

    public function destroy(Request $request, string $id){
        Todo::where('id',$id)->delete();
        return redirect()->route('todo')->with('success', 'Berhasil menghapus data');
    }
}
