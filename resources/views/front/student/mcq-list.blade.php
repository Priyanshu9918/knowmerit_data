@extends('layouts.student.master')
@section('content')
<style type="text/css">
.user-nav a.dropdown-toggle {
    display: block;
}

span.top-view-c2 {
    padding: 3px 6px;
}

.settings-inner-blk table tbody tr td {
    padding: 0.7rem 0.5rem;
}

/* .settings-inner-blk table tbody tr:last-child{
		border: 5px solid #009fff !important;
   } */
.dash-table td {
    padding: 1rem 35px !important;
}
</style>
<div class="col-xl-9 col-lg-8 col-md-12">
    <h3> MCQs</h3>
    <div class="settings-widget">
        <div class="settings-inner-blk p-0">
            <div class="comman-space pb-0">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="all">
                        <div class="settings-tickets-blk table-responsive">

                            <table class="table table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Subject</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span style="color: #fbb116;">[1]</span>
                                            <span><a href="{{url('student/mcqs')}}" class="link">need a freelancer
                                                    software</a></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span style="color: #fbb116;">[2]</span>
                                            </a>
                                            <span><a href="{{url('student/mcqs')}}" class="link">I have a
                                                    problem</a></span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <span style="color: #fbb116;">[3]</span>
                                            <span><a href="{{url('student/mcqs')}}" class="link">Enabling SSH
                                                    service</a></span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <span style="color: #fbb116;">[4]</span>
                                            <span><a href="{{url('student/mcqs')}}" class="link">when will start the
                                                    order</a></span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <span style="color: #fbb116;">[5]</span>
                                            <span><a href="{{url('student/mcqs')}}" class="link">I need blog comment
                                                    backlinks from example.co.uk</a></span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <span style="color: #fbb116;">[6]</span>
                                            <span><a href="{{url('student/mcqs')}}" class="link">need a freelancer
                                                    software</a></span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <span style="color: #fbb116;">[7]</span>
                                            <span><a href="{{url('student/mcqs')}}" class="link">I have a
                                                    problem</a></span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <span style="color: #fbb116;">[8]</span>
                                            <span><a href="{{url('student/mcqs')}}" class="link">Enabling SSH
                                                    service</a></span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <span style="color: #fbb116;">[9]</span>
                                            <span><a href="{{url('student/mcqs')}}" class="link">when will start the
                                                    order</a></span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <span style="color: #fbb116;">[10]</span>
                                            <span><a href="{{url('student/mcqs')}}" class="link">I need blog comment
                                                    backlinks from example.co.uk</a></span>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
$('.tab-value').click(function() {
    var t = $(this).text();
    $('#addbtn').html('Add' + t);
});
</script>