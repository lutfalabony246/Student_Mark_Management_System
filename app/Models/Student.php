<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded=[];

    // relationship with studentclass model
    public function class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
      public function subject(){
      return $this->hasMany(Subject::class,'subject_id','id');
      }


}
