@extends('layouts.admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create Product</h4>
                            <form action="{{ route('admin.products.create') }}" method="POST" id="createFrm"
                                enctype="multipart/form-data">
                                @csrf
                                <p class="card-description">
                                    Personal info
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Title</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="title"
                                                    name="title" />
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-title"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Price</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="price"
                                                    name="price" />
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-price"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Discount Price</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="d_price" id="d_price" />
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-d_price"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Gross Weight</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="gross_weight" />
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-gross_weight"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="position: inherit;">
                                            <label class="col-sm-4 col-form-label">Net Weight</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="net_weight" id="net_weight">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-net_weight"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="position: inherit;">
                                            <label class="col-sm-4 col-form-label">No Pcs</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="no_pcs" id="no_pcs">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-no_pcs"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">About</label>
                                            <div class="col-sm-10">
                                            <textarea class="form-control" id="summernote" name="about" ></textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-about"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Instruction</label>
                                            <div class="col-sm-10">
                                            <textarea class="form-control " id="summernote1" name="instruction" ></textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-instruction"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Images</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control" name="image" />
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-image"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Customize</label>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customizeCheckbox" name="customize">
                                                    <label class="form-check-label" for="customizeCheckbox">Check to customize</label>
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email"></p>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row g-4 d-none" id="c_num">

                                    <div class="col-md-3 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="customize_title" name="customize_title[]" class="form-control">
                                            <label for="customize_title">Title<b class="text-danger">*</b></label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-customize_title_0">
                                        </p>

                                    </div>
                                    <div class="col-md-3 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="customize_price" name="customize_price[]"
                                                class="form-control">
                                            <label for="customize_price">price<b class="text-danger">*</b></label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-customize_price_0"></p>
                                    </div>
                                    <div class="col-md-2 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="number" id="customize_pack" name="customize_pack[]"
                                                class="form-control">
                                            <label for="customize_pack">pack<b class="text-danger">*</b></label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-customize_pack_0">
                                        </p>

                                    </div>
                                    <div class="col-md-2 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="file" id="customize_image" name="customize_image[]" class="form-control">
                                            <!-- <label for="customize_image">image<b class="text-danger">*</b></label> -->
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-customize_image_0"></p>
                                    </div>

                                    <div class="col-md-2 pt-3">
                                        <button type="button" class="btn btn-primary add-area-btn1" data-id="Aaddress"
                                            id="add1"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-12" id="mt12">
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
        {{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
        <script>
                //on change country
                $(document).on('click', '#customizeCheckbox', function(event) {
                    var isChecked = $(this).prop('checked');
                    if (isChecked) {
                        $('#c_num').removeClass('d-none');
                    } else {
                        $('#c_num').addClass('d-none');
                    }
                });
                $(document).ready(function() {
                    var i = 0;

                    $("#add1").click(function() {
                        ++i;
                        $("#mt12").append(`
                    <div class="row g-4" id="row${i}">
                        <div class="col-md-3 pt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" name="customize_title[]">
                                <label for="customize_title">Title<b class="text-danger">*</b></label>
                            </div>
                            <p style="margin-bottom: 2px;" class="text-danger error_container customize_title_${i}" id="error-customize_title_${i}"></p>
                        </div>
                        <div class="col-md-3 pt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" name="customize_price[]">
                                <label for="customize_price">Price<b class="text-danger">*</b></label>
                            </div>
                            <p style="margin-bottom: 2px;" class="text-danger error_container customize_price_${i}" id="error-customize_price_${i}"></p>
                        </div>
                        <div class="col-md-2 pt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="customize_pack" name="customize_pack[]" class="form-control">
                                <label for="customize_pack">Pack<b class="text-danger">*</b></label>
                            </div>
                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                id="error-customize_pack_0">
                            </p>

                        </div>
                        <div class="col-md-2 pt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="file" id="customize_image" name="customize_image[]"
                                    class="form-control">
                                <label for="customize_image">End Date<b class="text-danger">*</b></label>
                            </div>
                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                id="error-customize_image_0"></p>
                        </div>
                        <div class="col-md-2 pt-2">
                            <p style="margin-bottom: 2px;" class="text-danger error_container Answer_error"></p>
                            <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    `);
                    });
                    $(document).on('click', '.btn_remove', function() {
                        var button_id = $(this).attr("id");
                        $('#row' + button_id).remove();
                    });
                });
            $(document).ready(function() {
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
                                $('.submit').html('Submit');
                            }, 2000);
                            //console.log(response);
                            if (response.success == true) {

                                //notify
                                toastr.success("Product Created Successfully!");
                                // redirect to google after 5 seconds
                                window.setTimeout(function() {
                                    window.location = "{{ url('/') }}" + "/admin/products";
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

                $('textarea#summernote').summernote({
                    tabsize: 2,
                    height: 100,
                    toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'italic', 'underline', 'clear']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['height', ['height']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture', 'hr']],
                            ['help', ['help']]
                    ],
                });
                $('textarea#summernote1').summernote({
                    tabsize: 2,
                    height: 100,
                    toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'italic', 'underline', 'clear']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['height', ['height']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture', 'hr']],
                            ['help', ['help']]
                    ],
                });
            });

          
        </script>
    @endpush
