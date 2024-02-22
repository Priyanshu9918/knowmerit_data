@extends('layouts.student.master')
@section('content')
<style type="text/css">
    .user-nav a.dropdown-toggle {
        display: block;
    }

    .course-instruct-blk .badge {
        min-width: 133px;
        padding: 7px 10px;
        border-radius: 30px !important;
        color: #fff;
        font-size: 14px;
    }

    .for-margin {
        margin: 20px;
    }
    .group-img-tdbtn
    {
        position: absolute;
        top: 33%;
        right: 0%;
    }
    .enrollremainclass {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .enrollremainclass .textfield h6 {
        margin-bottom: 3px;
    }
    .enrollremainclass .textfield h6 span {
        font-weight: 600;
    }
    .ticket-btn-grp a {
        font-weight: 600;
    }
</style>
<div class="col-xl-9 col-lg-8 col-md-12">
    <!-- <div class="row" style="background-color: #4f94cf12; border-radius: 10px; padding: 20px 20px 60px 20px;">
        <div class="enrollremainclass">
                    @php
                        $id = Auth::user()->id;
                        $data = DB::table('users')->where('id' ,$id)->first();
                        $t_class = DB::table('book_sessions')->where('student_id',$id)->get();

                        $today124 = Carbon\Carbon::now();
                        $dt = new \DateTime($today124, new \DateTimeZone('UTC'));
                        $re_class = App\Models\BookSession::where('student_id', auth()->user()->id)
                            ->where('end_time', '>', $dt)
                            ->where('teacher_url', '<>', null)
                            ->orderBy('start_time', 'ASC')
                            ->get();

                        $datacon = DB::table('countries')->where('id',$data->country)->first();
                        $datatime = DB::table('time_zones')->where('id',$data->timezone)->first();
                    @endphp
                <div class="textfield">
                    <h6>Enrolled classes : <span>{{count($t_class)}}</span></h6>
                    <h6>Remaining classes : <span>{{count($re_class)}}</span></h6>
                </div>
                <div class="ticket-btn-grp">
                    <a href="javascript:void(0)" id="raise">Raise an issue</a>
                </div>
        </div>
        <div class="profile-details mt-4">
            <div class="settings-widget mt-4" data-select2-id="19">
                <div class="settings-inner-blk p-0" data-select2-id="18">
                    <div class="comman-space pb-0" data-select2-id="17">
                    </div>
                    @php
                        $data = DB::table('users')->where('id' ,Auth::user()->id)->first();

                        $datacon = DB::table('book_class_attendance')->where('user_id',Auth::user()->mh_user_id)->get();
                
                        $today124 = Carbon\Carbon::now();
                        $dt = new \DateTime($today124, new \DateTimeZone('UTC'));
                        $re_class = App\Models\BookSession::where('student_id', auth()->user()->id)
                            ->where('end_time', '>', $dt)
                            ->where('student_url', '<>', null)
                            ->orderBy('start_time', 'ASC')
                            ->get();

                        $datacon123 = DB::table('countries')->where('id',$data->country)->first();
                        $datatime = DB::table('time_zones')->where('id',$data->timezone)->first();
                    @endphp
                    <div class="comman-space pb-0">
                        <div class="settings-referral-blk course-instruct-blk  table-responsive">
                            <table class="table table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <td>id</td>
                                        <td>Class Name</td>
                                        <td>Teacher</td>
                                        <td>start time</td>
                                        <td>end time</td>
                                        <td>total Time</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($datacon) > 0)
                                        @foreach($datacon as $key=>$vdata)
                                            @php
                                                $today124 = Carbon\Carbon::now();
                                                $dt = new \DateTime($today124, new \DateTimeZone('UTC'));
                                                $re_class = App\Models\BookSession::where('student_id', auth()->user()->id)
                                                    ->where('end_time', '>', $dt)
                                                    ->where('student_url', '<>', null)
                                                    ->orderBy('start_time', 'ASC')
                                                    ->get();
                                                $book_data = App\Models\BookSession::where('merithub_class_id',$vdata->class_id)->where('student_id',Auth::user()->id)->first();
                                                if($book_data){
                                                    $student_name = App\Models\User::where('id',$book_data->teacher_id)->first();
                                                    $class_name = DB::table('categories')->where('id',$book_data->sub_id)->first();
                                                    $start_time = new \DateTime($vdata->start_time, new \DateTimeZone('UTC'));
                                                    $end_time = new \DateTime($vdata->end_time, new \DateTimeZone('UTC'));
                                                    $total_time = $vdata->total_time/60;
                                                }
                                            @endphp
                                            @if($book_data)
                                                <tr>
                                                    <td>{{$key++}}</td>
                                                    <td>{{ $class_name->name ?? ''}}</td>
                                                    <td>{{ $student_name->name ?? ''}}</td>
                                                    @if(isset($start_time))
                                                    <td>{{ $start_time->format('Y-m-d H:i:s') }}</td>
                                                    @endif
                                                    @if(isset($end_time))
                                                    <td>{{ $end_time->format('Y-m-d H:i:s') }}</td>
                                                    @endif
                                                    <td>{{ ceil($total_time ?? '')}} min</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                           
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div> -->
    <div class="row" style="background-color: #4f94cf12; border-radius: 10px; padding: 20px 20px 60px 20px;">
        
        <div class="row attendance-categ align-items-center">
            <div class="col-md-3 col-sm-12">
                <div class="cat-select-stud">
                    <select name="" id="">
                      <option value="">Select Category</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="cat-select-stud">
                    <select name="" id="">
                      <option value="">Select Subject</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="cat-select-stud">
                    <select name="" id="">
                      <option value="">Select Tutor</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="cat-select-stud">
                    <a href="javascript:void(0)" id="raise">Submit</a>
                    <!-- <a href="javascript:void(0)" id="raise">Payment Link</a> -->
                </div>
            </div>
        </div>
        <div class="enrollremainclass">
               
                <div class="textfield">
                    <div>
                        <div class="progress blue">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                            <span class="progress-right">
                               <span class="progress-bar"></span>
                            </span>
                            <!-- <div class="progress-value">90%</div> -->
                        </div>
                    </div>
                    <div>
                        <h6><span>Enrolled classes : 36</span></h6>
                        <h6> <span>Remaining classes : 0</span></h6>
                    </div>
                </div>
                <!-- <div class="ticket-btn-grp">
                    <a href="javascript:void(0)" id="raise">Raise an issue</a>
                    <a href="javascript:void(0)" id="raise">Payment Link</a>
                </div> -->
        </div>
        <div class="profile-details mt-4">
                <!-- 
            
                                     -->

                    <div class="lapidatetime">
                        <div class="lapidatetimeblock1">
                            <i class="fa fa-laptop" aria-hidden="true"></i>
                            <p>Class Logs</p>
                        </div>
                        <div>
                            <ul class="datetimeli">
                                <li>
                                    <label>From: </label>
                                    <input type="date" name="start_time" placeholder="04/01/2024">
                                </li>
                                <li>
                                    <label>To: </label>
                                    <input type="date" name="end_time" placeholder="04/01/2024">
                                </li>
                                <!-- <li>
                                    <select>
                                        <option>Today</option>
                                        <option>Tomorrow</option>
                                        <option>10/01/2024</option>
                                    </select>
                                </li> -->
                            </ul>
                        </div>
                    </div>
            <div class="settings-widget mt-4 border-0" data-select2-id="19">
                <div class="settings-inner-blk p-0" data-select2-id="18">
                    <div class="comman-space pb-0" data-select2-id="17">
                    </div>
                                        <div class="comman-space pb-0">
                        <div class="settings-referral-blk course-instruct-blk  table-responsive">
                            <table class="table table-nowrap mb-1 attentableblock">
                                <thead>
                                    <tr>
                                        <td>id</td>
                                        <td>Class Name</td>
                                        <td>Students</td>
                                        <td>start time</td>
                                        <td>end time</td>
                                        <td>total Time</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

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

    <div id="add-student-lesson" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <div class="modal-header"> -->
                    <!-- <button id="cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                <!-- </div> -->
                <div class="modal-body">
                    <div class="popup-add">
                        <form action="{{ route('student.reason') }}" method="POST" id="createFrm" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label>Your Issue</label>
                                <textarea class="form-control" type="text" name="issue"></textarea>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-issue"></p>
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                    </div>


                </div>
                <!-- <div class="modal-footer">
          </div> -->
            </div>

        </div>
    </div>

    @endsection
        @push('script')
{{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        //on change country
        $(document).on('click', '#raise', function() {
            $('#add-student-lesson').modal('show');
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
                        toastr.success("Issue send Successfully!");
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            // window.location = "{{ url('/')}}" + "/teacher/payment";
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
</script>

@endpush