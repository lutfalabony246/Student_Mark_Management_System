@extends('master')

<div id="wrapper">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="add-brand-container d-flex justify-content-between mb-2">
                                <h4 style="font-size: 24px;">Subject List</h4>
                                <button data-bs-toggle="modal" data-bs-target="#add-class-modal" type="button" class="btn btn-success waves-effect waves-light mb-2 me-2"><i class="fas fa-plus pe-2"></i> Add Subject</button>
                            </div>

                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Subject Name</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $subject)
                                    <tr>
                                        <td>{{ $subject->class->class_name}}</td>

                                        <td>{{ $subject->subject_name}}</td>
                                        <td>
                                            <!-- <button type="button" value="{{ $subject->id }}"
                                                        class="btn btn-success editBtn btn-sm">
                                                        Edit</button>
                                                    <a href=""
                                                        class="btn btn-danger btn-sm" id="delete">Delete</a> -->
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
</div>
<!-- END wrapper -->
<!--Add brand modal-->
<div class="add-class-modal">
    <div class="modal fade" tabindex="-1" id="add-class-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="AddSubjectForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <h5 style="color: black"> <span class="text-danger">*</span>Class Name </h5>
                            <div class="controls">
                                <select name="class_id" class="form-control">
                                    <option selected>Select a class name</option>
                                    @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <span id="error_name" class="text-danger"></span>

                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <h5 style="color: black"> <span class="text-danger">*</span>Class Name </h5>
                            <div class="controls">
                                <select name="subject_name" class="form-control">
                                    <option selected>Select a class name</option>
                                    <option value="Math">Math</option>
                                    <option value="English">English</option>
                                    <option value="Bangla">Bangla</option>
                                    <option value="Sociology">Sociology</option>
                                    <option value="Religion">Religion</option>
                                </select>
                                <span id="error_subject_name" class="text-danger"></span>


                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary waves-effect waves-light mb-2 me-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light mb-2 me-2"> Add
                            Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('script')
{{-- add subject --}}
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Add Submit
        $(document).on('submit', '#AddSubjectForm', function(e) {

            e.preventDefault();
            let formData = new FormData($('#AddSubjectForm')[0]);

            $.ajax({
                type: "POST"
                , url: "{{ route('subject.store') }}"
                , data: formData
                , contentType: false
                , processData: false
                , success: function(response) {
                    console.log(response);
                    if (response.status == 400) {
                        $('#error_name').text(response.errors.class_id);
                        $('#error_subject_name').text(response.errors.subject_name);

                    } else {
                        toastr.success(response.message);
                        location.reload();
                        $('#add-class-modal').modal('hide');
                    }
                }

            });
        });
    });

</script>
@endsection
