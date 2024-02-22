<div id="qu_{{$page}}">
            <h4>Page {{$page}}</h4>
        <div class="question-head">
                @php
                    $count = count($question);
                    $count1 = count($question1);
                @endphp
            <div>
                <div class="question-number">
                    <ul>
                        @for($i=1; $i<=$count; $i++)
                        <li id="nub_{{$page}}_{{$i}}">{{$i}}</li>
                        @endfor
                    </ul>
                </div>
            </div>
            <div class="outofanswer">
                <p>Answered <span id="ttl_{{$page}}">0</span> of {{$count}}</p>
            </div>
        </div>
        @if(isset($questions))
            @foreach($questions as $key=>$drop12)
                @if($drop12->type == 'single_choice_radio')
                <div class="forcheckicons-parent">
                    <div class="questions forcheckicons">
                        <div class="check-uncheckicon">
                            <i class="fa fa-check-square-o chegreen d-none" id="nub1_{{$page}}_{{$key+1}}" aria-hidden="true"></i>
                            <i class="fa fa-square-o yelodes" id="nub2_{{$page}}_{{$key+1}}" aria-hidden="true"></i>
                        </div>
                        <label class="all-ques-label-des"> {{ $key + 1 }}. &nbsp; {!! $drop12->question !!}</label>
                        <div class="row">
                        @php $option = explode(',',$drop12->option); @endphp
                        @foreach($option as $op1)
                            <div class="col-md-6">
            &nbsp;              
            &nbsp;              <label class="quesoptiondes">
                                    <i class="fa fa-circle-o unchk" aria-hidden="true"></i>
                                    <input type="radio" class="q_n quesoptiondesin" data-page="{{$page}}" data-key="{{$key+1}}" name="ans[{{$drop12->id}}][]" id="{{$key}}" value="{{$op1}}~{{$drop12->id}}" style="display: none;">
                                    {!!$op1!!}</label>
                            </div>
                            @endforeach
                            </div>
                    </div>
                </div>
                @elseif($drop12->type == 'mult_choice')
                <div class="forcheckicons-parent">
                <div class="questions forcheckicons">
                        <div class="check-uncheckicon">
                            <i class="fa fa-check-square-o chegreen d-none" id="nub1_{{$page}}_{{$key+1}}" aria-hidden="true"></i>
                            <i class="fa fa-square-o yelodes" id="nub2_{{$page}}_{{$key+1}}" aria-hidden="true"></i>
                        </div>
                        <label class="all-ques-label-des"> {{ $key + 1 }}. &nbsp; {!! $drop12->question !!}</label>
                        <div class="row">
                        @php $option2 = explode(',',$drop12->option); @endphp
                            @foreach($option2 as $op13)
                            <div class="col-md-6">
                                  
                                  <label class="multiquesoptiondes"> 
                                        <i class="fa fa-square-o unchk" aria-hidden="true"></i>
                                        <input type="checkbox" class="q_n multi-question" data-page="{{$page}}" data-key="{{$key+1}}" name="ans[{{$drop12->id}}][]" value="{{$op13}}~{{$drop12->id}}" style="display: none;" >
                                        {!!$op13!!}</label>
                            </div>
                            @endforeach
                            </div>
                </div>
            </div>
            @else
            <div class="forcheckicons-parent">
                <div class="questions forcheckicons">
                        <div class="check-uncheckicon">
                            <i class="fa fa-check-square-o chegreen d-none" id="nub1_{{$page}}_{{$key+1}}" aria-hidden="true"></i>
                            <i class="fa fa-square-o yelodes" id="nub2_{{$page}}_{{$key+1}}" aria-hidden="true"></i>
                        </div>
                        <label class="all-ques-label-des"> {{ $key + 1 }}. &nbsp; {!! $drop12->question !!}</label>
                        <div class="row">
                        @php $option1 = explode(',',$drop12->option); @endphp
                        <div class="col-md-6">
                            <select class="form-control q_n selectfontwei"  data-page="{{$page}}" data-key="{{$key+1}}" id="category" name="ans[{{$drop12->id}}][]">
                                <option>Select option</option>
                                @foreach($option1 as $op11)
                                    <option value="{{$op11}}~{{$drop12->id}}">{!! $op11 !!}</option>
                                @endforeach


                            </select>
                        </div>
                        </div>
                </div>
            </div>
            @endif
            @endforeach
        @endif
        &nbsp;       &nbsp;
        <div class="question-prev">
            <button type="button" id="prv_{{$page}}" data-page="{{$page}}" class="d-none prv">Preview</button> &nbsp;
            @if($count1 != 0)
            <button type="button" data-page="{{$page+1}}" data-u_id="{{$u_id}}" id="nxt">Next</button> &nbsp;
            @else
            <button type="submit">Submit</button>
            @endif
        </div>
    </div>
    <div id="data_{{$page+1}}">
    </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>




<script type="text/javascript">
      $('.quesoptiondes').on('click', function() {
            $(this).closest('.row').find('.quesoptiondes').removeClass('active');
             $(this).closest('.row').find('.quesoptiondes i').removeClass('fa-check-circle');
            $(this).closest('.row').find('.quesoptiondes i').addClass('fa-circle-o');
            if($(this).find('.quesoptiondesin').is(":checked")){
                 $(this).find('i').toggleClass('fa-check-circle fa-circle-o');
                $(this).toggleClass('active');
            }
                 
      });


       $('.multiquesoptiondes').on('click', function() {
            // $(this).closest('.row').find('.quesoptiondes').removeClass('active');
            // $(this).closest('.row').find('.quesoptiondes i').removeClass('fa-check-circle');
            // $(this).closest('.row').find('.quesoptiondes i').addClass('fa-circle-o');
            if($(this).find('.multi-question').is(":checked")){
                 $(this).find('i').toggleClass('fa-check-square fa-square-o');
                $(this).toggleClass('active');
            }
                 
      });
</script>