<div id="scrm">
@if(isset($Scrom) && $Scrom->is_completed == 0)
<button class="btn btn-warning d-none cmpt float-end m-2 mt-0" id="scrm1" data-type="scrom"
    data-id="{{$Scrom->id}}">Complete</button>
<div class="d-flex justify-content-end d-none" id="scrm12">
    <button class="btn btn-success m-3 mt-0">Completed</button>
    <button class="btn btn-primary" id="view_quiz" data-type="quiz" data-id="{{$lession}}">Next</button>
</div>
@else
<div class="d-flex justify-content-end" id="scrm">
    <button class="btn btn-success m-3 mt-0">Completed</button>
    <button class="btn btn-primary" id="view_quiz" data-type="quiz" data-id="{{$lession}}">Next</button>
</div>
@endif
</div>