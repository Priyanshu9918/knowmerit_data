
@extends('layouts.admin.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
            <h4 class="card-title">User List</h4>
            <!-- <p class="card-description">
            Add class
            </p> -->
            <div>
                <a href="{{route('admin.customer.create')}}" class="btn btn-primary">Add Customer</a>
            </div>
            <div class="table-responsive">
            <table class="table table-striped" id="user-datatable">
                <thead>
                <tr>
                    <th> #</th>
                    <th> Name</th>
                    <th> created_at</th>
                    <th> Action</th>
                    <!-- <th>Deadline</th> -->
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

        if ($("#user-datatable").length > 0) {
            /*Checkbox Add*/
            var tdCnt=0;
            var targetDt = $('#user-datatable').DataTable({

                processing: true,

                serverSide: true,

                ajax: "{{route('admin.customer')}}",

                columns: [

                        //{data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'check', name: 'check'},

                        {data: 'name', name: 'name'},

                        {data: 'created_at', name: 'created_at'},

                        {data: 'action', name: 'action'},

                    ],

                "dom": '<"row"<"col-7 mb-3"<"contact-toolbar-left">><"col-5 mb-3"<"contact-toolbar-right"f>>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

                "ordering": true,

                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": [0,3]
                } ],

                // "order": [1, 'desc' ],

                language: { search: "",
                    searchPlaceholder: "Search",
                    "info": "_START_ - _END_ of _TOTAL_",
                    sLengthMenu: "View  _MENU_",
                    paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>', // or '→'
                    previous: '<i class="ri-arrow-left-s-line"></i>' // or '←'
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('custom-pagination pagination-simple pagination-sm');
                }
            });

            // $('table tr').each(function(){
            //     $('<span class="form-check mb-0"><input type="checkbox" class="form-check-input check-select" id="chk_sel_'+tdCnt+'"><label class="form-check-label" for="chk_sel_'+tdCnt+'"></label></span>').appendTo($(this).find("td:first-child"));
            //     tdCnt++;
            // });
            // $(document).on('click', '.del-button', function () {
            //     targetDt.rows('.selected').remove().draw( false );
            //     return false;
            // });
            //$("div.contact-toolbar-left").html('<div class="d-xxl-flex d-none align-items-center"><div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example"><button type="button" class="btn btn-outline-light active">View all</button><button type="button" class="btn btn-outline-light">Monitored</button><button type="button" class="btn btn-outline-light">Unmonitored</button></div>');
            $("div.contact-toolbar-right").addClass('d-flex justify-content-end').append('	<button class="btn btn-sm btn-outline-light ms-3"><span><span class="icon"><i class="bi bi-filter"></i></span><span class="btn-text">Filters</span></span></button>');
            $("#user-datatable").parent().addClass('table-responsive');

            /*Select all using checkbox*/
            var  DT1 = $('#user-datatable').DataTable();
            $(".check-select-all").on( "click", function(e) {
                $('.check-select').attr('checked', true);
                if ($(this).is( ":checked" )) {
                    DT1.rows().select();
                    $('.check-select').prop('checked', true);
                } else {
                    DT1.rows().deselect();
                    $('.check-select').prop('checked', false);
                }
            });
            $(".check-select").on( "click", function(e) {
                if ($(this).is( ":checked" )) {
                    $(this).closest('tr').addClass('selected');
                } else {
                    $(this).closest('tr').removeClass('selected');
                    $('.check-select-all').prop('checked', false);
                }
            });
        }


        $(document).on('click', '.statusBtn', function (event) {

            var id = $(this).attr('data-id');
            var type =$(this).attr('data-type');
            //  alert(user_id);
            var table = 'users';
            swal({
                // icon: "warning",
                type: "warning",
                title: "Are you Want to Change The Status of This Category?",
                text: "",
                dangerMode: true,
                showCancelButton: true,
                confirmButtonColor: "#007358",
                confirmButtonText: "YES",
                cancelButtonText: "CANCEL",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(e){
                if(e==true)
                {
                    $.ajax({
                        type:'POST',
                        url: "{{route('admin.status-action')}}",
                        data: {"_token" : "{{ csrf_token() }}",'id':id,'table_name':table,'type':type},
                        success: function (response) {

                            //console.log(response);
                            if (response.success) {
                                // window.setTimeout(function(){
                                //    location.reload();
                                // },2000);
                                // toastr.success("Status Changed Successfully");

                                if(response.type=='enable')
                                {
                                    $('table.categoryTable tr').find("[data-ac='" + id + "']").fadeIn("slow");
                                    $('table.categoryTable tr').find("[data-ac='" + id + "']").removeClass("d-none");

                                    $('table.categoryTable tr').find("[data-dc='" + id + "']").fadeOut("slow");

                                    $('table.categoryTable tr').find("[data-dc='" + id + "']").addClass("d-none");

                                }
                                else if(response.type=='disable')
                                {
                                    $('table.categoryTable tr').find("[data-dc='" + id + "']").fadeIn("slow");
                                    $('table.categoryTable tr').find("[data-dc='" + id + "']").removeClass("d-none");

                                    $('table.categoryTable tr').find("[data-ac='" + id + "']").fadeOut("slow");

                                    $('table.categoryTable tr').find("[data-ac='" + id + "']").addClass("d-none");
                                }

                                toastr.success(response.message);

                                window.setTimeout(()=>{
                                    window.location.reload();
                                },2000);
                            }
                            else {

                            }

                            swal.close();

                        },
                        error: function (xhr, textStatus, errorThrown) {
                            // alert("Error: " + errorThrown);
                        }

                    });
                }
                else
                {
                    swal.close();
                }
            });

        });

        $(document).on('click','.deleteBtn',function(){

            var _this=$(this);
            // var result=confirm("Are You Sure You Want to Delete?");
            var id = $(this).data('id');
            var table = 'users';
            swal({
                    // icon: "warning",
                    type: "warning",
                    title: "Are You Sure You Want to Delete?",
                    text: "",
                    dangerMode: true,
                    showCancelButton: true,
                    confirmButtonColor: "#007358",
                    confirmButtonText: "YES",
                    cancelButtonText: "CANCEL",
                    closeOnConfirm: false,
                    closeOnCancel: false
                    },
                    function(e){
                        if(e==true)
                        {
                            _this.addClass('disabled-link');
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "{{route('admin.delete-action')}}",
                                data: {"_token": "{{ csrf_token() }}",'id': id,'table_name':table},
                                success: function(data){
                                    console.log(data);
                                    window.setTimeout(function(){
                                    _this.removeClass('disabled-link');
                                    },2000);

                                    if(data.code==200)
                                    {
                                        window.setTimeout(function(){
                                            window.location.reload();
                                        },2000);
                                    }
                                },
                                error : function(response)
                                {
                                    console.log(response);
                                }
                            });
                            swal.close();
                        }
                        else
                        {
                            swal.close();
                        }
                    }
            );
        });
    });
    </script>
@endpush
