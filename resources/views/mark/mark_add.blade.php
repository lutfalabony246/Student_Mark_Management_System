@extends('master')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-5 m-5">
                        <h4>Mark Add</h4>
                        <form method="POST" action="{{ route('mark.store') }}" enctype="multipart/form-data">

                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Class Name<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <select name="class_id" class="form-control" id="class_get">
                                            {{-- <option selected>Select a class name</option> --}}
                                            @foreach ($classes as $class)
                                            <option selected>Enter class
                                            </option>

                                            <option value="{{ $class->id }}">{{ $class->class_name }}
                                            </option>
                                            @endforeach
                                        </select>

                                        @error('class_id')

                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <small>To add mark please select class first</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for=""> Student Roll Number <b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <select name="student_id" class="form-control">
                                            @foreach ($Students as $Student)
                                            <option selected>Enter roll number
                                            </option>

                                            <option value="{{ $Student->roll_no }}">{{ $Student->roll_no }}

                                            </option>
                                            @endforeach
                                        </select>

                                        @error('student_id')

                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div id="newAdd"></div>
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
@section('script')
<script>
    $(document).ready(function() {
        $('#class_get').on('change', function() {
            var class_id = $(this).val();
            if (class_id) {
                $.ajax({
                    url: `/mark/get/subject/ajax/${class_id}`
                    , type: "GET"
                    , dataType: "json"
                    , success: function(data) {
                        console.log(data);

                        var newRowAdd = "";
                        $('#newAdd').empty();


                        $.each(data, function(index, value) {
                            console.log(value);


                            newRowAdd += ` <div class = "input-group m-3" >
                                <div class="input-group-prepend">
                                            <label>${value.subject_name}</label>
                                        <input type="text" name="subject[${index}][marks]" class="form-control m-input">

                                        <input type="text" hidden name="subject[${index}][id]" value=${value.id} class="form-control m-input">
                                </div>
                                        </div>

                            `;
                        });
                        console.log(newRowAdd);

                        $('#newAdd').append(newRowAdd);
                    }
                , });
            } else {
                alert('danger');
            }
        });
    });

</script>

@endsection
