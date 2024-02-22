@extends('layouts.teacher.master1')
@section('content')
<style type="text/css">
.theiaStickySidebar {
    display: none;
}

.container {
    max-width: 100%;
}

.page-content.instructor-page-content.createteacher {
    padding: 75px 0 0px !important;
}

div#preview-section {
    padding: 10px;
}

.profile-title h3 i {
    margin-right: 25px;
    margin-left: 5px;
}
#Web
{
  display: none;
  padding: 0px;
  width: 100%;
  height: auto;
  text-align: center;
  background: #fff;
  position: fixed;
  top: 10%;
  left: 0%;
  background-color: #fff;
  overflow: scroll;
    height: 90vh;
    overflow-x: hidden;
  z-index: 99;

}
.cnclbtn
{
    display: flex;
    justify-content: end;
    padding: 20px 20px 0px 20px;
}
/*.popup-add {
    padding: 10px 100px 70px 100px;
    text-align: left;
}*/
.cnclbtn button#Web-cancel-btn {
    border: none;
    background-color: unset;
    font-size: 40px;
}
.webbtn-des
{
    text-align: center;
    padding: 15px 0px;
}
.popup-add label {
    font-size: 16px;
    font-weight: 500;
    color: #468dcb;
}
#iframe_view .modal-body {
    height: 235px;
    width: 100%;
    background-color: unset;
}
button#iframe_view-cancel-btn {
    /*padding: 5px 15px;*/
    background-color: unset;
    color: #fff;
    margin: 0;
    font-size: 25px;
    padding: 0px;
    border: none;
}

#iframe_view .modal-header h5 {
    margin: 0;
    color: #fff;
}
#iframe_view label {
    font-size: 16px;
    margin-bottom: 10px;
    font-weight: 500;
    color: #559ad2;
}
#iframe_view .subbtn
{
	position: relative;
	color: #fff;
    border-radius: 7px!important;
    background-color: #009fff;
    border: none;
    padding: 5px 20px;
    font-weight: 500;
    margin-top: 20px;
}

#iframe_view .modal-header {
    color: #fff;
    font-size: 20px;
    display: flex;
    justify-content: end;
    padding: 5px 15px;
    background-color: #559ad2;
}

#iframe_view .modal-dialog {
    top: 20%;
}

#data-web-view .modal-body {
    height: 300px;
    width: 100%;
    background-color: unset;
}
button#data-web-view-cancel-btn {
    /*padding: 5px 15px;*/
    background-color: unset;
    color: #fff;
    margin: 0;
    font-size: 25px;
    padding: 0px;
    border: none;
}

#data-web-view .modal-header h5 {
    margin: 0;
    color: #fff;
}
#data-web-view label {
    font-size: 16px;
    margin-bottom: 10px;
    font-weight: 500;
    color: #559ad2;
}
#data-web-view .subbtn
{
	position: relative;
	color: #fff;
    border-radius: 7px!important;
    background-color: #009fff;
    border: none;
    padding: 5px 20px;
    font-weight: 500;
    margin-top: 20px;
}

#data-web-view .modal-header {
    color: #fff;
    font-size: 20px;
    display: flex;
    justify-content: end;
    padding: 5px 15px;
    background-color: #559ad2;
}

#data-web-view .modal-dialog {
    top: 20%;
}

#data-audio-view .modal-body {
    height: 300px;
    width: 100%;
    background-color: unset;
}
button#data-audio-view-cancel-btn {
    /*padding: 5px 15px;*/
    background-color: unset;
    color: #fff;
    margin: 0;
    font-size: 25px;
    padding: 0px;
    border: none;
}

#data-audio-view .modal-header h5 {
    margin: 0;
    color: #fff;
}
#data-audio-view label {
    font-size: 16px;
    margin-bottom: 10px;
    font-weight: 500;
    color: #559ad2;
}
#data-audio-view .subbtn
{
	position: relative;
	color: #fff;
    border-radius: 7px!important;
    background-color: #009fff;
    border: none;
    padding: 5px 20px;
    font-weight: 500;
    margin-top: 20px;
}

#data-audio-view .modal-header {
    color: #fff;
    font-size: 20px;
    display: flex;
    justify-content: end;
    padding: 5px 15px;
    background-color: #559ad2;
}

#data-audio-view .modal-dialog {
    top: 20%;
}

