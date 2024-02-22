<div class="tab-pane fade show active" id="student">
    <div class="row">
        @php
        $faq_student = Helper::faqstudentpoint();
    @endphp
     @if(count($faq_student)> 0 )
        @foreach($faq_student as $key=>$student)
        <div class="col-lg-6">
            <div class="faq-card">
                <h6 class="faq-title">
                <a class="collapsed" data-bs-toggle="collapse" href="#faqone{{$key}}" aria-expanded="false">{{$student->question}}</a>
                </h6>
                <div id="faqone{{$key}}" class="collapse" style="">
                <div class="faq-detail">
                    {!!$student->answer!!}
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
