<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory;

    protected $table = "todos";
    protected $fillable = ["task", "is_done", "user_id", "category_id","description"];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
