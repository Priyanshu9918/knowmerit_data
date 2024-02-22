<div class="popup-add" id="data12">
<form action="{{route('teacher.edit-lession1',['id'=>base64_encode($lession->id)])}}" method="POST" id="createFrm122" enctype="multipart/form-data">
@csrf
    <input type="hidden" name="lession" id="lession123" value="{{$lession->id}}">
    <div>
        <label>Lession</label>
        <input class="form-control" type="text" name="title" placeholder="Lesson" value="{{$lession->title}}">
        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error1-title"></p>
    </div>
    <button>Submit</button>
</form>
</div>