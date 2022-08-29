<?php

namespace App\Http\Controllers;

use App\Models\Marks;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\MarkGrade;
use Illuminate\Http\Request;
use App\Models\Subject;

class MarkController extends Controller
{
    //
    public function Add()
    {
        $classes = StudentClass::get();
        $Students = Student::get();
        return view('mark.mark_add', compact('classes', 'Students'));
    }
    // for showing subject data
    public function SubjectAjax($class_id)
    {
        $subject_get = Subject::where('class_id', $class_id)->get();
        return response($subject_get);
    }


    public function Store(Request $request)
    {
        $total_marks = 0;
        $total_subject = 0;

        foreach ($request->subject as $subject) {

            $subject_marks = new Marks();
            $subject_marks->class_id = $request->class_id;
            $subject_marks->student_id = $request->student_id;
            $subject_marks->subject_id = $subject['id'];
            $subject_marks->marks = $subject['marks'];
            $total_marks += $subject['marks'];
            $total_subject += $subject['id'];
            $subject_marks->save();
        }

        $markgrade = new MarkGrade();
        $markgrade->total_mark = $total_marks;
        $total_subject = $subject_marks->subject_id;
        $expected_mark = $total_subject * 100;

        $grade = ($total_marks / $expected_mark) * 100;

// dd($grade);
        switch ($grade) {
            case $grade >= 90:
                $markgrade->grade = 'A+';
                break;
            case $grade < 90 && $grade > 80:
                $markgrade->grade = 'A-';
                break;
            case $grade <= 80 && $grade > 70:
                $markgrade->grade = 'B+';
                break;
            case $grade <= 70 && $grade > 60:
                $markgrade->grade = 'C+';
                break;
            case $grade <= 60 && $grade > 50:
                $markgrade->grade = 'C-';
                break;
            case $grade <= 50 && $grade > 40:
                $markgrade->grade = 'C';
                break;
            case $grade <= 40 && $grade >= 30:
                $markgrade->grade = 'D';
                break;
            case $grade < 30:
                $markgrade->grade = 'F';
                break;
        }
        // dd($markgrade->grade);
       if ($markgrade->grade =="F") {
     $markgrade->final_result ="fail";
    //  dd("Fail");
       } elseif ($markgrade->grade =="A+") {
       $markgrade->final_result ="1st";
       }elseif ($markgrade->grade =="B+") {
       $markgrade->final_result ="2nd";
       }elseif ($markgrade->grade =="C+") {
       $markgrade->final_result ="3rd";
       } else {
       $markgrade->final_result ="Pass";
       }
        $markgrade->class_id =$request->class_id;
          $markgrade->student_id =$request->student_id;
       $markgrade->save();


    }
    // marks filtering page
     public function MarkShowAdd()
     {
        return view('mark_show');
     }
    //  filtering marks data and show
     public function MarkShow($id)
     {
       $mark=Marks::with('students','subject')->where('student_id',$id)->get();

       $mark_grade=MarkGrade::where('student_id',$id)->get();

      return response()->json(array(
      'mark' => $mark,
      'mark_grade' => $mark_grade,

      ));


     }
}
