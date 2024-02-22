@extends('layouts.front.master')
@section('content')
<section class="section share-knowledge">
    <div class="container">
        <div class="row">
            @php
            $a_points = Helper::aboutuspoints();
            @endphp
              @if(isset($a_points))

                <div class="col-md-6">
                    <div class="knowledge-img aos aos-init aos-animate" data-aos="fade-up">
                    <img src="{{asset('uploads/about/'.$a_points->image)}}" alt="" class="img-fluid">
                    </div>
                </div>
            <div class="col-md-6 d-flex align-items-center">
                <div class="join-mentor aos aos-init aos-animate" data-aos="fade-up">
                    <h2>{{$a_points->title}}</h2>
                    <p>{!!$a_points->description!!}</p>
                </div>
            </div>

            @else
                <h1>No Data Found</h1>
            @endif
            </div>
         {{-- <div class="row">
            <div class="col-md-6">
                <div class="knowledge-img aos aos-init aos-animate" data-aos="fade-up">
                    <img src="assets/img/share.png" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div class="join-mentor aos aos-init aos-animate" data-aos="fade-up">
                    <h2>Want to share your knowledge? Join us a Mentor</h2>
                    <p>High-definition video is video of higher resolution and quality than standard-definition. While
                        there is no standardized meaning for high-definition, generally any video.</p>
                    <ul class="course-list">
                        <li><i class="fa-solid fa-circle-check"></i>Best Courses</li>
                        <li><i class="fa-solid fa-circle-check"></i>Top rated Instructors</li>
                    </ul>

                </div>
            </div>
        </div> --}}
    </div>
</section>
<section class="section master-skill">
    <div class="container">
        <div class="row">
            @if(isset($a_points))
            <div class="col-lg-7 col-md-12">


                <div class="section-header aos aos-init aos-animate" data-aos="fade-up">
                    <div class="section-sub-head">
                        <h2>{{$a_points->m_title}}</h2>
                    </div>
                </div>
                <div class="section-text aos aos-init aos-animate" data-aos="fade-up">
                    {{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic</p> --}}
                  <p>{!!$a_points->m_description!!}</p>

                </div>
            </div>

             <div class="col-lg-5 col-md-12">
             <div class="trust-rating d-flex align-items-center justify-content-center">
                    <div class="rate-head">
                    <h2><span>{{$a_points->m_grade}}</span>+</h2>
                    </div>
                    @php
                        $rating = $a_points->m_rating;
                        $fullStars = floor($rating);
                        $halfStar = $rating - $fullStars >= 0.5;
                    @endphp
                    <div class="rating d-flex align-items-center">
                    <h2 class="d-inline-block average-rating">{{ $rating }}</h2>
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i < $fullStars)
                                <i class="fas fa-star filled"></i> <!-- Full star -->
                            @elseif ($halfStar && $i == $fullStars)
                                <i class="fas fa-star-half-alt filled"></i>
                                <!-- Half star -->
                            @else
                                <i class="fas fa-star"></i> <!-- Empty star -->
                            @endif
                        @endfor
                        </p>
                    </div>
                    <br>

                    </div>
                    <p>{!!$a_points->r_description!!}</p>