#data-video-view .modal-body {
    height: 300px;
    width: 100%;
    background-color: unset;
}
button#data-video-view-cancel-btn {
    /*padding: 5px 15px;*/
    background-color: unset;
    color: #fff;
    margin: 0;
    font-size: 25px;
    padding: 0px;
    border: none;
}

#data-video-view .modal-header h5 {
    margin: 0;
    color: #fff;
}
#data-video-view label {
    font-size: 16px;
    margin-bottom: 10px;
    font-weight: 500;
    color: #559ad2;
}
#data-video-view .subbtn
{
	position: relative;
	color: #fff;
    border-radius: 7px!important;
    background-color: #009fff;
    border: none;
    padding: 5px 20px;
    font-weight: 500;
    margin-top: 20px;
}

#data-video-view .modal-header {
    color: #fff;
    font-size: 20px;
    display: flex;
    justify-content: end;
    padding: 5px 15px;
    background-color: #559ad2;
}

#data-video-view .modal-dialog {
    top: 20%;
}
.process_b_bar{
    background-color: #009FFF;
    color: #fff;
    width: 27px;
    height: 27px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    border-radius: 12px;
}
.process_b_bar{
    background-color: #009FFF;
    color: #fff;
    width: 27px;
    height: 27px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    border-radius: 12px;
}
.status_icons .fa-lock{
    color:#000 !important;
    font-size: 22px;
}
.status_icons .fa-square-check{
    color: #21B477 !important;
    font-size: 22px;
}
.status_icons .fa-chevron-right{
    font-size: 22px;
    color:#fbb116 !important;
}
#list-lesson .fa-xmark{
    padding: 5px;
    color: white;
    background-color: red;
    font-size: 13px;
    width: 25px;
    border-radius: 20px;
    height: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 5px;
}
#list-lesson .fa-pen-to-square{
    padding: 5px;
    color: white;
    background-color: black;
    font-size: 13px;
    width: 25px;
    border-radius: 20px;
    height: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 5px;
}
</style>
@php 
$iframe11 = DB::table('course_games')->where('course_id',$course->id)->orderBy('created_at', 'asc')->get();
@endphp
<div class="profile-title" style="background-color:#009FFF;">
    <h3 class="mb-0 text-white text-uppercase"><a href="{{url('/teacher/course-details12',['st_id' => request()->st_id, 'id' => $course->id])}}">
        <svg style="width: 30px;stroke: #fff;margin-right: 20px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          </a> Course Games
    </h3>
</div>
<div class="col-xl-12 col-lg-12 col-md-12" style="background-color: #f6f6f6; height: 700px;">
    <div id="preview-section" class="profile-details preview-page">

        <div class="row">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="preview-tap-div" style="height: 100%;">
                    <div class="tab">
                        <!-- <button class="tablinks" onclick="openCity(event, 'lesson-list')">
                            <img src="../../assets/img/icon/play.svg" alt="" style="filter: invert(1);"> Lesson List
                        </button> -->
                       <!--  <button class="tablinks" onclick="openCity(event, 'question-answer')">
                            <img style="width: 25px;" src="../../assets/img/homework.png" alt=""> Assignment </button> -->
                    </div>
                    <div id="lesson-list" class="tabcontent">
                        <!-- <h5 id="chapter-togg">
                            <i class="fa fa-book" aria-hidden="true" style="flex-basis: 10%;"></i>
                            <span style="flex-basis: 82%;"> {{$chapture->title ?? ''}}</span>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </h5> -->
                        <!-- <div class="lesson-open-togg"> -->
                            <h6 id="lesson-toggle" class="nav-item dropdown dropdown-account">
                                <a class="nav-link align-items-center">
                                    <i style="flex-basis: 10%;"><i class="fa-solid left-icon fa-chevron-right position-relative"></i></i>
                                    <span style="flex-basis: 81%; color:#22100D;">{{$course->title ?? ''}}</span>
                                    <!-- <span style="background-color:#009FFF;color:#fff;">30%</span> -->
                                    <div class="status_icons">
                                    <!-- <i class="fa-solid fa-lock"></i> -->
                                    <!-- <i class="fa-solid fa-square-check"></i> -->
                                    <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                                    </div>
                                </a>
                                <!-- <i class="fa fa-columns"></i> &nbsp; &nbsp; &nbsp; &nbsp; {{$lession->title ?? ''}}<i class="fa fa-angle-down" style="margin-left: 120px;" aria-hidden="true"></i></a> -->
                            </h6>
                            <ul id="list-lesson" class="dropdown-menu dropdown-side" style="display: block;">
                                @if(count($iframe11) > 0)
                                    @foreach($iframe11 as $iframe1)
                                    <li>
                                        <a href="javascript:void(0)" id="iframe" data-id="{{$iframe1->id}}">
                                            <i class="fas fa-square" aria-hidden="true"></i>
                                            {{$iframe1->title ?? 'iframe'}}
                                        </a>
                                        <a href="javascript:void(0)" data-bs-toggle="collapse" id="del_presentation" data-type="game" data-id="{{$iframe1->id}}">
                                        <i class="fa fa-times" style="padding: 15px; color:red;"></i> </a>
                                        <a href="javascript:void(0)" data-bs-toggle="collapse" id="edit_iframe" data-type="game" data-id="{{$iframe1->id}}">
                                        <i class="fa fa-edit" style="padding: 15px; color:green;"></i> </a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        <!-- </div> -->
                    </div>
                    <div id="question-answer" class="tabcontent">

                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-12">
                <div class="preview-img-video play" id="disdata" style="height: 100%;">
                    <iframe class="tube d-none" id="ytube" width="100%" height="500px" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <!-- <div class="d-none" id="scrom1"></div> -->
            </div>
        </div>
    </div>
