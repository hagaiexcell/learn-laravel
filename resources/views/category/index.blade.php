@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                <h1 class="text-xl font-bold">Category : {{ $category->name }}</h1> 
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <!-- 03. Searching -->
                <form id="todo-form" action="{{ route('todo') }}" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                            placeholder="masukkan kata kunci">
                        <button class="btn btn-secondary" type="submit">
                            Cari
                        </button>
                    </div>
                </form>
                
                <ul class="list-group mb-4" id="todo-list">
                    <!-- 04. Display Data -->
                    @foreach($todos as $todo)
                        <x-card :todo="$todo"/>   
                    @endforeach
                </ul>
           
            </div>
        </div>
    </div>
</div>
@endsection