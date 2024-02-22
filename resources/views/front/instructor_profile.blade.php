@extends('layouts.front.master')
@section('content')
    <style>
        img.write-review1 {
            width: 75px !important;
            height: 75px !important;
            border-radius: 50px;
            border: 2px solid #f2e8d3;
        }
        .learn-more-five {
                padding: 10px 20px;
        }
    </style>
    <section style="margin-top: 140px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12">

                    <div class="about-text">
                        <h5>About Me</h5>
                        <h6>
                            Hi, my name is {{ $profile->name }} I am a recent {{ $profile->degree }} from
                            {{ $profile->university_name }} where I
                            completed{{ $profile->degree }}{{ $profile->describe_experience }}
                            {{-- Hi, my name is Gaurav Sharma. I am a recent Post Graduation from MCA where I completed Post Graduation. I have done degree certification from Rajasthan University, I participated in debates for various social topics. During my college time I was a trainer for coding workshop. --}}
                        </h6>
                    </div>


                    <div class="all-edu-certi">


                        <div class="card education-sec teacher-profile-details">
                            <div class="card-body">
                                <h5 class="subs-title">Education</h5>
                                <div class="edu-wrap">
                                    <div class="edu-name">
                                        <i class="fa fa-graduation-cap" aria-hidden="true"
                                            style="background-color: #fbb117;padding: 14px 12px;border-radius: 50%;color: #fff;"></i>
                                    </div>
                                    <div class="edu-detail">
                                        <h6>{{ $profile->degree }}</h6>
                                        <p class="edu-duration">{{ $profile->university_name }}</p>
                                        <p>
                                            I have done degree certification from {{ $profile->degree }}, {{ $profile->describe_experience }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card education-sec teacher-profile-details">
                            <div class="card-body">
                                <h5 class="subs-title">Experience</h5>
                                <div class="edu-wrap">
                                    <div class="edu-name">
                                        <i class="fa fa-building" aria-hidden="true"
                                            style="background-color: #fbb117;padding: 14px 15px;border-radius: 50%;color: #fff;"></i>
                                    </div>
                                    <div class="edu-detail">
                                        <h6>College Experiance</h6>
                                        <p class="edu-duration">{{ $profile->experience_year }} Years</p>
                                        <p> {{ $profile->describe_experience }}
                                        </p>
                                    </div>
                                </div>
                                <div class="edu-wrap">
                                    <div class="edu-name">
                                        <i class="fa fa-home" aria-hidden="true"
                                            style="background-color: #fbb117;padding: 14px 15px;border-radius: 50%;color: #fff;"></i>
                                    </div>
                                    <div class="edu-detail">
                                        <h6>Background Experience</h6>
                                        <p> {{ $profile->backgorund_experience }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $sdata = DB::table('write_reviews')
                                ->leftjoin('tutors', 'write_reviews.tutor_name', '=', 'tutors.id')
                                ->leftjoin('users', 'users.id', '=', 'write_reviews.student_id')
                                ->select('write_reviews.*', 'tutors.name', 'tutors.image', 'tutors.user_id', 'users.avatar', 'users.first_name')
                                ->where('write_reviews.tutor_name', $profile->id)
                                ->get();
                        @endphp
                        @if (count($sdata) > 0)
                            <div class="card education-sec teacher-profile-details">
                                <div class="card-body">
                                    <h5 class="subs-title">Review</h5>

                                    @foreach ($sdata as $data)
                                        <div class="edu-wrap" style="border-bottom: 1px solid #e7e7e7; padding: 25px 0px;">
                                            <div class="edu-name">
                                                @if(isset($data->avatar))
                                                <img src="{{ asset('uploads/tutors/' . $data->avatar) }}" alt="img"
                                                    class="write-review1">
                                                    @else
                                                    <img src="{{ asset('assets/img/user/av.jpg') }}" alt="img"
                                                    class="write-review1">
                                                    @endif
                                            </div>
                                            <div class="edu-detail">
                                                <h6>{{ $data->first_name }}</h6>
                                                <p>
                                                    {{ $data->comment }} </p>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="profile-sticky">

                        <div class="teacher-profile-img">
                            <div class="profile-info-blk for-certi">
                                @if (isset($userp->avatar))
                                    <a href="javascript:;" class="profile-info-img">
                                        <img src="{{ asset('uploads/tutors/' . $userp->avatar) }}" alt=""
                                            class="img-fluid">
                                    </a>
                                @else
                                    <a href="javascript:;" class="profile-info-img">
                                        <img src="{{ asset('assets/img/user/av.jpg') }}" alt="" class="img-fluid">
                                    </a>
                                @endif
                                @if($profile->is_verified == 1)
                                <img class="certiimgdet" style="width: 20px;" src="http:/knowmerit.com/uploads/tutors/certified-logo.png">
                                @endif
                                <h4>
                                    <a href="javascript:;">{{ $profile->name }}</a>
                                    </span>
                                    </a>
                                </h4>
                                @php
                                    $lanquage = explode(',', $profile->language);
                                    $lan = '';
                                    foreach ($lanquage as $ln) {
                                        $lan = $lan . ', ' . $ln;
                                    }
                                @endphp
                                <div class="pro-deta">
                                    <p class="lang-para"><span class="bold-color">LANGUAGES:
                                        </span>{{ $str1 = substr($lan, 2) }}</p>
                                    <p class="lang-para"><span class="bold-color">LOCATION: </span>{{ $profile->location }}
                                    </p>
                                    <p class="lang-para"><span class="bold-color">RATE: </span>
                                        ₹{{ $profile->charge_amount }}/Hour</p>

                                </div>
                                <div>
                                    {{-- @if (Auth::check())
                                    <a href="{{ url('chatify', ['id' => $profile->user_id]) }}" class="learn-more-five contdes mb-4">Contact</a>
                                @else
                                    <a href="{{ url('user/login') }}"
                                          class="learn-more-five mb-4 contdes">Contact</a>
                                    @endif --}}
                                    <a href="javascript:void(0)" class="learn-more-five mb-4" id="contct1" data-id="{{$profile->user_id}}">Contact</a>

                                    @if ($profile->youtube_url != '')
                                    <a href="javascript:void(0)" class="learn-more-five videobtndes" data-url="{{ $profile->youtube_url }}" id="watch-videos-det" href="javascript:void(0)">Watch Video</a>
                                    @endif
                                    <!-- <a href=""  class="learn-more-five" style="margin-left: 10px;"></a> -->
                                </div>

                            </div>
                        </div>


                    </div>
                </div>



            </div>
        </div>
    </section>



     <div id="watch-video-modal-det" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 10px 10px 10px 10px;">
                <div class="modal-header">
                    <button id="watch-video-cancel" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div>
                    <a href="https://www.youtube.com/watch?v=d0wV9EC3t14"></a>
                     <iframe class="tube" id="ytube" width="100%" height="460" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                <!-- <div class="modal-footer">
          </div> -->
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script src="http://merit.techsaga.live/assets/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).on('click', '#watch-videos-det', function() {
        var url = $(this).attr('data-url');
            $("#ytube").attr('src',url);
        $('#watch-video-modal-det').modal('show');
        return false;
    });
    $(document).on('click', '#watch-video-cancel', function() {
        $('#watch-video-modal-det').modal('hide');
    })

    $(document).on('click', '#contct1', function(event) {
        var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('ct_pages') }}",
                type: "get",
                data: {
                    'active': id,
                },
                success: function(response) {
                if(response.success == true){
                    window.location = "{{ url('/') }}" + "/user/login";
                }
                if(response.success2 == true){
                    window.location = "{{ url('/') }}" +"/chatify";
                }
                }
            });
        });

    </script>



@endpush
