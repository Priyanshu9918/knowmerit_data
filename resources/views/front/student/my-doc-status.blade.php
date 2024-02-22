<div id="statuscmpt">
            @if(isset($video11) && $video11->is_completed == 0)
                <button class="btn btn-warning d-none cmpt float-end m-2 mt-0" id="v_dis1" data-type="video"
                    data-id="{{$video11->id}}">Complete</button>
                <div class="d-flex justify-content-end justify-content-end d-none" id="v_dis12">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <button class="btn btn-primary mb-3 mt-0" data-type="audio" id="audio" data-id="{{$lession}}">Next</button>
                </div>
                @else
                <div class="d-flex justify-content-end d-none" id="v_dis">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <button class="btn btn-primary mb-3 mt-0" id="audio" data-type="audio" data-id="{{$lession}}">Next</button>
                </div>
                @endif
                @if(isset($audio11) && $audio11->is_completed == 0)
                <button class="btn btn-warning d-none cmpt float-end m-2 mt-0" id="a_dis1" data-type="audio"
                    data-id="{{$audio11->id}}">Complete</button>
                <div class="d-flex justify-content-end d-none" id="a_dis12">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <button class="btn btn-primary mb-3 mt-0" id="iframe" data-type="iframe" data-id="{{$lession}}">Next</button>
                </div>
                @else
                <div class="d-flex justify-content-end d-none" id="a_dis">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <button class="btn btn-primary mb-3 mt-0" id="iframe" data-type="iframe" data-id="{{$lession}}">Next</button>
                </div>
                @endif
                @if(isset($iframe11) && $iframe11->is_completed == 0)
                <button class="btn btn-warning d-none cmpt float-end m-2 mt-0" id="i_dis1" data-type="iframe"
                    data-id="{{$iframe11->id}}">Complete</button>
                <div class="d-flex justify-content-end d-none" id="i_dis12">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <button class="btn btn-primary mb-3 mt-0" id="view_presentation" data-type="presentation" data-id="{{$lession}}">Next</button>
                </div>
                @else
                <div class="d-flex justify-content-end d-none" id="i_dis">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <button class="btn btn-primary mb-3 mt-0" id="view_presentation" data-type="presentation" data-id="{{$lession}}">Next</button>
                </div>
                @endif
                @if(isset($presentaion) && $presentaion->is_completed == 0)
                <button class="btn btn-warning d-none cmpt float-end m-2 mt-0" id="p_dis1" data-type="presentation"
                    data-id="{{$presentaion->id}}">Complete</button>
                <div class="d-flex justify-content-end d-none" id="p_dis12">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <button class="btn btn-primary mb-3 mt-0" id="view_assign" data-type="assign" data-id="{{$lession}}">Next</button>
                </div>
                @else
                <div class="d-flex justify-content-end d-none" id="p_dis">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <button class="btn btn-primary mb-3 mt-0" id="view_assign" data-type="assign" data-id="{{$lession}}">Next</button>
                </div>
                @endif
                @if(isset($Assign) && $Assign->is_completed == 0)
                <button class="btn btn-warning d-none cmpt float-end m-2 mt-0" id="as_dis1" data-type="assign"
                    data-id="{{$Assign->id}}">Complete</button>
                <div class="d-flex justify-content-end d-none" id="as_dis12">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <button class="btn btn-primary mb-3 mt-0" id="view_scrom" data-type="scrom" data-id="{{$lession}}">Next</button>
                </div>
                @else
                <div class="d-flex justify-content-end d-none" id="as_dis">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <button class="btn btn-primary mb-3 mt-0" id="view_scrom" data-type="scrom" data-id="{{$lession}}">Next</button>
                </div>
                @endif
                @if(isset($Quiz) && $Quiz->is_completed == 0)
                <button class="btn btn-warning d-none cmpt float-end m-2 mt-0" id="qz" data-type="quiz"
                    data-id="{{$Quiz->id}}">Complete</button>
                <div class="d-flex justify-content-end d-none" id="qz12">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <button class="btn btn-primary" id="view_web" data-type="web" data-id="{{$lession}}">Next</button>
                </div>
                @else
                <div class="d-flex justify-content-end d-none" id="qz1">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <button class="btn btn-primary" id="view_web" data-type="web" data-id="{{$lession}}">Next</button>
                </div>
                @endif
                @if(isset($Web) && $Web->is_completed == 0)
                <button class="btn btn-warning d-none cmpt float-end m-2 mt-0" id="w" data-type="web"
                    data-id="{{$Web->id}}">Complete</button>
                <div class="d-flex justify-content-end d-none" id="w12">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <!-- <button class="btn btn-primary" id="view_assign" data-id="{{$lession}}">Next</button> -->
                </div>
                @else
                <div class="d-flex justify-content-end d-none" id="w1">
                    <button class="btn btn-success m-3 mt-0">Completed</button>
                    <!-- <button class="btn btn-primary" id="view_web" data-id="{{$lession}}">Next</button> -->
                </div>
                @endif
</div>