@extends('layouts.admin.master')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">MCQs</h4>
                        <form action="{{ route('admin.mcq.create') }}" method="POST" id="createFrm" enctype="multipart/form-data">
                            @csrf
                            <div class="row gx-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">Category name</label>
                                        <select class="form-control category" id="category" name="category">
                                            <option value="">Select Category</option>
                                            @if (count($parent_cat) > 0)
                                                @foreach ($parent_cat as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-category"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Select Sub category</label>
                                    <select class="form-control" name="sub_category" id="sub_category">
                                        <option value="">Select</option>
                                    </select>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-sub_category"></p>
                                </div>
                            </div>
                            <div class="row gx-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Test Title</label>
                                        <input class="form-control" name="title" type="text" id="formFile" >
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-3">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Question</label>
                                        <input class="form-control" name="question[]" type="text" id="formFile" required>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-question"></p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="formFile" class="form-label">Option A</label>
                                        <input class="form-control" name="ans1[]" type="text" id="formFile" required>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-ans1"></p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="formFile" class="form-label">Option B</label>
                                        <input class="form-control" name="ans2[]" type="text" id="formFile" required>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-ans2"></p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="formFile" class="form-label">Option C</label>
                                        <input class="form-control" name="ans3[]" type="text" id="formFile" required>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-ans3"></p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="formFile" class="form-label">Option D</label>
                                        <input class="form-control" name="ans4[]" type="text" id="formFile" required>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-ans4"></p>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Answer</label>
                                        <select class="form-control" name="answer[]" required>
                                            <option value="">Select</option>
                                            <option value="1">A</option>
                                            <option value="2">B</option>
                                            <option value="3">C</option>
                                            <option value="4">D</option>
                                        </select>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-Answer"></p>
                                    <button type="button" class="btn btn-success add-area-btn1" data-id="Aaddress" id="add1"><i class="fa fa-plus"></i></button>
                                </div>
                                <div class="col-md-12" id="mt12"></div>
                            </div>
                            <button type="submit" class="btn btn-primary submit mt-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('script')
    {{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
    <script>

    $(document).ready(function() {

    var i = 0;
    $("#add1").click(function() {
        ++i;
        $("#mt12").append(`<div class="row gx-3" id="row${i}">
                                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Question</label>
                                        <input class="form-control" name="question[]" type="text" id="formFile" required>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-question"></p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="formFile" class="form-label">Option A</label>
                                        <input class="form-control" name="ans1[]" type="text" id="formFile" required>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-ans1"></p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="formFile" class="form-label">Option B</label>
                                        <input class="form-control" name="ans2[]" type="text" id="formFile" required>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-ans2"></p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="formFile" class="form-label">Option C</label>
                                        <input class="form-control" name="ans3[]" type="text" id="formFile" required>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-ans3"></p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="formFile" class="form-label">Option D</label>
                                        <input class="form-control" name="ans4[]" type="text" id="formFile" required>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-ans4"></p>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">answer</label>
                                        <select class="form-control" name="answer[]" required>
                                            <option value="">Select</option>
                                            <option value="1">A</option>
                                            <option value="2">B</option>
                                            <option value="3">C</option>
                                            <option value="4">D</option>
                                        </select>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-Answer"></p>
                                    <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove"><i class="fa fa-minus"></i></button>
                                </div>`);
    });
    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
    });
    $(document).on('change', '.category', function() {
        var id = $('#category').val();
        $.ajax({
            type: "get",
            url: "{{ route('admin.sub-category-list') }}",
            data: {
                'category': id,
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                if (data.success == true) {
                    $("#s_n").removeClass('d-none');
                    $("#sub_category").empty();
                    $.each(data.value, function(key, value) {
                        $("#sub_category").append('<option value="' + value.id + '">' +
                            value.name + '</option>');
                    });
                }
                if (data.success == false) {
                    $("#s_n").addClass('d-none');
                }
            }
        });
    });

    $(document).ready(function() {
        //on change country
        $(document).on('submit', 'form#createFrm', function(event) {
            event.preventDefault();
            //clearing the error msg
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
                        $('.submit').html('Save');
                    }, 2000);
                    //console.log(response);
                    if (response.success == true) {

                        //notify
                        toastr.success("MCQs Created Successfully");
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/') }}" +
                                "/admin/mcq";
                        }, 2000);

                    }
                    //show the form validates error
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

    });
    </script>
    @endpush
