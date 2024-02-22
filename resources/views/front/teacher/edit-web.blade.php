<div id="web-data">
    <input type="hidden" name="id" id="id" value="{{$web->id}}">
    <div>
        <label>Title</label>
        <input class="form-control" type="text" name="title1" value="{{$web->title ?? ''}}">
        <p style="margin-bottom: 25px;" class="text-danger error_container" id="error1-title1"></p>
    </div>
    <div class="mt-3">
        <label>Content</label>
        <textarea class="form-control" name="content" id="dialogQuestionText">{!!$web->content!!}</textarea>
        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error1-content"></p>
    </div>
    <div class="webbtn-des">
        <button type="submit" class="btn btn-primary subbtn">Submit</button>
    </div>
</div>
<script src="{{asset('/ckeditor/ckeditor/ckeditor.js')}}"></script>
<script>
                CKEDITOR.replace('dialogQuestionText', {
                extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
                mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
                removeButtons: 'PasteFromWord'
            });
</script>