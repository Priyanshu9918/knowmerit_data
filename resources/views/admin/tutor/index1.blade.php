@extends('layouts.admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Course Bank</h4>
                            <div>
                                <a href="{{ route('admin.tutor.create') }}" class="btn btn-primary">Add Teacher</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped" id="course-datatable1111">
                                    <thead>
                                        <tr>
                                            <th> #</th>
                                            <th> Title</th>
                                            <th> Created At</th>
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
            $(document).ready(function() {

                if ($("#course-datatable1111").length > 0) {
                    /*Checkbox Add*/
                    var tdCnt = 0;
                    var targetDt = $('#course-datatable1111').DataTable({

                        processing: true,

                        serverSide: true,

                        ajax: "{{ route('admin.course-bank') }}",

                        columns: [

                            //{data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {
                                data: 'check',name: 'check'
                            },

                            {
                                data: 'title',
                                name: 'title'
                            },

                            {
                                data: 'created_at',
                                name: 'created_at'
                            },
                            {
                                data: 'action',
                                name: 'action'
                            },


                        ],

                        "dom": '<"row"<"col-7 mb-3"<"contact-toolbar-left">><"col-5 mb-3"<"contact-toolbar-right"f>>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',

                        "ordering": true,

                        "columnDefs": [{
                            "searchable": false,
                            "orderable": false,
                            "targets": [0, 6]
                        }],

                        // "order": [6, 'desc'],

                        language: {
                            search: "",
                            searchPlaceholder: "Search",
                            "info": "_START_ - _END_ of _TOTAL_",
                            sLengthMenu: "View  _MENU_",
                            paginate: {
                                next: '<i class="ri-arrow-right-s-line"></i>', // or '→'
                                previous: '<i class="ri-arrow-left-s-line"></i>' // or '←'
                            }
                        },
                        "drawCallback": function() {
                            $('.dataTables_paginate > .pagination').addClass(
                                'custom-pagination pagination-simple pagination-sm');
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
                    $("div.contact-toolbar-right").addClass('d-flex justify-content-end').append(
                        '	<button class="btn btn-sm btn-outline-light ms-3"><span><span class="icon"><i class="bi bi-filter"></i></span><span class="btn-text">Filters</span></span></button>'
                        );
                    $("#course-datatable1111").parent().addClass('table-responsive');

                    /*Select all using checkbox*/
                    var DT1 = $('#course-datatable1111').DataTable();
                    $(".check-select-all").on("click", function(e) {
                        $('.check-select').attr('checked', true);
                        if ($(this).is(":checked")) {
                            DT1.rows().select();
                            $('.check-select').prop('checked', true);
                        } else {
                            DT1.rows().deselect();
                            $('.check-select').prop('checked', false);
                        }
                    });
                    $(".check-select").on("click", function(e) {
                        if ($(this).is(":checked")) {
                            $(this).closest('tr').addClass('selected');
                        } else {
                            $(this).closest('tr').removeClass('selected');
                            $('.check-select-all').prop('checked', false);
                        }
                    });
                }
            });
        </script>
    @endpush
