@extends('layouts.admin.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">User</h4>
                    <form action="{{ route('admin.role.edit',['id'=>base64_encode($role->id)]) }}" method="POST" id="editFrm" enctype="multipart/form-data">
                            @csrf
                        <p class="card-description">
                        Personal info
                        </p>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="role" name="role" value="{{$role->name ?? ''}}"/>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-role"></p>
                            </div>
                            </div>
                        </div>
                        </div>

                        <div class="card" style="background:white;">
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                        <button type="submit" class="btn btn-success submit mr-2">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
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
   $(document).ready(function(){
        $(document).on('submit', 'form#editFrm', function (event) {
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
                        $('.submit').html('Update');
                      },2000);
                    //console.log(response);
                    if(response.success==true) {

                        //notify
                        // toastr.success("blog Updated Successfully");
                        // Swal.fire({
                        // position: 'top-end',
                        // icon: 'success',
                        // title: 'Role Updated Successfully',
                        // showConfirmButton: false,
                        // timer: 1500
                        // })
                        toastr.success("Role updated successfully!");
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/')}}"+"/admin/role";
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
    });
    $(document).ready(function() {
          $('.summernote').summernote();
        });
</script>
@endpush
