@extends('layouts.admin.master1')
@section('content')
<style type="text/css">
.student-list .instructor-list .instructor-content .rating-img,
.instructor-list .instructor-content .course-view {
    margin-bottom: 0px !important;
}

.student-list {
    padding: 10px 20px !important;
    margin-bottom: 15px !important;
}

.instructor-list .instructor-content .rating-img,
.instructor-list .instructor-content .course-view {
    margin-bottom: 0px !important;
}

.student-info {
    padding-left: 5px;
}

.instructor-info i {
    color: #685F78;
}

.instructor-content h6 {
    color: #685F78;
    margin-bottom: 6px !important;
}

.category-box {
    margin-bottom: 11px; 
    padding: 11px;
}
</style>
<div class="col-xl-9 col-lg-8 col-md-12 pt-4">

                    <div class="col-lg-12 col-md-12 d-flex justify-content-start"> 
                        <a href="{{route('admin.course-bank')}}" data-id="{{Auth::user()->id}}" class="btn btn-primary">Student Courses</a>
                        &nbsp; &nbsp; &nbsp; &nbsp; 
                        <a href="{{route('admin.course-bankt')}}" data-id="{{Auth::user()->id}}" class="btn btn-primary">Teacher Courses</a>
                    </div>
                    <div class="col-lg-12 col-md-12 d-flex justify-content-end">
                        <a href="{{ url('admin/add-lession',1) }}" data-id="{{Auth::user()->id}}" class="btn btn-primary">Create Teacher Course</a>
                        <!-- &nbsp; &nbsp; &nbsp; &nbsp; 
                        <a href="{{url('admin/add-lession',0)}}" data-id="{{Auth::user()->id}}" class="btn btn-primary">Create Student Course</a> -->
                    </div>
                    @php
                        $t_courses = DB::table('courses')->where('teacher_id',1)->where('is_user',1)->get();
                    @endphp
                    @if(isset($t_courses))
                    <div class="row">
                        @foreach($t_courses as $s_crs)

                        <div id="instructor-box-dec" class="col-lg-3 col-md-6 d-flex mt-4">
                            <a href="{{url('/admin/course-details12',$s_crs->id)}}">
                                <div class="instructor-box flex-fill ins-box1">
                                    <div id="inst-img" class="instructor-img ins-img">
                                        <!-- <a href="{{url('/teacher/course-details12',$s_crs->id)}}"> -->
                                        <img class="img-fluid" alt="" src="{{asset('uploads/course/'.$s_crs->image)}}">
                                        <!--  </a> -->
                                        <div class="overlay icon">
                                            <!-- <a href="{{url('/teacher/course-details12',$s_crs->id)}}" class="icon" title="User Profile"> -->
                                            <i class="fa fa-pencil"></i>
                                            <!-- </a> -->
                                        </div>
                                    </div>
                            </a>
                            <a href="{{url('/admin/course-details12',$s_crs->id)}}" style="font-size: 16px">
                                <div class="instructor-content">
                                    <div class="text-v">
                                        <h3 style="font-size: 16px">{{$s_crs->title ?? ''}}</h3>
                                        @if(isset($s_crs->short_description))
                                        <h6 style="font-size: 16px">{!! substr($s_crs->short_description,0,50)?? '' !!}...</h6>
                                        @endif
                                    </div>

                                    <div class="instruct-stip d-flex align-items-center">
                                        @php
                                        $total = Helper::PercentageCourse($s_crs->id);
                                        @endphp
                                        <div class="course-stip progress-stip">
                                            @if($total == 0)
                                            <span class="per-cross" style="color: #000!important">{{$total}}%</span>
                                            @else
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{round($total)}}%;" aria-valuenow="{{round($total)}}"
                                                aria-valuemin="0" aria-valuemax="100">{{round($total)}}%</div>
                                            @endif
                                            <!-- <span class="per-cross" style="color: #000!important;font-size: 14px;">0%</span> -->
                                            <!-- <div class="progress-bar bg-success progress-bar-striped active-stip"></div> -->
                                        </div>
                                    </div>
                                </div>
                        </div></a>
                    </div>
                    @endforeach
                    @endif
                </div>
    @endsection
    @push('script')
    <script type="text/javascript">
    // $('.tab-value').click(function() {
    //     var t = $(this).text();
    //     $('#addbtn').html('Add' + t);
    // });
    $(document).ready(function() {
        $(document).on('click', '#student1', function(event) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('teacher.dash1') }}",
                type: "get",
                data: {
                    'active': id,
                },
                success: function(response) {
                    console.log(response);
                    $('#data1').replaceWith(response);
                }
            });
        });
        $(document).on('click', '#video', function(event) {
            $('#addvideo').removeClass('d-none');
            $('#addhome').addClass('d-none');
            $('#addtest').addClass('d-none');
            $('#adddoc').addClass('d-none');
        });
        $(document).on('click', '#home', function(event) {
            $('#addvideo').addClass('d-none');
            $('#addhome').removeClass('d-none');
            $('#addtest').addClass('d-none');
            $('#adddoc').addClass('d-none');
        });
        $(document).on('click', '#test', function(event) {
            $('#addvideo').addClass('d-none');
            $('#addhome').addClass('d-none');
            $('#addtest').removeClass('d-none');
            $('#adddoc').addClass('d-none');
        });
        $(document).on('click', '#doc', function(event) {
            $('#addvideo').addClass('d-none');
            $('#addhome').addClass('d-none');
            $('#addtest').addClass('d-none');
            $('#adddoc').removeClass('d-none');
        });
        $(document).on('click', '#addvideo', function(event) {
            $('#learnMore1').modal('show');
            $('#category').val('video');
            $('#head').text('Add Video');
        });
        $(document).on('click', '#addhome', function(event) {
            $('#learnMore12').modal('show');
            $('#category1').val('homework');
            $('#head1').text('Add HomeWork');
        });
        $(document).on('click', '#addtest', function(event) {
            $('#learnMore12').modal('show');
            $('#category1').val('test');
            $('#head1').text('Add Tests');
        });
        $(document).on('click', '#adddoc', function(event) {
            $('#learnMore12').modal('show');
            $('#category1').val('document');
            $('#head1').text('Add Documents');
        });
        $(document).on('submit', 'form#createFrm', function(event) {
            event.preventDefault();
            //clearing the error msg
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
                        $('.submit').html('Save');
                    }, 2000);
                    //console.log(response);
                    if (response.success == true) {
                        //notify
                        toastr.success("AboutUs Created successfully!");
                        // Swal.fire({
                        //     position: 'top-end',
                        //     icon: 'success',
                        //     title: 'user Created Successfully',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        //     })
                        window.setTimeout(function() {
                            location.reload();
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
        $(document).on('submit', 'form#createFrm1', function(event) {
            event.preventDefault();
            //clearing the error msg
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
                        $('.submit').html('Save');
                    }, 2000);
                    //console.log(response);
                    if (response.success == true) {
                        //notify
                        toastr.success("AboutUs Created successfully!");
                        // Swal.fire({
                        //     position: 'top-end',
                        //     icon: 'success',
                        //     title: 'user Created Successfully',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        //     })
                        window.setTimeout(function() {
                            location.reload();
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

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).on("click","#add-student",function(){
        var id = $(this).attr('data-id');
        var url = '{{url('teacher/add-lession',':id')}}';
        url = url.replace('%3Aid', id);
        $(".pks").attr('href',url);
        $('#add-student-Modal').modal('show');
        return false;
        });
        $("#cancel-btn").on("click", function()
        {
            $('#add-student-Modal').modal('hide');
        })
    </script> -->




    @endpush
