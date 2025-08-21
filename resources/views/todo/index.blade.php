@extends('layouts.app')

@section('content')
    <!-- 01. Content-->
    <h1 class="text-center mb-4">To Do List</h1>
    @if(Auth::user()->isAdmin())
        <div class="text-center mb-4 text-lg font-bold">Anda Adalah Admin</div>
    @endif
   
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <!-- 02. Form input data -->
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form id="todo-form" action="{{ route('todo.post') }}" method="post">
                    @csrf
                    <div class="input-group grid grid-cols-8 gap-3 mb-3">
                        <div class="col-span-5">
                            <input type="text" class="form-control " name="task" id="todo-input"
                                placeholder="Tambah task baru" required value="{{ old('task') }}">
                        </div>
                        <div class="col-span-2">
                            <select class="form-control" name="category" id="">
                                @foreach($categories as $cat)
                                    <option def value="{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-1">
                            <button class="btn btn-primary w-full" type="submit">
                                Simpan
                            </button>
                        </div>
                    </div>
                    <div class="h-32">
                        <textarea name="description" id="description" placeholder="description..." cols="10" rows="10" class="form-control w-full h-full"></textarea>
                    </div>
                </form>
            </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="flex gap-2">
                        @foreach ($categories as $cat)
                            <div class="bg-slate-200 cursor-pointer p-1 rounded-lg text-sm">
                                <a href="{{ route('category', ['category' => $cat->slug]) }}">
                                    {{ $cat->name }}
                                </a>
                            </div>
                        @endforeach
                    </div>
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
                        @foreach($data as $todo)
                            <x-card :todo="$todo"/>
                        @endforeach
                    </ul>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function () {
                let targetId = this.getAttribute("data-bs-target");
                let targetElement = document.getElementById(targetId);

                console.log(targetId,targetElement,'o');

                // Toggle class Tailwind hidden/block
                if (targetElement.classList.contains("hidden")) {
                    targetElement.classList.remove("hidden");
                    targetElement.classList.add("block");
                } else {
                    targetElement.classList.remove("block");
                    targetElement.classList.add("hidden");
                }
            });
        });
    });
</script>