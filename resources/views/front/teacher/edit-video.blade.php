<div id="video-data">
    <input type="hidden" name="id" value="{{$video->id}}">
    <div>
        <label>Title</label>
        <input type="text" class="form-control" name="title" placeholder="" value="{{$video->title}}">
        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
    </div>
    <div>
        <label>file</label>
        <input type="file" class="form-control" name="video" accept="video/mp4,video/x-m4v,video/*">
        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-video"></p>
    </div>
    <button type="submit" class="btn subbtn">Submit</button>
</div>