@extends('layouts.teacher.master')
@section('content')
        <div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #f6f6f6;">
             <div>
              <div class="card-body">
               <!--  <h5 class="subs-title">Tags : Project Management, Leadership</h5> -->
                <div class="instructor-wrap">
                  <div class="about-instructor">
                    <div class="abt-instructor-img img12">
                      <a href="#">
                        <img src="assets/img/user/user1.jpg" alt="img" class="img-fluid">
                      </a>
                    </div>
                    <div class="instructor-detail">
                      <h5>
                        <a href="#">Nicole Brown</a>
                      </h5>
                      <p>Sunday - November 13, 2022</p>
                    </div>
                  </div>

                  <div class="add-community">
                    <a href="{{url('/teacher/add-community')}}"><button>+ Add New</button></a>
                  </div>
                </div>
                <h5>
                  <b>Exploring Leadership</b>
                </h5>
                <p class="rev-info">“ This is the second Photoshop course I have completed with Cristian. Worth every penny and recommend it highly. To get the most out of this course, its best to to take the Beginner to Advanced course first. The sound and video quality is of a good standard. Thank you Cristian. “</p>
                <div class="col-md-12">
                  <img class="blog-post-image" src="assets/img/my-img/comm.jpg" width="100%" style="height: 300px;
                  object-fit: fill;">
                </div>
                <div class="like-p mt-4 d-flex">
                  <div class="like">
                    <a href="javascript:">
                      <img src="assets/img/my-img/like-img-gr.png" style="width: 23px;height: 23px;">
                    </a>
                    <a href="">10</a>
                  </div>
                  <div class="unlike">
                    <a href="javascript:" class="m-2 mt-lg-1">
                      <img src="assets/img/my-img/unlike-img-gr.png" style="width: 23px;height: 23px;">
                    </a>
                    <a href="">5</a>
                  </div>
                  <div class="comment">
                    <a href="javascript:" class="m-2 mt-lg-1">
                      <i class="fa fa-commenting" aria-hidden="true" style="color: #ffe088;font-size: 21px;"></i>
                      <!-- <img src="assets/img/my-img/unlike-img-gr.png" style="width: 23px;height: 23px;"> -->
                    </a>
                    <a href="">5</a>
                  </div>


                </div>
                <div class="addcomment mt-4">
                  <div class="row">
                    <div class="col-md-11" style="padding-right: 0px">
                      <textarea rows="2" class="form-control" placeholder="Comments"></textarea>
                    </div>
                    <div class="col-md-1" style="padding-left: 0px">
                      <div class="send-icon">
                        <a href=""><img src="assets/img/my-img/send-icon-new.png" class="send-icon1"></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="notify-item mt-5">
                  <div class="row align-items-center">
                    <div class="col-md-12">
                      <div class="notify-content">
                        <a href="instructor-profile.html">
                          <img class="avatar-img semirounded-circle" src="assets/img/user/user2.jpg" alt="User Image">
                        </a>
                        <div class="notify-detail">
                          <h6><a href="#">Rolands R </a><span>Today at 9:42 AM</span></h6>
                          <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here,</p>
                        </div>

                      </div>
                    </div>
                    <div class="rep12">
                      <div class="reply reply-view">
                        <a href="javascript:;" class="btn btn-reply rep-btn rep_view1"><i class="feather-corner-up-left"></i> Reply</a>
                      </div>

                      <div class="like like1">
                        <a href="javascript:">
                          <img src="assets/img/my-img/like-img-gr.png" style="width: 23px;height: 23px;">
                        </a>
                        <a href="">10</a>
                      </div>
                    </div>
                    <div class="addcomment1 mt-4">
                      <div class="row">
                        <div class="col-md-11" style="padding-right: 0px">
                          <textarea rows="2" class="form-control sec-reply" placeholder="Comments"></textarea>
                        </div>
                        <div class="col-md-1" style="padding-left: 0px">
                          <div class="send-icon">
                            <a href=""><img src="assets/img/my-img/send-icon-new.png" class="send-icon1" style="border: unset;"></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="notify-item message2">
                  <div class="row align-items-center">
                    <div class="col-md-12">
                      <div class="notify-content">
                        <a href="instructor-profile.html">
                          <img class="avatar-img semirounded-circle" src="assets/img/user/user2.jpg" alt="User Image">
                        </a>
                        <div class="notify-detail">
                          <h6><a href="instructor-profile.html">Rolands R </a><span>Today at 9:42 AM</span></h6>
                          <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here,</p>
                          <br>
                          <div class="rep123" style="margin-left: 0">
                            <div class="reply">
                              <a href="javascript:;" class="btn btn-reply rep-btn rep_view"><i class="feather-corner-up-left"></i> Reply</a>
                            </div>

                            <div class="like like1">
                              <a href="javascript:">
                                <img src="assets/img/my-img/like-img-gr.png" style="width: 23px;height: 23px;">
                              </a>
                              <a href="">10</a>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="addcomment12 mt-4">
                      <div class="row">
                        <div class="col-md-11" style="padding-right: 0px">
                          <textarea rows="2" class="form-control sec-reply" placeholder="Comments"></textarea>
                        </div>
                        <div class="col-md-1" style="padding-left: 0px">
                          <div class="send-icon">
                            <a href=""><img src="assets/img/my-img/send-icon-new.png" class="send-icon1" style="border: unset;"></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>    
            </div>
@endsection