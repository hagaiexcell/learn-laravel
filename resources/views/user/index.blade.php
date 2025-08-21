@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-4">
            @if($data->count() > 0)
                <div class="card-body">
                    <h1 class="text-xl font-bold">Todo By : {{ $data[0]->user->name }}</h1> 
                </div>
            @endif
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