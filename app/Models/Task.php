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

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
