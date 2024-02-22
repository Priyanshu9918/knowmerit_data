@extends('layouts.teacher.master')
@section('content')
<div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #f6f6f6;">

              <div class="add-commu-form">
              	<div class="profile-title">
                	<h3>Add New Community</h3>
                </div>
                <form action="{{ route('teacher.community.create') }}" method="POST" id="createFrm"
                  enctype="multipart/form-data">
                  @csrf
                  {{-- <input type="hidden" name="community_type" class="comm-title" value="{{Auth::user()->id}}"> --}}
                  <div class="community-form">
                    <label>Community Title</label><br>
                    <input type="text" name="title" class="comm-title" placeholder="Enter Community Title">
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                  </div>
                  <div class="community-form">
                    <label>Community Image</label><br>
                    <input type="file" name="image" id="image">
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-image"></p>

                  </div>
                  <div class="community-form">
                  	<label>Description</label><br>
                  	<textarea name="description" id="description"></textarea>
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-description"></p>
                  </div>
                  <div class="community-form text-center">
                    <button type="submit" class="btn btn-primary submit mt-2">Save</button>
                  </div>
                </form>
              </div>
            </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            //on change country

            $(document).on('submit', 'form#createFrm', function(event) {
                event.preventDefault();
                //clearing the error msg
                $('p.error_container').html("");
                var title = $('div.iti__selected-flag').attr('title');
                // var countycode = $('li.iti__country').attr('data-country-code');
                // alert(countycode);
                // return false;
                var form = $(this);
                var data = new FormData($(this)[0]);
                data.append("c_code", title);
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
                            toastr.success("Community Created successfully!");

                            // Swal.fire({
                            //     position: 'top-end',
                            //     icon: 'success',
                            //     title: 'user Created Successfully',
                            //     showConfirmButton: false,
                            //     timer: 1500
                            //     })
                            window.setTimeout(function() {
                                window.location = "{{ url('/') }}" +
                                    "/teacher/dashboard-community";
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
                $('#mysummernote').summernote({
                height: 150
            });
        });

    </script>
@endpush
