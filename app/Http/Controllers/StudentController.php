<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Exception;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    public function View()
    {
        $headers=['Image','Roll No','Name','class','Email','Gender','Date Of Birth','Branch','Shift','Added On','Action'];
        $students=Student::with('class')->get();
        return view('student.student_view',compact('students','headers'));
    }

    //show student add page
    public function Add()
    {
        $classes=StudentClass::get();
        return view('student.student_add',compact('classes'));
    }
    // for storing student data into database
    public function Store(Request $request)
    {
   //for validating requested data
   $request->validate([
    'roll_no' => 'required',
    'name' => 'required',
    'class_id' => 'required',
    'image' => 'required',
    'email' => 'required',
    'gender' => 'required',
    'date_of_birth' => 'required',
    'branch' => 'required',
    'shift' => 'required',
    'added_on' => 'required',

    ]);
     try {
    //  using image intervention
     $image = $request->file('image');
     $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
     Image::make($image)->resize(400, 400)->save('upload/student_image/' . $name_gen);
     $save_url = 'upload/student_image/' . $name_gen;

    // storing in database
     Student::create([
     'roll_no' => $request->roll_no,
     'name' => $request->name,
     'class_id' => $request->class_id,
     'email' => $request->email,
     'gender' => $request->gender,
     'date_of_birth' => $request->date_of_birth,
     'branch' => $request->branch,
     'shift' => $request->shift,
     'added_on' => $request->added_on,
     'image' => $save_url,

     ]);
      $notification = array(
                'message' => 'Student Added Successfully',
                'alert-type' => 'success'
            );
     return redirect()->route('student.view')->with($notification);
     } catch (\Exception $e) {
     return ('Insert into database error -' . $e->getLine() . $e->getMessage());
     }



    }
    // for editing data
    public function Edit($id)
    {
        // dd($id);
        //for edit data
        try {
            $classes=StudentClass::get();
            $student = Student::find($id);
    
            if (isset($student)) {
            return view('student.student_edit',compact('student','classes'));
            } else {
            throw new Exception('This Student id is not found');
            }
            } catch (\Exception $e) {
            return $e->getMessage();
            }
    }
    // for updating data
    public function Update(Request $request)
    {
       
          //validation
          $request->validate([
            'roll_no' => 'required',
            'name' => 'required',
            'class_id' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'branch' => 'required',
            'shift' => 'required',
            'added_on' => 'required',
        
            ]);
 
        //edit data storing  into database
        try {
         $id=$request->student_id;
         $old_image=$request->old_image;
       
         $update_student = Student::find($id);
 
         if ($request->file('image')) {
         if(file_exists($old_image) && $request->old_image != null)
         {
         unlink($old_image);
         }
         //Image Save
         $image = $request->file('image');
         $name_gen = hexdec(uniqid()) .'.'. $image->getClientOriginalExtension();
         Image::make($image)->resize(870,370)->save('upload/student_image/'. $name_gen);
         $save_url = 'upload/student_image/'. $name_gen;
         $update_student->image =$save_url;
         }
         $update_student->roll_no=$request->roll_no;
         $update_student->name=$request->name;
         $update_student->class_id=$request->class_id;
         $update_student->email=$request->email;
         $update_student->gender=$request->gender;
         $update_student->gender=$request->gender;
         $update_student->date_of_birth=$request->date_of_birth;
         $update_student->branch=$request->branch;
         $update_student->shift=$request->shift;
         $update_student->added_on=$request->added_on;
         $update_student->update();
         $notification = array(
            'message' => 'Student Updated Successfully',
            'alert-type' => 'success'
        );
           return redirect()->route('student.view')->with($notification);
        } catch (\Exception $e) {
        return ('Update into database error -' . $e->getLine() . $e->getMessage());
        }
    }
    // for deleting data from database
    public function Delete($id)
    {
       
        $student = Student::findOrFail($id);
        if(isset($student) && file_exists($student->image))
        {
            unlink(  $student->image );
        }
        Student::findOrFail($id)->delete();

        return redirect()->back();
    }
}
