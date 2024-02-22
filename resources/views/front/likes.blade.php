<div class="like-p d-flex" id="st_id{{$id}}">
@php 
    $comment = DB::table('community_comments')->where('community_id',$id)->where('parent',0)->paginate(5);
    $count_comm = count( $comment );
@endphp
@php 
if(auth()->check()){
    $like = DB::table('community_likes')->where('community_id',$id)->where('user_id',Auth::user()->id)->first();
}
$like1 = DB::table('community_likes')->where('community_id',$id)->where('status',1)->get();
$dislike = DB::table('community_likes')->where('community_id',$id)->where('status',0)->get();
@endphp
@if(auth()->check())
    @if(isset($like))
        @if($like->status == 1)
        <div class="like">
            <a href="javascript:" id="like" data-id="{{$id}}">
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            </a>
            <a>{{count($like1) ?? 0}}</a>
        </div>
        @else
        <div class="like">
            <a href="javascript:" id="like" data-id="{{$id}}">
                <img src="{{asset('assets/img/my-img/like-img-gr.png')}}" style="width: 23px;height: 23px;">
            </a>
            <a>{{count($like1) ?? 0}}</a>
        </div>
        @endif
        @if($like->status == 0)
        <div class="unlike">
            <a href="javascript:" class="m-2 mt-lg-1" id="dislike" data-id="{{$id}}">
                <i class="fa-solid fa-thumbs-down"></i>                                    </a>
            <a>{{count($dislike) ?? 0}}</a>
        </div>
        @else
        <div class="unlike">
            <a href="javascript:" class="m-2 mt-lg-1" id="dislike" data-id="{{$id}}">
                <img src="{{asset('assets/img/my-img/unlike-img-gr.png')}}" style="width: 23px;height: 23px;">
            </a>
            <a>{{count($dislike) ?? 0}}</a>
        </div>
        @endif
    @else
        <div class="like">
            <a href="javascript:" id="like" data-id="{{$id}}">
                <img src="{{asset('assets/img/my-img/like-img-gr.png')}}" style="width: 23px;height: 23px;">
            </a>
            <a>{{count($like1) ?? 0}}</a>
        </div>
        <div class="unlike">
            <a href="javascript:" class="m-2 mt-lg-1" id="dislike" data-id="{{$id}}">
                <img src="{{asset('assets/img/my-img/unlike-img-gr.png')}}" style="width: 23px;height: 23px;">
            </a>
            <a>{{count($dislike) ?? 0}}</a>
        </div>
    @endif
@else
    <div class="like">
        <a href="{{route('front.login')}}" id="like" data-id="{{$id}}">
            <img src="{{asset('assets/img/my-img/like-img-gr.png')}}" style="width: 23px;height: 23px;">
        </a>
        <a>{{count($like1) ?? 0}}</a>
    </div>
    <div class="unlike">
        <a href="{{route('front.login')}}" class="m-2 mt-lg-1" id="dislike" data-id="{{$id}}">
            <img src="{{asset('assets/img/my-img/unlike-img-gr.png')}}" style="width: 23px;height: 23px;">
        </a>
        <a>{{count($dislike) ?? 0}}</a>
    </div>
@endif
</div>