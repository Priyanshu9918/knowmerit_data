<div id="scrom-data">
    <input type="hidden" name="id" id="id" value="{{$scrom->id ?? ''}}">
        <div>
            <label>Title</label>
            <input class="form-control" type="text" name="title" value="{{$scrom->title ?? ''}}">
            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
        </div>
        <div class="mt-3">
            <label>upload file</label>
            <input class="form-control" type="file" name="file" value="">
            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-file"></p>
        </div>
    <button type="submit" class="btn subbtn">Submit</button>
</div>