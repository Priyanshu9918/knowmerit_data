@extends('layouts.teacher.master')
@section('content')
    <style type="text/css">
        .user-nav a.dropdown-toggle {
            display: block;
        }

        .add-course-info .add-course-label {
            font-weight: 600;
            color: #000;
            margin-bottom: 3px;
            font-size: 14px !important;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e9ecef;
        }

        .select2-container--default .select2-selection--multiple {
            padding-bottom: unset;
            height: 43px;
        }

        label.add-course-label {
            font-weight: 600;
            color: #000;
            margin-bottom: 3px;
            font-size: 14px !important;
        }

        .category-tab ul li a {
            background: #E0E0E0;
        }

        span.select2.select2-container.select2-container--default {
            width: 100% !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            overflow: auto;
        }
    </style>
    <div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #f6f6f6;">
        <section class="page-content course-sec">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="add-course-header">
                            <h2>Update Profile</h2>
                            {{-- <div class="add-course-btns">
                                <ul class="nav">
                                    <li>
                                        <a href="dashboard-instructor.html" class="btn btn-black">Back to Course</a>
                                    </li>
                                    <div class="ticket-btn-grp">
                                        <a href="instructor-new-tickets.html">Deactivate Account</a>
                                        </div>
                                    <li>
                                        <a href="javascript:void(0);" class="btn btn-success-dark">Save</a>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="widget-set">
                                <div class="widget-setcount">
                                    <ul id="progressbar">
                                        <li class="progress-active">
                                            <p><span></span> Personal Information</p>
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
                                                <form
                                                    action="{{ route('teacher.dashboard.tutor.edit', ['id' => Auth::user()->id]) }}"
                                                    method="POST" id="editFrm" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="add-course-label">Name</label>
                                                                <input type="text" class="form-control" name="tutor_name"
                                                                    id="tutor_name" placeholder="Enter Teacher Name"
                                                                    value="{{ $tutor->name }}">
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
                                                                    value="{{ $tutor->email }}"
                                                                    placeholder="Enter Teacher Email" readonly>
                                                                <p style="margin-bottom: 2px;"
                                                                    class="text-danger error_container"
                                                                    id="error-tutor_email"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="add-course-label">Gender</label>
                                                                <select class="form-control" name="tutor_gender"
                                                                    id="tutor_gender">
                                                                    <option value="male"
                                                                        {{ $tutor->gender === 'male' ? 'selected' : '' }}>
                                                                        Male</option>
                                                                    <option value="female"
                                                                        {{ $tutor->gender === 'female' ? 'selected' : '' }}>
                                                                        Female</option>
                                                                    <option value="other"
                                                                        {{ $tutor->gender === 'other' ? 'selected' : '' }}>
                                                                        Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="add-course-label">Mobile Number</label>
                                                                <input type="tel" class="form-control" id="tutor_mobile"
                                                                    name="tutor_mobile" placeholder="Enter Tutor Mobile"
                                                                    value="{{ $tutor->mobile }}" />
                                                                <p style="margin-bottom: 2px;"
                                                                    class="text-danger error_container"
                                                                    id="error-tutor_name"></p>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="add-course-label">Image</label>

                                                                        <input class="form-control" name="image" type="file" id="image"
                                                                        accept="image/*">
                                                                        @if ($tutor->image)
                                                                        <img class="mt-2" src="{{ asset('uploads/tutors/' . $tutor->image) }}"
                                                                            width="100px" height="70px" alt="img">
                                                                        @endif

                                                                    <p style="margin-bottom: 2px;"
                                                                        class="text-danger error_container" id="error-image">
                                                                    </p>
                                                                </div>
                                                            </div> --}}


                                                        @php
                                                            $values = explode(',', $tutor->category);
                                                        @endphp
                                                        <div class="col-md-12">
                                                            <label class="add-course-label">Category</label>
                                                            <select class="form-control select select2 cate" id="category"
                                                                name="category[]" multiple>
                                                                <option value="" disabled>Select</option>
                                                                @foreach ($parent_categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        {{ in_array($category->id, $values) ? 'selected' : '' }}>
                                                                        {{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <p style="margin-bottom: 2px;"
                                                                class="text-danger error_container" id="error-category">
                                                            </p>
                                                        </div>
                                                        {{-- @php
                                                        $values = explode(',', $tutor->sub_category);
                                                        $parent_sub = DB::table('categories')
                                                            ->leftJoin('categories as c', 'categories.parent', '=', 'c.id')
                                                            ->select('categories.id', 'categories.name', 'categories.parent','c.name as p_name')
                                                            ->whereIn('categories.id', $values)
                                                            ->where('categories.status', '<>', 2)
                                                            ->get();
                                                        @endphp

                                                        <div class="col-md-6 @if (empty($values)) d-none @endif" id="s_n">
                                                            <label class="add-course-label">Sub Category</label>
                                                            <select class="form-control sub_category select select2" id="sub_category" name="sub_category[]" multiple>
                                                                <option value="" disabled>Select</option>
                                                                @foreach ($parent_sub as $sub_category)
                                                                    <option value="{{ $sub_category->id }}"  data-id="{{$sub_category->parent}}"
                                                                        {{ in_array($sub_category->id, $values) ? 'selected' : '' }}>
                                                                        {{ $sub_category->name }}({{ $sub_category->p_name }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-sub_category"></p>
                                                        </div> --}}

                                                        @php
                                                            $values = explode(',', $tutor->category);
                                                            $parent_sub = DB::table('categories')
                                                                ->leftJoin('categories as c', 'categories.parent', '=', 'c.id')
                                                                ->select('categories.id', 'categories.name', 'categories.parent', 'c.name as p_name')
                                                                ->whereIn('c.id', $values)
                                                                ->where('categories.status', '<>', 2)
                                                                ->get();
                                                        @endphp

                                                        <div class="col-md-12 @if (empty($values)) d-none @endif"
                                                            id="s_n">
                                                            <label class="add-course-label">Sub Category</label>
                                                            <select class="form-control sub_category select2"
                                                                id="sub_category" name="sub_category[]" multiple>
                                                                <option value="" disabled>Select</option>
                                                                @foreach ($parent_sub as $sub_category)
                                                                    <option data-id="{{ $sub_category->parent }}"
                                                                        value="{{ $sub_category->id }}"
                                                                        {{ in_array($sub_category->id, explode(',', $tutor->sub_category)) ? 'selected' : '' }}>
                                                                        {{ $sub_category->name }}({{ $sub_category->p_name }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <p style="margin-bottom: 2px;"
                                                                class="text-danger error_container" id="error-sub_category">
                                                            </p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="hidden" id="lat" name="lat"
                                                                    value="{{ $tutor->lat }}">
                                                                <input type="hidden" id="lng" name="lng"
                                                                    value="{{ $tutor->lng }}">
                                                                <label class="add-course-label">Location</label>
                                                                <input class="form-control" name="tutor_location"
                                                                    type="text" id="tutor_location"
                                                                    value="{{ $tutor->location }}"
                                                                    placeholder="Enter the location">
                                                                <p style="margin-bottom: 2px;"
                                                                    class="text-danger error_container"
                                                                    id="error-tutor_location"></p>
                                                                <div id="autocomplete-container"></div>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $values = explode(',', $tutor->language);
                                                        @endphp
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="add-course-label">Add languages that you
                                                                        speak</label>
                                                                <select class="form-control select select2"
                                                                    name="language[]" id="language" multiple>
                                                                    <option value="" disabled>Select</option>
                                                                    @foreach ($list_langauge as $lang)
                                                                        <option value="{{ $lang->value }}"
                                                                            {{ in_array($lang->value, $values) ? 'selected' : '' }}>
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
                                            <div class="widget-btn">
                                                <!-- <a class="btn btn-black">Back</a> -->
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
                                                            <label class="add-course-label">Add your most recent
                                                                Degree</label>
                                                            <select class="form-control mb-4" name="degree"
                                                                id="degree">
                                                                <option value="">Select</option>
                                                                <option value="12th"
                                                                    {{ $tutor->degree === '12th' ? 'selected' : '' }}>
                                                                    12th</option>
                                                                <option value="Graduation"
                                                                    {{ $tutor->degree === 'Graduation' ? 'selected' : '' }}>
                                                                    Graduation
                                                                </option>
                                                                <option value="Post Graduation"
                                                                    {{ $tutor->degree === 'Post Graduation' ? 'selected' : '' }}>
                                                                    Post
                                                                    Graduation</option>
                                                                <option value="Phd"
                                                                    {{ $tutor->degree === 'Phd' ? 'selected' : '' }}>
                                                                    Phd</option>
                                                            </select>
                                                            <p class="text-danger error_container" id="error-degree">
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="margin-top: -23px;">
                                                        <div class="form-group">
                                                            <label class="add-course-label"></label>
                                                            <input class="form-control mb-4 mt-4" type="text"
                                                                name="university_name" id="university_name"
                                                                value="{{ $tutor->university_name }}"
                                                                placeholder="Enter School/University Name">
                                                            <p class="text-danger error_container"
                                                                id="error-university_name">
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" style="margin-top: -23px;">
                                                        <div class="form-group ">
                                                            <label class="add-course-label"></label>
                                                            <select class="form-control mb-4 mt-4" name="degree_status"
                                                                id="degree_status">
                                                                <option value="">Select</option>
                                                                <option value="Completed"
                                                                    {{ $tutor->degree_status === 'Completed' ? 'selected' : '' }}>
                                                                    Completed
                                                                </option>
                                                                <option value="Pursuing"
                                                                    {{ $tutor->degree_status === 'Pursuing' ? 'selected' : '' }}>
                                                                    Pursuing
                                                                </option>
                                                            </select>
                                                            <p class="text-danger error_container"
                                                                id="error-degree_status">
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                @php
                                                    $board = explode(',', $tutor->school_board);
                                                @endphp
                                                <div class="col-md-12">
                                                    <label class="add-course-label">Which school boards of class 10 do
                                                        you
                                                        teach for?</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="school_board[]" value="cbse"
                                                            id="cbse"
                                                            {{ in_array('cbse', $board) ? 'checked' : '' }}>CBSE
                                                    </label>
                                                    <label class="checkbox-inline ">
                                                        <input type="checkbox" name="school_board[]" value="icse"
                                                            id="icse"
                                                            {{ in_array('icse', $board) ? 'checked' : '' }}>ICSE
                                                    </label>
                                                    <label class="checkbox-inline ">
                                                        <input type="checkbox" name="school_board[]" value="state"
                                                            id="state"
                                                            {{ in_array('state', $board) ? 'checked' : '' }}>State Board
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="school_board[]" value="int"
                                                            id="int"
                                                            {{ in_array('int', $board) ? 'checked' : '' }}>International
                                                        Baccalaureate
                                                    </label>
                                                    <label class="checkbox-inline ">
                                                        <input type="checkbox" name="school_board[]" value="dev"
                                                            id="dev"
                                                            {{ in_array('dev', $board) ? 'checked' : '' }}>DAV Board
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="school_board[]" value="nios"
                                                            id="nios"
                                                            {{ in_array('nios', $board) ? 'checked' : '' }}>NOS
                                                    </label>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                        id="error-school_board"></p>
                                                </div>
                                                @php
                                                    $cbse = DB::table('CBSE')->get();
                                                @endphp
                                                @php
                                                    $all_cbse_subject = explode(',', $tutor->cbse_subject);
                                                @endphp
                                                <div class="col-sm-12 {{ in_array('cbse', $board) ? '' : 'd-none' }}"
                                                    id="CBSE1">
                                                    <div class="form-group ">
                                                        <label class="add-course-label">Which of the following CBSE subjects
                                                                do you provide
                                                                tuition for?*</label>

                                                        <div class="row">
                                                            @foreach ($cbse as $cb)
                                                                <div class=""
                                                                    style="display: flex;justify-content-center">
                                                                    <p class="col-11">{{ $cb->subject }}</p>
                                                                    <input type="checkbox" name="all_cbse_subject[]"
                                                                        value="{{ $cb->subject }}"
                                                                        {{ in_array($cb->subject, $all_cbse_subject) ? 'checked' : '' }}>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-all_cbse_subject"></p>
                                                    </div>
                                                </div>
                                                @php
                                                    $icse = DB::table('ICSE')->get();
                                                @endphp
                                                @php
                                                    $all_icse_subject = explode(',', $tutor->icse_subject);
                                                @endphp
                                                <div class="col-sm-12 {{ in_array('icse', $board) ? '' : 'd-none' }}"
                                                    id="ICSE1">
                                                    <div class="form-group ">
                                                        <label class="add-course-label">Which of the following ICSE subjects
                                                                do you provide
                                                                tuition for?*</label>

                                                        <div class="row">
                                                            @foreach ($icse as $ic)
                                                                <div class=""
                                                                    style="display: flex;justify-content-center">
                                                                    <p class="col-11">{{ $ic->subject }}</p>
                                                                    <input type="checkbox" name="all_icse_subject[]"
                                                                        value="{{ $ic->subject }}"
                                                                        {{ in_array($ic->subject, $all_icse_subject) ? 'checked' : '' }}>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-all_icse_subject"></p>
                                                    </div>
                                                </div>

                                                @php
                                                    $inter = DB::table('International_Baccalaureate_sub')->get();
                                                @endphp
                                                @php
                                                    $all_inter_subject = explode(',', $tutor->international_subject);
                                                @endphp
                                                <div class="col-sm-12 {{ in_array('int', $board) ? '' : 'd-none' }}"
                                                    id="INT1">
                                                    <div class="form-group ">
                                                        <label class="add-course-label">Which of the following International
                                                                Baccalaureate
                                                                subjects do you provide tuition for?*</label>

                                                        <div class="row">
                                                            @foreach ($inter as $int)
                                                                <div class=""
                                                                    style="display: flex;justify-content-center">
                                                                    <p class="col-11">{{ $int->subject }}</p>
                                                                    <input type="checkbox" name="all_inter_subject[]"
                                                                        value="{{ $int->subject }}"
                                                                        {{ in_array($int->subject, $all_inter_subject) ? 'checked' : '' }}>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-all_inter_subject"></p>
                                                    </div>
                                                </div>
                                                @php
                                                    $nios = DB::table('NIOS')->get();
                                                @endphp
                                                @php
                                                    $all_nios_subject = explode(',', $tutor->nios_subject);
                                                @endphp
                                                <div class="col-sm-12 {{ in_array('nios', $board) ? '' : 'd-none' }}"
                                                    id="NIOS1">
                                                    <div class="form-group ">
                                                        <label class="add-course-label">Which of the following NIOS subjects
                                                                do you provide
                                                                tuition for?*</label>

                                                        <div class="row">
                                                            @foreach ($nios as $ni)
                                                                <div class=""
                                                                    style="display: flex;justify-content-center">
                                                                    <p class="col-11">{{ $ni->subject }}</p>
                                                                    <input type="checkbox" name="all_nios_subject[]"
                                                                        value="{{ $ni->subject }}"
                                                                        {{ in_array($ni->subject, $all_nios_subject) ? 'checked' : '' }}>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-all_nios_subject"></p>
                                                    </div>
                                                </div>
                                                @php
                                                    $state_sub = DB::table('state_sub')->get();
                                                @endphp
                                                @php
                                                    $all_state = explode(',', $tutor->all_state_subject);
                                                @endphp
                                                <div class="col-sm-12 {{ in_array('state', $board) ? '' : 'd-none' }}"
                                                    id="STATE1">
                                                    <div class="form-group">
                                                        <label class="add-course-label">Which of the following State Syllabus
                                                                subjects do you
                                                                provide tuition for?*</label>

                                                        <div class="row">
                                                            @foreach ($state_sub as $st_sub)
                                                                <div class=""
                                                                    style="display: flex;justify-content-center">
                                                                    <p class="col-11">{{ $st_sub->subject }}</p>
                                                                    <input type="checkbox" name="all_state_subject[]"
                                                                        value="{{ $st_sub->subject }}"
                                                                        {{ in_array($st_sub->subject, $all_state) ? 'checked' : '' }}>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-all_state_subject"></p>
                                                    </div>
                                                </div>
                                                @php
                                                    $state_bord = DB::table('state_boards')->get();
                                                @endphp
                                                @php
                                                    $all_state_board = explode(',', $tutor->state_board);
                                                @endphp
                                                <div class="col-sm-12 {{ in_array('state', $board) ? '' : 'd-none' }}"
                                                    id="STATEB1">
                                                    <div class="form-group ">
                                                        <label class="add-course-label">Which state boards of Class I-V do you
                                                                teach?*</label>

                                                        <div class="row">
                                                            @foreach ($state_bord as $st_brd)
                                                                <div class=""
                                                                    style="display: flex;justify-content-center">
                                                                    <p class="col-11">{{ $st_brd->board_name }}</p>
                                                                    <input type="checkbox" name="all_state_board[]"
                                                                        value="{{ $st_brd->board_name }}"
                                                                        {{ in_array($st_brd->board_name, $all_state_board) ? 'checked' : '' }}>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-all_state_board"></p>
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
                                                            <label class="add-course-label">Do you have any prior
                                                                teaching
                                                                experience?</label>
                                                            <select class="form-control" name="teaching_experience"
                                                                id="teaching_experience">
                                                                <option value="">Select</option>
                                                                <option value="Yes"
                                                                    {{ $tutor->teaching_experience === 'Yes' ? 'selected' : '' }}>
                                                                    Yes
                                                                </option>
                                                                <option value="No"
                                                                    {{ $tutor->teaching_experience === 'No' ? 'selected' : '' }}>
                                                                    No
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 @if ($tutor->experience_year == '') d-none @endif"
                                                        id="e_n">
                                                        <div class="form-group">
                                                            <label class="add-course-label">What is your Total
                                                                experience (in
                                                                Years)?</label>
                                                            <select class="form-control" name="experience_year"
                                                                id="experience_year">
                                                                <option value="">Select</option>
                                                                <option value="0"
                                                                    {{ $tutor->experience_year === '0' ? 'selected' : '' }}>
                                                                    0</option>
                                                                <option value="1"
                                                                    {{ $tutor->experience_year === '1' ? 'selected' : '' }}>
                                                                    1</option>
                                                                <option value="2"
                                                                    {{ $tutor->experience_year === '2' ? 'selected' : '' }}>
                                                                    2</option>
                                                                <option value="3"
                                                                    {{ $tutor->experience_year === '3' ? 'selected' : '' }}>
                                                                    3</option>
                                                                <option value="4"
                                                                    {{ $tutor->experience_year === '4' ? 'selected' : '' }}>
                                                                    4</option>
                                                                <option value="5"
                                                                    {{ $tutor->experience_year === '5' ? 'selected' : '' }}>
                                                                    5</option>
                                                                <option value="6"
                                                                    {{ $tutor->experience_year === '6' ? 'selected' : '' }}>
                                                                    6</option>
                                                                <option
                                                                    value="7"{{ $tutor->experience_year === '7' ? 'selected' : '' }}>
                                                                    7</option>
                                                                <option value="8"
                                                                    {{ $tutor->experience_year === '8' ? 'selected' : '' }}>
                                                                    8</option>
                                                                <option value="9"
                                                                    {{ $tutor->experience_year === '9' ? 'selected' : '' }}>
                                                                    9</option>
                                                                <option
                                                                    value="10"{{ $tutor->experience_year === '10' ? 'selected' : '' }}>
                                                                    10</option>
                                                                <option value="11"
                                                                    {{ $tutor->experience_year === '11' ? 'selected' : '' }}>
                                                                    11</option>
                                                                <option value="12"
                                                                    {{ $tutor->experience_year === '12' ? 'selected' : '' }}>
                                                                    12</option>
                                                                <option value="13"
                                                                    {{ $tutor->experience_year === '13' ? 'selected' : '' }}>
                                                                    13</option>
                                                                <option value="14"
                                                                    {{ $tutor->experience_year === '14' ? 'selected' : '' }}>
                                                                    14</option>
                                                                <option value="15"
                                                                    {{ $tutor->experience_year === '15' ? 'selected' : '' }}>
                                                                    15</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="add-course-label" for="comment">What is
                                                                your
                                                                background &amp; experience?</label>
                                                            <textarea class="form-control" rows="5" id="backgorund_experience" name="backgorund_experience"
                                                                placeholder="Eg : I am a teacher/engineer... I am giving home/online/tutor home tuition since..I am certified in... I have a degree in.. My key skills are.. My  accomplishments.. Any other relevant detials to make your profile looks richer.">{{ $tutor->describe_experience }}</textarea>
                                                            <p style="margin-bottom: 2px;"
                                                                class="text-danger error_container"
                                                                id="error-backgorund_experience"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="add-course-label" for="comment">Introduction Video Link</label>
                                                                <input type="text" class="form-control" name="youtube_url" id="youtube_url" placeholder="Youtube Link" value="{{ $tutor->youtube_url}}">
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
                                                <h4>Classes</h4>
                                            </div>
                                            <div class="add-course-form">

                                                <div class="row">
                                                    {{-- <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="add-course-label">How Long are you willing to
                                                                        Travel(Km)?</label>
                                                                    <input type="text" class="form-control"
                                                                        name="tutor_travel" id="tutor_travel" value="{{ $tutor->tutor_travel }}"
                                                                        placeholder="Enter Travel (Max 25km)">
                                                                    <p style="margin-bottom: 2px;"
                                                                        class="text-danger error_container"
                                                                        id="error-tutor_travel"></p>
                                                                </div>
                                                            </div> --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="add-course-label">How much do you charge per
                                                                hour?</label>
                                                            <input type="number" class="form-control"
                                                                name="charge_amount" id="charge_amount"
                                                                value="{{ $tutor->charge_amount }}"
                                                                placeholder="₹ Enter Price / Hour">
                                                            <p style="margin-bottom: 2px;"
                                                                class="text-danger error_container"
                                                                id="error-charge_amount"></p>
                                                        </div>
                                                    </div>
                                                    {{-- @php
                                                            $mode = explode(',', $tutor->classes_mode);
                                                            @endphp
                                                            <div class="col-md-6">
                                                                <label class="add-course-label">Do you search private or group
                                                                    classses?</label><br>
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" name="classes_mode[]" value="Private Classes"
                                                                    id="private_classes" class="op1"
                                                                    {{ in_array('Private Classes', $mode) ? 'checked' : '' }}>One on one / Private
                                                                Tutions
                                                                </label>
                                                                <label class="checkbox-inline op12">
                                                                    <input type="checkbox" name="classes_mode[]" value="Group Classes"
                                                    id="group_classes" class="op1"
                                                    {{ in_array('Group Classes', $mode) ? 'checked' : '' }}>Group
                                                Classes
                                                                </label>
                                                                <p style="margin-bottom: 2px;"
                                                                    class="text-danger error_container"
                                                                    id="error-classes_mode"></p>
                                                            </div> --}}
                                                    @php
                                                        $conduct_mode = explode(',', $tutor->conduct_mode_class);
                                                    @endphp
                                                    <div class="col-md-6">
                                                        <label class="add-course-label">Preferrable mode of classes
                                                            ?</label><br>
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" name="conduct_mode_class[]"id="conduct_mode_class"
                                                            value="Online"
                                                            {{ in_array('Online', $conduct_mode) ? 'checked' : '' }}> Online (Remote)
                                                        </label><br>
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" name="conduct_mode_class[]" value="Offline"
                                                            id="conduct_mode_class"
                                                            {{ in_array('Offline', $conduct_mode) ? 'checked' : '' }}> Offline
                                                        </label><br>
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" name="conduct_mode_class[]" value="Hybrid"
                                                            id="conduct_mode_class"
                                                            {{ in_array('Hybrid', $conduct_mode) ? 'checked' : '' }}> Hybrid (Online + Offline)
                                                        </label>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                            id="error-conduct_mode_class"></p>

                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="add-course-label" for="comment">Tell us about
                                                                yourself (Describe your
                                                                experience in School or Collage)</label>
                                                            <textarea class="form-control" rows="5" id="describe_experience" name="describe_experience"
                                                                placeholder="E.g. : During my time at school/college, I pursued studies in... I actively participated in... I was involved with clubs/organizations such as... My academic achievements include... I completed my degree/diploma in... My key learnings from this experience were... Any other pertinent details that enhance my educational profile.">{{ $tutor->describe_experience }}</textarea>
                                                            <p style="margin-bottom: 2px;"
                                                                class="text-danger error_container"
                                                                id="error-describe_experience"></p>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group ">
                                                        <label class="col-sm-12 col-add-course-label">Benefits</label>

                                                        <input type="text" class="form-control" id="payment_status"
                                                            name="payment_status" value="{{ $tutor->payment_status }}"
                                                            readonly />
                                                    </div>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                        id="error-classes_choice"></p>
                                                </div>
                                            </div>
                                            <div class="widget-btn">
                                                <a class="btn btn-black prev_btn">Previous</a>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="widget-btn">
                                                            <button type="submit"
                                                                class="btn btn-info-light ">Update</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </fieldset>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $('.tab-value').click(function() {
            var t = $(this).text();
            $('#addbtn').html('Add' + t);
        });
    </script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tutor_name').on('keypress', function(e) {
                var $this = $(this);
                var regex = /^[A-Za-z ]+$/;
                var inputChar = String.fromCharCode(e.which);

                if (!regex.test(inputChar)) {
                    e.preventDefault();
                }
            });
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
            let progressVal = 0;
            let businessType = 0;
            $(".next_btn0").click(function() {
                var name = $('#tutor_name').val();
                var email = $('#tutor_email').val();
                var mobile = $('#tutor_mobile').val();
                var gender = $('#tutor_gender').val();
                var category = $('#category').val();
                var location = $('#tutor_location').val();
                var language = $('#language').val();
                // var image = $('#image').val();

                var errors = false;

                if (name == '') {
                    $('#error-tutor_name').html('Please enter tutor name');
                    errors = true;
                } else {
                    $('#error-tutor_name').html('');
                }

                if (email == '') {
                    $('#error-tutor_email').html('Please enter email');
                    errors = true;
                } else {
                    $('#error-tutor_email').html('');
                }

                // if (gender == '') {
                //     $('#error-tutor_gender').html('Please enter gender');
                //     errors = true;
                // } else {
                //     $('#error-tutor_gender').html('');
                // }
                if (category == '') {
                    $('#error-category').html('Please enter category');
                    errors = true;
                } else {
                    $('#error-category').html('');
                }

                if (location == '') {
                    $('#error-tutor_location').html('Please enter location');
                    errors = true;
                } else {
                    $('#error-tutor_location').html('');
                }

                // if (image == '') {
                //     $('#error-image').html('Please enter image');
                //     errors = true;
                // } else {
                //     $('#error-image').html('');
                // }

                if (language == '') {
                    $('#error-language').html('Please enter language');
                    errors = true;
                } else {
                    $('#error-language').html('');
                }

                if (mobile == '') {
                    $('#error-tutor_mobile').html('Please enter mobile number');
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
                var errors = false;
                if (degree == '') {
                    $('#error-degree').html('Please enter a degree');
                    errors = true;
                } else {
                    $('#error-degree').html('');
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
                // var experience_year = $('#experience_year').val();
                var backgorund_experience = $('#backgorund_experience').val();

                var errors = false;

                // if (teaching_experience == '') {
                //     $('#error-teaching_experience').html('Please enter teaching experience');
                //     errors = true;
                // } else {
                //     $('#error-teaching_experience').html('');
                // }

                if (experience_year == '') {
                    $('#error-experience_year').html('Please enter experience years');
                    errors = true;
                } else {
                    $('#error-experience_year').html('');
                }

                if (backgorund_experience == '') {
                    $('#error-backgorund_experience').html('Please enter backgorund experience');
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
                // var tutor_travel = $('#tutor_travel').val();
                var charge_amount = $('#charge_amount').val();
                var describe_experience = $('#describe_experience').val();

                var errors = false;

                // if (tutor_travel == '') {
                //     $('#error-tutor_travel').html('Please enter tutor travel');
                //     errors = true;
                // } else {
                //     $('#error-tutor_travel').html('');
                // }

                if (charge_amount == '') {
                    $('#error-charge_amount').html('Please enter charge amount');
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
                    $('#error-describe_experience').html('Please enter describe experience');
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
                            toastr.success("Teacher Updated Successfully");
                            // Swal.fire({
                            // position: 'top-end',
                            // icon: 'success',
                            // title: 'User Updated Successfully',
                            // showConfirmButton: false,
                            // timer: 1500
                            // })
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

        $(document).ready(function() {
            $('#category').select2({
                multiple: true,
                placeholder: 'Select',
                // ... other configurations ...
            });
        });
        $(document).ready(function() {
            $('#language').select2({
                multiple: true,
                placeholder: 'Select',
                // ... other configurations ...
            });
        });
        $(document).ready(function() {
            $('#sub_category').select2({
                multiple: true,
                placeholder: 'Select',
                // ... other configurations ...
            });
        });
        window.onload = function() {
            const input = document.querySelector("#tutor_mobile");
            window.intlTelInput(input, {
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
                initialCountry: "{{ $iso }}",
                separateDialCode: true,
            });
            setTimeout(function() {
                const value = "{{ $tutor->mobile }}"; //input.value.trim();
                if (value !== '') {
                    const cleanedValue = value.replace(/[\s\-]+/g, '').replace(/^0+/, '');
                    input.value = cleanedValue;
                }
            }, 500);
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

        $(document).on('click', '#cbse', function(event) {
            if ($("#cbse").prop('checked') == true) {
                $('#CBSE1').removeClass('d-none');
            } else {
                $('#CBSE1').addClass('d-none');
                $('#CBSE1 input:checkbox').prop('checked', false);
            }
        });
        $(document).on('click', '#icse', function(event) {
            if ($("#icse").prop('checked') == true) {
                $('#ICSE1').removeClass('d-none');

            } else {
                $('#ICSE1').addClass('d-none');
                $('#ICSE1 input:checkbox').prop('checked', false);
            }
        });
        $(document).on('click', '#state', function(event) {
            if ($("#state").prop('checked') == true) {
                $('#STATE1').removeClass('d-none');
                $('#STATEB1').removeClass('d-none');
            } else {
                $('#STATE1').addClass('d-none');
                $('#STATEB1').addClass('d-none');
                $('#STATE1 input:checkbox').prop('checked', false);
                $('#STATEB1 input:checkbox').prop('checked', false);
            }
        });
        $(document).on('click', '#int', function(event) {
            if ($("#int").prop('checked') == true) {
                $('#INT1').removeClass('d-none');
            } else {
                $('#INT1').addClass('d-none');
                $('#INT1 input:checkbox').prop('checked', false);
            }
        });
        $(document).on('click', '#igcse', function(event) {
            if ($("#igcse").prop('checked') == true) {
                $('#ICSE1').removeClass('d-none');
            } else {
                $('#ICSE1').addClass('d-none');
                $('#ICSE1 input:checkbox').prop('checked', false);
            }
        });
        $(document).on('click', '#nios', function(event) {
            if ($("#nios").prop('checked') == true) {
                $('#NIOS1').removeClass('d-none');
            } else {
                $('#NIOS1').addClass('d-none');
                $('#NIOS1 input:checkbox').prop('checked', false);
            }
        });

        $(document).on('select2:select', '.cate', function(e) {
            var id = $('#category').val();
            var value = e.params.data.id;
            $.ajax({
                type: "get",
                url: "{{ route('front.sub-category-list-edit') }}",
                data: {
                    'category': value,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.success == true) {
                        $("#s_n").removeClass('d-none');
                        // $("#sub_category").empty();
                        $.each(data.value, function(key, value) {
                            $("#sub_category").append('<option  data-id="'+ value.parent +'" value="' + value.id + '">' +
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
                $("#e_n").removeClass('d-none'); // Show the div
            } else {
                $("#e_n").addClass('d-none'); // Hide the div
            }
        });
        $(document).ready(function() {

            $(document).on("select2:unselecting", '#category', function(e) {
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

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4Bec1p6cCz6VvI3oRvWAyh0VBI9FOmw4&libraries=places&callback=initAutocomplete"
        async defer></script>
@endpush
