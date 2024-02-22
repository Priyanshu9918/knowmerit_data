<div class="popup-add" id="data123">
    <form action="{{route('teacher.edit-lecture1',['id'=>base64_encode($lecture->id)])}}" method="POST" id="createFrm1234" enctype="multipart/form-data">
        @csrf
            <div>
                <label>Lecture</label>
                <input class="form-control" type="text" name="title" placeholder="Lesson" value="{{$lecture->title}}">
                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error1-title"></p>
            </div>
            <div>
                <label>Description</label>
                <input class="form-control" type="text" name="description" placeholder="" value="{{$lecture->description}}">
                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error1-description"></p>
            </div>
            <button>Submit</button>
        </form>
    </div>