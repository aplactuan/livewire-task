<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'description',
      'status',
      'priority'
    ];

    public $dates = [
        'completed_at'
    ];

    public function scopeCompleted($query)
    {
        return $query->whereNotNull('completed_at');
    }

    public function scopePending($query)
    {
        return $query->whereNull('completed_at');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
