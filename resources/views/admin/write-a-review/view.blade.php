@extends('layouts.admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Review</h4>
                            <form>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label"><b>Tutor Tpye</b></label>
                                        <br>
                                        {{ $review->tutor_type }}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label"><b>Tutor Name</b></label>
                                        <br>
                                        {{ $review->tutor_name }}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label"><b>Description</b></label>
                                        <br>
                                        {{ $review->comment }}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label"><b>Created At</b></label>
                                        <br>
                                        {{ date('d M, Y', strtotime($review->created_at)) }}
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
