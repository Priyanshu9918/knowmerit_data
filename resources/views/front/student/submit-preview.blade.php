@extends('layouts.student.master')

@section('content')
    <style>
        .cls {
            background-color: #4bb543;
            border: 1px solid #4bb543;
            color: #fff;
        }

        .form-control:disabled,
        .form-control[readonly] {
            background-color: white !important;
        }
    </style>

    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #4f94cf12; border-radius: 10px;">

        <!-- <div class="profile-title for-quespretext">
            <h3>Question Preview</h3>
        </div> -->

        <input type="hidden" name="u_id" value="{{ $u_id }}">
        @if (count($question) > 0)
            <div class="zedex" id="qu_1">

                @if (isset($questions))
                    @foreach ($questions as $key => $drop12)
                        @if ($drop12->type == 'single_choice_radio')
                            <div class="forcheckicons-parent">
                                <div class="questions forcheckicons">
                                    {{-- <div class="check-uncheckicon">
                                        <i class="fa fa-check-circle chegreen d-none"
                                            id="nub1_{{ $page }}_{{ $key + 1 }}" aria-hidden="true"></i>
                                        <i class="fa fa-square-o yelodes" id="nub2_{{ $page }}_{{ $key + 1 }}"
                                            aria-hidden="true"></i>
                                    </div> --}}
                                    <label class="all-ques-label-des"> {{ $key + 1 }}. &nbsp; {!! $drop12->question !!}</label>
                                    <div class="row">
                                    @php
                                        $option = explode(',', $drop12->option);
                                        $correctOptions = explode(',', $drop12->answer);
                                        $userAnswer = '';
                                    @endphp
                                   @foreach ($option as $key1 => $op1)
                                   <div class="col-md-6">
                                       @php
                                           $isChecked = in_array($op1, $correctOptions);
                                           $textColor = $isChecked ? 'green' : 'black'; // Change color if correct or incorrect
                                           $alphabetKey = chr(64 + $key1 + 1); // Convert numeric key to alphabet character
                                       @endphp
                                       @if(in_array($op1, $correctOptions))
                                       <label for="" style="color: green; background-color: #cbffcb;" class="d-flex gap-2 quesoptiondes" > <!-- <Span
                                               style="font-weight: bold"> {{ $alphabetKey }} : </Span> -->
                                               <i class="fa fa-check-circle unchkgr" style="padding: 5px"></i>
                                           {!! $op1 !!} 
                                       </label>
                                       @else
                                       @php 
                                            $incorrect1 = DB::table('submit_question_students')->where('question_no',$drop12->id)->first();
                                            if(isset($incorrect1)){
                                                $inc_opt1 = explode(',', $incorrect1->ans);
                                            }else{
                                                $inc_opt1 = [];
                                            }
                                        @endphp
                                            @if(in_array($op1, $inc_opt1))
                                                <label for="" style="color:red; background-color: #ffe2e2;" class="d-flex gap-2 quesoptiondes" > <!-- <Span
                                                        style="font-weight: bold"> {{ $alphabetKey }} : </Span> -->
                                                        <i class="fa fa-times-circle unchkgr" style="padding: 5px"></i>
                                                    {!! $op1 !!} 
                                                </label>
                                            @else
                                                <label class="d-flex gap-2 quesoptiondes" > <!-- <Span
                                                        style="font-weight: bold"> {{ $alphabetKey }} : </Span> -->
                                                        <i class="fa fa-circle-o unchk" style="padding: 5px"></i>
                                                    {!! $op1 !!} 
                                                </label>
                                            @endif
                                       @endif
                                   </div>
                               @endforeach
                               </div>

                                    @foreach ($answers as $answer)
                                        {{-- @php dd($answer) @endphp --}}
                                        @if ($answer->question_no == $drop12->id)
                                            @php
                                                $isCorrect = in_array($answer->ans, $correctOptions);
                                                $textColor = $isCorrect ? 'green' : 'red'; // Change color if correct or incorrect
                                            @endphp

                                            @if (!$isCorrect)
                                                <!-- Display if the answer is incorrect -->
                                                <!-- <span class="d-flex gap-2"   style="color: {{ $textColor }}">

                                                    <p >
                                                        Your Answer: {!! $answer->ans !!} <i class="fa fa-times-circle" style="padding:5px"></i>
                                                    </p>
                                                </span> -->
                                            @else
                                                <!-- Display if the answer is correct -->
                                                <!-- <span class="d-flex gap-2"  style="color: {{ $textColor }}">
                                                <p >Your Answer: {!! $answer->ans !!}
                                                    <i class="fas fa-check-circle" style="padding: 5px"></i>
                                                </p>
                                            </span> -->
                                            @endif

                                            @php
                                                $userAnswer = $answer->ans;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($userAnswer === '')
                                        <!-- Display a message if the user hasn't submitted an answer -->
                                        <p style="color: red;">You have not submitted an answer for this question.</p>
                                    @endif
                                </div>
                            </div>
                        @elseif($drop12->type == 'mult_choice')
                            <div class="forcheckicons-parent">
                                <div class="questions forcheckicons">
                                    {{-- <div class="check-uncheckicon">
                                        <i class="fa fa-check-circle-o chegreen d-none"
                                            id="nub1_{{ $page }}_{{ $key + 1 }}" aria-hidden="true"></i>
                                        <i class="fa fa-square-o yelodes"
                                            id="nub2_{{ $page }}_{{ $key + 1 }}" aria-hidden="true"></i>
                                    </div> --}}
                                    {{-- <label style="display: flex;">{{ $key + 1 }} - {!! $drop12->question !!}</label> --}}
                                    <label class="all-ques-label-des"> {{ $key + 1 }}. &nbsp; {!! $drop12->question !!}</label>
                                    <div class="row">
                                    @php
                                        $option2 = explode(',', $drop12->option);
                                        $correctOptions = explode(',', $drop12->answer);
                                        $userAnswer = '';
                                    @endphp
                                    @foreach ($option2 as $key2 => $op13)
                                        <div class="col-md-6">
                                            @php
                                                $isChecked = in_array($op13, $correctOptions);
                                                $textColor = $isChecked ? 'green' : 'black'; // Change color if correct or incorrect
                                                $alphabetKey = chr(64 + $key2 + 1);
                                           @endphp
                                            {{-- <input type="checkbox" class="q_n" data-page="{{$page}}" data-key="{{$key+1}}" name="ans[{{$drop12->id}}][]" value="{{$op13}}-{{$drop12->id}}"  @if ($isChecked) checked @endif> --}}
                                            {{--<label for="" style="color: {{ $textColor }}" class="d-flex gap-2 multiquesoptiondes" > <!-- <Span
                                                    style="font-weight: bold"> {{ $alphabetKey }} : </Span> -->
                                                    <!-- <i class="fa fa-circle-o unchk" aria-hidden="true"></i> -->
                                                    <i class="fa fa-check-circle unchkgr" style="padding: 5px"></i>
                                                {!! $op13 !!} @if ($isChecked)
                                                <!-- <i class="fas fa-check-circle" style="padding: 5px"></i> -->
                                                @endif
                                            </label>--}}
                                                @if(in_array($op13, $correctOptions))
                                                <label for="" style="color:green; background-color: #cbffcb;" class="d-flex gap-2 multiquesoptiondes" > <!-- <Span
                                                        style="font-weight: bold"> {{ $alphabetKey }} : </Span> -->
                                                        <!-- <i class="fa fa-circle-o unchk" aria-hidden="true"></i> -->
                                                        <i class="fa fa-check-circle unchkgr" style="padding: 5px"></i>
                                                    {!! $op13 !!} @if ($isChecked)
                                                    <!-- <i class="fas fa-check-circle" style="padding: 5px"></i> -->
                                                    @endif
                                                </label>
                                                @else 
                                                @php 
                                                    $incorrect = DB::table('submit_question_students')->where('question_no',$drop12->id)->first();
                                                    if(isset($incorrect)){
                                                        $inc_opt = explode(',', $incorrect->ans);
                                                    }else{
                                                        $inc_opt = [];
                                                    }
                                                @endphp
                                                    @if(in_array($op13, $inc_opt))
                                                        <label for="" style="color: red; background-color: #ffe2e2;" class="d-flex gap-2 multiquesoptiondes" > <!-- <Span
                                                                style="font-weight: bold"> {{ $alphabetKey }} : </Span> -->
                                                                <!-- <i class="fa fa-circle-o unchk" aria-hidden="true"></i> -->
                                                                <i class="fa fa-times-circle unchkgr" style="padding: 5px"></i>
                                                            {!! $op13 !!} @if ($isChecked)
                                                            <!-- <i class="fas fa-check-circle" style="padding: 5px"></i> -->
                                                            @endif
                                                        </label>
                                                    @else
                                                        <label class="d-flex gap-2 multiquesoptiondes" > <!-- <Span
                                                                style="font-weight: bold"> {{ $alphabetKey }} : </Span> -->
                                                                <!-- <i class="fa fa-circle-o unchk" aria-hidden="true"></i> -->
                                                                <i class="fa fa-circle-o unchk" style="padding: 5px"></i>
                                                            {!! $op13 !!} @if ($isChecked)
                                                            <!-- <i class="fas fa-check-circle" style="padding: 5px"></i> -->
                                                            @endif
                                                        </label>
                                                    @endif
                                                @endif
                                        </div>
                                    @endforeach
                                    </div>
                                    @foreach ($answers as $answer)
                                        @if ($answer->question_no == $drop12->id)
                                            @php
                                                $isCorrect = in_array($answer->ans, $correctOptions);
                                                $textColor = $isCorrect ? 'green' : 'red'; // Change color if correct or incorrect
                                            @endphp

                                            @if (!$isCorrect)
                                                <!-- Display if the answer is incorrect -->
                                                <!-- <span class="d-flex gap-2"   style="color: {{ $textColor }}">
                                                <p>
                                                    Your Answer:{!! $answer->ans !!} <i class="fa fa-times-circle" style="padding:5px"></i>
                                                    {{-- Correct Answer: {{ implode(', ', $correctOptions) }} --}}
                                                </p>
                                            </span> -->
                                            @else
                                                <!-- Display if the answer is correct -->
                                                <!-- <span class="d-flex gap-2"  style="color: {{ $textColor }}">
                                                <p>Your Answer: {!! $answer->ans !!}
                                                    <i class="fas fa-check-circle" style="padding: 5px"></i>
                                                </p>
                                            </span> -->
                                            @endif
                                            @php
                                                $userAnswer = $answer->ans;
                                                // dd($userAnswer);
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($userAnswer === '')
                                        <!-- Display a message if the user hasn't submitted an answer -->
                                        <p style="color: red;">You have not submitted an answer for this question.</p>
                                    @endif

                                </div>
                            </div>
                        @else
                            <div class="forcheckicons-parent">
                                <div class="questions forcheckicons">
                                    {{-- <div class="check-uncheckicon">
                                        <i class="fa fa-check-circle-o chegreen d-none"
                                            id="nub1_{{ $page }}_{{ $key + 1 }}" aria-hidden="true"></i>
                                        <i class="fa fa-square-o yelodes"
                                            id="nub2_{{ $page }}_{{ $key + 1 }}" aria-hidden="true"></i>
                                     <label class="all-ques-label-des"> {{ $key + 1 }} :- &nbsp; {!! $drop12->question !!}</label>
                                     <div class="row"></div>
                                    @php
                                        $option1 = explode(',', $drop12->option);
                                        $correctOptions = explode(',', $drop12->answer);
                                        $userAnswer = '';
                                    @endphp
                                    <div class="col-md-6">
                                    <select class="form-control q_n quesoptiondes" data-page="{{ $page }}" data-key="{{ $key + 1 }}" id="q_drop" name="ans[{{ $drop12->id }}][]" style="color: green;">
                                        @foreach ($option1 as $key => $op11)
                                            @php
                                                $isChecked = in_array($op11, $correctOptions);
                                                $textColor = $isChecked ? 'green' : 'black';
                                            @endphp
                                            @if(in_array($op11, $correctOptions))
                                            <option value="{{ $op11 }}-{{ $drop12->id }}" disabled style="color:green; background-color: #cbffcb;" {{ $isChecked ? 'selected' : '' }}>

                                                
                                                <i class="fas fa-check-circle" style="padding: 5px" style="color: green; background-color: #cbffcb; position: absolute; right:2%; top: 47%;"></i>
                                                {{ $op11 }}
                                            </option>
                                            @else
                                            @php 
                                            $incorrect13 = DB::table('submit_question_students')->where('question_no',$drop12->id)->first();
                                                if(isset($incorrect13)){
                                                    $inc_opt13 = explode(',', $incorrect13->ans);
                                                }else{
                                                    $inc_opt13 = [];
                                                }
                                            @endphp
                                                @if(in_array($op11, $inc_opt13))
                                                    <option value="{{ $op11 }}-{{ $drop12->id }}" disabled style="color: red; background-color: #ffe2e2;" {{ $isChecked ? 'selected' : '' }}>
                                                    <i class="fas fa-times-circle" style="padding: 5px" style="color: green; background-color: #cbffcb; position: absolute; right:2%; top: 47%;"></i>
                                                    {{ $op11 }}
                                                    </option>
                                                @else
                                                    <option value="{{ $op11 }}-{{ $drop12->id }}" disabled style="color: black;" {{ $isChecked ? 'selected' : '' }}>
                                                    <i class="fas fa-circle-o" style="padding: 5px" style="color: green; background-color: #cbffcb; position: absolute; right:2%; top: 47%;"></i>
                                                    {{ $op11 }}
                                                    </option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                    </div>
                                    @foreach ($option1 as $key => $op11)
                                    </div>
                                    @php
                                        $isChecked = in_array($op11, $correctOptions);
                                    @endphp
                                    @if ($isChecked)
                                    <i class="fas fa-check-circle" style="padding: 5px" style="color: green; background-color: #cbffcb; position: absolute; right:2%; top: 47%;"></i>
                                    @endif
                                @endforeach --}}
                                <label style=" display: flex; font-weight: bold"> {{ $key + 1 }}. &nbsp; {!! $drop12->question !!}</label>
                                        @php
                                        $option2 = explode(',', $drop12->option);
                                        $correctOptions = explode(',', $drop12->answer);
                                        $userAnswer = '';
                                        @endphp
                                        @foreach ($option2 as $key3 => $op11)
                                            <div class="">
                                                @php
                                                    $isChecked = in_array($op11, $correctOptions);
                                                    $textColor = $isChecked ? 'green' : 'black'; // Change color if correct or incorrect
                                                    $alphabetKey = chr(64 + $key3 + 1);
                                                @endphp
                                                {{-- <input type="checkbox" class="q_n" data-page="{{$page}}" data-key="{{$key+1}}" name="ans[{{$drop12->id}}][]" value="{{$op11}}-{{$drop12->id}}"  @if ($isChecked) checked @endif> --}}
                                                <label for="" style="color: {{ $textColor }}" class="d-flex gap-2" > <Span
                                                        style="font-weight: bold"> {{ $alphabetKey }} : </Span>
                                                    {!! $op11 !!} @if ($isChecked)
                                                    <i class="fas fa-check-circle" style="padding: 5px"></i>
                                                    @endif
                                                </label>
                                            </div>
                                        @endforeach
                                    @foreach ($answers as $answer)
                                        @if ($answer->question_no == $drop12->id)
                                            @php
                                                $isCorrect = in_array($answer->ans, $correctOptions);
                                                $textColor = $isCorrect ? 'green' : 'red'; // Change color if correct or incorrect
                                            @endphp

                                            @if (!$isCorrect)
                                                <!-- Display if the answer is incorrect -->
                                                <!-- <span class="d-flex gap-2"  style="color: {{ $textColor }}">

                                                    <p>
                                                        Your Answer:{!! $answer->ans !!} <i class="fa fa-times-circle" style="padding:5px"></i>
                                                        {{-- Correct Answer: {{ implode(', ', $correctOptions) }} --}}
                                                    </p>
                                                </span> -->
                                            @else
                                                <!-- Display if the answer is correct -->
                                                <!-- <span class="d-flex gap-2"  style="color: {{ $textColor }}">
                                                <p>Your Answer: {!! $answer->ans !!}
                                                    <i class="fas fa-check-circle" style="padding: 5px"></i>
                                                </p>
                                                </span> -->
                                            @endif
                                            @php
                                                $userAnswer = $answer->ans;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($userAnswer == '')
                                        <!-- Display a message if the user hasn't submitted an answer -->
                                        <p style="color: red;">You have not submitted an answer for this question.</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

                &nbsp; &nbsp;
                    </div>
            <div class="question-number">
                <ul>
                    <span>Page No.</span>    &nbsp;       &nbsp;
                    @foreach($page_no as $pag)
                    <a href="{{ route('student.submit-preview',['id'=>base64_encode($u_id),'page'=>$pag->page]) }}"><li>{{$pag->page}}</li></a>
                    @endforeach
                </ul>
            </div>


    </div>
    @endif
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
<!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" integrity="sha512-BHDCWLtdp0XpAFccP2NifCbJfYoYhsRSZOUM3KnAxy2b/Ay3Bn91frud+3A95brA4wDWV3yEOZrJqgV8aZRXUQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.3.1/jquery-migrate.min.js" integrity="sha512-wDH73bv6rW6O6ev5DGYexNboWMzBoY+1TEAx5Q/sdbqN2MB2cNTG9Ge/qv3c1QNvuiAuETsKJnnHH2UDJGmmAQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js" integrity="sha256-4OrICDjBYfKefEbVT7wETRLNFkuq4TJV5WLGvjqpGAk=" crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js" integrity="sha256-g6iAfvZp+nDQ2TdTR/VVKJf3bGro4ub5fvWSWVRi2NE=" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.15/angular.min.js" integrity="sha256-vCJY79j8f3kuDmzPAzJnzDkyCC7lwUWtIRSv5kBglC8=" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.3/jquery.sticky.min.js" integrity="sha256-KaITQ+anfmmXJqtrI8++roWmTMUYukt1Q2wXcNxyzyA=" crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js" integrity="sha256-JnqDCSpf1uxft0a84S1ECr038dZJwHL2U+F9DIAOtkc=" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/spin.js/2.0.1/spin.min.js" integrity="sha256-JSY/svpQOuJTNt4GKwPClmBTD0aZ4Qa5sXlAuxwcBNQ=" crossorigin="anonymous"></script> -->


<script src="https://www.flexiquiz.com/scripts/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="https://d2a1lk4nhrwv0k.cloudfront.net/scripts/ckeditor/adapters/jquery.js" type="text/javascript"></script>
<!-- <script src="https://d2a1lk4nhrwv0k.cloudfront.net/scripts/pick-a-color-1.2.3.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinycolor/0.9.16/tinycolor.min.js" integrity="sha256-5Y4mFT0fg2H+wsN07VgR69qhhTHpeqrTmqshLaiVh38=" crossorigin="anonymous"></script> -->

<script src="https://www.flexiquiz.com/bundles/layoutSurveys?v=qZPgsoTFPKzWE74P93PtZbcQHMN82q6ZTuCLRti297Y1"></script>


    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
        messageStyle: "none"
        });
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML"></script>

<script type="text/javascript">
    var extraPluggins = 'autogrow,imageuploader,videouploader,sourcearea,youtube,font,colorbutton,table,expandmenu';
    var buttonsToRemove = 'Cut,Copy,Paste,Anchor,Strike,Subscript,Superscript,Unlink,About,Indent,Outdent';
</script>
