<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    //
    // for adding subject
    public function Add()
    {
        $subjects=Subject::with('class')->get();
        $classes=StudentClass::get();
      return view('subject_add',compact('classes','subjects'));
    }
    public function Store(Request $request)
    {
    //validation
    $validator = Validator::make($request->all(), [
    'class_id' => 'required',
    'subject_name' => 'required',
    ]);

    if ($validator->fails()) {
    return response()->json([
    'status' => 400,
    'errors' => $validator->messages()
    ]);
    }

    else {
    $class = new Subject();
    $class->class_id = $request->input('class_id');
     $class->subject_name = $request->input('subject_name');
    $class->save();
    return response()->json(['message' => 'Subject Name Added Successfully']);
    }
    }

}
