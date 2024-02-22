@extends('layouts.teacher.master')

@section('content')

<!-- <link href="https://www.flexiquiz.com/Content/flatControls?v=p0BLBrjEKO8jM23VriyHXo8HJDGKNmv5-ON3N0C82zc1" rel="stylesheet"/> -->
<style type="text/css">
.add-ques-head-text {
    display: none;
}

div#cke_1_contents {
    height: 100px !important;
}

.for-quespretext {
    position: relative;
}

.preview-text {
    position: absolute;
    right: 0;
}

.preview-text {
    position: absolute;
    right: 0%;
    bottom: 0%;
    font-size: 16px;
    color: #468dcb;
}

#contactForm {
    display: none;
    padding: 0px;
    width: 100%;
    height: auto;
    text-align: center;
    background: #fff;
    position: fixed;
    top: 11%;
    left: 0%;
    background-color: #fff;
    z-index: 99;


}

#contactForm1 {
    display: none;
    padding: 0px;
    width: 100%;
    height: auto;
    text-align: center;
    background: #fff;
    position: fixed;
    top: 11%;
    left: 0%;
    background-color: #fff;
    z-index: 99;

}

.popup-save-btn {
    border: none;
    background-color: #468dcb;
    color: #fff;
    border-radius: 7px !important;
    font-size: 14px;
    padding: 5px 15px;
    font-weight: 600;
}

.cross-btn-modal {
    display: flex;
    justify-content: end;
    padding: 10px 20px;
}

.cross-btn-modal #add-question-list {
    border: none;
    background-color: unset;
    font-size: 25px;
}

.modal-form-des form#createFrm12 {
    padding: 10px 70px 70px 70px;
}

.modal-form-des {
    overflow: scroll;
    height: 90vh;
    overflow-x: hidden;
}

.multiple-question-type {
    display: flex;
    align-items: center;
}

.multiple-question-type select {
    border: 1px solid #dff1ff;
    border-radius: 5px;
    margin-left: 10px;
    padding: 5px;
    font-size: 14px;
}

.point-text {
    border: 1px solid #dff1ff;
    border-radius: 5px;
    margin-left: 10px;
    padding: 5px;
    font-size: 14px;
}

.form-group {
    text-align: left;
}

.correc {
    margin-left: 10px;
    display: flex;
    align-items: center;
}

.correc label {
    margin-left: 5px;
    margin-right: 5px;
}

.modal-form-des .mode-label {
    font-weight: 600;
}

/* input, textarea {
  margin: .8em auto;
  font-family: inherit;
  text-transform: inherit;
  font-size: inherit;

  display: block;
  width: 280px;
  padding: .4em;
}
textarea { height: 80px; resize: none; } */

.formBtn {
    width: 140px;
    display: inline-block;
    background: teal;
    color: #fff;
    font-weight: 100;
    font-size: 1.2em;
    border: none;
    height: 30px;
}
</style>

