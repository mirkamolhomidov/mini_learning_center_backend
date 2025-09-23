<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StudentGroup extends Model
{
    use HasFactory;
    
    protected $table = 'student_groups';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = ['student_id', 'group_id', 'status'];
    
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
    
    protected static function booted()
    {
        parent::booted();
        
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}