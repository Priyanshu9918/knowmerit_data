@extends('layouts.admin.master')
@section('content')
<style>
    .remove-image {
        /* display: none; */
        position: relative;
        top: -100px;
        right: -80px;
        border-radius: 10em;
        padding: 3px 6px 3px;
        text-decoration: none;
        font: 700 21px/20px sans-serif;
        background: #555;
        border: 3px solid #fff;
        color: #FFF;
        box-shadow: 0 2px 6px rgb(0 0 0 / 50%), inset 0 2px 4px rgb(0 0 0 / 30%);
        text-shadow: 0 1px 2px rgb(0 0 0 / 50%);
        -webkit-transition: background 0.5s;
        transition: background 0.5s;
    }

    .remove-image
    {
        padding: 0px 3px 0px !important;
    }

    .image-area img{
        height: 100px !important;
        width: 100px !important;
        padding: 8px !important;
    }

    .image-area{
        width: 90px !important;
    }

    .remove-image:hover
    {
        padding: 0px 3px 0px !important;
    }

    .remove-image:hover {
        background: #E54E4E;
        color: #fff;
    }

</style>
<!-- Main Content -->

<div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                <div class="hk-pg-header ">
                    <h1 class="fs-4 m-0">Product Images</h1>

                </div>
                <!-- /Page Header -->

                <!-- Page Body -->
                <div class="hk-pg-body" style="padding-top: 85px;">
                    <div class="row edit-profile-wrap add-cust">

                        <div class="col-lg-10 col-sm-9 col-8">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab_block_1">
                                    <form action="{{ route('admin.products.image-gallery',['id'=>base64_encode($product->id)]) }}" method="POST" id="createFrm" enctype="multipart/form-data">
                                        @csrf
                                        @if(count($productImage)>0)
                                            <div class="row gx-3">
                                                @foreach ($productImage as $item)
                                                    <div class="col-1" style="margin: 20px">
                                                        <div class="image-area" style="width:110px;">
                                                            <img src="{{asset('uploads/product/'.$item->image)}}" title="file_name" alt="preview" style="height:100px;"/>
                                                            <a class="remove-image" data-id="{{ base64_encode($item->id) }}" href="javascript:;" style="display: inline;">×</a>
                                                            <input type="hidden" name="fileID[]" value="{{ $item->id }}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="row gx-3">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="formFile" class="form-label">Images *</label>
                                                    <input class="form-control" name="image[]" type="file" id="formFile" accept="image/*" multiple>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-image"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary submit mt-2">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('script')
<script>
    $(document).ready(function(){

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
                        $('.submit').html('Save');
                      },2000);
                    //console.log(response);
                    if(response.success==true) {

                        //notify
                        toastr.success("Product Image Created Successfully");
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location.reload();
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

        //remove file
        $(document).on('click','.remove-image',function(){

            var current = $(this);
            var id = $(this).attr('data-id');
            swal({
                // icon: "warning",
                type: "warning",
                title: "Are You Want to Remove?",
                text: "",
                dangerMode: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "YES",
                cancelButtonText: "CANCEL",
                closeOnConfirm: false,
                closeOnCancel: false
                },
                function(e){
                    if(e==true)
                    {
                        var fd = new FormData();

                        fd.append('id',id);
                        fd.append('_token', '{{csrf_token()}}');

                        $.ajax({
                            type: 'POST',
                            url: "{{ url('admin/products/remove/image') }}",
                            data: fd,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                // console.log(data);
                                if (data.fail == false) {
                                    //reset data
                                    $('.fileupload').val("");
                                    //append result
                                    $(current).parent('.image-area').detach();
                                } else {

                                    console.log("file error!");

                                }
                            },
                            error: function(error) {
                                console.log(error);
                                // $(".preview_image").attr("src","{{asset('images/file-preview.png')}}");
                            }
                        });
                        swal.close();
                    }
                    else
                    {
                        swal.close();
                    }
                }
            );

        });
    });
</script>
@endpush
