@extends('layouts.admin.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome {{Auth::user()->name ?? ''}}</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                        <p class="mb-4">Total Categorys</p>
                        <p class="fs-30 mb-2">50</p>
                        <p class="fs-15 mb-2">Sub Category : 40 </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Total Users</p>
                        <p class="fs-30 mb-2">45</p>
                        <p class="fs-15 mb-2">Active : 25
                            <br><span class="fs-15 mb-2">In Active : 20   </span>
                        </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection
