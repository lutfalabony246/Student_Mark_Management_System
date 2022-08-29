@extends('master')
<div class="text-center">
    <button class="btn btn-success"><a href="{{ route('class.create') }}" class="btn btn-info" title="Edit Data">Class Add</a></button>
    <button class="btn btn-success"><a href="{{ route('subject.add') }}" class="btn btn-info" title="Edit Data">Subject Add</a></button>
    <button class="btn btn-success"><a href="{{ route('student.add') }}" class="btn btn-info" title="Edit Data">Student Add</a></button>
    <button class="btn btn-success"><a href="{{ route('mark.add') }}" class="btn btn-info" title="Edit Data">Student Mark Add</a></button>
    <button class="btn btn-success"><a href="{{ route('mark.filter.view') }}" class="btn btn-info" title="Edit Data">Student Mark Filtering</a></button>
</div>
