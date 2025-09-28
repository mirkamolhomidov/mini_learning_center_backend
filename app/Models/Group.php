<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function lesson()
    {
        return $this->hasMany(Lesson::class, 'group_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_groups', 'group_id', 'student_id');
    }
}
