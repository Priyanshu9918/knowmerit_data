@extends('layouts.admin.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                
                <div class="card">
                        @php $teacher = DB::table('users')->where('user_type',2)->where('status',1)->orderBy('name','asc')->get(); @endphp
                        <div style="display:flex;top: 16px;position: relative;left: 18px; ">
                            <div style="width:30%;">
                                <select class="select form-control player" style="color:black;">
                                    <option value="">Select Teacher</option>
                                    @foreach($teacher as $plya1)
                                        <option value="{{$plya1->id}}">{{$plya1->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    <div class="card-body">
                        <h4 class="card-title">Teacher Attendance List</h4>
                        <div class="table-responsive">
                            <table class="table table-striped" id="category-datatable">
                                <thead>
                                    <tr>
                                        <th> #</th>
                                        <th> Class Name</th>
                                        <th> Teacher Name</th>
                                        <th> Student Name</th>
                                        <th> Start Time</th>
                                        <th> End Time</th>
                                        <th> Total Time</th>
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
                url : "{{ route('admin.t_attendace') }}",
                data : {'teacher_id':player}
            },
                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    // {data: 'check', name: 'created_at'},
                    {data: 'category', name: 'category'},

                    {data: 'teacher', name: 'teacher'},

                    {data: 'student', name: 'student'},

                    {data: 'start_time', name: 'start_time'},

                    {data: 'end_time', name: 'end_time'},

                    {data: 'totalTime', name: 'totalTime'},

                    {data: 'status', name: 'status'},
                ],
            });
        }

    });
    
    </script>
@endpush
