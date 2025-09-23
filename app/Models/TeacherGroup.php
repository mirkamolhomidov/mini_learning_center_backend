<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TeacherGroup extends Model
{
    use HasFactory;
    protected $table = 'teacher_groups';
    protected $keyType ='string';
    public $incrementing = false;
    public $timestamps = false;

    protected $guarded = ['id'];
    
    public function teacher()
    {
      return $this->belongsTo(Staff::class);
    }

    public function group()
    {
      return $this->belongsTo(Group::class);
    }
    protected static function booted()
    {
      parent::booted();

      static::creating(function ($model) {
        if(empty($model->{$model->getKeyName()})){
          $model->{$model->getKeyName()} = (string) Str::uuid();
        }
      });
    }
}
