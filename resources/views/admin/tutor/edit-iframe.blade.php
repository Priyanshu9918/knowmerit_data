<div id="iframe_data">
    <input type="hidden" name="id" value="{{$iframe->id}}">
    <div>
        <label>Iframe Title</label>
        <input class="form-control" type="text" name="title" value="{{$iframe->title ?? ''}}" placeholder="Enter Iframe Url">
        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
    </div>
    <div>
        <label>Add Url</label>
        <input class="form-control" type="text" name="url" value="{{$iframe->url ?? ''}}" placeholder="Enter Iframe Url">
        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-url"></p>
    </div>
    <button type="submit" class="btn subbtn">Submit</button>
</div>