        @php
        $faq_teacher = Helper::faqteacherpoint();
    @endphp
<div class="tab-pane" id="teacher">
    <div class="row">
    @if(count($faq_teacher)> 0 )
        @foreach($faq_teacher as $key=>$teacher)
        <div class="col-lg-6">
            <div class="faq-card">
                <h6 class="faq-title">
                <a class="collapsed" data-bs-toggle="collapse" href="#faqone{{$key}}" aria-expanded="false">{{$teacher->question}}</a>
                </h6>
                <div id="faqone{{$key}}" class="collapse" style="">
                <div class="faq-detail">
                    {!!$teacher->answer!!}
                </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="row">
            <div class="no-up">
                <div class="noenquery" style="margin-top:-35px">
                    <img src="no-data.gif" alt="Girl in a jacket">
                </div>
                <div style="text-align:center;padding-top: 25px;">
                    <span class="noupcom">There is no Faqs.</span>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
