@extends('layouts.admin.master')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Category</h4>
                        <form action="{{ route('admin.category.edit',['id'=>base64_encode($category->id)]) }}" method="POST" id="editFrm" enctype="multipart/form-data">
                                @csrf
                                <div class="row gx-3">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Category name</label>
                                            <input class="form-control" type="text" name="category_name" value="{{$category->name}}" placeholder="Enter Category name"/>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-category_name"></p>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-6">
                                        <label class="form-label">Select parent category</label>
                                        <select class="form-control" name="parent_category">
                                            <option value="">Select</option>
                                            @if(count($parent_categories)>0)
                                                @foreach ($parent_categories as $cat)
                                                    <option value="{{$cat->id}}" @if($cat->id==$category->parent) selected @endif>{{$cat->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-parent_category"></p>
                                    </div> -->
                                </div>
                                <div class="row gx-3">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="formFile" class="form-label">Choose category icon</label>
                                            <input class="form-control" name="icon" type="file" id="formFile" accept="image/*">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-icon"></p>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary submit mt-2">Update</button>
                            </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('script')
    {{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('submit', 'form#editFrm', function(event) {
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
                            $('.submit').html('Update');
                        }, 2000);
                        //console.log(response);
                        if (response.success == true) {

                            //notify
                            toastr.success("Category Updated Successfully");
                            // Swal.fire({
                            // position: 'top-end',
                            // icon: 'success',
                            // title: 'User Updated Successfully',
                            // showConfirmButton: false,
                            // timer: 1500
                            // })
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                window.location = "{{ url('/')}}" + "/admin/category";
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
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
    @endpush
