<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = ['content', 'deadline', 'user_id'];

    public function users(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
