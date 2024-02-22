@extends('layouts.teacher.master')

@section('content')


    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
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
    @php
    $choise = DB::table('choice_questions')
    ->select('u_id', DB::raw('MAX(id) as id'), DB::raw('MAX(title) as title'), DB::raw('MAX(course_id) as course_id'))
    ->whereNull('course_id')
    ->groupBy('u_id')
    ->get();


        // $choise = DB::table('choice_questions')->select('title')->groupBy('u_id')->get();
    @endphp
    <div class="col-xl-9 col-lg-8 col-md-12">

        <div class="row" style="background-color: #4f94cf12; border-radius: 10px; margin-bottom: 10px;">
            <div class="col-md-6 col-sm-12">
                <div class="course-group mb-0 d-flex mt-3 mb-3"
                    style="background-color: #fff; padding: 16px; border-radius: 5px;">
                    <div class="course-group-img d-flex align-items-center">
                        <div class="course-name">
                            @php
                                $id = Auth::user()->id;
                                $data = DB::table('users')
                                    ->where('id', $id)
                                    ->first();
                                $datacon = DB::table('countries')
                                    ->where('id', $data->country)
                                    ->first();
                                $datatime = DB::table('time_zones')
                                    ->where('id', $data->timezone)
                                    ->first();
                            @endphp
                            <h4><a href="">{{ $datacon->name ?? '' }}</a></h4>
                            <p>{{ $datatime->timezone ?? '' }}</p>
                        </div>
                    </div>
                    @php
                        $user_id = Auth::user()->id;
                        $user1 = DB::table('users')
                            ->where('id', $user_id)
                            ->first();
                        $timezone = DB::table('time_zones')
                            ->where('id', $user1->timezone ?? 195)
                            ->first();
                        $tz = $timezone->timezone;
                        $timestamp = time();
                        $dt = new DateTime('now', new DateTimeZone($tz));
                        $dt1 = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                        $dt->setTimestamp($timestamp);
                    @endphp
                    <div class="profile-share d-flex align-items-center justify-content-center">
                        <p class="head-time-des">{{ $dt->format('h:ia') }} (UTC {{ $timezone->raw_offset }}.00)</p>
                        <a href="javascript:;" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#timezone">Edit</a>
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
                                        <form action="{{ route('teacher.timezone2.create') }}" method="POST"
                                            id="teacher2Frm">
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
                                                <select class="form-select" aria-label="Default select example"
                                                    name="timezone3" id="timezone_id3">
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
                <div class="course-group mb-0 d-flex mt-3 mb-3"
                    style="background-color: #fff; padding: 27px; border-radius: 5px;">
                    <a href="{{ url('/teacher/calendar', ['id' => base64_encode(Auth::user()->id)]) }}" class="iconpadding">
                        <i class="fa fa-calendar icnfirst"></i>
                        <span> Availability</span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            @php
                $total_msg = DB::table('ch_messages')
                    ->where('seen', 0)
                    ->where('to_id', Auth::user()->id)
                    ->count('seen');
            @endphp
            <div class="col-md-3 col-sm-12">
                <div class="course-group mb-0 d-flex mt-3 mb-3"
                    style="background-color: #fff; padding: 27px; border-radius: 5px;">
                    <a href="{{ url('chatify') }}" class="iconpadding">
                        <i class="fa fa-comments icnfirst"></i>
                        <span> My Inbox</span>
                        <span class="spancunt">{{ $total_msg ?? 0 }}</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row" style="background-color: #4f94cf12; border-radius: 10px; padding: 20px 20px 70px 20px;">
            <div class="profile-title for-quespretext">
                <!-- <h3>Question Bank</h3> -->
                @php
                    $id = rand(100000, 9999999);
                @endphp
                <a href="{{ route('teacher.question-answer', ['id' => base64_encode($id)]) }}">
                    <h6 class="preview-text">Create Quiz</h6>
                </a>
            </div>
            <div>
                @if (count($choise) > 0)
                   <div class="settings-widget" data-select2-id="19" style="border:none; margin-top: 65px;">
                        <div class="settings-inner-blk p-0" data-select2-id="18">
                            <div class="comman-space p-0" data-select2-id="17">
                            </div>
                            <div class="comman-space p-0">
                                <div class="settings-referral-blk course-instruct-blk  table-responsive">
                                    <table class="table table-nowrap mb-0 quiz-table-des">
                                        @foreach ($choise as $key => $listq)
                                            <tbody style="border-bottom: 2px solid #4f94cf12">
                                                <tr width="100%">
                                                    <td width="70%"><a
                                                            href="{{ route('teacher.question-answer', ['id' => base64_encode($listq->u_id)]) }}">{{ $listq->title ?? 'Quizs' }}</a>
                                                    </td>
                                                    <td width="20%"> <a
                                                            href="{{ route('teacher.question-preview', ['id' => base64_encode($listq->u_id), 'page' => 1]) }}"><span
                                                                class="badge info-low"
                                                                style="position: relative;">Preview</span></a></td>
                                                    <td width="10%" class="text-center"> <a href="javascript:void(0)"
                                                            id="delete" data-id="{{ $listq->u_id }}"><span
                                                                class="badgedt info-low"><i class="fa fa-times"
                                                                    aria-hidden="true"></span></a></td>
                                                    <td width="10%" class="text-center">
                                                        <a href="{{ route('teacher.update_title', ['id' => $listq->id]) }}" class="editButton">
                                                            <span class="badgedt info-low"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="no-up">
                            <div class="noenquery for-margin">
                                <img src="{{ asset('no-data.gif') }}" alt="Girl in a jacket">
                            </div>
                            <div style="text-align:center;padding-top: 25px;">
                                <span class="noupcom">There is no Question available</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>



@endsection
@push('script')
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
    <script src="./script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>

        $(document).ready(function() {
            $(document).on('click', '#delete', function() {
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'you want to delete your Quiz.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, make your AJAX request here to delete the account
                        var ajaxUrl = "{{ route('teacher.delete-quiz') }}";
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
                                        title: 'Quiz Deleted!',
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
        });
    </script>
@endpush
