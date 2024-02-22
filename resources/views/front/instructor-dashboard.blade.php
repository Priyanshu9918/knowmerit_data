@extends('layouts.front.master')
@section('content')
<div class="page-content instructor-page-content createteacher">
  <div class="container">
    <div class="row">
      <div class="col-xl-3 col-lg-4 col-md-12 theiaStickySidebar">
        <div class="settings-widget dash-profile">
          <div class="settings-menu p-0">
            <div class="profile-bg">
              <h5>Beginner</h5>
              <img src="assets/img/instructor-profile-bg.jpg" alt>
              <div class="profile-img">
                <a href="#">
                  <img src="assets/img/user/user15.jpg" alt>
                </a>
              </div>
            </div>
            <div class="profile-group">
              <div class="profile-name text-center">
                <h4>
                  <a href="#">Jenny Wilson</a>
                </h4>
              </div>
            </div>
          </div>
        </div>
        <div class="settings-widget account-settings">
          <div class="settings-menu">
            <h3>DASHBOARD</h3>
            <ul>
              <li class="nav-item active">
                <a href="#" class="nav-link">
                  <i class="feather-home"></i> My Dashboard </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="feather-book"></i> My Courses </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="feather-shopping-bag"></i> Orders </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="feather-users"></i> Teacher </a>
              </li>
            </ul>
            <div class="instructor-title">
              <h3>ACCOUNT SETTINGS</h3>
            </div>
            <ul>
              <li class="nav-item">
                <a href="#" class="nav-link ">
                  <i class="feather-settings"></i> Edit Profile </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="feather-user"></i> Security </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="feather-refresh-cw"></i> Social Profiles </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="feather-bell"></i> Notifications </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="feather-lock"></i> Profile Privacy </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="feather-trash-2"></i> Delete Profile </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="feather-power"></i> Sign Out </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-xl-9 col-lg-8 col-md-12">
        <div class="settings-top-widget">
          <div class="row">
            <div class="">
            <div class="no-upcomimg">
          <img src="assets/img/my-img/clipboard1.png">
          </div>
          <h3 class="text-white">No Upcoming Task </h3>
           
          <!-- <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card stat-info net-earn">
                <a href="#">
                  <div class="card-body text-center dashboard-c">
                    <i class='fas fa-book-open icon-dash'></i>
                    <h3>Upcoming Task</h3>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <a href="#">
                <div class="card stat-info bal">
                  <div class="card-body text-center dashboard-c12">
                    <i class="fa fa-building-o classroom1" aria-hidden="true"></i>
                    <h3 style="color: #607D8B;">Classrooms</h3>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-xl-3 col-lg-6">
              <a href="#">
                <div class="card stat-info avg">
                  <div class="card-body text-center dashboard-c2">
                    <i class="fa fa-address-book bookaddress" aria-hidden="true"></i>
                    <h3>Lesson</h3>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-xl-3 col-lg-6">
              <a href="#">
                <div class="card stat-info refer">
                  <div class="card-body text-center dashboard-c1">
                    <i class='fa fa-check-square classroom'></i>
                    <h3 style="color: #159F46">Completed Task</h3>
                  </div>
                </div>
              </a>
            </div>
          </div> -->
        </div>
        </div>
        <!-- <div class="row">
          <div class="col-md-12">
            <div class="settings-widget">
              <div class="settings-inner-blk p-0">
                <div class="sell-course-head comman-space">
                  <h3>Courses</h3>
                </div>
                <div class="comman-space pb-0">
                  <div class="settings-tickets-blk course-instruct-blk table-responsive">
                    <table class="table table-nowrap mb-2">
                      <thead>
                        <tr>
                          <th>COURSES</th>
                          <th>STUDENTS</th>
                          <th>STATUS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="sell-table-group d-flex align-items-center">
                              <div class="sell-group-img">
                                <a href="#">
                                  <img src="assets/img/course/course-10.jpg" class="img-fluid " alt="">
                                </a>
                              </div>
                              <div class="sell-tabel-info">
                                <p>
                                  <a href="#">Information About UI/UX Design Degree</a>
                                </p>
                                <div class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                  <div class="rating-img d-flex align-items-center">
                                    <img src="assets/img/icon/icon-01.svg" alt="">
                                    <p>10+ Lesson</p>
                                  </div>
                                  <div class="course-view d-flex align-items-center">
                                    <img src="assets/img/icon/timer-start.svg" alt="">
                                    <p>7hr 20min</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>3200</td>
                          <td>
                            <span class="badge info-low">Live</span>
                          </td>
                        </tr>
                       
                        
                        <tr>
                          <td>
                            <div class="sell-table-group d-flex align-items-center">
                              <div class="sell-group-img">
                                <a href="#">
                                  <img src="assets/img/course/course-13.jpg" class="img-fluid " alt="">
                                </a>
                              </div>
                              <div class="sell-tabel-info">
                                <p>
                                  <a href="#">C# Developers Double Your Coding Speed with Visual Studio</a>
                                </p>
                                <div class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                  <div class="rating-img d-flex align-items-center">
                                    <img src="assets/img/icon/icon-01.svg" alt="">
                                    <p>10+ Lesson</p>
                                  </div>
                                  <div class="course-view d-flex align-items-center">
                                    <img src="assets/img/icon/timer-start.svg" alt="">
                                    <p>7hr 20min</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>0</td>
                          <td>
                            <span class="badge info-medium">Pending</span>
                          </td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</div>
@endsection