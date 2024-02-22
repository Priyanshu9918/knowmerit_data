@extends('layouts.front.master')
@section('content')
    <!-- <div class="page-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <h1 class="mb-0">Contact Us</h1>
                    </div>
                </div>
            </div>
        </div> -->
    <style>
        .bg-danger,
        .badge-danger {
            background-color: #fbb92e !important;
        }
    </style>
 <!--    <section class="section share-knowledge">
<div class="container">
<div class="row">
<div class="col-md-6">
<div class="knowledge-img aos aos-init aos-animate mt-4" data-aos="fade-up">
<img src="assets/img/joing-us-skill.png" alt="" class="img-fluid">
</div>
</div>
<div class="col-md-6 d-flex align-items-center">
<div class="join-mentor aos aos-init aos-animate" data-aos="fade-up">
<h2>Learn anything from anywhere anytime</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quam dolor fermentum massa viverra congue proin. A volutpat eget ultrices velit nunc orci. Commodo quis integer a felis ac vel mauris a morbi. Scelerisque</p>


</div>
</div>
</div>
</div>
</section> -->
<!-- <div class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">

                <h2 class="text-center">Contact</h2>

            </div>
        </div>
    </div>
</div> -->
    <section class="section share-knowledge">
        <div class="container">
            @php
            $contact_headers = Helper::contact_headers();
        @endphp
        @if (isset($contact_headers))
            <div class="row">
                <div class="col-md-6">
                    <div class="knowledge-img aos aos-init aos-animate mt-4" data-aos="fade-up">
                        <img src="{{ asset('uploads/contact_headers/' . $contact_headers->one_image) }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="join-mentor aos aos-init aos-animate" data-aos="fade-up">
                        <h2>{{ $contact_headers->title }}</h2>
                        <p>{!! $contact_headers->description !!}</p>
                    </div>
                </div>
            </div>
            @else
            <h1>No Data Found</h1>
            @endif
        </div>
    </section>
    <section class="master-section-five page-content">
        <div class="container">
            <div class="master-five-vector">
                <img class="ellipse-right" src="assets/img/bg/master-vector-left.svg" alt="">
            </div>
            <div class="row">
                @php
                    $contact_masters = Helper::contact_masters();
                @endphp
                @if (isset($contact_masters))
                    <div class="col-lg-6 col-sm-12 aos-init aos-animate" data-aos="fade-down">
                        <div class="section-five-sub">
                            <div class="header-five-title">
                                <h2>{{ $contact_masters->title }}</h2>
                                <p>{!! $contact_masters->description !!}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <h1>No Data Found</h1>
                @endif
                <div class="col-lg-6 col-sm-12">
                    <div class="row">
                        @php
                            $contact_sec_fsts = Helper::contact_sec_fsts();
                        @endphp
                        @if (isset($contact_sec_fsts))
                            @foreach ($contact_sec_fsts as $key => $contact)
                                <div class="col-lg-6 col-sm-6 aos-init aos-animate" data-aos="fade-down">
                                    <div class="skill-five-item">
                                        <div class="skill-five-icon">
                                            <img src="{{ asset('uploads/contact_sec_fsts/' . $contact->one_image) }}"
                                                class="bg-danger" alt="Stay motivated">
                                        </div>
                                        <div class="skill-five-content">
                                            <h3>{{ $contact->title }}</h3>
                                            <p>{!! $contact->description !!}
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
        </div>
    </section>
    <div class="page-content" style="padding-top: 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <div class="support-wrap">
                        <h5>Submit a Request</h5>
                        <form action="{{ route('contact-us') }}" method="POST" id="createFrm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" placeholder="Enter Your Full Name" name="name"
                                    id="name">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name"></p>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Enter Your Email Address"
                                    name="email" id="email">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email"></p>
                            </div>
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control" placeholder="Enter Your Subject" name="subject"
                                    id="subject">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-subject"></p>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" placeholder="Description" rows="4" name="description" id="description"></textarea>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-description">
                                </p>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section share-knowledge">
        <div class="container">
            <div class="row">
                @php
                    $contact_sec_scnds = Helper::contact_sec_scnds();
                @endphp
                @if (isset($contact_sec_scnds))
                    <div class="col-md-6">
                        <div class="knowledge-img aos aos-init aos-animate" data-aos="fade-up">
                            <img src="{{ asset('uploads/contact_sec_scnds/' . $contact_sec_scnds->one_image) }}"
                                alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="join-mentor aos aos-init aos-animate" data-aos="fade-up">
                            <h2>{{ $contact_sec_scnds->title }}</h2>
                            <p>{!! $contact_sec_scnds->description !!}</p>

                            <div class="all-btn all-category d-flex align-items-center">

                            </div>
                        </div>
                    </div>
            </div>
        @else
            <h1>No Data Found</h1>
            @endif
        </div>
    </section>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            //on change country
            $('#name').on('keypress', function(e) {
                var $this = $(this);
                var regex = /^[A-Za-z ]+$/;
                var inputChar = String.fromCharCode(e.which);

                if (!regex.test(inputChar)) {
                    e.preventDefault();
                }
            });
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
                            toastr.success("Your request has been submitted!");
                            // redirect to google after 5 seconds
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
@endpush
