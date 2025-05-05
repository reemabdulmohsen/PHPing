<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    protected $fillable = ['title', 'due_date', 'is_completed','completed_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
