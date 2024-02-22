@extends('layouts.admin.master')
@section('content')
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

        /*.preview-text
        {
            position: absolute;
            right: 0;
        }
        */
        .preview-text {
            position: absolute;
            right: 0%;
            /*bottom: 9%;*/
            font-size: 14px;
            color: #ffffff;
            background-color: #009fff;
            padding: 12px 25px;
            border-radius: 7px;
            font-weight: 600;
            margin-top: 12px;
        }

        span.badge.info-low {
            color: #fff;
            border-radius: 7px !important;
            background-color: #009fff;
        }
    </style>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class=" p-4 " style="background-color: #4f94cf12; border-radius: 10px;">


                    @if (isset($single_choice_radio))
                        @foreach ($single_choice_radio as $key => $drop12)
                            <div class="forcheckicons-parent">
                                <div class="questions forcheckicons">
                                    <!-- <div class="check-uncheckicon">
                                        <i class="fa fa-check-square-o chegreen" aria-hidden="true"></i>
                                        <i class="fa fa-square-o yelodes" aria-hidden="true"></i>
                                    </div> -->
                                    <label
                                        class="all-ques-label-des">{{ $key + 1 }}.&nbsp;{!! $drop12->question !!}</label>
                                    <div class="row">
                                        @php $option = explode(',',$drop12->option); @endphp
                                        @foreach ($option as $op1)
                                            <div class="col-md-6">
                                                <label class="quesoptiondes"><i class="fa fa-circle-o unchk"
                                                        aria-hidden="true"></i>
                                                    <input type="radio" name="sdvbnm" class="quesoptiondesin"
                                                        value="1" required="" style="display: none;">
                                                    {!! $op1 !!}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if (isset($single_choice_check))
                        @foreach ($single_choice_check as $key => $drop)
                            <div class="forcheckicons-parent">
                                <div class="questions forcheckicons">
                                    <!-- <div class="check-uncheckicon">
                                        <i class="fa fa-check-square-o chegreen" aria-hidden="true"></i>
                                        <i class="fa fa-square-o yelodes" aria-hidden="true"></i>
                                    </div> -->
                                    <label class="all-ques-label-des">{{ $key + 1 }}. &nbsp;
                                        {!! $drop->question !!}</label>
                                    <div class="row">
                                        @php $option2 = explode(',',$drop->option); @endphp
                                        @foreach ($option2 as $op13)
                                            <div class="col-md-6">

                                                <label class="quesoptiondes"><i class="fa fa-circle-o unchk"
                                                        aria-hidden="true"></i>
                                                    <input type="checkbox" name="sdvbnm" value="1"
                                                        class="quesoptiondesin" required="" style="display: none;">
                                                    {!! $op13 !!}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if (isset($single_choice_drop))
                        @foreach ($single_choice_drop as $key => $drop1)
                            <div class="forcheckicons-parent">
                                <div class="questions forcheckicons">
                                    <!-- <div class="check-uncheckicon">
                                        <i class="fa fa-check-square-o chegreen" aria-hidden="true"></i>
                                        <i class="fa fa-square-o yelodes" aria-hidden="true"></i>
                                    </div> -->
                                    <label class="all-ques-label-des">{{ $key + 1 }}.
                                        &nbsp;{!! $drop1->question !!}</label>
                                    @php $option1 = explode(',',$drop1->option); @endphp
                                    <select class="form-control" id="category" name="category">
                                        <option value="">Select option</option>
                                        @foreach ($option1 as $key => $op11)
                                            <option value="{{ $op11 }}">{!! $op11 !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    &nbsp; &nbsp;
                    <div class="question-number">
                        <ul>
                            <span>Page No.</span> &nbsp; &nbsp;
                            @foreach ($page_no as $key => $pag)
                                <a
                                    href="{{ route('admin.teacher.question-preview', ['id' => base64_encode($u_id), 'page' => $pag->page]) }}">
                                    <li>{{ $pag->page }}</li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                    @if (count($single_choice_radio) == 0 && count($single_choice_check) == 0 && count($single_choice_drop) == 0)
                        <p> No Any Question found! </p>
                    @endif
                </div>
            </div>
        </div>
    @endsection
    @push('script')
        <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>




        <!-- <script type="text/javascript">
            $('.quesoptiondes').on('click', function() {
                $(this).closest('.row').find('.quesoptiondes').removeClass('active');
                $(this).closest('.row').find('.quesoptiondes i').removeClass('fa-check-circle');
                $(this).closest('.row').find('.quesoptiondes i').addClass('fa-circle-o');
                if ($(this).find('.quesoptiondesin').is(":checked")) {
                    $(this).find('i').toggleClass('fa-check-circle fa-circle-o');
                    $(this).toggleClass('active');
                }

            });
        </script> -->
    @endpush
