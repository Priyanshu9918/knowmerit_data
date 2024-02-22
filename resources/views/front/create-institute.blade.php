@extends('layouts.front.master')
<style>
    span.select2.select2-container.select2-container--default {
    width: 100% !important;
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
    overflow: auto;
}
    .institute a {
        color: #009fff;

    }

</style>
@section('content')
    <section class="page-content course-sec createteacher">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="selectblock d-flex select-tech">
                            <div class="individual">
                                <a href="{{ route('front.tutor.create') }}">
                                    <div>I am an Individual</div>
                                </a>
                            </div>
                            <div class="institute">
                                <a href="{{ route('front.institute.create') }}">
                                    <div>I run an Institute</div>
                                </a>
                            </div>
                        </div>
                        <div class="widget-set" id="div1">
                            <h5 class="select-tech1"> I run an Institute</h5>
                            <div class="widget-setcount">
                                <ul id="progressbar">
                                    <li class="progress-active">
                                        <p><span></span> Personal Information </p>
                                    </li>
                                    <li>
                                        <p><span></span> Education</p>
                                    </li>
                                    <li>
                                        <p><span></span> Experience</p>
                                    </li>
                                    <li>
                                        <p><span></span> Classes</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="widget-content multistep-form">
                                <fieldset id="first">
                                    <div class="add-course-info">
                                        <div class="add-course-inner-header">
                                            <h4>Personal Information</h4>
                                        </div>
                                        <div class="add-course-form">
                                            <form action="" method="POST" id="createFrm"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" id="bnft" name="bnft" />
                                                <input type="hidden" id="price1" name="price1" />

                                                <div class="mt-4">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="add-course-label">Institute Name</label>
                                                                <input type="name" class="form-control"
                                                                    name="institute_name" id="institute_name"
                                                                    placeholder="Enter Institute Name">
                                                                <p style="margin-bottom: 2px;"
                                                                    class="text-danger error_container"
                                                                    id="error-institute_name"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="add-course-label">Contact person name</label>
                                                                <input class="form-control" type="text" name="tutor_name"
                                                                    id="tutor_name" placeholder="Enter Teacher name" />
                                                                <p style="margin-bottom: 2px;"
                                                                    class="text-danger error_container"
                                                                    id="error-tutor_name"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="add-course-label">Email</label>
                                                                <input type="email" class="form-control"
                                                                    name="tutor_email" id="tutor_email"
                                                                    placeholder="Enter  Email">
                                                                <p style="margin-bottom: 2px;"
                                                                    class="text-danger error_container"
                                                                    id="error-tutor_email"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="add-course-label">Phone</label>
                                                                <div class="input-group">
                                                                    <input type="tel" class="form-control"
                                                                        id="tutor_mobile" name="tutor_mobile"
                                                                        placeholder="Enter Teacher Mobile" maxlength="10" />
                                                                </div>
                                                                <p style="margin-bottom: 2px;"
                                                                    class="text-danger error_container"
                                                                    id="error-tutor_mobile"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="add-course-label">Institute Logo</label>
                                                                <div class="relative-form">
                                                                    <input type="file" name="image" id="image">
                                                                </div>
                                                                <p style="margin-bottom: 2px;"
                                                                    class="text-danger error_container" id="error-image">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="add-course-label">Category</label>
                                                                <select class="form-control select2 cate " id="category"
                                                                    name="category[]" multiple>
                                                                    <option value="">Select Category</option>
                                                                    @if (count($parent_categories) > 0)
                                                                        @foreach ($parent_categories as $category)
                                                                            <option value="{{ $category->id }}">
                                                                                {{ $category->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                <p style="margin-bottom: 2px;"
                                                                    class="text-danger error_container"
                                                                    id="error-category"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 d-none" id="s_n">
                                                            <label class="add-course-label">Sub Category</label>
                                                            <select class="form-control select2" name="sub_category[]"
                                                                id="sub_category" multiple>
                                                            </select>
                                                            <p style="margin-bottom: 2px;"
                                                                class="text-danger error_container"
                                                                id="error-sub-category"></p>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="hidden" id="lat" name="lat"
                                                                    value="">
                                                                <input type="hidden" id="lng" name="lng"
                                                                    value="">
                                                                <label class="add-course-label">Location</label>
                                                                <input class="form-control" name="tutor_location"
                                                                    type="text" id="tutor_location"
                                                                    placeholder="Enter the location">
                                                                <p style="margin-bottom: 2px;"
                                                                    class="text-danger error_container"
                                                                    id="error-tutor_location"></p>
                                                                <div id="autocomplete-container"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="add-course-label">Add languages that you
                                                                    speak</label>
                                                                <select class="form-control select2" name="language[]"
                                                                    id="language" multiple>
                                                                    <option value="" disabled>Select</option>
                                                                    @foreach ($list_langauge as $lang)
                                                                        <option value="{{ $lang->value }}">
                                                                            {{ $lang->value }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <p style="margin-bottom: 2px;"
                                                                    class="text-danger error_container"
                                                                    id="error-language"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="widget-btn">
                                            <a class="btn btn-info-light next_btn0">Continue</a>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="field-card">
                                    <div class="add-course-info">
                                        <div class="add-course-inner-header">
                                            <h4>Education</h4>
                                        </div>
                                        <div class="add-course-form">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="add-course-label">Add your most recent Degree</label>
                                                        <select class="form-control select2 mb-4" name="degree"
                                                            id="degree">
                                                            <option value="">Select</option>
                                                            <option value="12th">12th</option>
                                                            <option value="Graduation">Graduation</option>
                                                            <option value="Post Graduation">Post Graduation</option>
                                                            <option value="Phd">Phd</option>
                                                        </select>
                                                        <p class="text-danger error_container" id="error-degree"></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="margin-top: 23px;">
                                                    <div class="form-group">
                                                        <label class="add-course-label"></label>
                                                        <input class="form-control mb-4" type="text"
                                                            name="university_name" id="university_name"
                                                            placeholder="Enter Institute/University Name" />
                                                        <p class="text-danger error_container" id="error-university_name">
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="margin-top: 23px;">
                                                    <div class="form-group ">
                                                        <label class="add-course-label"></label>
                                                        <select class="form-control select2 mb-4" name="degree_status"
                                                            id="degree_status">
                                                            <option value="">Select</option>
                                                            <option value="Completed">Completed</option>
                                                            <option value="Pursuing">Pursuing</option>
                                                        </select>
                                                        <p class="text-danger error_container" id="error-degree_status">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" style="position: inherit;">
                                                    <label class="add-course-label">Password</label>
                                                    <input class="form-control" type="password" name="password"
                                                        autocomplete="current-password" required="" id="password">
                                                    <i class="far fa-eye" id="togglePassword"
                                                    style="margin-top: -28px; cursor: pointer; position: absolute;right: 0;margin-right: 40px;"></i>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                        id="error-password"></p>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12">
                                                <div class="form-group" style="position: inherit;">
                                                    <label class="add-course-label">Password</label>
                                                    <input class="form-control" type="password" name="password"
                                                        autocomplete="current-password"  id="password">
                                                    <i class="far fa-eye" id="togglePassword"
                                                    style="margin-top: -28px; cursor: pointer; position: absolute;right: 0;margin-right: 40px;"></i>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                        id="error-password"></p>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-12">
                                                <label class="add-course-label">Which school boards of class 10 do you
                                                    teach for?</label>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="school_board[]" value="cbse"
                                                        id="cbse1" class="op1">CBSE
                                                </label>
                                                <label class="checkbox-inline op12">
                                                    <input type="checkbox" name="school_board[]" value="icse"
                                                        id="icse1" class="op1">ICSE
                                                </label>
                                                <label class="checkbox-inline op12">
                                                    <input type="checkbox" name="school_board[]" value="state"
                                                        id="state1" class="op1">State Board
                                                </label>
                                                <label class="checkbox-inline op12">
                                                    <input type="checkbox" name="school_board[]" value="int"
                                                        id="int1" class="op1">International Baccalaureate
                                                </label>
                                                <label class="checkbox-inline op12">
                                                    <input type="checkbox" name="school_board[]" value="dav"
                                                        id="dav1"class="op1">DAV Board
                                                </label>
                                                <label class="checkbox-inline op12">
                                                    <input type="checkbox" name="school_board[]" value="nios"
                                                        id="nios1" class="op1">NOS
                                                </label>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-school_board"></p>
                                            </div>
                                            <div class="col-sm-12 d-none" id="STATE11">
                                                <div class="form-group ">
                                                    <label class="add-course-label">Which of the following State Syllabus
                                                            subjects do you provide tuition for?*</label>
                                                    @php
                                                        $state_sub = DB::table('state_sub')->get();
                                                    @endphp
                                                    <div class="row">
                                                        @foreach ($state_sub as $st_sub)
                                                        <div class="" style="display: flex;justify-content-center">
                                                            <p class="col-11">{{ $st_sub->subject }}</p>
                                                            <input type="checkbox" name="all_state_subject[]"
                                                                value="{{ $st_sub->subject }}">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                        id="error-all_state_subject"></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 d-none" id="STATEB11">
                                                <div class="form-group ">
                                                    <label class="add-course-label">Which state boards of Class I-V do you
                                                            teach?*</label>
                                                    @php
                                                        $state_bord = DB::table('state_boards')->get();
                                                    @endphp
                                                    <div class="row">
                                                        @foreach ($state_bord as $st_brd)
                                                        <div class="" style="display: flex;justify-content-center">
                                                            <p class="col-11">{{ $st_brd->board_name }}</p>
                                                            <input type="checkbox" name="all_state_board[]"
                                                                value="{{ $st_brd->board_name }}">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                        id="error-all_state_board"></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 d-none" id="CBSE11">
                                                <div class="form-group ">
                                                    <label class="add-course-label">Which of the following CBSE subjects
                                                            do you provide tuition for?*</label>
                                                    @php
                                                        $cbse = DB::table('CBSE')->get();
                                                    @endphp
                                                    <div class="row">
                                                        @foreach ($cbse as $cb)
                                                        <div class="" style="display: flex;justify-content-center">
                                                            <p class="col-11">{{ $cb->subject }}</p>
                                                            <input type="checkbox" name="all_cbse_subject[]"
                                                                value="{{ $cb->subject }}">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                        id="error-all_cbse_subject"></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 d-none" id="ICSE11">
                                                <div class="form-group ">
                                                    <label class="add-course-label">Which of the following ICSE subjects
                                                            do you provide tuition for?*</label>
                                                    @php
                                                        $icse = DB::table('ICSE')->get();
                                                    @endphp
                                                    <div class="row">
                                                        @foreach ($icse as $ic)
                                                        <div class="" style="display: flex;justify-content-center">
                                                            <p class="col-11">{{ $ic->subject }}</p>
                                                            <input type="checkbox" name="all_icse_subject[]"
                                                                value="{{ $ic->subject }}">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                        id="error-all_icse_subject"></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 d-none" id="INT11">
                                                <div class="form-group ">
                                                    <label class="add-course-label">Which of the following International
                                                            Baccalaureate subjects do you provide tuition
                                                            for?*</label>
                                                    @php
                                                        $inter = DB::table('International_Baccalaureate_sub')->get();
                                                    @endphp
                                                    <div class="row">
                                                        @foreach ($inter as $int)
                                                        <div class="" style="display: flex;justify-content-center">
                                                            <p class="col-11">{{ $int->subject }}</p>
                                                            <input type="checkbox" name="all_inter_subject[]"
                                                                value="{{ $int->subject }}">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                        id="error-all_inter_subject"></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 d-none" id="NIOS11">
                                                <div class="form-group ">
                                                    <label class="add-course-label">Which of the following NIOS subjects
                                                            do you provide tuition for?*</label>
                                                    @php
                                                        $nios = DB::table('NIOS')->get();
                                                    @endphp
                                                    <div class="row">
                                                        @foreach ($nios as $ni)
                                                        <div class="" style="display: flex;justify-content-center">
                                                            <p class="col-11">{{ $ni->subject }}</p>
                                                            <input type="checkbox" name="all_nios_subject[]"
                                                                value="{{ $ni->subject }}">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                        id="error-all_nios_subject"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-btn">
                                            <a class="btn btn-black prev_btn">Previous</a>
                                            <a class="btn btn-info-light next_btn1">Continue</a>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="field-card">
                                    <div class="add-course-info">
                                        <div class="add-course-inner-header">
                                            <h4>Experience</h4>
                                        </div>
                                        <div class="add-course-form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="add-course-label">Do you have any prior teaching
                                                            experience?</label>
                                                        <select class="form-control" name="teaching_experience"
                                                            id="teaching_experience">
                                                            <option value="">Select</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-teaching_experience"></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 d-none" id="e1_n">
                                                    <div class="form-group">
                                                        <label class="add-course-label">What is your Total experience (in Years)?</label>
                                                        <select class="form-control experience_year" name="experience_year" id="experience_year">
                                                            <option value="">Select</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                        </select>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-experience_year"></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="add-course-label" for="comment">What is your
                                                            background & experience?</label>
                                                        <textarea class="form-control" rows="5" id="backgorund_experience" name="backgorund_experience"
                                                            placeholder="Eg : I am a teacher/engineer... I am giving home/online/tutor home tuition since..I am certified in... I have a degree in.. My key skills are.. My  accomplishments.. Any other relevant detials to make your profile looks richer."></textarea>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-backgorund_experience"></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="add-course-label" for="comment">Introduction Video Link</label>
                                                            <input type="text" class="form-control" name="youtube_url" id="youtube_url" placeholder="Youtube Link">
                                                       <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-youtube_url"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-btn">
                                            <a class="btn btn-black prev_btn">Previous</a>
                                            <a class="btn btn-info-light next_btn2">Continue</a>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="field-card">
                                    <div class="add-course-info">
                                        <div class="add-course-inner-header">
                                            <h4 class="mb-4">Classes</h4>
                                            <div class="row">


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="add-course-label">How much do you charge per
                                                            hour?</label>
                                                        <input type="number" class="form-control" name="charge_amount"
                                                            id="charge_amount" placeholder="₹ Enter Price / Hour">
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-charge_amount"></p>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="add-course-label">Delivery of classes / Mode of classes
                                                        ?</label><br>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="conduct_mode_class[]" value="Online"
                                                            class="op1">Online
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="conduct_mode_class[]"
                                                            value="Offline" class="op1">Offline
                                                    </label><br>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="conduct_mode_class[]" value="Hybrid"
                                                            class="op1">Hybrid (Online + Offline)
                                                    </label>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                        id="error-conduct_mode_class"></p>

                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="add-course-label" for="comment">Tell us about yourself
                                                            (Describe your
                                                            experience in School or Collage)</label>
                                                        <textarea class="form-control" rows="5" id="describe_experience" name="describe_experience"
                                                            placeholder="E.g. : During my time at school/college, I pursued studies in... I actively participated in... I was involved with clubs/organizations such as... My academic achievements include... I completed my degree/diploma in... My key learnings from this experience were... Any other pertinent details that enhance my educational profile."></textarea>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-describe_experience"></p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="widget-btn">
                                            <a class="btn btn-black prev_btn">Previous</a>
                                            <a class="btn btn-info-light next_btn3">Continue</a>

                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="field-card">
                                    <div class="add-course-info">
                                        <div class="curriculum-info">
                                            <div id="accordion-one" class="accordion1">
                                                <div class="faq-grid">
                                                    @php
                                                        $benifits = Helper::benifits();
                                                    @endphp
                                                    <div class="faq-header">
                                                        <a class="collapsed faq-collapse" data-bs-toggle="collapse"
                                                            href="#collapseFour">
                                                            <i class="fas fa-align-justify"></i>
                                                            {{-- {{ $benifits->title ?? '' }} --}}
                                                        </a>
                                                    </div>
                                                    <div
                                                        id="collapseFour"class="collapse show"data-bs-parent="#accordion-one">
                                                        {!! $benifits->benifits ?? '' !!}

                                                    </div>
                                                </div>
                                                @php
                                                    $member_ship = DB::table('member_ship_plans')
                                                        ->where('status', 1)
                                                        ->where('user_type', 1)
                                                        ->get();
                                                @endphp

                                                @foreach ($member_ship as $m_ship)
                                                    <div class="featured-info-time d-flex align-items-center">
                                                        <div class="hours-time-two d-flex align-items-center">
                                                            <div class="radio ">
                                                                <label><input type="radio" class="Input_Id"
                                                                        data-id="1" data-value="{{ $m_ship->amount }}"
                                                                        name="payment_status"
                                                                        value="{{ $m_ship->benifits }}">
                                                                    <span
                                                                        style="margin-left: 10px">{{ $m_ship->benifits }}</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="course-view d-inline-flex align-items-center">
                                                            <div class="course-price cprice1">
                                                                <h3>₹{{ $m_ship->amount }}</span>
                                                                </h3>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endforeach
                                                <div class="featured-info-time d-flex align-items-center">
                                                    <div class="hours-time-two d-flex align-items-center">
                                                        <div class="radio Input_Id" data-id="2">
                                                            <label>
                                                                <input type="radio" name="payment_status"
                                                                    value="Continue without prime benefits"><span
                                                                    style="margin-left: 10px ; color:#009fff;">Continue
                                                                    without prime
                                                                    benefits</span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <P class="sec"><i class="fa fa-lock"></i> 100%
                                                SECURE PAYMENT</P>
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
                                            <a class="btn btn-black prev_btn">Previous</a>
                                            <div class="row">
                                                <div class="col-6 d-none" id="p_n">
                                                    <div class="widget-btn">
                                                        <button type="submit"><a href="javascript:void(0)"
                                                                class="btn btn-info-light float-right buy_now"
                                                                data-amount="100" data-id="7">Pay Now</a></button>
                                                    </div>
                                                </div>
                                                <div class="col-6" id="p_l">
                                                    <div class="widget-btn">

                                                        <button type="submit" class="btn btn-info-light ">Pay
                                                            later</button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                            {{-- <button type="submit" class="btn btn-primary submit mt-2">Save</button> --}}
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4Bec1p6cCz6VvI3oRvWAyh0VBI9FOmw4&libraries=places&callback=initAutocomplete"
    async defer></script>
    <script>
        //email check the
        $(document).ready(function() {

            $('#tutor_mobile').on('keypress', function(e) {
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
            $('#tutor_name').on('keypress', function(e) {
                var $this = $(this);
                var regex = /^[A-Za-z ]+$/;
                var inputChar = String.fromCharCode(e.which);

                if (!regex.test(inputChar)) {
                    e.preventDefault();
                }
            });
            $('#tutor_email').on('blur', function() {
                var email = $(this).val();
                if (email) {
                    $.ajax({
                        url: "{{ route('check-email') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            email: email
                        },
                        success: function(response) {
                            if (response.exists) {
                                $('#error-tutor_email').html('Email already exists.');
                            } else {
                                $('#error-tutor_email').html('');
                            }
                        }
                    });
                }
            });

            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function(e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
            });

            let progressVal = 0;
            let businessType = 0;
            $(".next_btn0").click(function() {
                var name = $('#tutor_name').val();
                var institute_name = $('#institute_name').val();
                var email = $('#tutor_email').val();
                var mobile = $('#tutor_mobile').val();
                // var gender = $('#tutor_gender').val();
                var category = $('#category').val();
                var location = $('#tutor_location').val();
                var language = $('#language').val();
                var image = $('#image').val();

                var errors = false;

                if (name == '') {
                    $('#error-tutor_name').html('please enter tutor name');
                    errors = true;
                } else {
                    $('#error-tutor_name').html('');
                }

                if (email == '') {
                    $('#error-tutor_email').html('please enter email');
                    errors = true;
                } else {
                    $('#error-tutor_email').html('');
                }

                if (institute_name == '') {
                    $('#error-institute_name').html('please enter institute name');
                    errors = true;
                } else {
                    $('#error-institute_name').html('');
                }
                if (category == '') {
                    $('#error-category').html('Please enter category');
                    errors = true;
                } else {
                    $('#error-category').html('');
                }

                if (location == '') {
                    $('#error-tutor_location').html('please enter location');
                    errors = true;
                } else {
                    $('#error-tutor_location').html('');
                }

                if (image == '') {
                    $('#error-image').html('please enter image');
                    errors = true;
                } else {
                    $('#error-image').html('');
                }

                if (language == '') {
                    $('#error-language').html('please enter language');
                    errors = true;
                } else {
                    $('#error-language').html('');
                }

                if (mobile == '') {
                    $('#error-tutor_mobile').html('please enter mobile number');
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


            $(".next_btn1").click(function() {
                var degree = $('#degree').val();
                var university_name = $('#university_name').val();
                var degree_status = $('#degree_status').val();
                var password = $('#password').val();

                var errors = false;

                if (degree == '') {
                    $('#error-degree').html('Please enter a degree');
                    errors = true;
                } else {
                    $('#error-degree').html('');
                }

                if (password == '') {
                    $('#error-password').html('Please enter a password');
                    errors = true;
                } else {
                    $('#error-password').html('');
                }

                if (university_name == '') {
                    $('#error-university_name').html('Please enter a university name');
                    errors = true;
                } else {
                    $('#error-university_name').html('');
                }

                if (degree_status == '') {
                    $('#error-degree_status').html('Please enter a degree status');
                    errors = true;
                } else {
                    $('#error-degree_status').html('');
                }

                // Check if any checkbox in the "school_board" group is selected
                var selectedSchoolBoards = $('input[name="school_board[]"]:checked');
                if (selectedSchoolBoards.length === 0) {
                    $('#error-school_board').html('Please select at least one');
                    errors = true;
                } else {
                    $('#error-school_board').html('');
                }

                // Check if the 'cbse' checkbox is selected within the "school_board" group
                if (selectedSchoolBoards.filter('[value="cbse"]').is(':checked')) {
                    var selectedCbseBoards = $('input[name="all_cbse_subject[]"]:checked');
                    if (selectedCbseBoards.length === 0) {
                        $('#error-all_cbse_subject').html('Please select at CBSE Subject');
                        errors = true;
                    } else {
                        $('#error-all_cbse_subject').html('');
                    }
                } else if (selectedSchoolBoards.filter('[value="icse"]').is(':checked')) {
                    var selectedIcseBoards = $('input[name="all_icse_subject[]"]:checked');
                    if (selectedIcseBoards.length === 0) {
                        $('#error-all_icse_subject').html('Please select at ICSE Subject');
                        errors = true;
                    } else {
                        $('#error-all_icse_subject').html('');
                    }
                } else if (selectedSchoolBoards.filter('[value="int"]').is(':checked')) {
                    var selectedInterBoards = $('input[name="all_inter_subject[]"]:checked');
                    if (selectedInterBoards.length === 0) {
                        $('#error-all_inter_subject').html(
                            'Please select at International Baccalaureate Subject');
                        errors = true;
                    } else {
                        $('#error-all_inter_subject').html('');
                    }
                } else if (selectedSchoolBoards.filter('[value="nios"]').is(':checked')) {
                    var selectedNiosBoards = $('input[name="all_nios_subject[]"]:checked');
                    if (selectedNiosBoards.length === 0) {
                        $('#error-all_nios_subject').html('Please select at NIOS Subject');
                        errors = true;
                    } else {
                        $('#error-all_nios_subject').html('');
                    }
                } else if (selectedSchoolBoards.filter('[value="state"]').is(':checked')) {
                    var selectedStateBoards = $('input[name="all_state_subject[]"]:checked');
                    if (selectedStateBoards.length === 0) {
                        $('#error-all_state_subject').html('Please select at State Subject');
                        errors = true;
                    } else {
                        $('#error-all_state_subject').html('');
                    }
                }
                // if(selectedStateBoards.filter('[value="state"]').is(':checked')) {
                //     var selectedBoards = $('input[name="all_state_board[]"]:checked');
                //     if (selectedBoards.length === 0) {
                //         $('#error-all_state_board').html('Please select at least one Board');
                //         errors = true;
                //     } else {
                //         $('#error-all_state_board').html('');
                //     }
                // }

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




            $(".next_btn2").click(function() {
                var teaching_experience = $('#teaching_experience').val();
                var experience_year = $('#experience_year').val();
                var backgorund_experience = $('#backgorund_experience').val();

                var errors = false;

                if (teaching_experience == '') {
                    $('#error-teaching_experience').html('please enter teaching experience');
                    errors = true;
                } else {
                    $('#error-teaching_experience').html('');
                }

                if (experience_year==''  && teaching_experience == 'Yes') {
                    $('#error-experience_year').html('please enter experience years');
                    errors = true;
                } else {
                    $('#error-experience_year').html('');
                }

                if (backgorund_experience == '') {
                    $('#error-backgorund_experience').html('please enter backgorund experience');
                    errors = true;
                } else {
                    $('#error-backgorund_experience').html('');
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
            $(".next_btn3").click(function() {
                var charge_amount = $('#charge_amount').val();
                var describe_experience = $('#describe_experience').val();
                var errors = false;

                if (charge_amount == '') {
                    $('#error-charge_amount').html('please enter charge amount');
                    errors = true;
                } else {
                    $('#error-charge_amount').html('');
                }

                // var classesModeChecked = $('#private_classes').is(':checked') || $('#group_classes').is(
                //     ':checked');
                // if (!classesModeChecked) {
                //     $('#error-classes_mode').html('Please select at least one');
                //     errors = true;
                // } else {
                //     $('#error-classes_mode').html('');
                // }

                if (describe_experience == '') {
                    $('#error-describe_experience').html('please enter describe experience');
                    errors = true;
                } else {
                    $('#error-describe_experience').html('');
                }

                var selectedValues = [];

                $('input[type="checkbox"]').each(function() {
                    if ($(this).is(':checked')) {
                        selectedValues.push($(this).val());
                    }
                });

                if (selectedValues.length > 0) {
                    console.log('Selected values:', selectedValues);
                } else {
                    $('#error-conduct_mode_class').html('Please select at least one');
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


            $(".prev_btn").click(function() {
                $(this).parent().parent().parent().prev().fadeIn('slow');
                $(this).parent().parent().parent().css({
                    'display': 'none'
                });
                progressVal = progressVal - 1;
                $('.progress-active').removeClass('progress-active').prev().removeClass(
                    'progress-activated').addClass('progress-active');
            });


            //on change country
            select2subject();
            select2subject1();
            select2subject2();
            select2subject3();

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
                            toastr.success(" Created successfully!");
                            window.setTimeout(function() {
                                window.location =
                                    "{{ url('/teacher/teacher-instructor-dashboard') }}";
                            }, 2000);

                            // Swal.fire({
                            //     position: 'top-end',
                            //     icon: 'success',
                            //     title: 'user Created Successfully',
                            //     showConfirmButton: false,
                            //     timer: 1500
                            //     })
                            // window.setTimeout(function() {

                            // }, 2000);

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

        // function select2subject() {
        //     $('#tutor_subject_teach').select2({
        //         multiple: true,
        //         placeholder: 'Select',

        //     });
        // }

        function select2subject() {
            $('#category').select2({
                multiple: true,
                placeholder: 'Select',

            });
        }

        function select2subject1() {
            $('#language').select2({
                multiple: true,
                placeholder: 'Select',

            });
        }
        function select2subject3() {
            $('#sub_category').select2({
                multiple: true,
                placeholder: 'Select',

            });
        }

        var SITEURL = '{{ URL::to('') }}';
        $.ajaxSetup({
            headers: {
                contentType: 'multipart/form-data',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('body').on('click', '.buy_now', function(e) {

            var c_code = $('div.iti__selected-flag').attr('title');

            var name = $('#tutor_name').val();
            var university_name = $('#university_name').val();
            var email = $('#tutor_email').val();
            var mobile = $('#tutor_mobile').val();
            var image = $('#image').prop('files')[0];
            var school_board = $('input[name="school_board[]"]:checked')
                .map(function() {
                    return $(this).val();
                }).get();
            var conduct_mode_class = $('input[name="conduct_mode_class[]"]:checked')
                .map(function() {
                    return $(this).val();
                }).get();
            var classes_mode = $('input[name="classes_mode[]"]:checked')
                .map(function() {
                    return $(this).val();
                }).get();
            var all_state_subject = $('input[name="all_state_subject[]"]:checked')
                .map(function() {
                    return $(this).val();
                }).get();
            var all_state_board = $('input[name="all_state_board[]"]:checked')
                .map(function() {
                    return $(this).val();
                }).get();
            var all_cbse_subject = $('input[name="all_cbse_subject[]"]:checked')
                .map(function() {
                    return $(this).val();
                }).get();
            var all_icse_subject = $('input[name="all_icse_subject[]"]:checked')
                .map(function() {
                    return $(this).val();
                }).get();
            var all_inter_subject = $('input[name="all_inter_subject[]"]:checked')
                .map(function() {
                    return $(this).val();
                }).get();
            var all_nios_subject = $('input[name="all_nios_subject[]"]:checked')
                .map(function() {
                    return $(this).val();
                }).get();

            var payment_status = $("input[name='payment_status']:checked").val();
            var category = $('#category').val();
            var sub_category = $('#sub_category').val();
            var location = $('#tutor_location').val();
            var lng = $('#lng').val();
            var lat = $('#lat').val();
            var language = $('#language').val();
            var degree = $('#degree').val();
            // var image = $('#image')[0].files[0];
            var institute_name = $('#institute_name').val();
            var degree_status = $('#degree_status').val();
            var password = $('#password').val();
            var teaching_experience = $('#teaching_experience').val();
            var experience_year = $('#experience_year').val();
            var backgorund_experience = $('#backgorund_experience').val();
            var youtube_url = $('#youtube_url').val();
            var charge_amount = $('#charge_amount').val();
            var describe_experience = $('#describe_experience').val();
            var amount = $('#price1').val();
            var options = {
                "key": "{{ env('RAZAR_CLIENT_ID') }}",
                "amount": (amount * 100),
                "name": name,
                "description": "Payment",
                "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
                "handler": function(response) {
                    window.location.href = SITEURL + '/' + 'paysuccessinstitute?payment_id=' + response
                        .razorpay_payment_id + '&amount=' + amount + '&name=' + name + '&mobile=' + mobile +
                        '&email=' + email + '&sub_category=' + sub_category + '&category=' + category +
                        '&location=' + location + '&language=' + language + '&image=' + image + '&degree=' +
                        degree + '&university_name=' + university_name +
                        '&degree_status=' + degree_status + '&password=' + password +
                        '&teaching_experience=' + teaching_experience + '&experience_year=' +
                        experience_year + '&backgorund_experience=' + backgorund_experience +
                         '&charge_amount=' + charge_amount +
                        '&describe_experience=' + describe_experience + '&youtube_url=' + youtube_url +
                        '&school_board=' + school_board + '&institute_name=' + institute_name +
                        '&conduct_mode_class=' + conduct_mode_class + '&all_state_subject=' +
                        all_state_subject + '&classes_mode=' + classes_mode + '&all_cbse_subject=' +
                        all_cbse_subject + '&all_state_board=' + all_state_board + '&all_icse_subject=' +
                        all_icse_subject + '&all_inter_subject=' + all_inter_subject +
                        '&lng=' + lng + '&lat=' + lat + '&all_nios_subject=' + all_nios_subject +
                        '&c_code=' + c_code + '&payment_status=' + payment_status;
                },
                "prefill": {
                    "contact": mobile,
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

        function select2subject2() {
            const input = document.querySelector("#tutor_mobile");
            window.intlTelInput(input, {
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
                initialCountry: "IN",
                separateDialCode: true,
            });
        }

        function initAutocomplete() {
            const locationInput = document.getElementById('tutor_location');
            const lat = document.getElementById('lat');
            const lng = document.getElementById('lng');
            const autocompleteContainer = document.getElementById('autocomplete-container');
            const autocomplete = new google.maps.places.Autocomplete(locationInput);
            // autocomplete.bindTo('bounds', map);
            const place = autocomplete.getPlace();
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                locationInput.value = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                // console.log(longitude);
                lat.value = latitude;
                lng.value = longitude;
            });
        }

        $(document).on('click', '#cbse1', function(event) {
            if ($("#cbse1").prop('checked') == true) {
                $('#CBSE11').removeClass('d-none');
            } else {
                $('#CBSE11').addClass('d-none');
            }
        });
        $(document).on('click', '#icse1', function(event) {
            if ($("#icse1").prop('checked') == true) {
                $('#ICSE11').removeClass('d-none');
            } else {
                $('#ICSE11').addClass('d-none');
            }
        });
        $(document).on('click', '#state1', function(event) {
            if ($("#state1").prop('checked') == true) {
                $('#STATE11').removeClass('d-none');
                $('#STATEB11').removeClass('d-none');
            } else {
                $('#STATE11').addClass('d-none');
                $('#STATEB11').addClass('d-none');
            }
        });
        $(document).on('click', '#int1', function(event) {
            if ($("#int1").prop('checked') == true) {
                $('#INT11').removeClass('d-none');
            } else {
                $('#INT11').addClass('d-none');
            }
        });
        $(document).on('click', '#igcse1', function(event) {
            if ($("#igcse1").prop('checked') == true) {
                $('#ICSE11').removeClass('d-none');
            } else {
                $('#ICSE11').addClass('d-none');
            }
        });
        $(document).on('click', '#nios1', function(event) {
            if ($("#nios1").prop('checked') == true) {
                $('#NIOS11').removeClass('d-none');
            } else {
                $('#NIOS11').addClass('d-none');
            }
        });

        $(document).on('select2:select', '.cate', function(e) {
            var id = $('#category').val();
            var value = e.params.data.id;
            // var id = value;
            // console.log(value);
            $.ajax({
                type: "get",
                url: "{{ route('front.sub-category-list') }}",
                data: {
                    'category': id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.success == true) {
                        $("#s_n").removeClass('d-none');
                        $("#sub_category").html('');
                        $.each(data.value, function(key, value) {
                            $("#sub_category").append('<option data-id="'+ value.parent +'" value="' + value.id + '">' +
                                value.name + ' (' + value.p_name + ')</option>');
                        });
                    }
                    if (data.success == false) {
                        $("#s_n").addClass('d-none');
                    }
                }
            });
        });

    </script>
    <script>
        $(document).on('change', '#teaching_experience', function() {
            var experience = $('#teaching_experience').val();
            if (experience === "Yes") {
                $("#e1_n").removeClass('d-none'); // Show the div
            } else {
                $("#e1_n").addClass('d-none'); // Hide the div
            }
        });
        $(document).ready(function() {
            $('#category').on("select2:unselecting", function(e) {
                // console.log(e.params.args.data.id);
                // return false;
                var value = e.params.args.data.id;
                // alert(value);

                $("#sub_category option").each(function() {
                    if ($(this).attr('data-id') == value) {
                        // $(this).prop('selected',false);
                        $(this).remove();
                    }
                });

                $('#sub_category').select2({
                    multiple: true,
                    placeholder: 'Select',
                    // ... other configurations ...
                });

            });

            // setTimeout(function(){
            //     $("#sub_category option").each(function(){
            //         if($(this).attr('data-id')=='113')
            //         {
            //             // $(this).prop('selected',false);
            //             $(this).remove();
            //             $('#sub_category').select2({
            //                 multiple: true,
            //                 placeholder: 'Select',
            //                 // ... other configurations ...
            //             });
            //         }
            //     });
            // },4000);
        });
    </script>
@endpush
