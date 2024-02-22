@extends('layouts.front.master')
@section('content')
    <section class="home-three-slide d-flex align-items-center">
        <div class="container">
            <div class="row ">
                <div class="col-xl-6 col-lg-8 col-md-12 col-12" data-aos="fade-down">
                    <div class="home-three-slide-face">
                        <div class="home-three-slide-text">
                            <h1>Write a Review</h1>
                            <p>Help your favourite Tutor or Institute win the Know Merit Excellence Award 2023</p>
                        </div>
                        <div class="banner-three-content">
                            <div class="card comment-sec">
                                <div class="card-body">
                                    @php
                                    $results = DB::select(DB::raw("SELECT DISTINCT SUBSTRING_INDEX(SUBSTRING_INDEX(tutor_type, ',', n.digit+1), ',', -1) tutor_type FROM tutors INNER JOIN (SELECT 0 digit UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6) n ON LENGTH(REPLACE(tutor_type, ',' , '')) <= LENGTH(tutor_type)-n.digit;"));
                                    $id = Auth::user()->id;
                                            @endphp
                                    <form action="{{ route('write-a-review.create') }}" method="POST" id="createFrm"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden"  name="student_id" value="{{ $id }}" />

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control" id="tutor_type" name="tutor_type">
                                                        <option value="">Select</option>
                                                        @foreach ($results as $re)
                                                        <option {{ $re->tutor_type }} >{{ ucwords(Str($re->tutor_type)) }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-tutor_type"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select class="form-control" id="tutor_name" name="tutor_name">
                                                        <option value="">Select Name</option>
                                                    </select>
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-tutor_name"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea rows="4" class="form-control" name="comment" placeholder="Your Comments" style="padding-left: 10px;"></textarea>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-comment"></p>
                                        <div class="submit-section">
                                            <button class="btn submit-btn submit" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4 col-md-6 col-12" data-aos="fade-up">
                    <div class="girl-slide-img aos">
                        <img class="img-fluid" src="assets/img/slider/home-slider.png" alt>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home-three-trending">
        <div class="container">
            <div class="row">
                <div class="home-three-head section-header-title" data-aos="fade-up">
                    <div class="row align-items-center d-flex justify-content-between">
                        <div class="col-lg-12">
                            <h2>Recent Review</h2>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel home-three-trending-course owl-theme" data-aos="fade-up">
                    @php
                        $write_reviews = Helper::write_reviews();
                        // dd($write_reviews);
                    @endphp
                    @if (count($write_reviews)>0)
                        @foreach ($write_reviews as $key => $row)
                            <div class="trending-three-item">
                                <div class="trending-content-top trending-bg-four">
                                    <div class="trending-three-text">
                                        <div class="profile1">
                                            @if(isset($row->avatar))
                                            <img src="{{ asset('uploads/tutors/' . $row->avatar) }}" alt="img"
                                                class="write-review">
                                                @else
                                                <img src="{{ asset('assets/img/user/av.jpg') }}" alt="img"
                                                class="write-review">
                                                @endif
                                            <h3 class="title instructor-text" style="margin-left: 10px">
                                                {{ $row->first_name }}</h3>
                                        </div>
                                        <p>{!! $row->comment !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h1>No Data Found</h1>
                    @endif
                </div>
            </div>
        </div>
    </section>
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
                            // toastr.success("Created successfully!");

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
        $(document).on('change', '#tutor_type', function() {
            var id = $('#tutor_type').val();
            $.ajax({
                type: "get",
                url: "{{ route('tutore-list') }}",
                data: {
                    'category': id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    // if (data.success == true) {
                    //     $("#tutor_name").empty();
                    //     $("#tutor_name").append('<option value="">Select Name</option>');
                    //     $.each(data.value, function(key, value) {
                    //         $("#tutor_name").append('<option value="' + value.id + '">' + value.name + '</option>');
                    //     });
                    // }
                    if (data.success == true) {
                        $("#tutor_name").empty();
                        $("#tutor_name").append('<option value="">Select Name</option>');

                        $.each(data.value, function(key, value) {
                                var capitalizedName = value.name.replace(/\b\w/g, function (l) {
                            return l.toUpperCase();
                        });
                        $("#tutor_name").append('<option value="' + value.id + '">' + capitalizedName + '</option>');
                        });
                        }
               }
            });
        });
    </script>
@endpush
