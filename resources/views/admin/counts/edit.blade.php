@extends('layouts.admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Count</h4>
                            <form action="{{ route('admin.count.edit', ['id' => base64_encode($count->id)]) }}" method="POST"
                                id="editFrm" enctype="multipart/form-data">
                                @csrf
                                <div class="row gx-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Title</b></label>
                                            <input class="form-control" type="text" name="title" value="{{ $count->title }}"
                                                placeholder="Enter Count Title" />

                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-title"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Expert Tutors</b></label>
                                            <input class="form-control mb-2" type="text" name="expert_tutors" value="{{ $count->expert_tutors }}"
                                                placeholder="Enter  Expert Tutors" />
                                                <input class="form-control" type="number" name="expert_tutors_count" value="{{ $count->expert_tutors_count }}"
                                                placeholder="Enter Count Expert Tutors" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-expert_tutors"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Cetified Courses</b></label>
                                            <input class="form-control mb-2" type="text" name="cetified_courses" value="{{ $count->cetified_courses }}"
                                                placeholder="Enter Cetified Courses" />
                                                <input class="form-control" type="number" name="cetified_courses_count" value="{{ $count->cetified_courses_count }}"
                                                placeholder="Enter Count Cetified Courses" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-cetified_courses"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="form-label"><b>Online students</b></label>
                                                <input class="form-control mb-2" type="text" name="online_students" value="{{ $count->online_students }}"
                                                placeholder="Enter Online students" />
                                                <input class="form-control" type="number" name="online_students_count" value="{{ $count->online_students_count }}"
                                                placeholder="Enter  Count Online students" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-online_students"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="form-label"><b>Online Courses</b></label>
                                                <input class="form-control" type="text" name="online_courses" value="{{ $count->online_courses }}"
                                                placeholder="Enter Online Courses" />
                                                <input class="form-control" type="number" name="online_courses_count" value="{{ $count->online_courses_count }}"
                                                placeholder="Enter Count Online Courses" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-online_courses"></p>
                                            </div>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function() {
                $(document).on('submit', 'form#editFrm', function(event) {
                    event.preventDefault();

                    $('p.error_container').html("");

                    var title = $('div.iti__selected-flag').attr('title');
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
                                $('.submit').html('Update');
                            }, 2000);
                            //console.log(response);
                            if (response.success == true) {

                                //notify
                                toastr.success("count Updated Successfully");
                                // Swal.fire({
                                // position: 'top-end',
                                // icon: 'success',
                                // title: 'User Updated Successfully',
                                // showConfirmButton: false,
                                // timer: 1500
                                // })
                                // redirect to google after 5 seconds
                                window.setTimeout(function() {
                                    window.location = "{{ url('/') }}" +
                                        "/admin/count";
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
