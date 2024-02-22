@extends('layouts.admin.master')
<style>
    .form-check {
        padding-left: 50px !important;
    }

    .form-check .form-check-label {
        margin-left: 0.75rem !important;
    }
    span.select2.select2-container.select2-container--default {
    width: 100% !important;
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
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
                            <div class="row gx-3">
                                <div class="col-sm-3">
                                    <h4 class="card-title">Teacher</h4>
                                </div>
                                <div class="col-sm-9 d-flex">
                                    <div class="form-check">
                                        <a href="{{route('admin.tutor.create')}}">
                                            <label class="radio-inline">
                                                <input type="radio" name="optradio">
                                                <span style="color:#000">I am an Individual</span>
                                            </label>
                                        </a>
                                    </div>
                                    <div class="form-check">
                                        <a href="{{ route('admin.institute.create') }}">
                                            <label class="radio-inline">
                                                <input type="radio" name="optradio" checked> I run an Institute
                                            </label>
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <form action="{{ route('admin.institute.create') }}" method="POST" id="createFrm"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="bnft" name="bnft" />
                                <input type="hidden" id="price1" name="price1" />
                                <p class="card-description">
                                    Personal info
                                </p>
                                <div class="row gx-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Institute Name</b></label>
                                            <input class="form-control" type="text" name="institute_name"
                                                id="institute_name" placeholder="Enter Teacher name" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-institute_name"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Contact person name</b></label>
                                            <input class="form-control" type="text" name="tutor_name" id="tutor_name"
                                                placeholder="Enter Teacher name" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-tutor_name"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Email</b></label>
                                            <input class="form-control" type="email" name="tutor_email" id="tutor_email"
                                                placeholder="Enter Teacher email" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-tutor_email"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Phone</b></label>
                                            <div class="input-group">
                                                <input type="tel" class="form-control" id="tutor_mobile"
                                                    name="tutor_mobile" placeholder="Enter Teacher Mobile" maxlength="10" />
                                            </div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-tutor_mobile"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>What is your background &
                                                    experience?</b></label>
                                            <textarea class="form-control" rows="5" id="backgorund_experience" name="backgorund_experience"
                                                placeholder="Eg : I am a teacher/engineer... I am giving home/online/tutor home tuition since..I am certified in... I have a degree in.. My key skills are.. My  accomplishments.. Any other relevant detials to make your profile looks richer."></textarea>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-backgorund_experience"></p>
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-6">
                                        <label class="form-label"><b>Teach Subject</b></label>
                                        <select class="form-control select select2" name="tutor_subject_teach[]"
                                            id="tutor_subject_teach" multiple>
                                            <option value="" disaled>Select Category</option>
                                            @foreach ($parent_categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-tutor_subject_teach"></p>
                                    </div> --}}

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Location</b></label>
                                            <input type="hidden" id="lat" name="lat" value="">
                                            <input type="hidden" id="lng" name="lng" value="">
                                            <input class="form-control" name="tutor_location" type="text"
                                                id="tutor_location" placeholder="Enter the location">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-tutor_location"></p>
                                            <div id="autocomplete-container"></div>
                                        </div>
                                    </div>

                                    {{-- <div class="row gx-3"> --}}

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label"><b>Category</b></label>
                                                <select class="form-control select2 category " id="category"
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
                                            <label class="form-label"><b>Sub Category</b></label>
                                            <select class="form-control select2" name="sub_category[]"
                                                id="sub_category" multiple>
                                            </select>
                                            <p style="margin-bottom: 2px;"
                                                class="text-danger error_container"
                                                id="error-sub-category"></p>
                                        </div>

                                    {{-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Password</b></label>
                                            <input class="form-control" name="password" type="password" id="password"
                                                placeholder="Enter the Password" autocomplete="new-password">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-password"></p>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-6">
                                        <div class="form-group" style="position: inherit;">
                                            <label class="form-label"><b>Password</b></label>
                                            <input class="form-control" type="password" name="password"
                                                autocomplete="current-password" id="password">
                                            <i class="far fa-eye" id="togglePassword"
                                            style="margin-top: -28px; cursor: pointer; position: absolute;right: 0;margin-right: 12px;"></i>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-password"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Add languages that you speak</b></label>
                                            <select class="form-control select select2" name="language[]" id="language"
                                                multiple>
                                                <option value="" disabled>Select</option>
                                                @foreach ($list_langauge as $lang)
                                                    <option value="{{ $lang->value }}">{{ $lang->value }}</option>
                                                @endforeach
                                            </select>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-language"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="formFile" class="form-label"><b>Institute Logo</b></label>
                                            <input class="form-control" name="image" type="file" id="image"
                                                accept="image/*">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-image"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Add your most recent Degree</b></label>
                                            <select class="form-control select2 mb-4" name="degree" id="degree">
                                                <option value="">Select</option>
                                                <option value="12th">12th</option>
                                                <option value="Graduation">Graduation</option>
                                                <option value="Post Graduation">Post Graduation</option>
                                                <option value="Phd">Phd</option>
                                            </select>
                                            <p class="text-danger error_container" id="error-degree"></p>
                                            <input class="form-control mb-4" type="text" name="university_name"
                                                id="university_name" placeholder="Enter School/University Name" />
                                            <p class="text-danger error_container" id="error-university_name"></p>
                                            <select class="form-control select2 mb-4" name="degree_status"
                                                id="degree_status">
                                                <option value="">Select</option>
                                                <option value="Completed">Completed</option>
                                                <option value="Pursuing">Pursuing</option>
                                            </select>
                                            <p class="text-danger error_container" id="error-degree_status"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6  ">
                                        <div class="form-group ">
                                            <label class="form-label"><b>Which school boards of class 10 do you teach
                                                    for?</b></label>
                                            <div class="row">
                                                <div class="flex-design">
                                                <p class="col-10">CBSE</p>
                                                <input type="checkbox" name="school_board[]" value="cbse"
                                                    id="cbse">
                                                </div>
                                                <div class="flex-design">
                                                <p class="col-10">ICSE</p>
                                                <input type="checkbox" name="school_board[]" value="icse"
                                                    id="icse">
                                                </div>
                                                <div class="flex-design">
                                                <p class="col-10">State Board</p>
                                                <input type="checkbox" name="school_board[]" value="state"
                                                    id="state">
                                                </div>
                                                <div class="flex-design">
                                                <p class="col-10">International Baccalaureate</p>
                                                <input type="checkbox" name="school_board[]" value="int"
                                                    id="int">
                                                </div>
                                                <div class="flex-design">
                                                <p class="col-10">NIOS</p>
                                                <input type="checkbox" name="school_board[]" value="nios"
                                                    id="nios">
                                                </div>
                                                <div class="flex-design">
                                                <p class="col-10">DAV board</p>
                                                <input type="checkbox" name="school_board[]" value="dev"
                                                    id="dev">
                                                </div>
                                            </div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-school_board"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="add-course-label"><b>Do you have any prior teaching
                                                experience?</b></label>
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
                                    <div class="col-sm-6 d-none" id="y_n" >
                                        <div class="form-group">
                                            <label class="add-course-label"><b>What is your Total experience (in Years)?</b></label>
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
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" for="comment"><b>Introduction Video Link</b></label>
                                                <input type="text" class="form-control" name="youtube_url" id="youtube_url" placeholder="Youtube Link">
                                           <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-youtube_url"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>How much do you charge per hour?</b></label>
                                            <input type="number" class="form-control" name="charge_amount"
                                                id="charge_amount" placeholder="₹ Enter Price / Hour">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-charge_amount"></p>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group ">
                                            <label class="form-label"><b>Delivery of classes / Mode of classes
                                                    ?</b></label>
                                            <div class="row">
                                                <div class="flex-design">
                                                <p class="col-10">Online</p>
                                                <input type="checkbox" name="conduct_mode_class[]" value="Online"
                                                    id="conduct_mode_class">
                                                </div>
                                                <div class="flex-design">
                                                <p class="col-10">Offline</p>
                                                <input type="checkbox" name="conduct_mode_class[]" value="Offline"
                                                    id="conduct_mode_class">
                                                </div>
                                                <div class="flex-design">
                                                <p class="col-10">Hybrid (Online + Offline)</p>
                                                <input type="checkbox" name="conduct_mode_class[]" value="Hybrid"
                                                    id="conduct_mode_class">
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
                                                <textarea class="form-control" rows="5" id="describe_experience" name="describe_experience"
                                                    placeholder="E.g. : During my time at school/college, I pursued studies in... I actively participated in... I was involved with clubs/organizations such as... My academic achievements include... I completed my degree/diploma in... My key learnings from this experience were... Any other pertinent details that enhance my educational profile."></textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-describe_experience"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 d-none" id="STATE1">
                                        <div class="form-group ">
                                            <label class="form-label"><b>Which of the following State Syllabus subjects do
                                                    you provide tuition for?*</b></label>
                                            @php
                                                $state_sub = DB::table('state_sub')->get();
                                            @endphp
                                            <div class="row">
                                                @foreach ($state_sub as $st_sub)
                                                <div class="flex-design">
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
                                    <div class="col-sm-12 d-none" id="STATEB1">
                                        <div class="form-group ">
                                            <label class="form-label"><b>Which state boards of Class I-V do you
                                                    teach?*</b></label>
                                            @php
                                                $state_bord = DB::table('state_boards')->get();
                                            @endphp
                                            <div class="row">
                                                @foreach ($state_bord as $st_brd)
                                                <div class="flex-design">
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
                                    <div class="col-sm-12 d-none" id="CBSE1">
                                        <div class="form-group ">
                                            <label class="form-label"><b>Which of the following CBSE subjects do you
                                                    provide tuition for?*</b></label>
                                            @php
                                                $cbse = DB::table('CBSE')->get();
                                            @endphp
                                            <div class="row">
                                                @foreach ($cbse as $cb)
                                                <div class="flex-design">
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
                                    <div class="col-sm-12 d-none" id="ICSE1">
                                        <div class="form-group ">
                                            <label class="form-label"><b>Which of the following ICSE subjects do you
                                                    provide tuition for?*</b></label>
                                            @php
                                                $icse = DB::table('ICSE')->get();
                                            @endphp
                                            <div class="row">
                                                @foreach ($icse as $ic)
                                                <div class="flex-design">
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
                                    <div class="col-sm-12 d-none" id="INT1">
                                        <div class="form-group ">
                                            <label class="form-label"><b>Which of the following International Baccalaureate
                                                    subjects do you provide tuition for?*</b></label>
                                            @php
                                                $inter = DB::table('International_Baccalaureate_sub')->get();
                                            @endphp
                                            <div class="row">
                                                @foreach ($inter as $int)
                                                <div class="flex-design">
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
                                    <div class="col-sm-12 d-none" id="NIOS1">
                                        <div class="form-group ">
                                            <label class="form-label"><b>Which of the following NIOS subjects do you
                                                    provide tuition for?*</b></label>
                                            @php
                                                $nios = DB::table('NIOS')->get();
                                            @endphp
                                            <div class="row">
                                                @foreach ($nios as $ni)
                                                <div class="flex-design">
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
                                    {{-- </div> --}}
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @php
                            $member_ship = DB::table('member_ship_plans')
                                ->where('status', 1)
                                ->where('user_type', 1)
                                ->get();
                        @endphp
                        <div class="form-group ">
                            <label class="col-sm-12 col-form-label"><b>Payment</b></label>

                            @foreach ($member_ship as $mb)
                                <div class="radio ">
                                    <label>
                                        <input type="radio" class="Input_Id" data-id="1"
                                            data-value="{{ $mb->amount }}" name="payment_status"
                                            value="{{ $mb->benifits }}">
                                        <span style="margin-left: 10px">{{ $mb->benifits }}
                                            ₹({{ $mb->amount }})
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                            <div class="radio Input_Id" data-id="2">
                                <label>
                                    <input type="radio" name="payment_status"
                                        value="Continue without prime benefits"><span
                                        style="margin-left: 10px ; color:#009fff;">Continue
                                        without prime
                                        benefits</span></label>
                            </div>
                        </div>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-payment_status"></p>
                    </div>
                    <div class="card" style="background:white;">
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12 text-center d-none" id="p_n">
                                    <button type="submit"><a href="javascript:void(0)"
                                            class="btn btn-success btn-sm float-right buy_now" data-amount="100"
                                            data-id="7">Pay</a></button>
                                </div>
                                <div class="col-lg-12 text-center " id="p_l">
                                    <button type="submit" class="btn btn-success submit mr-2">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
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
        $(document).ready(function() {
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

            $(".buy_now").click(function() {

                var name = $('#tutor_name').val();
                var email = $('#tutor_email').val();
                var mobile = $('#tutor_mobile').val();
                var institute_name = $('#institute_name').val();
                var category = $('#category').val();
                var location = $('#tutor_location').val();
                var language = $('#language').val();
                var image = $('#image').val();
                var degree = $('#degree').val();
                var university_name = $('#university_name').val();
                var degree_status = $('#degree_status').val();
                var password = $('#password').val();
                var teaching_experience = $('#teaching_experience').val();
                var experience_year = $('#experience_year').val();
                var backgorund_experience = $('#backgorund_experience').val();
                // var tutor_travel = $('#tutor_travel').val();
                var charge_amount = $('#charge_amount').val();
                var describe_experience = $('#describe_experience').val();
                // var payment_status = $('#payment_status').val();

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
                    $('#error-institute_name').html('please enter institute_name');
                    errors = true;
                } else {
                    $('#error-institute_name').html('');
                }
                // if (subject_teach == '') {
                //     $('#error-tutor_subject_teach').html('please enter subject teach');
                //     errors = true;
                // } else {
                //     $('#error-tutor_subject_teach').html('');
                // }

                if (category == '') {
                    $('#error-category').html('please select category name');
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

                if (teaching_experience == '') {
                    $('#error-teaching_experience').html('please enter teaching experience');
                    errors = true;
                } else {
                    $('#error-teaching_experience').html('');
                }

                if (experience_year == '') {
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


                // if (tutor_travel == '') {
                //     $('#error-tutor_travel').html('please enter tutor travel');
                //     errors = true;
                // } else {
                //     $('#error-tutor_travel').html('');
                // }

                if (charge_amount == '') {
                    $('#error-charge_amount').html('please enter charge amount');
                    errors = true;
                } else {
                    $('#error-charge_amount').html('');
                }

                if (describe_experience == '') {
                    $('#error-describe_experience').html('please enter describe experience');
                    errors = true;
                } else {
                    $('#error-describe_experience').html('');
                }

                // var classesModeChecked = $('#private_classes').is(':checked') || $('#group_classes').is(
                //     ':checked');
                // if (!classesModeChecked) {
                //     $('#error-classes_mode').html('Please select at least one');
                //     errors = true;
                // } else {
                //     $('#error-classes_mode').html('');
                // }

                var selectedConductModeClass = $('input[name="conduct_mode_class[]"]:checked');
                if (selectedConductModeClass.length === 0) {
                    $('#error-conduct_mode_class').html('Please select at least one');
                    errors = true;
                } else {
                    $('#error-conduct_mode_class').html('');
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

            });

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
                            $('.submit').html('Submit');
                        }, 2000);
                        //console.log(response);
                        if (response.success == true) {
                            //notify
                            toastr.success("Teacher Created successfully!");

                            // Swal.fire({
                            //     position: 'top-end',
                            //     icon: 'success',
                            //     title: 'user Created Successfully',
                            //     showConfirmButton: false,
                            //     timer: 1500
                            //     })
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

        // function select2subject() {
        //     $('#tutor_subject_teach').select2({
        //         multiple: true,
        //         placeholder: 'Select',
        //         // ... other configurations ...
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

        function select2subject2() {
            const input = document.querySelector("#tutor_mobile");
            window.intlTelInput(input, {
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
                initialCountry: "IN",
                separateDialCode: true,
            });
        }

        var SITEURL = '{{ URL::to('') }}';
        $.ajaxSetup({
            headers: {
                // contentType: 'multipart/form-data',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('body').on('click', '.buy_now', function(e) {
            var c_code = $('div.iti__selected-flag').attr('title');

            // alert(c_code);
            // return false;

            // data.append("c_code", title);
            // var c_code =$('#c_code').val();
            var name = $('#tutor_name').val();
            var lng = $('#lng').val();
            var lat = $('#lat').val();
            var email = $('#tutor_email').val();
            var mobile = $('#tutor_mobile').val();
            var institute_name = $('#institute_name').val();
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
            // var subject_teach = $('#tutor_subject_teach').val();
            var category = $('#category').val();
            var sub_category = $('#sub_category').val();
            var location = $('#tutor_location').val();
            var language = $('#language').val();
            var image = $('#image').val();
            var degree = $('#degree').val();
            var university_name = $('#university_name').val();
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
                    window.location.href = SITEURL + '/' + 'admin/paysuccessadmininstitute?payment_id=' + response
                        .razorpay_payment_id + '&amount=' + amount + '&name=' + name + '&mobile=' + mobile +
                        '&email=' + email + '&location=' + location +
                        '&language=' + language + '&image=' + image + '&degree=' + degree +
                        '&institute_name=' +
                        institute_name + '&university_name=' + university_name +
                        '&degree_status=' + degree_status + '&password=' + password +
                        '&teaching_experience=' + teaching_experience + '&experience_year=' +
                        experience_year + '&backgorund_experience=' + backgorund_experience +
                        '&charge_amount=' + charge_amount +
                        '&describe_experience=' + describe_experience +
                        '&school_board=' + school_board + '&conduct_mode_class=' + conduct_mode_class +
                        '&all_state_subject=' + all_state_subject +
                        '&all_cbse_subject=' + all_cbse_subject + '&all_state_board=' + all_state_board +
                        '&all_icse_subject=' + all_icse_subject + '&all_inter_subject=' +
                        all_inter_subject + '&lng=' + lng + '&lat=' + lat + '&category=' + category +
                        '&sub_category=' + sub_category + '&youtube_url=' + youtube_url +
                        '&all_nios_subject=' + all_nios_subject + '&c_code=' + c_code + '&payment_status=' +
                        payment_status;
                },
                "prefill": {
                    "mobile": mobile,
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
        $(document).on('click', '#icse', function(event) {
            if ($("#icse").prop('checked') == true) {
                $('#ICSE1').removeClass('d-none');
            } else {
                $('#ICSE1').addClass('d-none');
            }
        });
        $(document).on('click', '#state', function(event) {
            if ($("#state").prop('checked') == true) {
                $('#STATE1').removeClass('d-none');
                $('#STATEB1').removeClass('d-none');
            } else {
                $('#STATE1').addClass('d-none');
                $('#STATEB1').addClass('d-none');
            }
        });
        $(document).on('click', '#int', function(event) {
            if ($("#int").prop('checked') == true) {
                $('#INT1').removeClass('d-none');
            } else {
                $('#INT1').addClass('d-none');
            }
        });
        $(document).on('click', '#igcse', function(event) {
            if ($("#igcse").prop('checked') == true) {
                $('#ICSE1').removeClass('d-none');
            } else {
                $('#ICSE1').addClass('d-none');
            }
        });
        $(document).on('click', '#nios', function(event) {
            if ($("#nios").prop('checked') == true) {
                $('#NIOS1').removeClass('d-none');
            } else {
                $('#NIOS1').addClass('d-none');
            }
        });

        $(document).on('select2:select', '.category', function(e) {
            var id = $('#category').val();
            var value = e.params.data.id;
            // var id = value;
            // console.log(value);
            $.ajax({
                type: "get",
                url: "{{ route('admin.tutor.sub-category-list') }}",
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
                $("#y_n").removeClass('d-none'); // Show the div
            } else {
                $("#y_n").addClass('d-none'); // Hide the div
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
