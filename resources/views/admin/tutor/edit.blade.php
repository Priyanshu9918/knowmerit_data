@extends('layouts.admin.master')
<style>
    span.select2.select2-container.select2-container--default {
        width: 100% !important;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
        overflow: auto;
    }

    .select2-container--default .select2-selection--multiple {
        overflow: auto;
    }
    .flex-design {
  display: flex;
  justify-content: space-between;
}
</style>
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">


                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Teacher</h4>
                            <form action="{{ route('admin.tutor.edit', ['id' => base64_encode($tutor->id)]) }}" method="POST"
                                id="editFrm" enctype="multipart/form-data">
                                @csrf
                                <p class="card-description">
                                    Personal info
                                </p>
                                <div class="row gx-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Name</b></label>
                                            <input class="form-control" type="text" name="tutor_name" id="tutor_name"
                                                placeholder="Enter Teacher name" value="{{ $tutor->name }}" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-tutor_name"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Email</b></label>
                                            <input class="form-control" type="email" name="tutor_email" id="tutor_email"
                                                placeholder="Enter Teacher email" value="{{ $tutor->email }}" readonly />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-tutor_email"></p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Gender</b></label>
                                            <select class="form-control" name="tutor_gender" id="tutor_gender">
                                                <option value="">Select</option>
                                                <option value="male" {{ $tutor->gender === 'male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="female" {{ $tutor->gender === 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                                <option value="other" {{ $tutor->gender === 'other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-tutor_gender"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Mobile</b></label>
                                            <div class="input-group">
                                                <input type="tel" class="form-control" id="tutor_mobile"
                                                    name="tutor_mobile" placeholder="Enter Tutor Mobile"
                                                    value="{{ $tutor->mobile }}" />
                                            </div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-tutor_mobile"></p>
                                        </div>
                                    </div>
                                    {{-- @php
                                        $p = explode(',', $tutor->parent_id);
                                    @endphp
                                    <div class="col-sm-6">
                                        <label class="form-label"><b>Teach Subject</b></label>
                                        <select class="form-control select select2" name="tutor_subject_teach[]"
                                            id="tutor_subject_teach" multiple>
                                            <option value="" disabled>Select</option>
                                            @foreach ($parent_categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ in_array($cat->id, $p) ? 'selected' : '' }}>{{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-tutor_subject_teach"></p>
                                    </div> --}}
                                    @php
                                        $values = explode(',', $tutor->category);
                                    @endphp
                                    <div class="col-md-6">
                                        <label class="form-label"><b>Category</b></label>
                                        <select class="form-control select select2 cate" id="category" name="category[]"
                                            multiple>
                                            <option value="" disabled>Select</option>
                                            @foreach ($parent_categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ in_array($category->id, $values) ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-category">
                                        </p>
                                    </div>

                                    @php
                                        $values = explode(',', $tutor->category);
                                        $parent_sub = DB::table('categories')
                                            ->leftJoin('categories as c', 'categories.parent', '=', 'c.id')
                                            ->select('categories.id', 'categories.name', 'categories.parent', 'c.name as p_name')
                                            ->whereIn('c.id', $values)
                                            ->where('categories.status', '<>', 2)
                                            ->get();
                                    @endphp

                                    <div class="col-md-6 @if (empty($values)) d-none @endif" id="s_n">
                                        <label class="form-label"><b>Sub Category</b></label>
                                        <select class="form-control sub_category select2" id="sub_category"
                                            name="sub_category[]" multiple>
                                            <option value="" disabled>Select</option>
                                            @foreach ($parent_sub as $sub_category)
                                                <option data-id="{{ $sub_category->parent }}"
                                                    value="{{ $sub_category->id }}"
                                                    {{ in_array($sub_category->id, explode(',', $tutor->sub_category)) ? 'selected' : '' }}>
                                                    {{ $sub_category->name }}({{ $sub_category->p_name }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-sub_category"></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Location</b></label>
                                            <input type="hidden" id="lat" name="lat"
                                                value="{{ $tutor->lat }}">
                                            <input type="hidden" id="lng" name="lng" value="{{ $tutor->lng }}">
                                            <input class="form-control" name="tutor_location" type="text"
                                                id="tutor_location" placeholder="Enter the location"
                                                value="{{ $tutor->location }}">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-tutor_location"></p>
                                            <div id="autocomplete-container"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gx-3">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label"><b>What is your background & experience?</b></label>
                                            <textarea class="form-control" rows="5" id="backgorund_experience" name="backgorund_experience">{{ $tutor->backgorund_experience }}</textarea>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-backgorund_experience"></p>
                                        </div>
                                    </div>

                                    @php
                                        $values = explode(',', $tutor->language);
                                    @endphp
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Add languages that you speak</b></label>
                                            <select class="form-control select select2" name="language[]" id="language"
                                                multiple>
                                                <option value="" disabled>Select</option>
                                                @foreach ($list_langauge as $lang)
                                                    <option value="{{ $lang->value }}"
                                                        {{ in_array($lang->value, $values) ? 'selected' : '' }}>
                                                        {{ $lang->value }}</option>
                                                @endforeach
                                            </select>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-language"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="formFile" class="form-label"><b>Image </b></label>
                                            <input class="form-control" name="image" type="file" id="image"
                                                accept="image/*">
                                            @if ($tutor->image)
                                                <img class="mt-2" src="{{ asset('uploads/tutors/' . $tutor->image) }}"
                                                    width="100px" height="70px" alt="img">
                                            @endif

                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-image"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Add your most recent Degree</b></label>
                                            <select class="form-control mb-4" name="degree" id="degree">
                                                <option value="">Select</option>
                                                <option value="12th" {{ $tutor->degree === '12th' ? 'selected' : '' }}>
                                                    12th</option>
                                                <option value="Graduation"
                                                    {{ $tutor->degree === 'Graduation' ? 'selected' : '' }}>Graduation
                                                </option>
                                                <option value="Post Graduation"
                                                    {{ $tutor->degree === 'Post Graduation' ? 'selected' : '' }}>Post
                                                    Graduation</option>
                                                <option value="Phd" {{ $tutor->degree === 'Phd' ? 'selected' : '' }}>
                                                    Phd</option>
                                            </select>
                                            <input class="form-control mb-4" type="text" name="university_name"
                                                placeholder="Enter School/University Name"
                                                value="{{ $tutor->university_name }}" />

                                            <select class="form-control select2 mb-4" name="degree_status"
                                                id="degree_status">
                                                <option value="">Select</option>
                                                <option value="Completed"
                                                    {{ $tutor->degree_status === 'Completed' ? 'selected' : '' }}>Completed
                                                </option>
                                                <option value="Pursuing"
                                                    {{ $tutor->degree_status === 'Pursuing' ? 'selected' : '' }}>Pursuing
                                                </option>
                                            </select>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-university_name"></p>
                                        </div>
                                    </div>
                                    @php
                                        $board = explode(',', $tutor->school_board);
                                    @endphp
                                    <div class="col-sm-6  ">
                                        <div class="form-group ">
                                            <label class="form-label "><b>Which school boards of class 10 do you teach
                                                    for?</b></label>
                                            <div class="row">
                                                <div class="flex-design">
                                                <p class="col-10">CBSE</p>
                                                <input type="checkbox" name="school_board[]" value="cbse"
                                                    id="cbse" {{ in_array('cbse', $board) ? 'checked' : '' }}>
                                                </div>
                                                <div class="flex-design">
                                                <p class="col-10">ICSE</p>
                                                <input type="checkbox" name="school_board[]" value="icse"
                                                    id="icse" {{ in_array('icse', $board) ? 'checked' : '' }}>
                                                </div>
                                                <div class="flex-design">
                                                <p class="col-10">State</p>
                                                <input type="checkbox" name="school_board[]" value="state"
                                                    id="state" {{ in_array('state', $board) ? 'checked' : '' }}>
                                                </div>
                                                <div class="flex-design">
                                                <p class="col-10">International Baccalaureate</p>
                                                <input type="checkbox" name="school_board[]" value="int"
                                                    id="int" {{ in_array('int', $board) ? 'checked' : '' }}>
                                                </div>
                                                <div class="flex-design">
                                                <p class="col-10">Dev Board</p>
                                                <input type="checkbox" name="school_board[]" value="dev"
                                                    id="dev" {{ in_array('dev', $board) ? 'checked' : '' }}>
                                                </div>
                                                <div class="flex-design">
                                                <p class="col-10">NIOS</p>
                                                <input type="checkbox" name="school_board[]" value="nios"
                                                    id="nios" {{ in_array('nios', $board) ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-school_board"></p>
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Do you have any prior teaching
                                                    experience?</b></label>
                                            <select class="form-control" name="teaching_experience"
                                                id="teaching_experience">
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                    {{ $tutor->teaching_experience === 'Yes' ? 'selected' : '' }}>Yes
                                                </option>
                                                <option value="No"
                                                    {{ $tutor->teaching_experience === 'No' ? 'selected' : '' }}>No
                                                </option>
                                            </select>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-teaching_experience"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 @if ($tutor->experience_year == '') d-none @endif" id="e_n">
                                        <div class="form-group">
                                            <label class="form-label"><b>What is your Total experience (in
                                                    Years)?</b></label>
                                            <select class="form-control" name="experience_year" id="experience_year">
                                                <option value="">Select</option>
                                                 <option value="1"
                                                    {{ $tutor->experience_year === '1' ? 'selected' : '' }}>1</option>
                                                <option value="2"
                                                    {{ $tutor->experience_year === '2' ? 'selected' : '' }}>2</option>
                                                <option value="3"
                                                    {{ $tutor->experience_year === '3' ? 'selected' : '' }}>3</option>
                                                <option value="4"
                                                    {{ $tutor->experience_year === '4' ? 'selected' : '' }}>4</option>
                                                <option value="5"
                                                    {{ $tutor->experience_year === '5' ? 'selected' : '' }}>5</option>
                                                <option value="6"
                                                    {{ $tutor->experience_year === '6' ? 'selected' : '' }}>6</option>
                                                <option
                                                    value="7"{{ $tutor->experience_year === '7' ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="8"
                                                    {{ $tutor->experience_year === '8' ? 'selected' : '' }}>8</option>
                                                <option value="9"
                                                    {{ $tutor->experience_year === '9' ? 'selected' : '' }}>9</option>
                                                <option
                                                    value="10"{{ $tutor->experience_year === '10' ? 'selected' : '' }}>
                                                    10</option>
                                                <option value="11"
                                                    {{ $tutor->experience_year === '11' ? 'selected' : '' }}>11</option>
                                                <option value="12"
                                                    {{ $tutor->experience_year === '12' ? 'selected' : '' }}>12</option>
                                                <option value="13"
                                                    {{ $tutor->experience_year === '13' ? 'selected' : '' }}>13</option>
                                                <option value="14"
                                                    {{ $tutor->experience_year === '14' ? 'selected' : '' }}>14</option>
                                                <option value="15"
                                                    {{ $tutor->experience_year === '15' ? 'selected' : '' }}>15</option>
                                            </select>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-experience_year"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Introduction Video Link</b></label>
                                                <input type="text" class="form-control" name="youtube_url" id="youtube_url" placeholder="Youtube Link" value="{{ $tutor->youtube_url}}">
                                           <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-youtube_url"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>How much do you charge per hour?</b></label><br>
                                            <input class="form-control" type="number" name="charge_amount"
                                                id="charge_amount" placeholder="₹ Enter Price / Hour"
                                                value="{{ $tutor->charge_amount }}" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-charge_amount"></p>
                                        </div>
                                    </div>
                                    {{-- @php
                                        $mode = explode(',', $tutor->classes_mode);
                                    @endphp
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Do you seach private or group
                                                    classses?</b></label>
                                            <div class="row">
                                                <p class="col-10">One on one / Private Tutions</p>
                                                <input type="checkbox" name="classes_mode[]" value="Private Classes"
                                                    {{ in_array('Private Classes', $mode) ? 'checked' : '' }}>
                                                <p class="col-10">Group Classes</p>
                                                <input type="checkbox" name="classes_mode[]" value="Group Classes"
                                                    {{ in_array('Group Classes', $mode) ? 'checked' : '' }}>
                                            </div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-classes_mode"></p>
                                        </div>
                                    </div> --}}

                                    @php
                                        $conduct_mode = explode(',', $tutor->conduct_mode_class);
                                    @endphp
                                    <div class="col-sm-6  ">
                                        <div class="form-group ">
                                            <label class="form-label"><b>Preferrable mode of classes ?</b></label>
                                            <div class="row">
                                                <div class="flex-design">
                                                <p class="col-10">Online (Remote)</p>
                                                <input type="checkbox" name="conduct_mode_class[]" value="Online"
                                                    {{ in_array('Online', $conduct_mode) ? 'checked' : '' }}>
                                                </div>
                                                <div class="flex-design">
                                                <p class="col-10">Student Location (Offline)</p>
                                                <input type="checkbox" name="conduct_mode_class[]"
                                                    value="Student Location"
                                                    {{ in_array('Student Location', $conduct_mode) ? 'checked' : '' }}>
                                                </div>
                                                <div class="flex-design">
                                                    <p class="col-10">At My Location (Offline)</p>
                                                <input type="checkbox" name="conduct_mode_class[]" value="At My Location"
                                                    {{ in_array('At My Location', $conduct_mode) ? 'checked' : '' }}>
                                                </div>
                                                </div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-conduct_mode_class"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="form-label"><b>Tell us about yourself (Describe your
                                                        experience in School or Collage)</b></label>
                                                <textarea class="form-control" rows="5" id="describe_experience" name="describe_experience">{{ $tutor->describe_experience }}</textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-describe_experience"></p>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $cbse = DB::table('CBSE')->get();
                                        $all_cbse_subject = explode(',', $tutor->cbse_subject);
                                    @endphp
                                    <div class="col-sm-12 {{ in_array('cbse', $board) ? '' : 'd-none' }}" id="CBSE1">
                                        <div class="form-group ">
                                            <label class="form-label"><b>Which of the following CBSE subjects do you
                                                    provide tuition for?*</b></label>
                                            <div class="row">
                                                @foreach ($cbse as $cb)
                                                <div class="flex-design">
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
                                        $all_icse_subject = explode(',', $tutor->icse_subject);
                                    @endphp
                                    <div class="col-sm-12  {{ in_array('icse', $board) ? '' : 'd-none' }}"
                                        id="ICSE1">
                                        <div class="form-group ">
                                            <label class="form-label"><b>Which of the following ICSE subjects do you
                                                    provide tuition for?*</b></label>
                                            <div class="row">
                                                @foreach ($icse as $ic)
                                                <div class="flex-design">
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
                                        $all_inter_subject = explode(',', $tutor->international_subject);
                                    @endphp
                                    <div class="col-sm-12 {{ in_array('int', $board) ? '' : 'd-none' }} " id="INT1">
                                        <div class="form-group ">
                                            <label class="form-label"><b>Which of the following International Baccalaureate
                                                    subjects do you provide tuition for?*</b></label>
                                            <div class="row">
                                                @foreach ($inter as $int)
                                                <div class="flex-design">
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
                                        $all_nios_subject = explode(',', $tutor->nios_subject);
                                    @endphp
                                    <div class="col-sm-12 {{ in_array('nios', $board) ? '' : 'd-none' }} "
                                        id="NIOS1">
                                        <div class="form-group ">
                                            <label class="form-label"><b>Which of the following NIOS subjects do you
                                                    provide tuition for?*</b></label>
                                            <div class="row">
                                                @foreach ($nios as $ni)
                                                <div class="flex-design">
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
                                            <label class="form-label"><b>Which of the following State Syllabus
                                                    subjects do you
                                                    provide tuition for?*</b></label>

                                            <div class="row">
                                                @foreach ($state_sub as $st_sub)
                                                <div class="flex-design">
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
                                            <label class="form-label"><b>Which state boards of Class I-V do you
                                                    teach?*</b></label>

                                            <div class="row">
                                                @foreach ($state_bord as $st_brd)
                                                 <div class="flex-design">
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

                                    @php
                                        $member_ship = DB::table('member_ship_plans')
                                            ->where('status', 1)
                                            ->get();
                                    @endphp
                                    <div class="col-sm-12">
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Benefits</b></label>

                                            <input type="text" class="form-control" id="payment_status"
                                                name="payment_status" value="{{ $tutor->payment_status }}" readonly />
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-classes_choice"></p>
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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            {{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
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
                                        window.location = "{{ url('/') }}" +
                                            "/admin/teacher";
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
                    }
                });
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
                    // alert(id);
                    $.ajax({
                        type: "get",
                        url: "{{ route('admin.tutor.sub-category-list-edit') }}",
                        data: {
                            'category': value,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success == true) {
                                $("#s_n").removeClass('d-none');
                                // $("#sub_category").empty();
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


            <!-- JavaScript/jQuery code -->
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