</div>
<div id="iframe_view" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button id="iframe-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                    <form action="{{route('teacher.update-game')}}" method="POST" id="editiframe" enctype="multipart/form-data">
                        @csrf
                        <div id="iframe_data"></div>
                    </form>
                    </div>


                </div>
                <!-- <div class="modal-footer">
          </div> -->
            </div>

        </div>
</div>




@endsection
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script><script  src="./script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
<script src="{{asset('/ckeditor/ckeditor/ckeditor.js')}}"></script>
 <script>
$(document).ready(function() {

            $(document).on('click', '#edit_iframe', function(event) {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                $.ajax({
                    url: "{{ route('teacher.edit-data1') }}",
                    type: "get",
                    data: {
                        'id': id,
                        'type': type,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#iframe_data').replaceWith(response);
                        $('#iframe_view').modal('show');
                    }
                });
            });
            $(document).on('submit', 'form#editiframe', function(event) {
                event.preventDefault();
                //clearing the error msg
                $('p.error_container').html("");
                $('.pre-loader').show();

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
                            $('.submit').html('Save');
                        }, 2000);
                        //console.log(response);
                        if (response.success == true) {

                            //notify
                            toastr.success("Games Updated Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                // window.location = "{{ url('/') }}" +
                                //     "/teacher/payment-list";
                                location.reload();
                            }, 2000);

                        }
                        //show the form validates error
                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error1-' + error_text).html(response.errors[control]);
                                // $('#error-'+error_text).html(response.errors[error_text][0]);
                                // console.log('#error-'+error_text);
                            }
                            // console.log(response.errors);
                            $('.pre-loader').hide();
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
            
    $(document).on('click', '#iframe', function(event) {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('teacher.d-iframe1') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                console.log(response);
                if (response.success == true) {
                    var url = response.value.url;
                    $(".tube").attr('src', url);
                    $('#ytube').removeClass('d-none');
                }
            }
        });
    });
    $(document).on('click', '#del_presentation', function() {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'you want to delete your Topic.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, make your AJAX request here to delete the account
                        var ajaxUrl = "{{ route('teacher.delete-data') }}";
                        var requestData = {
                            "_token": "{{ csrf_token() }}",
                            'id' : id,
                            'type' : type,
                        };
                        $.ajax({
                            type: 'POST',
                            url: ajaxUrl,
                            data: requestData,
                            success: function(response) {
                                if (response.success == true) {
                                    Swal.fire({
                                        title: 'Topic Deleted!',
                                        icon: 'success',
                                    }).then(() => {
                                        location.reload();
                                    });
                                }
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while deleting your account.',
                                    icon: 'error',
                                });
                            }
                        });
                    }
                });
            });
    
});
</script>
<script>
function openCity(evt, cityName) {
    // alert(cityName);
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    if (cityName == 'lesson-list') {
        var element = document.getElementById("disdata");
        element.classList.remove("d-none");
    }
    if (cityName == 'question-answer') {
        var element = document.getElementById("disdata");
        element.classList.add("d-none");
    }
}
</script>
<script type="text/javascript">
$('#lesson-toggle').on("click", function() {
    $('#list-lesson').toggle();
})
</script>
<script type="text/javascript">
$('#chapter-togg').on("click", function() {
    $('.lesson-open-togg').toggle();
})
</script> @endpush
