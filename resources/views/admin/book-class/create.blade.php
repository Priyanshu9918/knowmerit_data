@extends('layouts.admin.master')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Schedule class</h4>
                        <form action="" method="POST" id="createFrm" enctype="multipart/form-data">
                            @csrf
                            <p class="card-description">
                                Book Class
                            </p>
                            @php
                                $teacher = DB::table('users')->where('user_type',2)->where('status',1)->get();
                            @endphp
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Teacher Name</label>
                                        <div class="col-sm-8">
                                            <select class="form-control teacher" id="teacher" name="teacher">
                                            <option value="">Select Teacher</option>
                                            @foreach($teacher as $plya1)
                                                <option value="{{$plya1->id}}">{{$plya1->name}}</option>
                                            @endforeach
                                            </select>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-teacher"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Student Name</label>
                                        <div class="col-sm-8">
                                            <select class="form-control student" id="student" name="student">
                                                <option value="">Select Student</option>
                                            </select>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-student"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $cat = DB::table('categories')->where('status',1)->get();
                            @endphp
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Category</label>
                                        <div class="col-sm-8">
                                            <select class="form-control category" id="category" name="category">
                                                <option value="">Select Category</option>
                                                @foreach($cat as $cat1)
                                                    <option value="{{$cat1->id}}">{{$cat1->name}}</option>
                                                @endforeach
                                            </select>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-category"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Sub-Category</label>
                                        <div class="col-sm-8">
                                            <select class="form-control sub_category" id="sub_category" name="sub_category">
                                            <option value="">Select Sub Category</option>
                                            </select>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-sub_category"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="background:white;">
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <button type="button" class="btn btn-success mr-2 find_slot">Submit</button>
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

    <div class="modal fade" id="schedule-calendar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" style="margin-top: 0px;">
            {{-- style="max-width:70%;" --}}
            <div class="modal-content selectplan">
                <div class="modal-header">
                    <span><i class="fa-solid fa-chevron-left"></i></span>
                    <h1 class="modal-title fs-5">Schedule your lessons</h1>
                    <button type="button" class="btn-close m-0 p-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body time-frame" style="width:100%">
                    {{-- <div class="container">
                            <button class="btn btn-primary btn-prev"> prev</button>
                            <button class="btn btn-primary btn-today">Today</button>
                            <button class="btn btn-primary btn-nxt"> nxt</button>
                            <div id="container" style="height: 600px;"></div>
                        </div> --}}
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    <form action="" method="" class="d-none" id="boking_form">
        <input type="hidden" id="class_id" name="class_id" value="">
        <input type="hidden" id="sub_id" name="sub_id" value="">
        <input type="hidden" id="teacher_id" name="teacher_id" value="">
        <input type="hidden" id="student_id" name="student_id" value="">
        <input type="hidden" id="date_time" name="date_time" value="">
    </form>
    @endsection

    @push('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
    <link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
    <script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.ie11.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on("click", ".find_slot", function() {
                    var c_id = $('#category').val();
                    var s_id = $('#sub_category').val();
                    var st_id = $('#student').val();
                    var t_id = $('#teacher').val();
                    if(t_id == ''){
                        $('#error-student').html('');
                        $('#error-category').html('');
                        $('#error-sub_category').html('');
                        $('#error-teacher').html('please select Teacher');
                        return false;
                    }
                    if(st_id == ''){
                        $('#error-teacher').html('');
                        $('#error-category').html('');
                        $('#error-sub_category').html('');
                        $('#error-student').html('please select Student');
                        return false;
                    }
                    if(c_id == ''){
                        $('#error-teacher').html('');
                        $('#error-student').html('');
                        $('#error-sub_category').html('');
                        $('#error-category').html('please select category');
                        return false;
                    }
                    if(s_id == ''){
                        $('#error-teacher').html('');
                        $('#error-student').html('');
                        $('#error-category').html('');
                        $('#error-sub_category').html('please select sub-category');
                        return false;
                    }
                    $('#student_id').val(st_id);
                    $('#teacher_id').val(t_id);
                    $.ajax({
                        url: "{{ route('admin.cal') }}",
                        type: 'GET',
                        data: {
                            c_id: c_id,
                            s_id: s_id,
                            t_id: t_id,
                            st_id: st_id
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#class_id').val(data.class_id);
                            $('#sub_id').val(data.sub_id);
                            $('.time-frame').html(data.html);
                            $('#schedule-calendar').modal('show');

                            setTimeout(() => {
                                cal_init();
                            }, 200);
                        }
                    });
            });

            // $(document).on('change', '.category', function() {
            //     var id = $('#category').val();
            //     $.ajax({
            //         type: "get",
            //         url: "{{ route('admin.sub-category') }}",
            //         data: {
            //             'category': id,
            //             "_token": "{{ csrf_token() }}"
            //         },
            //         success: function(data) {
            //             if (data.success == true) {
            //                 $("#sub_category").empty();
            //                 $.each(data.value, function(key, value) {
            //                     $("#sub_category").append('<option value="' + value.id + '">' +
            //                         value.name + '</option>');
            //                 });
            //             }
            //             if (data.success == false) {
            //                 $("#sub_category").empty();
            //                 $("#sub_category").append('<option value="">No any Sub-category</option>');
            //             }
            //         }
            //     });
            // });
            $(document).on('change', '.category', function() {
                var id = $(this).val();
                var rowId = $(this).attr("id").replace("category", "");
                var subCategoryDropdown = $(`#sub_category${rowId}`);
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.sub-category') }}",
                    data: {
                        'category': id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.success == true) {
                            subCategoryDropdown.empty();
                            subCategoryDropdown.append('<option value="">Select Sub Category</option>');
                            $.each(data.value, function(key, value) {
                                subCategoryDropdown.append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        } else {

                            if (data.success == false) {
                                subCategoryDropdown.empty();
                                subCategoryDropdown.append('<option value="">No any Sub Category</option>');
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            $(document).on('change', '.teacher', function() {
                var id = $('#teacher').val();
                var rowId = $(this).attr("id").replace("teacher", "");
                var student = $(`#student${rowId}`);
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.student-class') }}",
                    data: {
                        'category': id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.success == true) {
                            $("#student").empty();
                            $("#student").append('<option value="">Select Student</option>');
                            $.each(data.value, function(key, value) {
                                $("#student").append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            });
                        }
                        if (data.success == false) {
                            $("#student").empty();
                                $("#student").append('<option value="">Select Student</option>');
                        }
                    }
                });
            });
        });
    </script>

    @endpush
