@extends('layouts.admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @php
            $parent_categories = DB::table('categories')
                ->where('status', 1)
                ->where('parent', 0)
                ->get();
            $teachers = DB::table('users')
                ->where('status', 1)
                ->where('user_type', 2)
                ->get();
        @endphp
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Assign Teacher</h4>
                            <form action="{{ route('admin.assign_teacher', ['id' => base64_encode($user->id)]) }}"
                                method="POST" id="createFrm" enctype="multipart/form-data">
                                @csrf
                                <p class="card-description">
                                    Personal info
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label"><b>Category</b></label>
                                        <select class="form-control category" id="category" name="category[]">
                                            <option value="">Select Category</option>
                                            @if (count($parent_categories) > 0)
                                                @foreach ($parent_categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-category"></p>
                                    </div>
                                    <div class="col-md-6" id="sb_n" >
                                        <label class="form-label"><b>Sub Category</b></label>
                                        <select class="form-control sub_category" name="sub_category[]" id="sub_category">
                                            <option value="">Select Sub Category</option>
                                        </select>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-sub_category"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label"><b>Teacher</b></label>
                                        <select class="form-control teacher" id="tutor_name" name="tutor_name[]">
                                            <option value="">Select Category</option>
                                            @if (count($teachers) > 0)
                                                @foreach ($teachers as $t)
                                                    <option value="{{ $t->id }}">{{ $t->name }}
                                                        ({{ $t->email }})</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-tutor_name"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label"><b>Credit</b></label>
                                        <input type="number" class="form-control credit" id="credit" name="credit[]" />
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-credit"></p>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success add-area-btn1" data-id="Aaddress" id="add1" style="width: auto; margin: 18px;"><i class="fa fa-plus"></i></button>
                                <div class="col-md-12" id="mt12"></div>
                                <div class="card" style="background:white;">
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" id="save" class="btn btn-success submit mr-2">Submit</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            var i = 0;
            $("#add1").click(function() {
                ++i;
                $("#mt12").append(`<div class="row gx-3" id="row${i}">
                    <div class="col-md-6">
                        <label class="form-label"><b>Category</b></label>
                        <select class="form-control category" id="category${i}" name="category[]">
                            <option value="">Select Category</option>
                            @if (count($parent_categories) > 0)
                                @foreach ($parent_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                            id="error-category${i}"></p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><b>Sub Category</b></label>
                        <select class="form-control sub_category" id="sub_category${i}" name="sub_category[]">
                            <option value="">Select Sub Category</option>
                        </select>
                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                            id="error-sub_category${i}"></p>
                    </div>
                    <div class="col-md-6">
                                        <label class="form-label"><b>Teacher</b></label>
                                        <select class="form-control teacher" id="tutor_name${i}" name="tutor_name[]">
                                            <option value="">Select Category</option>
                                            @if (count($teachers) > 0)
                                                @foreach ($teachers as $t)
                                                    <option value="{{ $t->id }}">{{ $t->name }}
                                                        ({{ $t->email }})</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-tutor_name${i}"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label"><b>Credit</b></label>
                                        <input type="number" class="form-control credit" id="credit${i}" name="credit[]" />
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-credit${i}"></p>
                                    </div>

                    <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove" style="width: auto; margin: 18px;">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>`);
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
            $("#save").click(function() {

                $('.error_content').remove();
                var errors_count = 0;
                $('.category').each(function($key , $value) {
                    if ($(this).val() == '') {
                        errors_count = errors_count + 1;
                        $(this).after('<span class="text-danger error_content">Select the category</span>');
                    }
                });
                $('.teacher').each(function() {
                    if ($(this).val() == '') {
                        errors_count = errors_count + 1;
                        $(this).after('<span class="text-danger error_content">Select the teacher</span>');
                    }
                });
                $('.sub_category').each(function() {
                    if ($(this).val() == '') {
                        errors_count = errors_count + 1;
                        $(this).after('<span class="text-danger error_content">Select the Sub category</span>');
                    }
                });
                $('.credit').each(function() {
                    if ($(this).val() == '') {
                        errors_count = errors_count + 1;
                        $(this).after('<span class="text-danger error_content">Select the credit</span>');
                    }
                });
                if (errors_count > 0) {
                   return false;
                }

            });
            $(document).on('submit', 'form#createFrm', function(event) {
                    event.preventDefault();
                    $('p.error_container').html("");
                    var form = $(this);
                    var data = new FormData($(this)[0]);
                    var url = form.attr("action");
                    var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
                    $('.submit').attr('disabled', true);
                    $('.form-control').attr('readonly', true);
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
                        success: function(response) {
                            window.setTimeout(function() {
                                $('.submit').attr('disabled', false);
                                $('.form-control').attr('readonly', false);
                                $('.form-control').removeClass('disabled-link');
                                $('.error-control').removeClass('disabled-link');
                                $('.submit').html('Submit');
                            }, 2000);
                            if (response.success == true) {

                                toastr.success("Teacher Assign Successfully");
                                window.setTimeout(function() {
                                    window.location = "{{ url('/') }}" +
                                        "/admin/student_manegement_two";
                                }, 2000);
                            }
                            if (response.success == false) {
                                for (control in response.errors) {
                                    var error_text = control.replace('.', "_");
                                    $('#error-' + error_text).html(response.errors[control]);
                                    // $('#error-'+error_text).html(response.errors[error_text][0]);
                                    // console.log('#error-'+error_text);
                                }
                                // console.log(response.errors);
                            }
                        },
                        error: function(response) {
                            // alert("Error: " + errorThrown);
                            console.log(response);
                        }
                    });
                    event.stopImmediatePropagation();
                    return false;
                });
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
                            subCategoryDropdown.empty();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    @endpush
