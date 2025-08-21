@extends('layouts.app')

@section('content')   
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-bold bg-red-500">
                            {!! $detail->is_done == '1'?'<del>':'' !!}
                            {{ $detail->task }}
                            {!! $detail->is_done == '1'?'</del>':'' !!}
                        </h1>
                        @if($detail->user == Auth::user() || Auth::user()->role === 'admin')
                            <div class="flex gap-2">
                                <form action="{{ route('todo.delete',['id'=>$detail->id]) }}" method="POST" onsubmit="return confirm('Yakin Menghapus Data Ini?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">✕</button>
                                </form>
                                <div>
                                    <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                        data-bs-target="collapse-{{ $detail->id }}" aria-expanded="false">✎</button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <li class="list-group-item list-update hidden collapse-{{ $detail->id }}">
                        <form action="{{ route('todo.update',['id'=>$detail->id]) }}" method="POST">
                            @csrf
                            @method('put')
                            <div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="task"
                                        value="{{ $detail->task }}">
                                    <button class="btn btn-outline-primary" type="submit">Update</button>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="radio px-2">
                                    <label>
                                        <input type="radio" value="1" name="is_done" {{ $detail->is_done == '1' ? 'checked':'' }}> Selesai
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="0" name="is_done" {{ $detail->is_done == '0' ? 'checked':'' }}> Belum
                                    </label>
                                </div>
                            </div>
                            <textarea name="description" placeholder="description..." cols="10" rows="10" class="form-control w-full h-20 hidden collapse-{{ $detail->id }}">{{$detail->description }}
                            </textarea>
                        </form>
                    </li>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div>
                        {{ $detail->description }}
                    </div>
                    
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
                let targetElements = document.getElementsByClassName(targetId);

                // Toggle class Tailwind hidden/block
                for(let i = 0; i<targetElements.length;i++){
                    if (targetElements[i].classList.contains("hidden")) {
                        targetElements[i].classList.remove("hidden");
                        targetElements[i].classList.add("block");
                    } else {
                        targetElements[i].classList.remove("block");
                        targetElements[i].classList.add("hidden");
                    }
                }
            });
        });
    });
</script>