</div>

        </div>
        @else
            <h1>No Data Found</h1>
        @endif
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12">
 <div class="career-group aos aos-init aos-animate" data-aos="fade-up">
                    <div class="row section-title">
                        <h2>Your Trusted Edtech Platform for AI-Enabled Learning</h2>
                        @php
                            $a_point = Helper::aboutuspoint();
                        @endphp
                        @if(isset($a_point))
                            @foreach($a_point as $a_pin)
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="certified-group blur-border d-flex">
                                    <div class="get-certified d-flex align-items-center">
                                        <div class="blur-box">
                                            <div class="certified-img ">
                                                <img src="{{asset('uploads/aboutus-point/'.$a_pin->image)}}" alt="" class="img-fluid"
                                                    style="filter: hue-rotate(218deg);">
                                            </div>
                                        </div>
                                        <!-- <p>Stay motivated with engaging instructors</p> -->
                                        <p>{{$a_pin->title}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <h1>No Data Found</h1>
                        @endif
                        {{--<div class="col-lg-6 col-md-6 d-flex">
                            <div class="certified-group blur-border d-flex">
                                <div class="get-certified d-flex align-items-center">
                                    <div class="blur-box">
                                        <div class="certified-img ">
                                            <img src="assets/img/icon/icon-2.svg" alt="" class="img-fluid"
                                                style="filter: hue-rotate(218deg);">
                                        </div>
                                    </div>
                                    <p>Keep up with in the latest in cloud</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 d-flex">
                            <div class="certified-group blur-border d-flex">
                                <div class="get-certified d-flex align-items-center">
                                    <div class="blur-box">
                                        <div class="certified-img ">
                                            <img src="assets/img/icon/icon-3.svg" alt="" class="img-fluid"
                                                style="filter: hue-rotate(218deg);">
                                        </div>
                                    </div>
                                    <p>Get certified with 100+ certification courses</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 d-flex">
                            <div class="certified-group blur-border d-flex">
                                <div class="get-certified d-flex align-items-center">
                                    <div class="blur-box">
                                        <div class="certified-img ">
                                            <img src="assets/img/icon/icon-4.svg" alt="" class="img-fluid"
                                                style="filter: hue-rotate(218deg);">
                                        </div>
                                    </div>
                                    <p>Build skills your way, from labs to courses</p>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                </div>
                </div>
                <div class="col-lg-5 col-md-12 d-flex align-items-end">
                <div class="career-img aos aos-init aos-animate" data-aos="fade-up">
                    <img src="{{asset('uploads/about/'.$a_points->m_image)}}" alt="" class="img-fluid">
                </div>
            </div>
            </div>
        </div>
    </section>








<div class="knowledge-sec">
    <div class="container-fluid">
        <div class="row align-items-center">
                @if(isset($a_points))
            <div class="col-lg-6 col-sm-12 ps-0">
                {{-- <div class="featured-img-1"> --}}
                    <img src="{{asset('uploads/about/'.$a_points->b_image)}}" alt="" class="img-fluid">
                {{-- </div> --}}
            </div>
            <div class="col-lg-6 col-sm-12 aos-init aos-animate" data-aos="fade-up">
                <div class="joing-group">
                    <div class="section-title">
                        <h2>{{$a_points->b_title}}</h2>
                        <div class="joing-section-text">
                            <p class="mb-0">{!!$a_points->b_description!!}</p>
                            </div>
                        </div>
                        {{-- <div class="section-title">
                            <h2>Want to share your knowledge? Join us a Mentor</h2>
                            <div class="joing-section-text">
                                <p class="mb-0">High-definition video is video of higher resolution and quality than
                                    standard-definition. While there is no standardized meaning for high-definition,
                                    generally any video.</p>
                            </div>
                        </div> --}}
                        {{-- <div class="joing-list">
                        <ul>
                            <li data-aos="fade-bottom" class="aos-init aos-animate">
                                <div class="joing-header">
                                    <span class="joing-icon bg-blue">
                                        <img src="assets/img/icon/joing-01.svg" alt="" class="img-fluid"
                                            style="filter: hue-rotate(218deg);">
                                    </span>
                                    <div class="joing-content">
                                        <h5 class="joing-title">Stay motivated with engaging instructors</h5>
                                        <div class="joing-para">
                                            <p>High-definition video is video of higher resolution and quality than
                                                standard-definition.</p>
                                            <p>While there is no standardized meaning for high-definition, generally any
                                                video.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li data-aos="fade-bottom" class="aos-init aos-animate">
                                <div class="joing-header">
                                    <span class="joing-icon bg-yellow">
                                        <img src="assets/img/icon/joing-02.svg" alt="" class="img-fluid"
                                            style="filter: hue-rotate(218deg);">
                                    </span>
                                    <div class="joing-content">
                                        <h5 class="joing-title">Keep up with in the latest in cloud</h5>
                                        <div class="joing-para">
                                            <p>High-definition video is video of higher resolution and quality than
                                                standard-definition.</p>
                                            <p>While there is no standardized meaning for high-definition, generally any
                                                video.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li data-aos="fade-bottom" class="aos-init aos-animate">
                                <div class="joing-header">
                                    <span class="joing-icon bg-green">
                                        <img src="assets/img/icon/joing-03.svg" alt="" class="img-fluid"
                                            style="filter: hue-rotate(218deg);">
                                    </span>
                                    <div class="joing-content aos">
                                        <h5 class="joing-title">Build skills your way, from labs to courses</h5>
                                        <div class="joing-para">
                                            <p>High-definition video is video of higher resolution and quality than
                                                standard-definition.</p>
                                            <p>While there is no standardized meaning for high-definition, generally any
                                                video.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li data-aos="fade-bottom" class="mb-0 aos-init">
                                <div class="joing-header">
                                    <span class="joing-icon bg-orange">
                                        <img src="assets/img/icon/joing-04.svg" alt="" class="img-fluid"
                                            style="filter: hue-rotate(218deg);">
                                    </span>
                                    <div class="joing-content aos">
                                        <h5 class="joing-title">Get certified with 100+ certification courses</h5>
                                        <div class="joing-para">
                                            <p>High-definition video is video of higher resolution and quality than
                                                standard-definition.</p>
                                            <p>While there is no standardized meaning for high-definition, generally any
                                                video.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
        @else
            <h1>No Data Found</h1>
        @endif
    </div>
</div>
@endsection
