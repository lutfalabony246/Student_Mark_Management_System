@extends('master')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-5 m-5">
                        <h4>Result Show</h4>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> Student Roll No<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                    <input type="text" name="roll_no" id="markdata" class="form-control" placeholder="roll no">
                                    <small>Input Student roll number</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div id="markdatashow"></div>
                        </div>
                        <div class="row">
                            <div id="markdatashow1"></div>
                        </div>

                        <div class="">
                            <button type="submit" class="btn btn-success">Submit </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@section('script')
{{-- ================================for filtering data according to student roll no======================================== --}}
<script>
    $(document).ready(function() {
        $('#markdata').on('change', function() {

            var class_id = $(this).val();
            if (class_id) {
                console.log(class_id);

                $.ajax({
                    url: `/mark/get/${class_id}`
                    , type: "GET"
                    , dataType: "json"
                    , success: function(data) {
                        console.log(data);

                        var newRowAdd = "";


                        $('#markdatashow').empty();
                        $('#markdatashow1').empty();

                        $.each(data.mark, function(index, value) {
                            console.log(value);
                            newRowAdd += ` <div class = "input-group m-3" >
                               <label>Subject-Marks:${value.subject.subject_name+'-'+value.marks}</label>

                                        </div>

                            `;
                        });
                        $.each(data.mark_grade, function(index, value) {

                            console.log(value);
                            newRowAdd += ` <div class="input-group m-3 mx-md-n5">
                               <div class="row">
                                 <div class="col-md-3">
                                   <label>total Mark:${value.total_mark}</label></br></br>

                                  </div>
                                  <div class="col-md-3">
                                      <label>Grade:${value.grade}</label>

                                  </div>

                                  <div class="col-md-3">
                                     <label>Position:${value.final_result}</label>

                                  </div>

                                </div>
                         </div>
                         `;
                        });

                        console.log(newRowAdd);

                        $('#markdatashow1').append(newRowAdd);

                    }
                , });
            } else {
                alert('danger');
            }
        });
    });

</script>

@endsection
