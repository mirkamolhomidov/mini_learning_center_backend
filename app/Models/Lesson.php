<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
