@extends('layouts.teacher.master')

@section('content')


    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <style type="text/css">
        .add-ques-head-text {
            display: none;
        }

        div#cke_1_contents {
            height: 100px !important;
        }

        .for-quespretext {
            position: relative;
        }

        /*.preview-text
    {
        position: absolute;
        right: 0;
    }
    */
        .preview-text {
            position: absolute;
            right: 0%;
            /*bottom: 9%;*/
            font-size: 14px;
            color: #ffffff;
            background-color: #009fff;
            padding: 12px 25px;
            border-radius: 7px;
            font-weight: 600;
            margin-top: 12px;
        }

        span.badge.info-low {
            color: #fff;
            border-radius: 7px !important;
            background-color: #009fff;
        }
    </style>
    @php
        $choise = DB::table('choice_questions')
            ->select('id', 'u_id', 'title')
            ->groupBy('id', 'u_id', 'title')
            ->get();

    @endphp
    <div class="col-xl-9 col-lg-8 col-md-12">

        <form action="{{ route('teacher.update_title', ['id' => $title->id]) }}"
            method="POST" id="editForm">
            @csrf
            <div class="col-sm-12">
                <div class="form-group">
                    <h2>Edit Title</h2>
                    <input type="text" class="from-control" name="title" value="{{$title->title}}" id="editedTitle" placeholder="Enter new title">
                    <button class="btn btn-success" id="saveChanges">Save</button>
                </div>
            </div>
        </form>
    </div>

@endsection
@push('script')
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
    <script src="./script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
            $(document).on('submit', 'form#editFrm', function(event) {
                event.preventDefault();
                //clearing the error msg
                $('p.error_container').html("");

                var form = $(this);
                var data = new FormData($(this)[0]);
                var url = form.attr("action");
                var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
                $('.submit').attr('disabled', true);
                $('.form-control').attr('readonly', true);
                $('.form-control').addClass('disabled-link');
                $('.error-control').addClass('disabled-link');
                if ($('.submit').html() !== loadingText) {
                    $('.submit').html(loadingText);
                }
                $.ajax({
                    type: form.attr('method'),
                    url: url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        window.setTimeout(function() {
                            $('.submit').attr('disabled', false);
                            $('.form-control').attr('readonly', false);
                            $('.form-control').removeClass('disabled-link');
                            $('.error-control').removeClass('disabled-link');
                            $('.submit').html('Update');
                        }, 2000);
                        //console.log(response);
                        if (response.success == true) {

                            //notify
                            toastr.success("title Updated Successfully");
                            window.setTimeout(function() {
                                window.location = "{{ url('/')}}" + "/question-list";
                            }, 2000);

                        }
                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error-' + error_text).html(response.errors[control]);
                            }
                            // console.log(response.errors);
                        }
                    },
                    error: function(response) {
                        // alert("Error: " + errorThrown);
                        console.log(response);
                    }
                });
                event.stopImmediatePropagation();
                return false;
            });
        });

    </script>
@endpush
