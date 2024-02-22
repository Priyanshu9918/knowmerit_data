@extends('layouts.admin.master')
@section('content')
<style>
    .select2-container .select2-selection--multiple {
    height: auto;
    min-height: 38px;
    border: 1px solid #ced4da;
    border-radius: 4px;
}

.select2-container .select2-selection--multiple .select2-selection__choice {
    background-color: #007bff;
    color: #fff;
    border: 1px solid #007bff;
}

.select2-container .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff;
}

.select2-container .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: #fff;
}

.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    margin-top: 5px;
}

.select2-container--default .select2-selection--multiple .select2-selection__arrow {
    top: 5px;
}

/* Adjust the dropdown style */
.select2-container--default .select2-results__option {
    padding: 8px;
}

.select2-container--default .select2-results__option[aria-selected="true"] {
    background-color: #007bff;
    color: #fff;
}

.select2-container--default .select2-results__option:hover {
    background-color: #007bff;
    color: #fff;
}

.select2-container--default .select2-results__option[aria-disabled="true"] {
    color: #868e96;
}
.select2-container .select2-selection--multiple .select2-selection__choice__remove {
    display: none;
}
</style>
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Assign Course</h4>
                    <form action="{{ route('admin.assign-course') }}" method="POST" id="createFrm" enctype="multipart/form-data">
                        @csrf
                        <!-- <p class="card-description">
                        Personal info
                        </p> -->
                        <input type="hidden" name="teacher_id" value="{{$id}}">
                        @php 
                            $a_c_id = DB::table('assign_teachers')->where('teacher_id',$id)->pluck('course_id');
                            $data = DB::table('courses')->whereNotIn('id', $a_c_id)->where('teacher_id', 1)->where('status', 1)->get();
                        @endphp
                        <div class="row">
                        <div class="col-md-10">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Courses</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2-multiple" name="course[]" id="course" multiple>
                                        <option value="">Select Course</option>
                                        @foreach($data as $courses)
                                            <option value="{{ $courses->id }}">{{ $courses->title }}</option>
                                        @endforeach
                                    </select>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-course"></p>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="card" style="background:white;">
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                        <button type="submit" class="btn btn-success submit mr-2">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                    </div>
                </div>
                </div>
                </div>
                </div>
@endsection
@push('script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function(){
        //on change country

        $(document).on('submit', 'form#createFrm', function (event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");

            var form = $(this);
            var data = new FormData($(this)[0]);
            var url = form.attr("action");
            var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
            $('.submit').attr('disabled',true);
            $('.form-control').attr('readonly',true);
            $('.form-control').addClass('disabled-link');
            $('.error-control').addClass('disabled-link');
            if ($('.submit').html() !== loadingText) {
                $('.submit').html(loadingText);
            }
            $.ajax({
                type: form.attr('method'),
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    window.setTimeout(function(){
                        $('.submit').attr('disabled',false);
                        $('.form-control').attr('readonly',false);
                        $('.form-control').removeClass('disabled-link');
                        $('.error-control').removeClass('disabled-link');
                        $('.submit').html('Submit');
                      },2000);
                    //console.log(response);
                    if(response.success==true) {
                        //notify
                        // Swal.fire({
                        //     position: 'top-end',
                        //     icon: 'success',
                        //     title: 'Role Created Successfully',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        //     })

                        toastr.success("Course Assign successfully!");

                        window.setTimeout(function() {
                            window.location = "{{ url('/')}}"+"/admin/teacher";
                        }, 2000);

                    }
                    //show the form validates error
                    if(response.success==false ) {
                        for (control in response.errors) {
                           var error_text = control.replace('.',"_");
                           $('#error-'+error_text).html(response.errors[control]);
                           // $('#error-'+error_text).html(response.errors[error_text][0]);
                           // console.log('#error-'+error_text);
                        }
                        // console.log(response.errors);
                    }
                },
                error: function (response) {
                    // alert("Error: " + errorThrown);
                    console.log(response);
                }
            });
            event.stopImmediatePropagation();
            return false;
        });
        $('.select2-multiple').select2({
                placeholder: "Select Courses",
                allowClear: true
            });
    });
</script>
@endpush

