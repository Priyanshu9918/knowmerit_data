
<style>
    .corr-text-des i {
  margin-top: 16px;
}
.corr-text-des {
  display: flex;
  align-content: center;
}
.text-coorect-option1 {
  display: flex;
  align-content: center;
}
.text-coorect-option1 i {
  margin-top: 16px;
}
.text-for-no
{
    display: unset;
}
.modal-form-des1 {
    overflow: scroll;
    height: 90vh;
    overflow-x: hidden;
    padding: 0px 100px 70px 100px;
}

</style>
<div id="data1">
<div class="modal-form-des1">
    <div class="cross-btn-modal">
        <button id="add-question-list" type="button" class="close">×</button>
    </div>
    <form action="{{ route('teacher.single_choice.edit',['id' =>$data->id]) }}" method="POST" id="editFrm222" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$data->id ?? ''}}">

        <div class="popup-add">

                <div class="quest-select-list">
                    <div class="multiple-question-type">

                    <label class="mode-label">Question Type</label>
                    <select name="question_type" disabled>
                        <option value="single_choice_radio"
                        {{ $data->type == 'single_choice_radio' ? 'selected' : '' }}>Single Choice (Radio Button)
                        </option>
                        <option value="single_choice_drop"
                        {{ $data->type == 'single_choice_drop' ? 'selected' : '' }}>Single Choice (Dropdown)
                        </option>
                        <option value="mult_choice"
                        {{ $data->type == 'mult_choice' ? 'selected' : '' }}>Multiple Choic
                        </option>
                       <!-- <option>Picture Choice</option>
                        <option>Fill in the Blanks</option>
                        <option>Matching</option>
                        <option>Matching Text</option>
                        <option>Free Text</option>
                        <option>File Upload</option> -->
                    </select>
                </div>
                <div class="d-flex align-items-sm-center">
                    <label class="mode-label">Points</label>
                    <input type="text" name="point" id="point" value="{{ $data->point}}">
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-point"></p>
                </div>
            </div>
           <div class="form-group">
                <label class="form-label mode-label" for="">Question</label>
                <textarea tabindex="2" class="form-control" id="dialogQuestionText10" rows="3" name="question">{!! $data->question!!}</textarea>
                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-question"></p>
           </div>
                    @php
                        $options = explode(',',$data->option);
                        $correctOptions = explode(',',$data->answer);
                    @endphp
                <div class="form-group">
                <label class="mode-label">Options</label>
                <div class="text-coorect-option1 text-for-no">
                    @foreach ($options as $key => $option)
                    <div class="corr-text-des">
                    <textarea tabindex="2" class="form-control" id='dialogQuestionText11{{$key}}' rows="3" name="option[]">{!!$option!!}</textarea>
                    {{-- <input type="text" name="option[]" value="{{ $option }}" id="option_{{ $key }}"> --}}
                    <div class="correc">
                        <input type="checkbox" name="answer[]" value="{{ $option }}" @if(in_array($option, $correctOptions)) checked @endif >
                        <label for="answer_{{ $key }}">Correct</label>
                        <!-- <i class="fa fa-times btn_remove removebtndes" id="1" aria-hidden="true"></i> -->
                    </div>
                    <i class="fa fa-times btn_remove1" name="remove" id="remove_{{ $key }}" aria-hidden="true"></i>
                    </div>
                    <script>
                                CKEDITOR.replace('dialogQuestionText11{{$key}}', {
                                    extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
                                    mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
                                    removeButtons: 'PasteFromWord'
                                });
                    </script>
                    @endforeach
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-answer"></p>

                </div>
                <div class="col-md-12" id="mt13"></div>

            </div>
            <div class="add-opti">
                <button type="button" id="edit1">Add Option</button>
            </div>
        </div>
        <!-- <button  class="foot-cansave" type="button" id="cancel-btn-ques">Cancel</button> -->
        <button class="foot-save submit popup-save-btn" type="submit">Update</button>
    </form>
</div>
</div>
<div id="data5"></div>
<script>
CKEDITOR.replace('dialogQuestionText10', {
    extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
    mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
    removeButtons: 'PasteFromWord'
});
</script>
