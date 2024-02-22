@extends('layouts.student.master')

@section('content')
    <style>
        .cls {
            background-color: #4bb543;
            border: 1px solid #4bb543;
            color: #fff;
        }
    </style>

    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #4f94cf12; border-radius: 10px;">

        <!-- <div class="profile-title for-quespretext">
            <h3>Question Preview</h3>
        </div> -->
        <form action="{{ route('student.answer-submit') }}" method="POST" id="createFrm12" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="u_id" value="{{ $u_id }}">
            @if (count($question) > 0)
                <div class="zedex" id="qu_1">
                    <h4>Page {{ $page }}</h4>
                    <div class="question-head">
                        <div>
                            @php
                                $count = count($question);
                                $count1 = count($question1);
                            @endphp
                            <div class="question-number">
                                <ul>
                                    @for ($i = 1; $i <= $count; $i++)
                                        <li id="nub_{{ $page }}_{{ $i }}">{{ $i }}</li>
                                    @endfor
                                    <!-- <li style="background-color: #4bb543; border: 1px solid #4bb543; color: #fff;">2</li>
                                                        <li>3</li>
                                                        <li>4</li>
                                                        <li>5</li>

                                                        <li>6</li>
                                                        <li style="background-color: #4bb543; border: 1px solid #4bb543; color: #fff;">7</li>
                                                        <li>8</li>
                                                        <li>9</li>
                                                        <li>10</li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="outofanswer">
                            <p>Answered <span id="ttl_{{ $page }}">0</span> of {{ $count }}</p>
                        </div>
                    </div>
                    @if (isset($questions))
                        @foreach ($questions as $key => $drop12)
                            @if ($drop12->type == 'single_choice_radio')
                                <div class="forcheckicons-parent">
                                    <div class="questions forcheckicons">
                                        <div class="check-uncheckicon">
                                            <i class="fa fa-check-square-o chegreen d-none"
                                                id="nub1_{{ $page }}_{{ $key + 1 }}" aria-hidden="true"></i>
                                            <i class="fa fa-square-o yelodes"
                                                id="nub2_{{ $page }}_{{ $key + 1 }}" aria-hidden="true"></i>
                                        </div>
                                        <label class="all-ques-label-des"> {{ $key + 1 }} . &nbsp;
                                            {!! $drop12->question !!}</label>
                                            <div class="row">
                                                    @php $option = explode(',',$drop12->option); @endphp
                                                    @foreach ($option as $op1)
                                                        <div class="col-md-6">
                                                            &nbsp;
                                                            &nbsp; <label class="quesoptiondes">
                                                                <i class="fa fa-circle-o unchk" aria-hidden="true"></i>
                                                                <input type="radio" class="q_n quesoptiondesin" data-page="{{ $page }}"
                                                                data-key="{{ $key + 1 }}" name="ans[{{ $drop12->id }}][]"
                                                                value="{{ $op1 }}~{{ $drop12->id }}" style="display: none;">
                                                                {!! $op1 !!}</label>
                                                        </div>
                                                    @endforeach
                                            </div>
                                    </div>
                                </div>
                            @elseif($drop12->type == 'mult_choice')
                                <div class="forcheckicons-parent">
                                    <div class="questions forcheckicons">
                                        <div class="check-uncheckicon">
                                            <i class="fa fa-check-square-o chegreen d-none"
                                                id="nub1_{{ $page }}_{{ $key + 1 }}" aria-hidden="true"></i>
                                            <i class="fa fa-square-o yelodes"
                                                id="nub2_{{ $page }}_{{ $key + 1 }}" aria-hidden="true"></i>
                                        </div>
                                        <label class="all-ques-label-des"> {{ $key + 1 }} . &nbsp;
                                            {!! $drop12->question !!}</label>
                                            <div class="row">
                                                @php $option2 = explode(',',$drop12->option); @endphp
                                                @foreach ($option2 as $op13)
                                                    <div class="col-md-6">

                                                        <label class="multiquesoptiondes">
                                                            <i class="fa fa-square-o unchk" aria-hidden="true"></i>
                                                            <input type="checkbox" class="q_n multi-question" data-page="{{ $page }}"
                                                            data-key="{{ $key + 1 }}" name="ans[{{ $drop12->id }}][]"
                                                            value="{{ $op13 }}~{{ $drop12->id }}"style="display: none;">{!! $op13 !!}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                    </div>
                                </div>
                            @else
                                <div class="forcheckicons-parent">
                                    <div class="questions forcheckicons">
                                        <div class="check-uncheckicon">
                                            <i class="fa fa-check-square-o chegreen d-none"
                                                id="nub1_{{ $page }}_{{ $key + 1 }}" aria-hidden="true"></i>
                                            <i class="fa fa-square-o yelodes"
                                                id="nub2_{{ $page }}_{{ $key + 1 }}" aria-hidden="true"></i>
                                        </div>
                                        <label class="all-ques-label-des"> {{ $key + 1 }} . &nbsp;
                                            {!! $drop12->question !!}</label>
                                            <div class="row">
                                                @php $option1 = explode(',',$drop12->option); @endphp
                                                <div class="col-md-12">
                                                    <select class="form-control q_n selectfontwei" data-page="{{ $page }}"
                                                        data-key="{{ $key + 1 }}" id="q_drop"
                                                        name="ans[{{ $drop12->id }}][]">
                                                        @foreach ($option1 as $key => $op11)
                                                            <option value="{{ $op11 }}~{{ $drop12->id }}">
                                                            {!! $op11 !!}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    &nbsp; &nbsp;
                    <div class="question-prev">
                        <button type="button" id="prv_{{ $page }}" data-page="{{ $page }}"
                            class="d-none prv">Preview</button> &nbsp;
                        @if ($count1 != 0)
                            <button type="button" data-page="{{ $page + 1 }}" data-u_id="{{ $u_id }}"
                                id="nxt">Next</button> &nbsp;
                        @else
                            <button type="submit" class="submit">Submit</button>
                        @endif
                    </div>
                </div>
                <div id="data_{{ $page + 1 }}">
                </div>
            @endif
        </form>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"
        integrity="sha512-BHDCWLtdp0XpAFccP2NifCbJfYoYhsRSZOUM3KnAxy2b/Ay3Bn91frud+3A95brA4wDWV3yEOZrJqgV8aZRXUQ=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.3.1/jquery-migrate.min.js"
        integrity="sha512-wDH73bv6rW6O6ev5DGYexNboWMzBoY+1TEAx5Q/sdbqN2MB2cNTG9Ge/qv3c1QNvuiAuETsKJnnHH2UDJGmmAQ=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"
        integrity="sha256-4OrICDjBYfKefEbVT7wETRLNFkuq4TJV5WLGvjqpGAk=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"
        integrity="sha256-g6iAfvZp+nDQ2TdTR/VVKJf3bGro4ub5fvWSWVRi2NE=" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.15/angular.min.js"
        integrity="sha256-vCJY79j8f3kuDmzPAzJnzDkyCC7lwUWtIRSv5kBglC8=" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.3/jquery.sticky.min.js"
        integrity="sha256-KaITQ+anfmmXJqtrI8++roWmTMUYukt1Q2wXcNxyzyA=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"
        integrity="sha256-JnqDCSpf1uxft0a84S1ECr038dZJwHL2U+F9DIAOtkc=" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/spin.js/2.0.1/spin.min.js"
        integrity="sha256-JSY/svpQOuJTNt4GKwPClmBTD0aZ4Qa5sXlAuxwcBNQ=" crossorigin="anonymous"></script> -->


    <script src="https://www.flexiquiz.com/scripts/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="https://d2a1lk4nhrwv0k.cloudfront.net/scripts/ckeditor/adapters/jquery.js" type="text/javascript"></script>
    <!-- <script src="https://d2a1lk4nhrwv0k.cloudfront.net/scripts/pick-a-color-1.2.3.min.js" type="text/javascript"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/tinycolor/0.9.16/tinycolor.min.js"
                                    integrity="sha256-5Y4mFT0fg2H+wsN07VgR69qhhTHpeqrTmqshLaiVh38=" crossorigin="anonymous"></script> -->

    <script src="https://www.flexiquiz.com/bundles/layoutSurveys?v=qZPgsoTFPKzWE74P93PtZbcQHMN82q6ZTuCLRti297Y1"></script>


    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
        messageStyle: "none"
        });
    </script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS_HTML"></script>

    <script type="text/javascript">
        var extraPluggins = 'autogrow,imageuploader,videouploader,sourcearea,youtube,font,colorbutton,table,expandmenu';
        var buttonsToRemove = 'Cut,Copy,Paste,Anchor,Strike,Subscript,Superscript,Unlink,About,Indent,Outdent';
    </script>

    <script type="text/javascript">
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
                        $('.submit').html('Submit');
                    }, 2000);
                    //console.log(response);
                    if (response.success == true) {

                        //notify
                        toastr.success("Quiz Submited Successfully");
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/') }}" + "/student/question-list";
                        }, 2000);

                    }
                    if (response.success2 == true) {
                        //notify
                        toastr.success("Quiz Submited Successfully");
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/') }}" + "/student/test-quiz-list/" + + response.u_id;
                        }, 3000);

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
        $(document).on("click", "#nxt", function() {
            var id = $(this).attr('data-u_id');
            var page = $(this).attr('data-page');
            var pag = page - 1;
            $.ajax({
                url: "{{ route('student.pre-page') }}",
                type: 'GET',
                data: {
                    id: id,
                    page: page,
                },
                dataType: 'json',
                success: function(data) {
                    $('#qu_' + pag).addClass('d-none');
                    $('#data_' + page).html(data.html);
                    $('#prv_' + page).removeClass('d-none');
                }
            });
        });
        $(document).on("click", ".prv", function() {
            var page = $(this).attr('data-page');
            var pag = page - 1;
            $('#qu_' + page).addClass('d-none');
            $('#qu_' + pag).removeClass('d-none');
        });
        // $(document).on("click", ".q_n", function() {
        //     var page = $(this).attr('data-page');
        //     var key = $(this).attr('data-key');
        //     var qname = $(this).attr('value');
        //     var getvalues = qname.split("~");
        //     var id = getvalues[1];
        //     // alert (id);
        //     var arr = [];
        //     var totl = $('#ttl_' + page).html();
        //     var t_val = parseInt(totl) + 1;
        //     var pag = page - 1;
        //     $('#nub_' + page + '_' + key).addClass("cls");
        //     $('#nub1_' + page + '_' +
        //             key)
        //         .removeClass("d-none");
        //     $('#nub2_' + page + '_' + key).addClass("d-none");
        //     $('#ttl_' + page)
        //         .html(t_val);
        // });
        var answeredQuestions = {};
        $(document).on("click", ".q_n", function() {
            var page = $(this).data('page');
            var key = $(this).data('key');
            var questionId = $(this).val().split('~')[1];
            if (!answeredQuestions[page] || !answeredQuestions[page][questionId]) {
                var totl = $('#ttl_' + page).text();
                var t_val = parseInt(totl) + 1;
                var pag = page - 1;
                $('#nub_' + page + '_' + key).addClass("cls");
                $('#nub1_' + page + '_' + key).removeClass("d-none");
                $('#nub2_' + page + '_' + key).addClass("d-none");
                $('#ttl_' + page).text(t_val);

                // Mark this question as answered
                if (!answeredQuestions[page]) {
                    answeredQuestions[page] = {};
                }
                answeredQuestions[page][questionId] = true;
            }
        });
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>




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
</script>
@endpush
