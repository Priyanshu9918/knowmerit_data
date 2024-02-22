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
                @php
                    $id1 = base64_decode($id);
                    $choise = DB::table('choice_questions')
                        ->where('teacher_id', $id1)
                        ->select('id', 'u_id', 'title')
                        ->groupBy('id', 'u_id', 'title')
                        ->get();
                @endphp
                <div class="row" style="background-color: #4f94cf12; border-radius: 10px; padding: 20px 20px 70px 20px;">
                    <div class="profile-title for-quespretext">
                        <!-- <h3>Question Bank</h3> -->
                        @php
                            $id = rand(100000, 9999999);
                        @endphp
                        <a
                            href="{{ route('admin.teacher.question-answer', ['id' => base64_encode($id), 'tid' => request()->id]) }}">
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
                                                                    href="{{ route('admin.teacher.question-preview', ['id' => base64_encode($listq->u_id), 'page' => 1]) }}"><span
                                                                        class="badge info-low"
                                                                        style="position: relative;">Preview</span></a></td>
                                                            <td width="10%" class="text-center"> <a
                                                                    href="javascript:void(0)" id="delete"
                                                                    data-id="{{ $listq->u_id }}"><span
                                                                        class="badgedt info-low"><i class="fa fa-times"
                                                                            aria-hidden="true"></span></a></td>
                                                            {{-- <td width="10%" class="text-center">
                                                            <a href="{{ route('admin.teacher.update_title', ['id' => $listq->id]) }}" class="editButton">
                                                                <span class="badgedt info-low"><i class="fa fa-pencil"
                                                                        aria-hidden="true"></i></span>
                                                            </a>
                                                        </td> --}}
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
                            var ajaxUrl = "{{ route('admin.teacher.delete-quiz') }}";
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
