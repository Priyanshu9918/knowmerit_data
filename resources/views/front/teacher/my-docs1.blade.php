<div class="row" id="sata12" style="width: 890px; height: 500px;">
            {{--@if(count($presentation)>0)
            @foreach($presentation as $t_work1)
                @if (pathinfo($t_work1->file, PATHINFO_EXTENSION) == 'pdf')
                <div class="col-md-2">
                    <div class="card-body video-card"> <img class="" src="{{asset('assets/img/my-img/pdf-img1.png')}}"
                            alt="" style="width: 100%">
                        <div class="download1"> <a href="{{asset('uploads/c_assign/'.$t_work1->file)}}" download><i
                                    class="fa fa-download" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-2">
                    <div class="card-body video-card"> <img class="" src="{{asset('assets/img/my-img/word1.png')}}" alt=""
                            style="width: 100%">
                        <div class="download1"> <a href="{{asset('uploads/c_assign/'.$t_work1->file)}}" download><i
                                    class="fa fa-download" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
            @endif--}}
            @if (pathinfo($presentation->file, PATHINFO_EXTENSION) == 'pdf')
                <iframe id="iframe1" src="{{asset('uploads/c_assign/'.$presentation->file)}}" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
            @else
                <iframe src='https://docs.google.com/gview?url={{asset('uploads/c_assign/'.$presentation->file)}}&embedded=true'  width="100%" height="100%"></iframe>
            @endif 
        </div>