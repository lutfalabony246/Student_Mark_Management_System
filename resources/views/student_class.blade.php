@extends('master')
@section('css')
@endsection
<!-- Begin page -->
<div id="wrapper">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="add-brand-container d-flex justify-content-between mb-2">
                                <h4 style="font-size: 24px;">CLass List</h4>
                                <button data-bs-toggle="modal" data-bs-target="#add-class-modal" type="button" class="btn btn-success waves-effect waves-light mb-2 me-2"><i class="fas fa-plus pe-2"></i> Add Class</button>
                            </div>

                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($class_names as $class_name)
                                    <tr>
                                        <td>{{ $class_name->class_name }}</td>
                                        <td>
                                            <button type="button" value="{{ $class_name->id }}" class="btn btn-success editBtn btn-sm">
                                                Edit</button>
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
<!--Add class modal-->
<div class="add-class-modal">
    <div class="modal fade" tabindex="-1" id="add-class-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="AddClassForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <h5 style="color: black"> <span class="text-danger">*</span>Class Name </h5>
                            <div class="controls">
                                <input type="text" name="class_name" placeholder="class Name" class="form-control">
                                <span id="error_name" class="text-danger"></span>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary waves-effect waves-light mb-2 me-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light mb-2 me-2"> Add
                            Class</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- -- EditClassModal start -- -->
<div class="modal fade" id="EditClassModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black"> Update Class </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="UpdateCLassForm" method="POST">
                {{ method_field('PUT') }}
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="edit_class_id">
                    <div class="form-group">
                        <h5 style="color: black"> <span class="text-danger">*</span> Class Name</h5>
                        <div class="controls">
                            <input type="text" name="class_name" id="edit_class_name" placeholder="Class Name" class="form-control">
                            <span id="error_class_name" class="errorColor"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Class</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- -- EditClassModal end -- -->
@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Add Submit
        $(document).on('submit', '#AddClassForm', function(e) {
            e.preventDefault();
            let formData = new FormData($('#AddClassForm')[0]);
            $.ajax({
                type: "POST"
                , url: "{{ route('class.store') }}"
                , data: formData
                , contentType: false
                , processData: false
                , success: function(response) {
                    console.log(response);
                    if (response.status == 400) {
                        $('#error_name').text(response.errors.class_name);
                    } else {
                        toastr.success(response.message);
                        location.reload();
                        $('#add-class-modal').modal('hide');
                    }
                }

            });
        });
        $(document).on('submit', '#UpdateCLassForm', function(e) {
            e.preventDefault();
            let formData = new FormData($('#UpdateCLassForm')[0]);
            var class_id = $('#edit_class_id').val();
            let EditFormData = new FormData($('#UpdateCLassForm')[0]);
            console.log(EditFormData);
            $.ajax({
                type: "POST"
                , url: `/class/${class_id}`
                , data: formData
                , contentType: false
                , processData: false
                , success: function(response) {
                    console.log(response);
                    if (response.status == 400) {
                        // $('#error_name').text(response.errors.class_name);
                    } else {
                        toastr.success(response.message);
                        location.reload();
                        $('#EditClassModal').modal('hide');
                    }
                }

            });
        });
        // }); //update end
        // for editing data using ajax
        $(document).on('click', '.editBtn', function() {
            var class_id = $(this).val();
            $('#EditClassModal').modal('show');
            $.ajax({
                type: "GET"
                , url: `/class/${class_id}/edit`
                , success: function(response) {
                    console.log(response);
                    $('#edit_class_name').val(response.class.class_name);
                    $('#edit_class_id').val(class_id);
                }
                // }
            })
        });
    });

</script>
@endsection
