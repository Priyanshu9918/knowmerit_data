<div id="quiz-data">
    <input type="hidden" name="id" id="id" value="{{$quiz->id}}">
    <div>
        <label>Title</label>
        <input class="form-control" type="text" name="title" value="{{$quiz->title ?? ''}}">
        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
    </div>
<button type="submit" class="btn subbtn">Submit</button>
</div>