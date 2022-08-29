@extends('master')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-5 m-5">
                        <h4>Student Add</h4>
                        <form method="POST" action="{{ route('student.store') }}" enctype="multipart/form-data">

                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Roll No<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>

                                        <input type="text" name="roll_no" class="form-control" placeholder="roll no">
                                        @error('roll_no')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for=""> Name <b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <input type="text" name="name" class="form-control" placeholder=" name">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Class Name <b style="color:red; font-weight:bold;font-size: 18px">**</b></label>

                                        <select name="class_id" class="form-control">
                                            <option selected>Select a class name</option>
                                            @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->class_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Image<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <input type="file" name="image" class="form-control">
                                        @error('image')

                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <input type="email" name="email" class="form-control" placeholder="email">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Date Of Birth<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <input type="date" name="date_of_birth" class="form-control" placeholder="roll no">
                                        @error('date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="branch">Branch<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <select name="branch" class="form-control">
                                            <option selected>Select a branch</option>
                                            <option value="Main Branch">Main Branch
                                            </option>
                                            <option value="Sub Branch">Sub Branch
                                            </option>
                                        </select>
                                        @error('branch')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="added on">Shift<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                    <select name="shift" class="form-control">
                                        <option selected>Select a shift</option>
                                        <option value="Day Shift">Day Shift
                                        </option>
                                        <option value="Morning Shift">Morning Shift
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="added on">Added On<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <input type="date" name="added_on" class="form-control" placeholder="roll no">
                                        @error('added_on')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center p-4">
                                <button type="submit" class="btn btn-success">Submit </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
