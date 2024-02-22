@extends('layouts.admin.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">
                <div style="display:flex;top: 16px;position: relative;left: 18px; ">
                            <div>
                                <a href="{{url('/admin/schedule-class')}}" class="btn btn-primary book-class mr-5">Book Class</a>
                            </div>
                            <div>
                                <a href="{{url('/admin/schedule-class1')}}" class="btn btn-primary book-class">Demo Class</a>
                            </div>
                            @php
                                $teacher = DB::table('users')->where('user_type',2)->where('status',1)->get();
                            @endphp
                            <div class="card-toolbar" style="width:24%;left: 480px;position: relative;">
                                <select class="select form-control player" style="color:black;">
                                    <option value="">Select Teacher</option>
                                    @foreach($teacher as $plya1)
                                        <option value="{{$plya1->id}}">{{$plya1->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    <div class="card-body">
                        <h4 class="card-title">Category List</h4>
                        <div class="table-responsive">
                            <table class="table table-striped" id="category-datatable">
                                <thead>
                                    <tr>
                                        <th> #</th>
                                        <th> Teacher Name</th>
                                        <th> Student Name</th>
                                        <th> Category</th>
                                        <th> Start Time</th>
                                        <th> End Time</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
    $(document).ready(function(){
        ledger();
        $(document).on('change','.player',function(){
            ledger();
        });
        function ledger(){
            var player = $('.player').val();
            var table = $('#category-datatable').DataTable({
            processing : true,
            serverSide : true,
            bDestroy : true,
            ajax : {
                url : "{{ route('admin.booking') }}",
                data : {'teacher_id':player}
            },
                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    // {data: 'check', name: 'check'},

                    {data: 'teacher', name: 'teacher'},

                    {data: 'student', name: 'student'},

                    {data: 'category', name: 'category'},

                    {data: 'start_time', name: 'start_time'},

                    {data: 'end_time', name: 'end_time'},

                    {data: 'value', name: 'value'},
                ],
            });
        }

    });

    </script>
@endpush