<input type="hidden" id="u_id111" value="{{$u_id}}">
<div class="col-xl-9 col-lg-8 col-md-12">

        <div class="row" style="background-color: #4f94cf12; border-radius: 10px; margin-bottom: 10px;">
                <div class="col-md-6 col-sm-12">
                    <div class="course-group mb-0 d-flex mt-3 mb-3"
                        style="background-color: #fff; padding: 16px; border-radius: 5px;">
                        <div class="course-group-img d-flex align-items-center">
                            <div class="course-name">
                                @php
                                $id = Auth::user()->id;
                                $data = DB::table('users')->where('id' ,$id)->first();
                                $datacon = DB::table('countries')->where('id',$data->country)->first();
                                $datatime = DB::table('time_zones')->where('id',$data->timezone)->first();
                                @endphp
                                <h4><a href="">{{ $datacon->name ?? '' }}</a></h4>
                                <p>{{ $datatime->timezone ?? '' }}</p>
                            </div>
                        </div>
                        @php
                        $user_id = Auth::user()->id;
                        $user1 = DB::table('users')->where('id',$user_id)->first();
                        $timezone = DB::table('time_zones')->where('id',$user1->timezone ?? 195)->first();
                        $tz = $timezone->timezone;
                        $timestamp = time();
                        $dt = new DateTime("now", new DateTimeZone($tz));
                        $dt1 = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
                        $dt->setTimestamp($timestamp);
                        @endphp
                        <div class="profile-share d-flex align-items-center justify-content-center">
                            <p class="head-time-des">{{$dt->format('h:ia')}} (UTC {{$timezone->raw_offset}}.00)</p>
                            <a href="javascript:;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#timezone">Edit</a>
                            <!-- The Modal -->
                            @php
                            $country = DB::table('countries')->get();
                            @endphp
                            <div class="modal" id="timezone">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="font-size: 18px;">Select Country And TimeZone</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="{{ route('teacher.timezone2.create') }}" method="POST" id="teacher2Frm">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="sel1">Country</label>
                                                    <select class="form-select country" aria-label="Default select example"
                                                        name="country3" id="country_id3">
                                                        <option>Select country</option>
                                                        @if (count($country) > 0)
                                                        @foreach ($country as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group container d-none" id="tiz4">
                                                    <label for="sel1">TimeZone</label>
                                                    <select class="form-select" aria-label="Default select example" name="timezone3"
                                                        id="timezone_id3">
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="course-group mb-0 d-flex mt-3 mb-3" style="background-color: #fff; padding: 27px; border-radius: 5px;">
                        <a href="{{url('/teacher/calendar',['id'=>base64_encode(Auth::user()->id)])}}" class="iconpadding">
                            <i class="fa fa-calendar icnfirst"></i>
                            <span> Availability</span>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                @php
                     $total_msg = DB::table('ch_messages')->where('seen', 0)->where('to_id', Auth::user()->id)->count('seen');
                    @endphp
                <div class="col-md-3 col-sm-12">
                    <div class="course-group mb-0 d-flex mt-3 mb-3" style="background-color: #fff; padding: 27px; border-radius: 5px;">
                        <a href="{{url('chatify')}}"  class="iconpadding">
                            <i class="fa fa-comments icnfirst"></i>
                            <span> My Inbox</span>
                            <span class="spancunt">{{ $total_msg ?? 0 }}</span>
                        </a>
                    </div>
                </div>
        </div>
        <div class="row" style="background-color: #4f94cf12; border-radius: 10px;">

            <!-- <div class="profile-title for-quespretext">
                <h3>Question Bank</h3>
                <h6 class="preview-text"><i class="fa fa-eye" aria-hidden="true"></i> Preview</h6>
            </div> -->
            <div>
                @php
                $welcome = DB::table('welcome_pages')->where('u_id',$u_id)->first();
                @endphp
                @if(isset($welcome))
                <div class="add-question-block mt-3"> 
                    <div class="panel-head add-block">
                        <h6>Welcome Page</h6>
                        <input class="add-ques-head-text" type="text" name="">
                        <!-- <div class="head-icon">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div> -->
                    </div>
                    <div class="panel-body">
                        <div class="btn-group">
                            <p>{!!$welcome->welcome_text!!}</p>
                        </div>
                    </div>
                </div>
                @endif
                @php $qa_page = DB::table('qa_pages')->where('u_id',$u_id)->get();@endphp
                @foreach($qa_page as $key=>$qa)
                <div class="add-question-block mt-3">
                    <div class="panel-head add-block">
                        <h6>Page {{$qa->page_no}}</h6>
                        <input class="add-ques-head-text" type="text" name="">
                        <div class="head-icon">
                            <!-- <i class="fa fa-pencil-square-o" aria-hidden="true"></i> -->
                            <i class="fa fa-times" aria-hidden="true" id="deleteq1" data-id="{{$qa->id}}"></i>
                        </div>
                    </div>
                    @php
                    $questions = DB::table('choice_questions')->where('u_id',$u_id)->where('page',$qa->page_no)->get();
                    @endphp

                    <div class="row"></div>
                    @foreach($questions as $key=>$ques)
                    @if($ques->type == 'single_choice_radio')
                    <div class="questions btmborder foriconscls">
                        <div class="edit-cancel-question">
                            <i class="fa fa-pencil-square-o" id="edit-question" aria-hidden="true" data-id="{{$ques->id}}"></i>
                            <i class="fa fa-times" aria-hidden="true" id="deleteq" data-id="{{$ques->id}}"></i>
                        </div>
                        <div ><b style="float:left;">{{$key+1}}. </b>{!!$ques->question!!}</div>
                        <div class="row">
                            @php $option = explode(',',$ques->option); @endphp
                            @foreach($option as $op1)
                            <div class="col-md-6">
                                  <label class="quesoptiondes"><i class="fa fa-circle-o unchk" aria-hidden="true"></i>
                                    <input type="radio" name="sdvbnm" value="1" class="quesoptiondesin" required
                                        style="display:none">{!! $op1 !!}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @elseif($ques->type == 'mult_choice')
                    <div class="questions btmborder foriconscls">
                        <div class="edit-cancel-question">
                            <i class="fa fa-pencil-square-o" id="edit-question" aria-hidden="true" data-id="{{$ques->id}}"></i>
                            <i class="fa fa-times" aria-hidden="true" id="deleteq" data-id="{{$ques->id}}"></i>
                        </div>
                        <div ><b style="float:left;">{{$key+1}}.</b> {!!$ques->question!!}</div>
                        <div class="row">
                            @php $option2 = explode(',',$ques->option); @endphp
                            @foreach($option2 as $op13)
                            <div class="col-md-6">

                                  <label class="multiquesoptiondes"><i class="fa fa-square-o unchk" aria-hidden="true"></i>
                                    <input type="checkbox" name="sdvbnm" value="1" class="multi-question" required
                                        style="display:none">{!! $op13 !!}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="questions btmborder foriconscls">
                        <div class="edit-cancel-question">
                            <i class="fa fa-pencil-square-o" id="edit-question" aria-hidden="true" data-id="{{$ques->id}}"></i>
                            <i class="fa fa-times" aria-hidden="true" id="deleteq" data-id="{{$ques->id}}"></i>
                        </div>
                        <div ><b style="float:left;">{{$key+1}}.</b> {!!$ques->question!!}</div>
                        <div class="row">
                            @php $option1 = explode(',',$ques->option); @endphp
                            <div class="col-md-6"><select class="form-control" id="category" name="category">
                                    <option value="">Select option</option>
                                    @foreach($option1 as $key=>$op11)
                                    <option value="{{  $key++ }}">{!! $op11 !!}</option>
                                    @endforeach
                                </select></div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    {{--@php
                        $single_choice_check = DB::table('choice_questions')->where('u_id',$u_id)->where('type','mult_choice')->where('page',$qa->page_no)->get();
                    @endphp
                    @foreach($single_choice_check as $key=>$ckecl)
                    <div class="questions btmborder foriconscls">
                        <div class="edit-cancel-question">
                            <i class="fa fa-pencil-square-o" id="edit-question"  aria-hidden="true" data-id="{{$ckecl->id}}"></i>
                                <i class="fa fa-times" aria-hidden="true" id="deleteq" data-id="{{$ckecl->id}}"></i>
                        </div>
                            <div >{!!$ckecl->question!!}</div>
                            @php $option2 = explode(',',$ckecl->option); @endphp
                            @foreach($option2 as $op13)
                            <div class="">
                                  <input type="checkbox" name="sdvbnm" value="1" required>
                                  <label for="">{{$op13}}</label>
                            </div>
                            @endforeach
                    </div>
                    @endforeach
                    @php
                    $single_choice_drop =
                    DB::table('choice_questions')->where('u_id',$u_id)->where('type','single_choice_drop')->where('page',$qa->page_no)->get();
                    @endphp
                    @foreach($single_choice_drop as $key=>$drop)
                    <div class="questions btmborder foriconscls">
                        <div class="edit-cancel-question">
                            <i class="fa fa-pencil-square-o" id="edit-question" aria-hidden="true" data-id="{{$drop->id}}"></i>
                            <i class="fa fa-times" aria-hidden="true" id="deleteq" data-id="{{$drop->id}}"></i>
                        </div>
                        <div >{!!$drop->question!!}</div>
                        @php $option1 = explode(',',$drop->option); @endphp
                        <select class="form-control" id="category" name="category">
                            <option value="">Select option</option>
                            @foreach($option1 as $key=>$op11)
                            <option value="{{  $key++ }}">{{ $op11 }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endforeach--}}
                    <div class="panel-body">

                        <div class="btn-group">
                            <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                + Add Item
                            </button>
                            <ul class="dropdown-menu">
                                <li><a id="contact" data-page="{{$qa->page_no}}" class="dropdown-item" href="#">Question</a></li>
                                <!-- <li><a class="dropdown-item" href="#">Question Bank</a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="add-new-block">
                    <div class="btn-group">
                        <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                            + Add Page
                        </button>
                        &nbsp;&nbsp;
                        @php
                        $dat1 = DB::table('choice_questions')->where('u_id',$u_id)->get();
                        @endphp
                        @if(count($dat1) > 0)
                        <button type="button" class="btn assign" aria-expanded="false">
                            Assign Student
                        </button>
                        @endif
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:void(0)" id="q_page">Quiz Page</a></li>
                            <li><a class="dropdown-item" href="javascript:void" id="wlcom">Welcome Page</a></li>
                            <!-- <li><a class="dropdown-item" href="thnk">Thank You Page</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>

        </div>
</div>




<div id="contactForm">
    <div class="modal-form-des">
        <div class="cross-btn-modal">
            <button id="add-question-list" type="button" class="close">×</button>
        </div>
        <form action="{{ route('teacher.single_choice.create') }}" method="POST" id="createFrm12"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="welcome_id" value="{{$welcome->id ?? ''}}">
            <input type="hidden" name="s_u_id" value="{{$u_id}}">
            <input type="hidden" name="course_id" value="{{ request()->input('course_id')}}">
            <input type="hidden" name="page" id="page" value="">
            <div class="popup-add">
                <div class="quest-select-list">
                    <div class="multiple-question-type">
                        <label class="mode-label mb-0">Question Type </label>
                        <select name="question_type">
                            <option value="single_choice_radio">Single Choice (Radio Button)</option>
                            <option value="single_choice_drop">Single Choice (Dropdown)</option>
                            <option value="mult_choice">Multiple Choice</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="mode-label mb-0">Points </label>
                        <input type="text" name="point" class="point-text">
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-point"></p>
                    </div>
                </div>

                <div class="form-group" id="dialogQuestionTextArea">
                    <label class="form-label mode-label" for="">Question</label>
                    <textarea tabindex="2" class="form-control" id="dialogQuestionText" rows="3"
                        name="question"></textarea>
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-question"></p>
                </div>
                <div class="form-group">
                    <label class="mode-label">Options</label>
                    <div class="text-coorect-option">
                        <textarea tabindex="2" class="form-control" id="dialogQuestionText0" rows="3"
                            name="option[]" required="required"></textarea>
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-option"></p>
                        <div class="correc">
                            <input type="checkbox" name="answer[]" value="0">
                            <label for="answer">Correct</label>
                        </div>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-answer"></p>
                        <!-- <i class="fa fa-times" aria-hidden="true"></i> -->
                    </div>
                    <div class="col-md-12" id="mt12"></div>

                </div>

                <div class="add-opti">
                    <button type="button" id="add1">Add Option</button>
                </div>
            </div>
            <button class="foot-save popup-save-btn">Save</button>
        </form>
    </div>
</div>




</div>

<div id="add-deail-question1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Welcome Page</h5>
                <button id="cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('teacher.welcome.create') }}" method="POST" id="createFrm"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="w_u_id" value="{{$u_id}}">
                <input type="hidden" name="course_id" value="{{ request()->input('course_id')}}">
                <div class="modal-body">
                    <div class="popup-add">
                        <div class="form-group">
                            <label class="form-label mode-label" for="">Heading</label>
                            <textarea class="form-control ckeditor" name="welcome_text" id="overview"
                                rows="5"></textarea>
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-welcome_text">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button id="cancel-btn" class="foot-cansave">Cancel</button> -->
                    <button class="foot-save" type="submit">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>
@php
$student_enquiry1 = App\Models\Credit::where('teacher_id', auth()->user()->id)
->orderBy('id', 'DESC')
->get();
@endphp
<div id="add-deail-question123" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Assign Student</h5>
                <button id="deail-question-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('teacher.student.assign') }}" method="POST" id="createFrm222"
                enctype="multipart/form-data">


                @csrf


                <input type="hidden" name="u_id" value="{{$u_id}}">
                <div class="modal-body">
                    <div class="popup-add">
                        <div>
                            <label class="mode-label">Student</label>
                            <select name="student">
                                @if(count($student_enquiry1) > 0)
                                <option value="">Select student</option>
                                @foreach ($student_enquiry1 as $st1)
                                @php
                                $data = DB::table('users')
                                ->where('id', $st1->student_id)
                                ->first();
                                @endphp
                                @if (isset($data->name))
                                <option value="{{ $st1->student_id }}">{{ $data->name }}</option>
                                @endif
                                @endforeach
                                @else
                                <option value="">No Any Student Assign</option>
                                @endif
                            </select>
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-student"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="foot-save" type="submit">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>

<div id="contactForm1">
    <div id="data1">

    </div>
</div>
<style>
.surveyNameBackground span {
    font-weight: 400 !important;
}
</style>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
<script src="{{asset('/ckeditor/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML"></script>

<script type="text/javascript">
CKEDITOR.replace('dialogQuestionText', {
    extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
    mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
    removeButtons: 'PasteFromWord'
});

CKEDITOR.replace('dialogQuestionText0', {
    extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
    mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
    removeButtons: 'PasteFromWord'
});
$(document).on('click', '#add-question', function() {
    var page = $(this).attr('data-page');
    $('#page').val(page);
    $('#add-deail-question').modal('show');
});
$(document).on('click', '.assign', function() {
    $('#add-deail-question123').modal('show');
});
$(document).on('click', '#deail-question-cancel-btn', function() {
    $('#add-deail-question123').modal('hide');
});


$(document).on('click', '#cancel-btn', function() {
    $('#add-deail-question').modal('hide');
})
$(document).on('click', '#wlcom', function() {
    $('#add-deail-question1').modal('show');
});

// $(document).on('click', '#edit-question', function() {
//     // var page = $(this).attr('data-page');
//     // $('#page').val(page);
//     $('#add-deail-question-edit').modal('show');
// });
$(document).on("click", "#edit-question", function() {
    $('#contactForm1').fadeToggle();
    var c_id = $(this).attr('data-id');
    $.ajax({
        url: "{{ route('teacher.editq') }}",
        type: 'GET',
        data: {
            c_id: c_id,
        },
        success: function(data) {
            $('#data1').replaceWith(data);
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $(document).on('click', '#cancel-btn-ques', function() {
        $('#add-deail-question-edit').modal('hide');
    });
    //on change country
    var i = 0;
    $(document).on('click', '#add1', function() {
        ++i;
        $("#mt12").append(`<div class="text-coorect-option" id="row${i}">
                                <textarea tabindex="2" class="form-control" id="dialogQuestionText${i}" rows="3" name="option[]" required="required"></textarea>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-option"></p>
                                <div class="correc">
                                    <input type="checkbox" name="answer[]" value="${i}">
                                    <label for="answer">Correct</label>
                                </div>
                                <i class="fa fa-times btn_remove" id="${i}" aria-hidden="true"></i>
                            </div>`);
        CKEDITOR.replace('dialogQuestionText' + i, {
            extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
            mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
            removeButtons: 'PasteFromWord'
        });

    });
    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });


    //edit
    var i = 0;
    $(document).on('click', '#edit1', function() {
        ++i;
        $("#mt13").append(`<div class="text-coorect-option1" id="row${i}">
                        <textarea tabindex="2" class="form-control" id='dialogQuestionText111${i}' rows="3" name="option1[]" required="required"></textarea>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-option1"></p>
                                <div class="correc">
                                    <input type="checkbox" name="answer[]" value="${i+1}">
                                    <label for="answer">Correct</label>
                                </div>
                                <i class="fa fa-times btn_remove1" id="${i}" aria-hidden="true"></i>
                            </div>`);
        CKEDITOR.replace('dialogQuestionText111' + i, {
            extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
            mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
            removeButtons: 'PasteFromWord'
        });



        //CKEDITOR.instances.dialogQuestionText1.config.allowedContent = {
        //    $1: {
        //        elements: CKEDITOR.dtd,
        //        attributes: true,
        //        styles: true,
        //        classes: true
        //    }
        //};
        //CKEDITOR.instances.dialogQuestionText1.config.disallowedContent = 'a';
    });
    $(document).on('click', '.btn_remove1', function() {
        // var button_id = $(this).attr("id");
        //     $('#row' + button_id + '').remove();
        $(this).parent().remove();
    });

    $(document).on('click', '#q_page', function() {
        var u_id = $('#u_id111').val();
        $.ajax({
            url: "{{ route('teacher.q_page') }}",
            type: 'GET',
            data: {
                u_id: u_id,
            },
            dataType: 'json',
            success: function(response) {
                if (response.success == true) {
                    location.reload();
                }
            }
        });
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
                    toastr.success("Question Created Successfully");
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

    $(document).on('submit', 'form#createFrm12', function(event) {
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
                    toastr.success("Question Created Successfully");
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
    $(document).on('submit', 'form#createFrm222', function(event) {
        event.preventDefault();
        //clearing the error msg
        $('p.error_container').html("");
        $('.pre-loader').show();

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
                    toastr.success("Question Assign Successfully");
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
                    $('.pre-loader').hide();
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

    $(document).on('click', '#deleteq', function() {
        var id = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: 'you want to delete your Question.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, make your AJAX request here to delete the account
                var ajaxUrl = "{{ route('teacher.delete-question') }}";
                var requestData = {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                };
                $.ajax({
                    type: 'POST',
                    url: ajaxUrl,
                    data: requestData,
                    success: function(response) {
                        if (response.success == true) {
                            Swal.fire({
                                title: 'Question Deleted!',
                                icon: 'success',
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while deleting your account.',
                            icon: 'error',
                        });
                    }
                });
            }
        });
    });
    $(document).on('click', '#deleteq1', function() {
        var id = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: 'you want to delete your Page with questions.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, make your AJAX request here to delete the account
                var ajaxUrl = "{{ route('teacher.delete-page') }}";
                var requestData = {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                };
                $.ajax({
                    type: 'POST',
                    url: ajaxUrl,
                    data: requestData,
                    success: function(response) {
                        if (response.success == true) {
                            Swal.fire({
                                title: 'Page Deleted!',
                                icon: 'success',
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while deleting your account.',
                            icon: 'error',
                        });
                    }
                });
            }
        });
    });



    $(document).on('submit', 'form#editFrm222', function(event) {
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
                    $('.submit').html('Update');
                }, 2000);
                //console.log(response);
                if (response.success == true) {

                    //notify
                    toastr.success("Q&A Update Successfully");
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

$(document).on('click', '#contact', function() {
    var page = $(this).attr('data-page');
    $('#page').val(page);
    $('#contactForm').fadeToggle();
})





$(document).on('click', '#add-question-list', function() {
    $('#contactForm').hide();
});
</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>




<!--
<script type="text/javascript">
      $('.quesoptiondes').on('click', function() {
            $(this).closest('.row').find('.quesoptiondes').removeClass('active');
             $(this).closest('.row').find('.quesoptiondes i').removeClass('fa-check-circle');
            $(this).closest('.row').find('.quesoptiondes i').addClass('fa-circle-o');
            if($(this).find('.quesoptiondesin').is(":checked")){
                 $(this).find('i').toggleClass('fa-check-circle fa-circle-o');
                $(this).toggleClass('active');
            }

      });


       $('.multiquesoptiondes').on('click', function() {
            // $(this).closest('.row').find('.quesoptiondes').removeClass('active');
            // $(this).closest('.row').find('.quesoptiondes i').removeClass('fa-check-circle');
            // $(this).closest('.row').find('.quesoptiondes i').addClass('fa-circle-o');
            if($(this).find('.multi-question').is(":checked")){
                 $(this).find('i').toggleClass('fa-check-square fa-square-o');
                $(this).toggleClass('active');
            }

      });
</script> -->
@endpush
