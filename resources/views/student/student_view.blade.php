@extends('master')
<div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card p-5">
                                <h4>Student List View</h4>
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            @foreach ($headers as $header )
                                            <th>{{ $header }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- {{-- show all student data --}} -->
                                        @foreach ($students as $student)
                                        <tr>
                                        <td> <img src="{{ asset($student->image) }}" style="width: 60px; height: 50px;">
                                            </td>
                                            <td class="fc">{{$student->roll_no }}</td>

                                            <td>{{$student->name }}</td>
                                            <td>{{$student->class->class_name }}</td>
                                            <td>{{$student->email }}</td>
                                            <td>{{$student->gender }}</td>
                                            <td>{{$student->date_of_birth }}</td>
                                            <td>{{$student->branch }}</td>
                                            <td>{{$student->shift }}</td>
                                            <td>{{$student->added_on }}</td>

                                            <td>
                                                <a href="{{ route('student.edit', $student->id) }}" class="btn btn-primary btn-sm">
                                                    Edit</a>
                                                <a href="{{ route('student.delete', $student->id) }}" class="btn btn-danger btn-sm">
                                                    Delete</a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>