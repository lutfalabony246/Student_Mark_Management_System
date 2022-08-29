<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;
    protected $guarded=[];
  public function students()
  {
  return $this->belongsTo(Student::class, 'student_id', 'roll_no');
  }

   public function subject()
   {
   return $this->belongsTo(Subject::class, 'subject_id', 'id');
   }

}
