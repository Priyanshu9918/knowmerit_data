<div id="audio-data">
    <input type="hidden" name="id" value="{{$audio->id}}">
    <div>
        <label>Title</label>
        <input class="form-control" type="text" name="title" value="{{$audio->title ?? ''}}" placeholder="Enter Audio Title">
        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
    </div>
    <div>
        <label>file</label>
        <input type="file" class="form-control" name="audio" accept=".mp3,audio/*">
        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-audio"></p>
    </div>
    <button type="submit" class="btn subbtn">Submit</button>
</div>