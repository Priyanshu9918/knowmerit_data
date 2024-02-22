<div class="row data1">
    @if (count($tutors) > 0)
        @foreach ($tutors as $key => $row)
            <?php $avtar = DB::table('tutors')
                ->where('id', $row->user_id)
                ->where('status', 1)
                ->first(); ?>
            <div class="col-lg-12 d-flex">
                <div class="instructor-list flex-fill">
                    <div class="instructor-img">
                        @if (isset($avtar->avatar))
                            <a href="#">
                                <img class="img-fluid" alt src="{{ asset('uploads/tutors/' . $avtar->avatar) }}">
                            </a>
                        @else
                            <a href="#">
                                <img class="img-fluid" alt src="assets/img/user/av.jpg">
                            </a>
                        @endif
                    </div>
                    <div class="instructor-content">
                        <h5><a href="#">{{ $row->name }}</a></h5>
                        <h6>Instructor</h6>
                        <div class="instructor-info">
                            <div class="rating-img d-flex align-items-center">
                                <i class="fa fa-language" aria-hidden="true" style="margin-right: 4px"></i>
                                <p>LANGUAGES : {{ $row->language }}</p>
                            </div>
                            <div class="course-view d-flex align-items-center ms-0">
                                <i class="feather-map-pin" style="margin-right: 4px"></i>
                                <p>LOCATION : {{ $row->location }}</p>
                            </div>
                            <div class="rating-img d-flex align-items-center">
                                <i class="fa fa-inr" aria-hidden="true" style="margin-right: 4px"></i>
                                <p>RATE : {{ $row->charge_amount }}/Hour</p>
                            </div>
                            <a href="#rate" class="rating-count"><i class="fa-regular fa-heart"></i></a>
                        </div>
                        <div class="trainer-tag">
                            <h6 class="mb-0">CATEGORY</h6>
                            <?php $cat = DB::table('categories')
                                ->where('id', $row->parent_id)
                                ->first(); ?>
                            <ul class="trainer-l">
                                <li>{{ $cat->name }}</li>
                            </ul>
                        </div>
                        <div class="featured-info-time d-flex align-items-center">
                            <div class="rate">
                                <div class="rating">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <span class="ms-3">203 reviews</span>
                                    <span class="availableCourse">
                                        <span>M</span>
                                        <span>T</span>
                                        <span>W</span>
                                        <span>Th</span>
                                        <span>F</span>
                                        <span>S</span>
                                        <span class="checked1">Su</span>
                                    </span>
                                </div>
                            </div>
                            <div class="course-view d-inline-flex align-items-center">
                                <div class="course-price">
                                    <h3>{{ $row->charge_amount }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
    <div class="row">
        <div class="no-up">
            <div class="no-upcomimg"> <img src="{{ asset('assets/img/my-img/clipboard1.png') }}">
                <h3 class="mt-4">No Data Found</h3>
            </div>
        </div>
    </div>
    @endif
</div>
