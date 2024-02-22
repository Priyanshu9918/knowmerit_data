<div id="presentation_data">
    <input type="hidden" name="id" id="id" value="{{$presentation->id}}">
    <div>
        <label>Title</label>
        <input class="form-control" type="text" name="title" value="{{$presentation->title ?? ''}}">
        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
    </div>
    <div>
        <label>Add file</label>
        <input class="form-control" type="file" name="file" accept=".doc,.docx,.ppt,.pptx,.pdf">
        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-file"></p>
    </div>
    <button type="submit" class="btn subbtn">Submit</button>
</div>