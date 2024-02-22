@extends('layouts.admin.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome {{Auth::user()->name ?? ''}}</h3>
                  {{-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> --}}
                </div>
                {{-- <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                      <a class="dropdown-item" href="#">January - March</a>
                      <a class="dropdown-item" href="#">March - June</a>
                      <a class="dropdown-item" href="#">June - August</a>
                      <a class="dropdown-item" href="#">August - November</a>
                    </div>
                  </div>
                 </div>
                </div> --}}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                      <div class="card-body">
                        <p class="mb-4">Total Teacher </p>
                        <p class="fs-30 mb-2">{{$teacher}}</p>
                        <p class="fs-15 mb-2">Active : {{$ActiveTeacher}}
                            <br><span class="fs-15 mb-2">In Active : {{$InactiveTeacher}}   </span>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                      <div class="card-body">
                        <p class="mb-4">Total Student</p>
                        <p class="fs-30 mb-2">{{$student}}</p>
                        <p class="fs-15 mb-2">Active : {{$Activestudent}}
                            <br><span class="fs-15 mb-2">In Active : {{$Inactivestudent}}   </span>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="card-body">
                        <p class="mb-4">Total Bookings</p>
                        <p class="fs-30 mb-2">{{ $BookSession}}</p>
                        <p class="fs-15 mb-2">Total Cancelled Bookings : {{$BookSessionCancel}}</p>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Total Blogs</p>
                        <p class="fs-30 mb-2">{{$blog}}</p>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                        <p class="mb-4">Total Categorys</p>
                        <p class="fs-30 mb-2">{{$category}}</p>
                        <p class="fs-15 mb-2">Sub Category : {{$Subcategory}} </p>

                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Total Users</p>
                        <p class="fs-30 mb-2">{{$users}}</p>
                        <p class="fs-15 mb-2">Active : {{$Activeusers}}
                            <br><span class="fs-15 mb-2">In Active : {{$Inactiveusers}}   </span>
                        </p>

                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Contacts</p>
                      <p class="fs-30 mb-2">{{$contact}}</p>

                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Total Feedback</p>
                      <p class="fs-30 mb-2">{{$feedback}}</p>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection
