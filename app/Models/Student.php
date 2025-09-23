<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = ['full_name', 'score'];

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
