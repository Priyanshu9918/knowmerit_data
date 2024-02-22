@extends('layouts.front.master')
@section('content')
<style>
    #home-Modal .modal-header {
        justify-content:space-between;
    }
    #home-Modal .widget-btn {
    padding: 12px 30px;
}
    .bookasession {
    padding: 0px 0px 0px;
}
.add-course-form {
    padding: 0 6px 6px;
}
.add-course-info .form-group {
    margin-bottom: 8px;
}

.event-blog-main .latest-blog-img img {
    border-radius: 5px;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.latest-blog-img {
    height: 300px;
}
.location-icon-des
{
    display: flex;
    align-items: center;
}
</style>
    <section class="home-three-slide d-flex align-items-center">
        <div class="container">
            @php
                $b_points = Helper::bannerpoints();
            @endphp
            <div class="row ">
                <div class="col-xl-6 col-lg-8 col-md-12 col-12" data-aos="fade-down">
                    <div class="home-three-slide-face">
                        @if ($b_points)
                            <div class="home-three-slide-text">
                                <p>{!! $b_points->description !!}</p>
                            </div>
                        @else
                            <p>No Data Found</p>
                        @endif

                        <div class="banner-content">
                            <form id="homeformsubmit" class="form" action="">
                                <div class="form-inner">
                                    <div class="input-group">
                                        <div class="location-icon-des"><i class="feather-map-pin"></i>
                                        {{-- <input type="email" class="form-control" placeholder="Location"> --}}
                                        <input type="text" class="form-control location-text inputhide" id="pincode"
                                            name="pincode" placeholder="Location"></div>
                                        <input type="hidden" id="lat" name="lat" value="">
                                        <input type="hidden" id="lng" name="lng" value="">
                                        <span class="">
                                            <div class="dropinput">
                                                <input type="text" class="inputhide" name="" id="category" placeholder="Category"
                                                    autocomplete="off">
                                                <input type="hidden" name="category_id" id="category_id">
                                            </div>
                                        </span>
                                        <button class="btn btn-primary sub-btn" id="next_btn0" type="submit"><i
                                                class="fa-solid fa-magnifying-glass"></i></button>
                                        <p style="position:absolute;top: 51px;right: 60px;"
                                            class="text-danger error_container inputhide1 home-input-categ" id="error-category_id"></p>

                                        <p style="position:absolute;top: 51px;" class="text-danger error_container inputhide1"
                                            id="error-pincode"></p>
                                    </div>
                                </div>
                            </form>
                            <div class="col-12" style="width:86%">
                                <span id="product_list"></span>
                            </div>
                        </div>


                        <!-- <div class="banner-content-five cate-mob">
                                                <form id="homeformsubmit" class="form">
                                                    <div class="form-inner-five">
                                                        <div class="input-group">
                                                            <span class="">


                                                                <div class="dropinput">
                                                                    <input type="text" name="" placeholder="Search by Category">
                                                                    <ul style="display: none;">
                                                                        <li>Category</li>
                                                                        <li>Maths</li>
                                                                        <li>Spanish</li>
                                                                        <li>Piano</li>
                                                                        <li>Singing</li>
                                                                    </ul>
                                                                </div>
                                                            </span>
                                                            <div class="home-location-text">
                                                                <i class="feather-map-pin"></i>
                                                                <input type="text" name="">
                                                            </div>
                                                            <button class="btn btn-primary sub-btn" type="submit"><span>
                                                                <i class="fa-solid fa-magnifying-glass"></i></span></button>
                                                        </div>

                                                        <button class="btn btn-primary sub-btn" id="next_btn0" type="submit"><span><i
                                                                    class="fa-solid fa-magnifying-glass"></i></span></button>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-category"></p>

                                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-pincode"></p>
                                                    </div>
                                                </div>
                                            </form>
                                        </div> -->
                    </div>

                </div>


                <div class="col-lg-6 col-12">
                    @if ($b_points)
                        <div class="banner-slider-img">
                            <div class="row">
                                <div class="col-lg-6 align-self-end">
                                    <div class="slider-five-one aos-init aos-animate" data-aos="fade-down">
                                        {{-- <img src="assets/img/slider/slider-01.png" alt=""> --}}
                                        <img src="{{ asset('uploads/managebanner/' . $b_points->one_image) }}"
                                            alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="slider-five-two aos aos-init aos-animate" data-aos="fade-down">
                                        {{-- <img src="assets/img/slider/slider-02.png" alt=""> --}}
                                        <img src="{{ asset('uploads/managebanner/' . $b_points->two_image) }}"
                                            alt="">
                                    </div>
                                </div>

                                <div class="col-lg-6 align-self-end">
                                    <div class="slider-five-one aos-init aos-animate" data-aos="fade-down">
                                        {{-- <img src="assets/img/slider/slider-01.png" alt=""> --}}
                                        <img src="{{ asset('uploads/managebanner/' . $b_points->one_image) }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <p>No Data Found</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="master-skills-sec">
        <div class="container">
            <div class="course-info-two">
                @php
                    $whyknowmerit = DB::table('whyknowmerits')
                        ->where('status', 1)
                        ->get();
                @endphp
                @foreach ($whyknowmerit as $key => $row)
                    @if (isset($row))
                        <div class="row align-items-center">
                            @if ($key % 2 == 0)
                                <div class="col-lg-6 col-md-12 order-lg-0 order-md-0 order-0" data-aos="fade-up">
                                    <div class="join-title-one">
                                        <h2>{{ $row->title }}</h2>
                                        <p>{!! $row->description !!}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 order-lg-1 order-md-1 order-1" data-aos="fade-up">
                                    <div class="join-mentor-img">
                                        <div class="winning-two-one">
                                            <img src="{{ asset('uploads/whyknowmerits/' . $row->one_image) }}" alt
                                                class="img-fluid">
                                        </div>
                                        <div class="joing-icon-award">
                                            <img src="{{ asset('uploads/whyknowmerits/' . $row->two_image) }}" alt
                                                class="joing-icon-one img-fluid">
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-xl-6 col-lg-7 col-md-12 order-lg-2 order-md-3 order-3" data-aos="fade-up">
                                    <div class="join-mentor-img">
                                        <div class="winning-two-two">
                                            <img src="{{ asset('uploads/whyknowmerits/' . $row->one_image) }}" alt
                                                class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="joing-icon-award">
                                        <img src="{{ asset('uploads/whyknowmerits/' . $row->two_image) }}" alt
                                            class="joing-icon-two img-fluid">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-5 col-md-12 order-lg-3 order-md-2 order-2" data-aos="fade-up">
                                    <div class="join-title-middle">
                                        <h2>{{ $row->title }}</h2>
                                        <p>{!! $row->description !!}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <h1>NO DATA FOUND</h1>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @php
        $count_points = Helper::countpoints();
    @endphp

    <section class="goals-section-five">
        @if (isset($count_points))
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-x-5 col-lg-5 col-md-12 col-sm-12" data-aos="fade-down">
                        <div class="header-five-title mb-0">
                            <h2 class="mb-0">{{ $count_points->title }}</h2>
                        </div>

                    </div>
                    <div class="col-x-7 col-lg-7 col-12">
                        <div class="row text-center counter-block">
                            <div class="col-md-3 col-6">
                                <div class="counter">
                                    <i class="fa fa-users fa-2x"></i>
                                    <h2 class="timer count-title count-number"
                                        data-to="{{ $count_points->expert_tutors_count }}" data-speed="1500"></h2>
                                    <p class="count-text ">{{ $count_points->expert_tutors }}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="counter">
                                    <i class="fa fa-certificate fa-2x"></i>
                                    <h2 class="timer count-title count-number"
                                        data-to="{{ $count_points->cetified_courses_count }}" data-speed="1500"></h2>
                                    <p class="count-text ">{{ $count_points->cetified_courses }}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="counter">
                                    <i class="fa fa-book fa-2x"></i>
                                    <h2 class="timer count-title count-number"
                                        data-to="{{ $count_points->online_courses_count }}" data-speed="1500"></h2>
                                    <p class="count-text ">{{ $count_points->online_courses }}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="counter">
                                    <i class="fa fa-users fa-2x"></i>
                                    <h2 class="timer count-title count-number"
                                        data-to="{{ $count_points->online_students_count }}" data-speed="1500"></h2>
                                    <p class="count-text ">{{ $count_points->online_students }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @else
            <p>NO DATA FOUND</p>
        @endif
    </section>
    <section class="testimonial-three">
        <div class="container">
            <div class="testimonial-pattern">
                <img class="pattern-left img-fluid" alt src="assets/img/bg/pattern-05.svg">
                <img class="pattern-right img-fluid" alt src="assets/img/bg/pattern-06.svg">
            </div>
            <div class="testimonial-three-content">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-12 col-md-12" data-aos="fade-down">
                        <div class="become-content">
                            <h2 class="aos-init aos-animate">Our Happy Parents!</h2>
                            <h4 class="aos-init aos-animate">We are a very happy because we have a happy customer</h4>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12" data-aos="fade-down">
                        <div class="swiper-testimonial-three">
                            @php
                                $y_points = Helper::testimonialspoint();

                            @endphp

                            <div class="swiper-wrapper">
                                @if (isset($y_points))
                                    @foreach ($y_points as $a_points)
                                        <div class="swiper-slide">
                                            <div class="testimonial-item-five">
                                                <div class="testimonial-quote">
                                                    <img src="{{ asset('uploads/testimonial/' . $a_points->image) }}"
                                                        alt="" class="quote img-fluid">
                                                </div>
                                                <div class="testimonial-content">
                                                    <p>{!! $a_points->description !!}</p>
                                                </div>
                                                <div class="testimonial-ratings">

                                                    <div class="rating">
                                                        @php
                                                            $rating = $a_points->rating; // Assuming $a_points->rating contains the rating value.
                                                            $fullStars = floor($rating); // Get the whole number of full stars.
                                                            $halfStar = $rating - $fullStars >= 0.5; // Check if there's a half star.
                                                        @endphp

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

                                                        <p class="d-inline-block">{{ $rating }}<span>ratings</span>
                                                        </p>
                                                    </div>


                                                </div>
                                                <div class="testimonial-users">
                                                    <!-- <div class="imgbx">
                                                                                                <img class="img-fluid" alt src="assets/img/profiles/avatar-02.jpg">
                                                                                                </div> -->
                                                    <div class="d-block">
                                                        <h6>{{ $a_points->name }}</h6>
                                                        <p>{{ $a_points->location }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h1>No Data Found</h1>
                                @endif

                            </div>

                            <div class="testimonial-bottom-nav">
                                <div class="slide-next-btn testimonial-next-pre"><i class="fas fa-arrow-left"></i></div>
                                <div class="slide-prev-btn testimonial-next-pre"><i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  <section class="home-three-courses">
                                                <div class="container">
                                                    <div class="favourite-course-sec">
                                                        <div class="row">
                                                            <div class="home-three-head section-header-title" data-aos="fade-up">
                                                                <div class="row align-items-center d-flex justify-content-between">
                                                                    <div class="col-lg-6 col-sm-8">
                                                                        <h2>Experience Know Merit Live Classes</h2>
                                                                    </div>
                                                                    <div class="col-lg-6 col-sm-4">
                                                                        <div class="see-all">
                                                                            <a href="#">See all<span class="see-all-icon"><i
                                                                                        class="fas fa-arrow-right"></i></span></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="all-corses-main">
                                                                <div class="tab-content">
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane fade active show" id="alltab" role="tabpanel">
                                                                            <div class="all-course">
                                                                                <div class="row">
                                                                                    <div class="col-xl-4 col-lg-6 col-md-6 col-12" data-aos="fade-up">
                                                                                        <div class="instructor-list flex-fill">
                                                                                            <div class="instructor-img">
                                                                                                <a href="#">
                                                                                                    <img class="img-fluid" alt=""
                                                                                                        src="assets/img/user/user11.jpg">
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="instructor-content">
                                                                                                <h5>Rolands R</h5>
                                                                                                <h6>Instructor</h6>
                                                                                                <div class="rating mb-2">
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star"></i>
                                                                                                    <span class="d-inline-block average-rating"><span>4.0</span>
                                                                                                        (15)</span>
                                                                                                </div>
                                                                                                <div class="instructor-info">

                                                                                                    <div class="course-view d-flex align-items-center ms-0">
                                                                                                        <img src="assets/img/icon/icon-02.svg" class="me-1"
                                                                                                            alt="">
                                                                                                        <p>Tue, 8 Aug at 10:15am IST</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="container1">
                                                                                                    <p class="class1">Class <br>Start In</p>
                                                                                                    <div class="day">Days<span class="days"></span></div>
                                                                                                    <div>Hours<span class="hours"></span></div>
                                                                                                    <div>Min<span class="minutes"></span></div>
                                                                                                    <div>Sec<span class="seconds"></span></div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="price-three-group d-flex align-items-center justify-content-between">
                                                                                                    <div class="price-three-view d-flex align-items-center mt-4">
                                                                                                        <div class="course-price-three">
                                                                                                            <h3 class="free">Free Trial Class</h3>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="all-btn all-category d-flex align-items-center">
                                                                                                        <a href="#" class="btn btn-primary">Register</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-xl-4 col-lg-6 col-md-6 col-12" data-aos="fade-up">
                                                                                        <div class="instructor-list flex-fill">
                                                                                            <div class="instructor-img">
                                                                                                <a href="#">
                                                                                                    <img class="img-fluid" alt=""
                                                                                                        src="assets/img/user/user11.jpg">
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="instructor-content">
                                                                                                <h5>Rolands R</h5>
                                                                                                <h6>Instructor</h6>
                                                                                                <div class="rating mb-2">
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star"></i>
                                                                                                    <span class="d-inline-block average-rating"><span>4.0</span>
                                                                                                        (15)</span>
                                                                                                </div>
                                                                                                <div class="instructor-info">

                                                                                                    <div class="course-view d-flex align-items-center ms-0">
                                                                                                        <img src="assets/img/icon/icon-02.svg" class="me-1"
                                                                                                            alt="">
                                                                                                        <p>Tue, 8 Aug at 10:15am IST</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="container1">
                                                                                                    <p class="class1">Class <br>Start In</p>
                                                                                                    <div class="day">Days<span class="days"></span></div>
                                                                                                    <div>Hours<span class="hours"></span></div>
                                                                                                    <div>Min<span class="minutes"></span></div>
                                                                                                    <div>Sec<span class="seconds"></span></div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="price-three-group d-flex align-items-center justify-content-between">
                                                                                                    <div class="price-three-view d-flex align-items-center mt-4">
                                                                                                        <div class="course-price-three">
                                                                                                            <h3 class="free">Free Trial Class</h3>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="all-btn all-category d-flex align-items-center">
                                                                                                        <a href="#" class="btn btn-primary">Register</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-xl-4 col-lg-6 col-md-6 col-12" data-aos="fade-up">
                                                                                        <div class="instructor-list flex-fill">
                                                                                            <div class="instructor-img">
                                                                                                <a href="#">
                                                                                                    <img class="img-fluid" alt=""
                                                                                                        src="assets/img/user/user.jpg">
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="instructor-content">
                                                                                                <h5>Rolands R</h5>
                                                                                                <h6>Instructor</h6>
                                                                                                <div class="rating mb-2">
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star"></i>
                                                                                                    <span class="d-inline-block average-rating"><span>4.0</span>
                                                                                                        (15)</span>
                                                                                                </div>
                                                                                                <div class="instructor-info">

                                                                                                    <div class="course-view d-flex align-items-center ms-0">
                                                                                                        <img src="assets/img/icon/icon-02.svg" class="me-1"
                                                                                                            alt="">
                                                                                                        <p>Tue, 8 Aug at 10:15am IST</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="container1">
                                                                                                    <p class="class1">Class <br>Start In</p>
                                                                                                    <div class="day">Days<span class="days"></span></div>
                                                                                                    <div>Hours<span class="hours"></span></div>
                                                                                                    <div>Min<span class="minutes"></span></div>
                                                                                                    <div>Sec<span class="seconds"></span></div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="price-three-group d-flex align-items-center justify-content-between">
                                                                                                    <div class="price-three-view d-flex align-items-center mt-4">
                                                                                                        <div class="course-price-three">
                                                                                                            <h3 class="free">Free Trial Class</h3>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="all-btn all-category d-flex align-items-center">
                                                                                                        <a href="#" class="btn btn-primary">Register</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-xl-4 col-lg-6 col-md-6 col-12" data-aos="fade-up">
                                                                                        <div class="instructor-list flex-fill">
                                                                                            <div class="instructor-img">
                                                                                                <a href="#">
                                                                                                    <img class="img-fluid" alt=""
                                                                                                        src="assets/img/user/user4.jpg">
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="instructor-content">
                                                                                                <h5>Rolands R</h5>
                                                                                                <h6>Instructor</h6>
                                                                                                <div class="rating mb-2">
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star"></i>
                                                                                                    <span class="d-inline-block average-rating"><span>4.0</span>
                                                                                                        (15)</span>
                                                                                                </div>
                                                                                                <div class="instructor-info">

                                                                                                    <div class="course-view d-flex align-items-center ms-0">
                                                                                                        <img src="assets/img/icon/icon-02.svg" class="me-1"
                                                                                                            alt="">
                                                                                                        <p>Tue, 8 Aug at 10:15am IST</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="container1">
                                                                                                    <p class="class1">Class <br>Start In</p>
                                                                                                    <div class="day">Days<span class="days"></span></div>
                                                                                                    <div>Hours<span class="hours"></span></div>
                                                                                                    <div>Min<span class="minutes"></span></div>
                                                                                                    <div>Sec<span class="seconds"></span></div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="price-three-group d-flex align-items-center justify-content-between">
                                                                                                    <div class="price-three-view d-flex align-items-center mt-4">
                                                                                                        <div class="course-price-three">
                                                                                                            <h3 class="free">Free Trial Class</h3>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="all-btn all-category d-flex align-items-center">
                                                                                                        <a href="#" class="btn btn-primary">Register</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-xl-4 col-lg-6 col-md-6 col-12" data-aos="fade-up">
                                                                                        <div class="instructor-list flex-fill">
                                                                                            <div class="instructor-img">
                                                                                                <a href="#">
                                                                                                    <img class="img-fluid" alt=""
                                                                                                        src="assets/img/user/user2.jpg">
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="instructor-content">
                                                                                                <h5>Rolands R</h5>
                                                                                                <h6>Instructor</h6>
                                                                                                <div class="rating mb-2">
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star"></i>
                                                                                                    <span class="d-inline-block average-rating"><span>4.0</span>
                                                                                                        (15)</span>
                                                                                                </div>
                                                                                                <div class="instructor-info">

                                                                                                    <div class="course-view d-flex align-items-center ms-0">
                                                                                                        <img src="assets/img/icon/icon-02.svg" class="me-1"
                                                                                                            alt="">
                                                                                                        <p>Tue, 8 Aug at 10:15am IST</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="container1">
                                                                                                    <p class="class1">Class <br>Start In</p>
                                                                                                    <div class="day">Days<span class="days"></span></div>
                                                                                                    <div>Hours<span class="hours"></span></div>
                                                                                                    <div>Min<span class="minutes"></span></div>
                                                                                                    <div>Sec<span class="seconds"></span></div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="price-three-group d-flex align-items-center justify-content-between">
                                                                                                    <div class="price-three-view d-flex align-items-center mt-4">
                                                                                                        <div class="course-price-three">
                                                                                                            <h3 class="free">Free Trial Class</h3>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="all-btn all-category d-flex align-items-center">
                                                                                                        <a href="#" class="btn btn-primary">Register</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-xl-4 col-lg-6 col-md-6 col-12" data-aos="fade-up">
                                                                                        <div class="instructor-list flex-fill">
                                                                                            <div class="instructor-img">
                                                                                                <a href="#">
                                                                                                    <img class="img-fluid" alt=""
                                                                                                        src="assets/img/user/user3.jpg">
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="instructor-content">
                                                                                                <h5>Rolands R</h5>
                                                                                                <h6>Instructor</h6>
                                                                                                <div class="rating mb-2">
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star filled"></i>
                                                                                                    <i class="fas fa-star"></i>
                                                                                                    <span class="d-inline-block average-rating"><span>4.0</span>
                                                                                                        (15)</span>
                                                                                                </div>
                                                                                                <div class="instructor-info">

                                                                                                    <div class="course-view d-flex align-items-center ms-0">
                                                                                                        <img src="assets/img/icon/icon-02.svg" class="me-1"
                                                                                                            alt="">
                                                                                                        <p>Tue, 8 Aug at 10:15am IST</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="container1">
                                                                                                    <p class="class1">Class <br>Start In</p>
                                                                                                    <div class="day">Days<span class="days"></span></div>
                                                                                                    <div>Hours<span class="hours"></span></div>
                                                                                                    <div>Min<span class="minutes"></span></div>
                                                                                                    <div>Sec<span class="seconds"></span></div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="price-three-group d-flex align-items-center justify-content-between">
                                                                                                    <div class="price-three-view d-flex align-items-center mt-4">
                                                                                                        <div class="course-price-three">
                                                                                                            <h3 class="free">Free Trial Class</h3>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="all-btn all-category d-flex align-items-center">
                                                                                                        <a href="#" class="btn btn-primary">Register</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section> -->
    <!--  <section class="about-section">
                                                  <div class="container">
                                                    <div class="row">
                                                      <div class="col-lg-6 wow fadeInLeft order-lg-1 order-xs-2 order-sm-2" data-aos="fade-up">
                                                        <div class="header-two-title">
                                                          <h2 class="mb-0">Get Trained By Experts & Professionals Around the World</h2>
                                                        </div>
                                                        <div class="header-two-title">
                                                          <p class="about-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quam dolor fermentum massa viverra congue proin. A volutpat eget ultrices velit nunc orci. Commodo quis integer a felis ac vel mauris a morbi. Scelerisque nunc accumsan elementum aenean nisl lacinia. Congue enim aliquet ac vitae turpis. Neque, bibendum imperdiet sed ullamcorper morbi amet. Facilisi odio amet, nunc quam ut nulla purus adipiscing pharetra.</p>
                                                          <div class="about-button more-details">
                                                            <a href="#" class="discover-btn">Learn more <i class="fas fa-arrow-right ms-2"></i></a>
                                                          </div>
                                                          <div class="about-button more-details">
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-lg-6 order-lg-2 order-xs-1 order-sm-1">
                                                        <div class="stylist-gallery">
                                                          <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12" data-aos="fade-down">
                                                              <div class="about-image count-one d-flex align-items-center justify-content-center flex-fill project-details">
                                                                <div class="about-count">
                                                                  <div class="course-img">
                                                                    <img src="assets/img/icon/count-one.svg" alt>
                                                                  </div>
                                                                  <div class="count-content-three course-count ms-0">
                                                                    <h4><span class="counterUp">10</span>K</h4>
                                                                    <p class="mb-0">Online Courses</p>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12" data-aos="fade-down">
                                                              <div class="about-image count-two d-flex align-items-center justify-content-center flex-fill project-details">
                                                                <div class="about-count">
                                                                  <div class="course-img">
                                                                    <img src="assets/img/icon/count-two.svg" alt>
                                                                  </div>
                                                                  <div class="count-content-three course-count ms-0">
                                                                    <h4><span class="counterUp">215</span>+</h4>
                                                                    <p class="mb-0">Expert Tutors</p>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12" data-aos="fade-right" data-wow-delay="1.5">
                                                              <div class="about-image count-three d-flex align-items-center justify-content-center flex-fill project-details">
                                                                <div class="about-count">
                                                                  <div class="course-img">
                                                                    <img src="assets/img/icon/count-three.svg" alt>
                                                                  </div>
                                                                  <div class="count-content-three course-count ms-0">
                                                                    <h4><span class="counterUp">10</span>K</h4>
                                                                    <p class="mb-0">Ceritified Courses</p>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12" data-aos="fade-left" data-wow-delay="0.5">
                                                              <div class="about-image count-four d-flex align-items-center justify-content-center flex-fill project-details">
                                                                <div class="about-count">
                                                                  <div class="course-img">
                                                                    <img src="assets/img/icon/count-four.svg" alt>
                                                                  </div>
                                                                  <div class="count-content-three course-count ms-0">
                                                                    <h4><span class="counterUp">10</span>K</h4>
                                                                    <p class="mb-0">Online Students</p>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </section> -->

    <section style="overflow: hidden;max-height: 600px; margin: auto;background: #000;">
        <div class="maindiv" style="transform: rotate(-6deg); margin-top: -105px;">
            @php
                $c_points1 = Helper::categoriespoints();
            @endphp

            <div class="container_ds ">
                @if (isset($c_points1))
                    @foreach ($c_points1 as $c_point)
                        <div class="panel1 box_ds">
                            <a href="#">
                                <img src="{{ asset('uploads/categories/' . $c_point->image) }}" alt="">
                                <span class="title_ds">{{ $c_point->name }}</span>
                            </a>
                        </div>
                    @endforeach
                @else
                    <h1>No Data Found</h1>
                @endif
            </div>

            @php
                $c_points2 = Helper::categoriespoints();
            @endphp

            <div class="container_ds " style="direction: rtl;">
                @if (isset($c_points2))
                    @foreach ($c_points2 as $c_point)
                        <div class="panel2 box_ds">
                            <a href="#">
                                <img src="{{ asset('uploads/categories/' . $c_point->image) }}" alt="">
                                <span class="title_ds">{{ $c_point->name }}</span>
                            </a>
                        </div>
                    @endforeach
                @else
                    <h1>No Data Found</h1>
                @endif

            </div>


            @php
                $c_points3 = Helper::categoriespoints();
            @endphp

            <div class="container_ds ">
                @if (isset($c_points3))
                    @foreach ($c_points3 as $c_point)
                        <div class="panel3 box_ds">
                            <a href="#">
                                <img src="{{ asset('uploads/categories/' . $c_point->image) }}" alt="">
                                <span class="title_ds">{{ $c_point->name }}</span>
                            </a>
                        </div>
                    @endforeach
                @else
                    <h1>No Data Found</h1>
                @endif

            </div>

            @php
                $c_points4 = Helper::categoriespoints();
            @endphp

            <div class="container_ds " style="direction: rtl;">
                @if (isset($c_points4))
                    @foreach ($c_points4 as $c_point)
                        <div class="panel4 box_ds">
                            <a href="#">
                                <img src="{{ asset('uploads/categories/' . $c_point->image) }}" alt="">
                                <span class="title_ds">{{ $c_point->name }}</span>
                            </a>
                        </div>
                    @endforeach
                @else
                    <h1>No Data Found</h1>
                @endif

            </div>
        </div>
    </section>
    {{-- @php
    $c_points = Helper::categoriespoints();
    @endphp

    <div class="container_ds ">
        @if (isset($c_points))
        @foreach ($c_points as $c_point)
        <div class="panel1 box_ds">
            <a href="#">
                <img src="{{ asset('uploads/categories/' . $c_point->image) }}" alt="">
                <span class="title_ds">{{ $c_point->name}}</span>
            </a>
        </div>
        @endforeach
        @else
            <h1>No Data Found</h1>
        @endif --}}
    <section class="gallery-three d-none">
        <div class="container-fluid">
            <div class="mb-5 text-center">
                <h2 class="text-white">Choose Favourite Course from Top Category</h2>
            </div>

            <div class="courses-gallery-three-sec">
                <main>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/basic-computer.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Basic Computer</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/chess.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Chess</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/cooking.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Cooking</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/driving.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Driving</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/economics.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Economics</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/math.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Math</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/music1.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Music</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/musical-keyword.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Musical</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/music-reading.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Music Reading</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/photoshop.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Photoshop</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/satastics.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Statistics</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/singing.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Singing</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/swimming.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Swimming</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/uklele.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Ukulele</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/vollin.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Violin</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/acting.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Acting</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/yoga.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Yoga</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/drawing.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Drawing</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
                <div class="main2">
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/basic-computer.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Basic Computer</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/chess.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Chess</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/cooking.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Cooking</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/driving.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Driving</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/economics.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Economics</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/math.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Math</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/music1.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Music</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/musical-keyword.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Musical</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/music-reading.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Music Reading</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/photoshop.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Photoshop</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/satastics.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Statistics</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/singing.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Singing</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/swimming.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Swimming</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/uklele.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Ukulele</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/vollin.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Violin</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/acting.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Acting</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/yoga.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Yoga</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/drawing.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Drawing</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="main3">
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/basic-computer.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Basic Computer</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/chess.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Chess</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/cooking.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Cooking</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/driving.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Driving</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/economics.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Economics</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/math.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Math</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/music1.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Music</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/musical-keyword.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Musical</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/music-reading.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Music Reading</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/photoshop.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Photoshop</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/satastics.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Statistics</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/singing.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Singing</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/swimming.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Swimming</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/uklele.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Ukulele</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/vollin.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Violin</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/acting.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Acting</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/yoga.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Yoga</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="gallery-three-img-item">
                            <div class="content-three-main">
                                <div class="gallery-img">
                                    <img src="assets/img/category/drawing.jpg" alt="Instructor">
                                </div>
                                <div class="content-three-overlay">
                                    <div class="content-three-text">
                                        <div>
                                            <p>Drawing</p>
                                        </div>
                                        <div>
                                            <a href="#" class="content-three-arrows">
                                                <span><i class="fas fa-arrow-right"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="home-three-favourite">
                                                  <div class="container">
                                                    <div class="row">
                                                      <div class="container">
                                                        <div class="home-three-head section-header-title" data-aos="fade-up">
                                                          <div class="row align-items-center d-flex justify-content-between">
                                                            <div class="col-lg-8 col-sm-12">
                                                              <h2>Choose Favourite Course from Top Category</h2>
                                                            </div>
                                                            <div class="col-lg-4 col-sm-12">
                                                              <div class="see-all">
                                                                <a href="#">See all<span class="see-all-icon"><i class="fas fa-arrow-right"></i></span></a>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="owl-carousel home-three-favourite-carousel owl-theme aos">
                                                          <div class="favourite-box" data-aos="fade-down">
                                                            <div class="favourite-item flex-fill">
                                                              <div class="categories-icon">
                                                                <img class="img-fluid" src="assets/img/category/category-1.svg" alt="Angular Development">
                                                              </div>
                                                              <div class="categories-content course-info">
                                                                <h3>Angular Development</h3>
                                                              </div>
                                                              <div class="course-instructors">
                                                                <div class="instructors-info">
                                                                  <p class="me-4">Instructors</p>
                                                                  <ul class="instructors-list">
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 1"><img src="assets/img/profiles/avatar-01.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 2"><img src="assets/img/profiles/avatar-02.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 3"><img src="assets/img/profiles/avatar-03.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li class="more-set">
                                                                      <a href="#">80+</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="favourite-box" data-aos="fade-down">
                                                            <div class="favourite-item flex-fill">
                                                              <div class="categories-icon">
                                                                <img class="img-fluid" src="assets/img/category/category-2.svg" alt="Pyhton Development">
                                                              </div>
                                                              <div class="categories-content course-info">
                                                                <h3>Pyhton Development</h3>
                                                              </div>
                                                              <div class="course-instructors">
                                                                <div class="instructors-info">
                                                                  <p class="me-4">Instructors</p>
                                                                  <ul class="instructors-list">
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 1"><img src="assets/img/profiles/avatar-01.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 2"><img src="assets/img/profiles/avatar-02.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 3"><img src="assets/img/profiles/avatar-03.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li class="more-set">
                                                                      <a href="#">80+</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="favourite-box" data-aos="fade-down">
                                                            <div class="favourite-item flex-fill">
                                                              <div class="categories-icon">
                                                                <img class="img-fluid" src="assets/img/category/category-3.svg" alt="NODE JS Development">
                                                              </div>
                                                              <div class="categories-content course-info">
                                                                <h3>NODE JS Development</h3>
                                                              </div>
                                                              <div class="course-instructors">
                                                                <div class="instructors-info">
                                                                  <p class="me-4">Instructors</p>
                                                                  <ul class="instructors-list">
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 1"><img src="assets/img/profiles/avatar-01.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 2"><img src="assets/img/profiles/avatar-02.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 3"><img src="assets/img/profiles/avatar-03.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li class="more-set">
                                                                      <a href="#">80+</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="favourite-box" data-aos="fade-down">
                                                            <div class="favourite-item flex-fill">
                                                              <div class="categories-icon">
                                                                <img class="img-fluid" src="assets/img/category/category-4.svg" alt="NODE JS Development">
                                                              </div>
                                                              <div class="categories-content course-info">
                                                                <h3>NODE JS Development</h3>
                                                              </div>
                                                              <div class="course-instructors">
                                                                <div class="instructors-info">
                                                                  <p class="me-4">Instructors</p>
                                                                  <ul class="instructors-list">
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 1"><img src="assets/img/profiles/avatar-01.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 2"><img src="assets/img/profiles/avatar-02.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 3"><img src="assets/img/profiles/avatar-03.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li class="more-set">
                                                                      <a href="#">80+</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="favourite-box" data-aos="fade-down">
                                                            <div class="favourite-item flex-fill">
                                                              <div class="categories-icon">
                                                                <img class="img-fluid" src="assets/img/category/category-5.svg" alt="Angular Development">
                                                              </div>
                                                              <div class="categories-content course-info">
                                                                <h3>Laravel Development</h3>
                                                              </div>
                                                              <div class="course-instructors">
                                                                <div class="instructors-info">
                                                                  <p class="me-4">Instructors</p>
                                                                  <ul class="instructors-list">
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 1"><img src="assets/img/profiles/avatar-01.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 2"><img src="assets/img/profiles/avatar-02.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 3"><img src="assets/img/profiles/avatar-03.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li class="more-set">
                                                                      <a href="#">80+</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="favourite-box" data-aos="fade-down">
                                                            <div class="favourite-item flex-fill">
                                                              <div class="categories-icon">
                                                                <img class="img-fluid" src="assets/img/category/category-6.svg" alt="Docker Development">
                                                              </div>
                                                              <div class="categories-content course-info">
                                                                <h3>Docker Development</h3>
                                                              </div>
                                                              <div class="course-instructors">
                                                                <div class="instructors-info">
                                                                  <p class="me-4">Instructors</p>
                                                                  <ul class="instructors-list">
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 1"><img src="assets/img/profiles/avatar-01.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 2"><img src="assets/img/profiles/avatar-02.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 3"><img src="assets/img/profiles/avatar-03.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li class="more-set">
                                                                      <a href="#">80+</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="favourite-box" data-aos="fade-down">
                                                            <div class="favourite-item flex-fill">
                                                              <div class="categories-icon">
                                                                <img class="img-fluid" src="assets/img/category/category-2.svg" alt="Pyhton Development">
                                                              </div>
                                                              <div class="categories-content course-info">
                                                                <h3>Pyhton Development</h3>
                                                              </div>
                                                              <div class="course-instructors">
                                                                <div class="instructors-info">
                                                                  <p class="me-4">Instructors</p>
                                                                  <ul class="instructors-list">
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 1"><img src="assets/img/profiles/avatar-01.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 2"><img src="assets/img/profiles/avatar-02.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 3"><img src="assets/img/profiles/avatar-03.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li class="more-set">
                                                                      <a href="#">80+</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="favourite-box" data-aos="fade-down">
                                                            <div class="favourite-item flex-fill">
                                                              <div class="categories-icon">
                                                                <img class="img-fluid" src="assets/img/category/category-3.svg" alt="NODE JS Development">
                                                              </div>
                                                              <div class="categories-content course-info">
                                                                <h3>NODE JS Development</h3>
                                                              </div>
                                                              <div class="course-instructors">
                                                                <div class="instructors-info">
                                                                  <p class="me-4">Instructors</p>
                                                                  <ul class="instructors-list">
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 1"><img src="assets/img/profiles/avatar-01.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 2"><img src="assets/img/profiles/avatar-02.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 3"><img src="assets/img/profiles/avatar-03.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li class="more-set">
                                                                      <a href="#">80+</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="favourite-box" data-aos="fade-down">
                                                            <div class="favourite-item flex-fill">
                                                              <div class="categories-icon">
                                                                <img class="img-fluid" src="assets/img/category/category-4.svg" alt="NODE JS Development">
                                                              </div>
                                                              <div class="categories-content course-info">
                                                                <h3>NODE JS Development</h3>
                                                              </div>
                                                              <div class="course-instructors">
                                                                <div class="instructors-info">
                                                                  <p class="me-4">Instructors</p>
                                                                  <ul class="instructors-list">
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 1"><img src="assets/img/profiles/avatar-01.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 2"><img src="assets/img/profiles/avatar-02.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 3"><img src="assets/img/profiles/avatar-03.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li class="more-set">
                                                                      <a href="#">80+</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="favourite-box" data-aos="fade-down">
                                                            <div class="favourite-item flex-fill">
                                                              <div class="categories-icon">
                                                                <img class="img-fluid" src="assets/img/category/category-5.svg" alt="Angular Development">
                                                              </div>
                                                              <div class="categories-content course-info">
                                                                <h3>Laravel Development</h3>
                                                              </div>
                                                              <div class="course-instructors">
                                                                <div class="instructors-info">
                                                                  <p class="me-4">Instructors</p>
                                                                  <ul class="instructors-list">
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 1"><img src="assets/img/profiles/avatar-01.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 2"><img src="assets/img/profiles/avatar-02.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 3"><img src="assets/img/profiles/avatar-03.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li class="more-set">
                                                                      <a href="#">80+</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                          <div class="favourite-box" data-aos="fade-down">
                                                            <div class="favourite-item flex-fill">
                                                              <div class="categories-icon">
                                                                <img class="img-fluid" src="assets/img/category/category-6.svg" alt="Docker Development">
                                                              </div>
                                                              <div class="categories-content course-info">
                                                                <h3>Docker Development</h3>
                                                              </div>
                                                              <div class="course-instructors">
                                                                <div class="instructors-info">
                                                                  <p class="me-4">Instructors</p>
                                                                  <ul class="instructors-list">
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 1"><img src="assets/img/profiles/avatar-01.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 2"><img src="assets/img/profiles/avatar-02.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li>
                                                                      <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="leader 3"><img src="assets/img/profiles/avatar-03.jpg" alt="img"></a>
                                                                    </li>
                                                                    <li class="more-set">
                                                                      <a href="#">80+</a>
                                                                    </li>
                                                                  </ul>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </section> -->
    <!-- @php
        $count_points = Helper::countpoints();
    @endphp -->

    <!-- <section class="goals-section-five">
                                                @if (isset($count_points))
    <div class="container">
                                                        <div class="row align-items-center">
                                                            <div class="col-x-5 col-lg-5 col-md-12 col-sm-12" data-aos="fade-down">
                                                                <div class="header-five-title mb-0">
                                                                    <h2 class="mb-0">{{ $count_points->title }}</h2>
                                                                </div>

                                                            </div>
                                                            <div class="col-x-7 col-lg-7 col-md-12 col-sm-12">
                                                                <div class="row text-center align-items-center">
                                                                    <div class="col-lg-3 col-3" data-aos="fade-down">
                                                                        <div class="goals-count-five goals-five-one">
                                                                            <div class="goals-content-five course-count ms-0">
                                                                                <h4><span class="counterUp">{{ $count_points->expert_tutors_count }}</span></h4>
                                                                                <p class="mb-0">{{ $count_points->expert_tutors }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-3" data-aos="fade-down">
                                                                        <div class="goals-count-five goals-five-two">
                                                                            <div class="goals-content-five course-count ms-0">
                                                                                <h4><span class="counterUp">{{ $count_points->cetified_courses_count }}</span>
                                                                                </h4>
                                                                                <p class="mb-0">{{ $count_points->cetified_courses }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-3" data-aos="fade-down">
                                                                        <div class="goals-count-five goals-five-three">
                                                                            <div class="goals-content-five course-count ms-0">
                                                                                <h4><span class="counterUp">{{ $count_points->online_courses_count }}</span>+
                                                                                </h4>
                                                                                <p class="mb-0">{{ $count_points->online_courses }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-3" data-aos="fade-down">
                                                                        <div class="goals-count-five goals-five-four goals-five-last">
                                                                            <div class="goals-content-five course-count ms-0">
                                                                                <h4><span class="counterUp">{{ $count_points->online_students_count }}</span>
                                                                                </h4>
                                                                                <p class="mb-0">{{ $count_points->online_students }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
@else
    <p>NO DATA FOUND</p>
    @endif
                                            </section> -->

    <!-- <section class="master-skills-sec">
                                                <div class="container">
                                                    <div class="course-info-two">
                                                        @php
                                                            $whyknowmerit = DB::table('whyknowmerits')
                                                                ->where('status', 1)
                                                                ->get();
                                                        @endphp
                                                        @foreach ($whyknowmerit as $key => $row)
    @if (isset($row))
    <div class="row align-items-center">
                                                                    @if ($key % 2 == 0)
    <div class="col-lg-6 col-md-12 order-lg-0 order-md-0 order-0" data-aos="fade-up">
                                                                            <div class="join-title-one">
                                                                                <h2>{{ $row->title }}</h2>
                                                                                <p>{!! $row->description !!}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-12 order-lg-1 order-md-1 order-1" data-aos="fade-up">
                                                                            <div class="join-mentor-img">
                                                                                <div class="winning-two-one">
                                                                                    <img src="{{ asset('uploads/whyknowmerits/' . $row->one_image) }}" alt
                                                                                        class="img-fluid">
                                                                                </div>
                                                                                <div class="joing-icon-award">
                                                                                    <img src="{{ asset('uploads/whyknowmerits/' . $row->two_image) }}" alt
                                                                                        class="joing-icon-one img-fluid">
                                                                                </div>
                                                                            </div>
                                                                        </div>
@else
    <div class="col-xl-6 col-lg-7 col-md-12 order-lg-2 order-md-3 order-3"
                                                                            data-aos="fade-up">
                                                                            <div class="join-mentor-img">
                                                                                <div class="winning-two-two">
                                                                                    <img src="{{ asset('uploads/whyknowmerits/' . $row->one_image) }}" alt
                                                                                        class="img-fluid">
                                                                                </div>
                                                                            </div>
                                                                            <div class="joing-icon-award">
                                                                                <img src="{{ asset('uploads/whyknowmerits/' . $row->two_image) }}" alt
                                                                                    class="joing-icon-two img-fluid">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-6 col-lg-5 col-md-12 order-lg-3 order-md-2 order-2"
                                                                            data-aos="fade-up">
                                                                            <div class="join-title-middle">
                                                                                <h2>{{ $row->title }}</h2>
                                                                                <p>{!! $row->description !!}</p>
                                                                            </div>
                                                                        </div>
    @endif
                                                                </div>
@else
    <h1>NO DATA FOUND</h1>
    @endif
    @endforeach
                                                    </div>
                                                </div>
                                            </section> -->
    <section class="experienced-course-five">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-down">
                    <div class="experienced-five-group">
                        <div class="instructor-vector-left">
                            <img src="assets/img/bg/instructor-vector-left.svg" alt>
                        </div>
                        <div class="developer-five-list">
                            @php
                                $teacher_points = Helper::teacherpoint();
                            @endphp
                            <ul>
                                @if (isset($teacher_points))
                                    @foreach ($teacher_points as $t_points)
                                        <li class="column-img">
                                            <div class="developer-profile-five">
                                                <div class="developer-image">
                                                    @php
                                                        $user = DB::table('users')
                                                            ->where('id', $t_points->user_id)
                                                            ->first();
                                                    @endphp
                                                    @if (isset($user->avatar))
                                                        <a
                                                            href="{{ url('/instructor-profile', ['id' => $t_points->user_id]) }}"><img
                                                                src="{{ asset('uploads/tutors/' . $user->avatar) }}"
                                                                alt="Course Instructor" class="quote img-fluid"></a>
                                                    @else
                                                        <img src="{{ asset('assets/img/user/av.jpg') }}"
                                                            alt="Course Instructor" class="quote img-fluid">
                                                    @endif
                                                </div>
                                                <div class="profile-five-ovelay">
                                                    <h5>{{ $t_points->name }}</h5>
                                                    {{-- <p>PHP Expert</p> --}}
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <h1>No Data Found</h1>
                                @endif


                            </ul>
                        </div>
                        <div class="instructor-vector-right">
                            <img src="assets/img/bg/instructor-vector-right.svg" alt>
                        </div>
                    </div>
                </div>
                @php
                    $featured_points = Helper::featuredpoints();
                @endphp
                <div class="col-lg-6" data-aos="fade-down">
                    <div class="experienced-five-sub">
                        <div class="header-five-title header-five-title-inner">
                            <h2 class="ex-five-title">Featured Profiles</h2>
                        </div>
                        @if (isset($featured_points))
                            <div class="career-five-content">
                                <p class="">{!! $featured_points->description !!}</p>
                            </div>
                        @endif
                        <!-- <a href="#" class="learn-more-five">Start Learning</a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="latest-blog-sec">
        <div class="container">
            <div class="header-two-title text-center" data-aos="fade-up">
                <h2>Our Latest Blogs</h2>
            </div>
            <div class="award-winning-two">
                <div class="row justify-content-center">
                    @php
                        $blog = DB::table('blogs')
                            ->where('status', 1)
                            ->orderBy('created_at', 'Desc')
                            ->take(3)
                            ->get();
                    @endphp
                    @foreach ($blog as $blogs)
                        <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-down">
                            <div class="event-blog-main">
                                <div class="latest-blog-img">
                                    <a href="{{ url('/blogs',['id' => $blogs->slug]) }}">
                                        <img class="img-fluid" alt src="{{ asset('uploads/blogs/' . $blogs->image) }}">
                                    </a>
                                </div>
                                <div class="latest-blog-content">
                                    <div class="event-content-title">
                                        {{-- <div class="event-span">
                                            <span class="span-name">{{ $blogs->title ?? '' }}</span>
                                        </div> --}}
                                        <h5><a
                                                href="{{ url('/blogs',['id' => $blogs->slug]) }}">{!! substr($blogs->short_description,0,60)?? '' !!}...</a>
                                        </h5>
                                        <div class="blog-student-count">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <!-- <span>Jun 15, 2022</span> -->
                                            <span>{{ date('M d ,y', strtotime($blogs->created_at)) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-down">
          <div class="event-blog-main">
            <div class="latest-blog-img">
              <a href="#">
                <img class="img-fluid" alt src="assets/img/blog/blog-02.jpg">
              </a>
            </div>
            <div class="latest-blog-content">
              <div class="event-content-title">
                <div class="event-span">
                  <span class="span-name">Sales</span>
                </div>
                <h5><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h5>
                <div class="blog-student-count">
                  <i class="fa-solid fa-calendar-days"></i>
                  <span>Jun 15, 2022</span>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
                    {{-- <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-down">
          <div class="event-blog-main">
                <div class="latest-blog-img">
                <a href="#">
                    <img class="img-fluid" alt src="assets/img/blog/blog-03.jpg">
                </a>
                </div>
                <div class="latest-blog-content">
                <div class="event-content-title">
                    <div class="event-span">
                    <span class="span-name">Marketing</span>
                    </div>
                    <h5><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h5>
                    <div class="blog-student-count">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Jun 15, 2022</span>
                    </div>
                </div>
                </div>
            </div>
          </div>
        </div> --}}
                </div>
            </div>
            <div class="col-lg-12">
                <div class="more-details text-center" data-aos="fade-down">
                    <a href="{{ url('/blog') }}" class="discover-btn">View all Blogs <i
                            class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="lead-companies-three">
        <div class="container">
            <div class="home-three-head section-header-title aos-init aos-animate">
                <div class="row align-items-center d-flex justify-content-between">

                </div>
            </div>
            <div class="m-0 p-0 lead-group aos" data-aos="fade-up">
                <div class="lead-group-slider owl-carousel owl-theme">
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt src="assets/img/my-img/knowmerit-client/1.jpg">
                        </div>
                    </div>
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt src="assets/img/my-img/knowmerit-client/2.jpg">
                        </div>
                    </div>
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt src="assets/img/my-img/knowmerit-client/3.jpg">
                        </div>
                    </div>
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt src="assets/img/my-img/knowmerit-client/4.jpg">
                        </div>
                    </div>
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt src="assets/img/my-img/knowmerit-client/5.jpg">
                        </div>
                    </div>
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt src="assets/img/my-img/knowmerit-client/6.jpg">
                        </div>
                    </div>
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt src="assets/img/my-img/knowmerit-client/7.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form action="{{ route('front.create_booking_class') }}" method="POST" id="createFrmbookclass"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="bnft" name="bnft" />
        <input type="hidden" id="price1" name="price1" />
        <input type="hidden" name="user_type" value="3" />
        <input type="hidden" name="category" id="cat" value="" />
        <input type="hidden" name="pincode" id="pin" value="" />
        <input type="hidden" name="lat" id="latt" value="">
        <input type="hidden" name="lng" id="lngg" value="">
        <div id="home-Modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Book a Demo</h4>
                        <button id="cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="home-three-slide-face">
                            <div class="home-three-slide-text">
                                {{-- <h1>Book a Demo</h1> --}}
                            </div>
                            <div class="banner-three-content">
                                <div class="comment-sec">
                                    <div class="card-body bookasession" style="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card" style="border:unset;margin-bottom: 0">
                                                    <div class="widget-set">
                                                        <div class="widget-content multistep-form">

                                                            <fieldset id="first" class="field-card">
                                                                <div class="add-course-info">
                                                                    <div class="add-course-form">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="form-control-label">Name.</label>
                                                                            <input type="text"
                                                                                class="form-control demoform"
                                                                                placeholder="Full Name"
                                                                                name="first_name" id="first_name"
                                                                                @if (Auth::check()) value="{{ Auth::user()->name }}" @endif>
                                                                            <p style="margin-bottom: 2px;"
                                                                                class="text-danger error_container"
                                                                                id="error-first_name"></p>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="form-control-label">Email.</label>

                                                                            <input type="email"
                                                                                class="form-control demoform"
                                                                                placeholder="Email" name="email"
                                                                                id="email"
                                                                                @if (Auth::check()) value="{{ Auth::user()->email }}" @endif>
                                                                            <p style="margin-bottom: 2px;"
                                                                                class="text-danger error_container"
                                                                                id="error-email"></p>
                                                                        </div>
                                                                        @if (!Auth::check())
                                                                            <div class="form-group hd-exist">
                                                                                <label class="form-control-label">Profile
                                                                                    Image.</label>

                                                                                <input type="file"
                                                                                    class="form-control demoform"
                                                                                    name="avatar" id="avatar"
                                                                                    @if (Auth::check()) value="{{ Auth::user()->avatar }}" @endif>
                                                                                <p style="margin-bottom: 2px;"
                                                                                    class="text-danger error_container"
                                                                                    id="error-avatar"></p>
                                                                            </div>
                                                                        @else
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="form-control-label d-none">Profile
                                                                                    Image.</label>

                                                                                <input type="hidden"
                                                                                    class="form-control demoform"
                                                                                    name="avatar" id="avatar">
                                                                                <p style="margin-bottom: 2px;"
                                                                                    class="text-danger error_container"
                                                                                    id="error-avatar"></p>
                                                                            </div>
                                                                        @endif
                                                                        @if (!Auth::check())
                                                                            <div class="form-group hd-exist">
                                                                                <label
                                                                                    class="form-control-label">Password.</label>
                                                                                <input type="password"
                                                                                    class="form-control demoform"
                                                                                    placeholder="Password"
                                                                                    name="password" id="password">
                                                                                    <i class="far fa-eye" id="togglePassword" style="position: absolute;margin-top: -28px;margin-right: 37px;right: 0;"></i>
                                                                                <p style="margin-bottom: 2px;"
                                                                                    class="text-danger error_container"
                                                                                    id="error-password"></p>
                                                                            </div>
                                                                        @else
                                                                            <div class="form-group">
                                                                                <label
                                                                                    class="form-control-label d-none">Password.</label>
                                                                                <input type="hidden"
                                                                                    class="form-control demoform"
                                                                                    placeholder="Password"
                                                                                    name="password" id="password">
                                                                                <p style="margin-bottom: 2px;"
                                                                                    class="text-danger error_container"
                                                                                    id="error-password"></p>
                                                                            </div>
                                                                        @endif
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Phone
                                                                                No.</label>
                                                                            <input type="number"
                                                                                class="form-control demoform phone_code"
                                                                                placeholder="Phone Number"
                                                                                name="phone" id="phone"
                                                                                @if (Auth::check()) value="{{ Auth::user()->phone }}" @endif
                                                                                style="display:block;">
                                                                            <p style="margin-bottom: 2px;"
                                                                                class="text-danger error_container"
                                                                                id="error-phone"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-btn">
                                                                        <a class="btn btn-info-light"
                                                                            id="next_btn">Continue</a>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <fieldset class="field-card">
                                                                <div class="add-course-info">
                                                                    <div class="add-course-form">
                                                                        <h6>How would you like to attend your classes</h6>
                                                                    </div>
                                                                    <div
                                                                        class="add-course-form d-flex justify-content-between">
                                                                        <div class="left-content d-flex">
                                                                            <i class="fa fa-desktop" aria-hidden="true"
                                                                                style="color: #a5a5a5;"></i>
                                                                            <p class="live-inter">Live Interactive Online
                                                                                Class
                                                                            </p>

                                                                        </div>
                                                                        <div class="right-content">
                                                                            <div class="checkbox">
                                                                                <label><input type="checkbox"
                                                                                        name="classes_choice"
                                                                                        value="online_class"
                                                                                        id="online_class"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="add-course-form d-flex justify-content-between">
                                                                        <div class="highrated">
                                                                            <ul>
                                                                                <li><strong>Recommended</strong></li>
                                                                                <li><i class="fa fa-check"
                                                                                        style="color:#009fff;"></i> High
                                                                                    Rated Tutor</li>
                                                                                <li><i class="fa fa-check"
                                                                                        style="color:#009fff;"></i> Free
                                                                                    Demo Classes</li>
                                                                            </ul>

                                                                        </div>

                                                                    </div>
                                                                    <div
                                                                        class="add-course-form d-flex justify-content-between">
                                                                        <div class="left-content d-flex">
                                                                            <i class="feather-map-pin"
                                                                                style="color: #a5a5a5;"></i>

                                                                            <p class="live-inter">Offline at my Home </p>
                                                                        </div>
                                                                        <div class="right-content">
                                                                            <div class="checkbox">
                                                                                <label><input type="checkbox"
                                                                                        name="classes_choice"
                                                                                        value="home_class"
                                                                                        id="home_class"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-btn">
                                                                        @if (Auth::check())
                                                                            <div class="col-6">
                                                                                <div class="widget-btn">
                                                                                    <button type="submit"
                                                                                        class="btn btn-info-light ">Submit
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <a
                                                                                class="btn btn-info-light next_btn hd-exist cng-btn">Continue</a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <fieldset class="field-card">
                                                                <div class="add-course-info">



                                                                    <div class="curriculum-info">
                                                                        <div id="accordion-one" class="accordion1">
                                                                            <div class="faq-grid">
                                                                                <div class="faq-header">
                                                                                    <a class="collapsed faq-collapse"
                                                                                        data-bs-toggle="collapse"
                                                                                        href="#collapseFour">
                                                                                        <i
                                                                                            class="fas fa-align-justify"></i>
                                                                                        Benefits
                                                                                    </a>

                                                                                </div>
                                                                                <div id="collapseFour"
                                                                                    class="collapse show"
                                                                                    data-bs-parent="#accordion-one">
                                                                                    <div
                                                                                        class="faq-body d-flex justify-content-between fqbody">
                                                                                        <p class="feature1">Feature your
                                                                                            Learning Requirement and Connect
                                                                                            with Top Tutors </p>
                                                                                        <i class="fa fa-info-circle"
                                                                                            style="color: #b4b4b4;margin-top: 2px;margin-left: 2px;"></i>
                                                                                    </div>
                                                                                    <div
                                                                                        class="faq-body d-flex justify-content-between fqbody">
                                                                                        <p class="feature1">Feature your
                                                                                            Learning Requirement and Connect
                                                                                            with Top Tutors </p>
                                                                                        <i class="fa fa-info-circle"
                                                                                            style="color: #b4b4b4;margin-top: 2px;margin-left: 2px;"></i>
                                                                                    </div>
                                                                                    <div
                                                                                        class="faq-body d-flex justify-content-between fqbody">
                                                                                        <p class="feature1">Feature your
                                                                                            Learning Requirement and Connect
                                                                                            with Top Tutors </p>
                                                                                        <i class="fa fa-info-circle"
                                                                                            style="color: #b4b4b4;margin-top: 2px;margin-left: 2px;"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @php
                                                                                $member_ship = DB::table('member_ship_plans')
                                                                                    ->where('status', 1)
                                                                                    ->where('user_type', 0)
                                                                                    ->get();
                                                                            @endphp

                                                                            @foreach ($member_ship as $m_ship)
                                                                                <div
                                                                                    class="featured-info-time d-flex align-items-center">
                                                                                    <div
                                                                                        class="hours-time-two d-flex align-items-center">
                                                                                        <div class="radio ">
                                                                                            <label><input type="radio"
                                                                                                    class="Input_Id"
                                                                                                    data-id="1"
                                                                                                    data-value="{{ $m_ship->amount }}"
                                                                                                    name="payment_status"
                                                                                                    value="{{ $m_ship->benifits }}">
                                                                                                <span
                                                                                                    style="margin-left: 10px">{{ $m_ship->benifits }}</span></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="course-view d-inline-flex align-items-center">
                                                                                        <div class="course-price cprice1">
                                                                                            <h3>₹{{ $m_ship->amount }}</span>
                                                                                            </h3>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            @endforeach
                                                                            <div
                                                                                class="featured-info-time d-flex align-items-center">
                                                                                <div
                                                                                    class="hours-time-two d-flex align-items-center">
                                                                                    <div class="radio Input_Id"
                                                                                        data-id="2">
                                                                                        <label>
                                                                                            <input type="radio"
                                                                                                name="payment_status"
                                                                                                value="Continue without prime benifits"><span
                                                                                                style="margin-left: 10px ; color:#009fff;">Continue
                                                                                                without prime
                                                                                                benifits</span></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                    <div class="text-center">
                                                                        <p class="sec"><i class="fa fa-lock"></i>
                                                                            100% SECURE PAYMENT</p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-center mb-2">

                                                                        <img src="assets/img/my-img/american-express.png"
                                                                            style="width:10%;object-fit: contain;">
                                                                        <img src="assets/img/my-img/MasterCard.png"
                                                                            style="width:10%;object-fit: contain;margin-left: 14px;">
                                                                        <img src="assets/img/my-img/visa-logo.png"
                                                                            style="width:10%;object-fit: contain;">
                                                                    </div>
                                                                    <div class="widget-btn">
                                                                        <div class="col-6" id="p_n">
                                                                            <div class="widget-btn">
                                                                                <button type="submit"><a
                                                                                        href="javascript:void(0)"
                                                                                        class="btn btn-info-light float-right buy_now"
                                                                                        data-amount="100"
                                                                                        data-id="7">Pay
                                                                                        Now</a></button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 d-none" id="p_l">
                                                                            <div class="widget-btn">
                                                                                <button type="submit"
                                                                                    class="btn btn-info-light submit">Pay later</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <fieldset class="field-card">
                                                                <div class="add-course-info">
                                                                    <div class="add-course-msg">
                                                                        <i class="fas fa-circle-check"></i>
                                                                        <h4>The Course Added Succesfully</h4>
                                                                        <p>Admin will be Approve soon.</p>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script> --}}
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4Bec1p6cCz6VvI3oRvWAyh0VBI9FOmw4&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script type="text/javascript">
     $('#first_name').keypress(function (e) {
        var regex = new RegExp(/^[a-zA-Z\s]+$/);
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        else {
            e.preventDefault();
            return false;
        }
    });
      $(document).ready(function() {

            $('#phone').on('keypress', function(e) {
                var $this = $(this);
                var regex = new RegExp("^[0-9\b]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                // for 10 digit number only
                if ($this.val().length > 9) {
                    e.preventDefault();
                    return false;
                }
                if (e.charCode < 54 && e.charCode > 47) {
                    if ($this.val().length == 0) {
                        e.preventDefault();
                        return false;
                    } else {
                        return true;
                    }
                }
                if (regex.test(str)) {
                    return true;
                }
                e.preventDefault();
                return false;
            });

            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function(e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                // this.classList.toggle('fa-eye-slash');
                $(this).toggleClass('fa fa-eye fa-eye-slash');
            });
        });
        function initAutocomplete() {
            const locationInput = document.getElementById('pincode');
            const lat = document.getElementById('lat');
            const lng = document.getElementById('lng');
            const autocompleteContainer = document.getElementById('autocomplete-container');
            const autocomplete = new google.maps.places.Autocomplete(locationInput);
            const place = autocomplete.getPlace();
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                locationInput.value = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                lat.value = latitude;
                lng.value = longitude;

            });
        }
        /////////error msg////
        $("#next_btn0").click(function() {
            var pincode = $('#pincode').val();
            var category_id = $('#category_id').val();
            var errors = false;
            if (category_id == '') {
                $("#error-category_id").show();
                $('#error-category_id').html('please select category name');
                errors = true;
            } else {
                $('#error-category_id').html('');
            }
            if (pincode == '') {
                $("#error-pincode").show();
                $('#error-pincode').html('please enter location');
                errors = true;
            }
            if (errors) {
                return false;
            }
            $(this).parent().parent().parent().next().fadeIn('slow');
            $(this).parent().parent().parent().css({
                'display': 'none'
            });
            progressVal = progressVal + 1;
            $('.progress-active').removeClass('progress-active').addClass('progress-activated').next()
                .addClass('progress-active');
        });
        $("#next_btn").click(function() {
            var first_name = $('#first_name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var errors = false;
            if (first_name == '') {
                $('#error-first_name').html('please enter first name');
                errors = true;
            } else {
                $('#error-first_name').html('');
            }
            if (email == '') {
                $('#error-email').html('please enter email address');
                errors = true;
            } else {
                $('#error-email').html('');
            }

            if (phone == '') {
                $('#error-phone').html('please enter phone number');
                errors = true;
            }
            if (errors) {
                return false;
            }
            $(this).parent().parent().parent().next().fadeIn('slow');
            $(this).parent().parent().parent().css({
                'display': 'none'
            });
            progressVal = progressVal + 1;
            $('.progress-active').removeClass('progress-active').addClass('progress-activated').next()
                .addClass('progress-active');
        });
        /////////////email
        $(document).ready(function() {
            $('#email').on('blur', function() {
                var email = $(this).val();
                if (email) {
                    $.ajax({
                        url: "{{ route('checkstudent-email') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            email: email
                        },
                        success: function(response) {
                            if (response.exists) {
                                // $('#error-email').html('Email already exists.');

                                $('.hd-exist').hide();
                                $('.cng-btn').after(`<div class="col-6">
                                                                            <div class="widget-btn">
                                                                                <button type="submit"
                                                                                    class="btn btn-info-light ">Submit
                                                                                    </button>
                                                                            </div>
                                                                        </div>`);

                            } else {
                                $('#error-tutor_email').html('');
                                $('.hd-exist').show();
                            }
                        }
                    });
                }
            });
        });
        //SUBMIT CODE
        $(document).on('submit', 'form#createFrmbookclass', function(event) {
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
                        $('.submit').html('Pay later');
                    }, 2000);
                    //console.log(response);
                    if (response.success == true) {
                        //notify
                        toastr.success(
                            "The Course Added Succesfully <br>Admin will be Approve soon."
                        );
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/') }}" +
                                "/student/student-dashboard";
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
        var SITEURL = '{{ URL::to('') }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '.buy_now', function(e) {
            var first_name = $('#first_name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var category = $('#category_id').val();
            var pincode = $('#pincode').val();
            var lat = $('#lat').val();
            var lng = $('#lng').val();
            var classes_choice = $("input[name='classes_choice']:checked").val();
            var payment_status = $("input[name='payment_status']:checked").val();
            var amount = $('#price1').val();
            var options = {
                "key": "{{ env('RAZAR_CLIENT_ID') }}",
                "amount": (amount * 100),
                "name": first_name,
                "description": "Payment",
                "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
                "handler": function(response) {
                    window.location.href = SITEURL + '/' + 'paysuccessstudent?payment_id=' + response
                        .razorpay_payment_id + '&amount=' + amount + '&first_name=' + first_name +
                        '&phone=' + phone + '&email=' + email + '&category=' + category +
                        '&classes_choice=' + classes_choice + '&payment_status=' + payment_status +
                        '&pincode=' + pincode + '&lat=' + lat + '&lng=' + lng;
                },
                "prefill": {
                    "contact": phone,
                    "email": email,
                },
                "theme": {
                    "color": "#528FF0"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        });

        $(".Input_Id").on('change', function() {
            var id = $(this).attr("data-id");
            var price = $(this).attr("data-value");
            if (id == 1) {
                $("#price1").val(price);
                $("#p_n").removeClass("d-none");
                $("#p_l").addClass("d-none");
            }
            if (id == 2) {
                $("#p_l").removeClass("d-none");
                $("#p_n").addClass("d-none");
                $("#bnft").val("2");

            }
        });

        $("#homeformsubmit").submit(function() {
            $('#home-Modal').modal('show');
            var category = $('#category').val();

            var category_id = $('#category_id').val();
            $('#cat').val(category_id);
            $('#cat_id').val(category_id);
            //  alert(category_id);

            var pincode = $('#pincode').val();
            $('#pin').val(pincode);
            var lat = $('#lat').val();
            // alert(lat);
            $('#latt').val(lat);
            var lng = $('#lng').val();
            $('#lngg').val(lng);
            // alert(category);
            return false;
        });
        $("#cancel-btn").on("click", function() {
            $('#home-Modal').modal('hide');
        })
        $(document).ready(function() {
            $('#category').on('keyup', function() {
                var query = $(this).val();
                $.ajax({
                    url: '{{ route('search') }}',
                    type: 'GET',
                    data: {
                        'category': query
                    },
                    success: function(data) {
                        $('#product_list').html(data);
                    }
                })
            });
            $(document).on('click', 'li', function() {
                var value = $(this).text();
                var id = $(this).attr('data-id');
                $('#category').val(value);
                $('#category_id').val(id);
                $('#product_list').html("");
            });
        });
        $(".inputhide").keyup(function(){
            $(".inputhide1").hide();
});



    </script>


@endsection
