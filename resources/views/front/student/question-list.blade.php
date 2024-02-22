@extends('layouts.student.master')

@section('content')


<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<style type="text/css">
    .add-ques-head-text
    {
        display: none;
    }
    div#cke_1_contents {
    height: 100px !important;
}
.for-quespretext
{
    position: relative;
}
.preview-text
{
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
.settings-inner-blk table tbody tr td {
    padding: 1rem 0.5rem;
    font-size: 16px;
    font-weight: 500;
}

span.badge.info-low {
    color: #fff;
    border-radius: 7px!important;
    background-color: #009fff;
}
</style>
<div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #f6f6f6;">
    <div class="profile-title for-quespretext">
        <h3>Question Bank</h3>
    </div>
    <div>
        @php
            $choise = DB::table('student_questions')->where('student_id',Auth::user()->id)->get();
        @endphp
        @if(count($choise) > 0)
        <div class="settings-widget mt-4" data-select2-id="19" style="border:none;">
            <div class="settings-inner-blk p-0" data-select2-id="18">
                <div class="comman-space p-0" data-select2-id="17">
                </div>
                <div class="comman-space p-0">
                    <div class="settings-referral-blk course-instruct-blk  table-responsive">
                        <table class="table table-nowrap mb-0 quiz-table-des">
                            @foreach($choise as $key=>$listq)
                            <tbody>
                                <tr>
                                    <td><a href="javascript:void(0)">Quiz{{$key+1}}</a></td>
                                    @if($listq->is_submitted == 1)
                                    <td>
                                        <a href="{{ route('student.submit-preview',['id'=>base64_encode($listq->u_id),'page'=>1]) }}"><span class="badge info-low" style="position: relative;">Submit Preview</span></a>
                                        <a href="{{ route('student.result',['id'=>base64_encode($listq->u_id),'page'=>1]) }}"><span class="badge info-low" style="position: relative;">Result</span></a>
                                        <a href="javascript:void(0)"><span class="badge info-low" style="position: relative;">Submitted</span></a>
                                    </td>
                                    @else
                                    <td> <a href="{{ route('student.question-preview',['id'=>base64_encode($listq->u_id),'page'=>1]) }}"><span class="badge info-low" style="position: relative;">Preview</span></a></td>
                                    @endif
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
                        <img src="{{asset('no-data.gif')}}" alt="Girl in a jacket">
                    </div>
                    <div style="text-align:center;padding-top: 25px;">
                        <span class="noupcom">There is no Question available</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
