@props(['todo'])

<li class="list-group-item d-flex justify-content-between align-items-center">
    <div class="flex flex-col gap-1 ">
        <a href="/user/{{$todo->user->username}}" class="text-gray-500 text-xs hover:underline">
            {{ $todo->user->name }}
        </a>
        <div class="bg-slate-200 cursor-pointer p-1 rounded-lg text-xs w-fit">
           <a href="{{ route('category',['category'=>$todo->category->slug]) }}">
            {{ $todo->category->name }}
           </a>
        </div>
        <div class="task-text">
            <a href="{{ route('todo.detail',$todo->id) }}">
                {!! $todo->is_done == '1'?'<del>':'' !!}
                {{ $todo->task }}
                {!! $todo->is_done == '1'?'</del>':'' !!}
            </a>
        </div>
    </div>
    
    <input type="text" class="form-control edit-input" style="display: none;"
        value="{{ $todo->task }}">
    @if($todo->user == Auth::user() || Auth::user()->role === 'admin')
        <div class="btn-group">
            <form action="{{ route('todo.delete',['id'=>$todo->id]) }}" method="POST" onsubmit="return confirm('Yakin Menghapus Data Ini?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm delete-btn">✕</button>
            </form>
            <div>
                <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                    data-bs-target="collapse-{{ $todo->id }}" aria-expanded="false">✎</button>
            </div>
        </div>
    @endif
</li>
<!-- 05. Update Data -->
<li class="list-group-item list-update hidden" id="collapse-{{ $todo->id }}">
    <form action="{{ route('todo.update',['id'=>$todo->id]) }}" method="POST">
        @csrf
        @method('put')
        <div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="task"
                    value="{{ $todo->task }}">
                <button class="btn btn-outline-primary" type="submit">Update</button>
            </div>
        </div>
        <div class="d-flex">
            <div class="radio px-2">
                <label>
                    <input type="radio" value="1" name="is_done" {{ $todo->is_done == '1' ? 'checked':'' }}> Selesai
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" value="0" name="is_done" {{ $todo->is_done == '0' ? 'checked':'' }}> Belum
                </label>
            </div>
        </div>
    </form>
</li>
 