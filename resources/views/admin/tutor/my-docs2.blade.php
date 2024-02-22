<style type="text/css">
	.complete-title {
    width: 150px;
    background-color: #fff;
    height: auto;
    padding: 10px;
}	


</style>
<div id="scrom1" style="position: relative;top: 50px;">
{{--@if(isset($presentation))
    @foreach($presentation as $t_work1)
    @php
    	$count = strlen($t_work1->title);
    @endphp
        <div class="scrom-lis-des">
        	<img src="../../assets/img/paper.png">
            <a class="btnlink" href='{{url('/uploads/Scrom/'.$t_work1->title.'/res/index.html')}}' target="_blank"><button type="button" class="btn btn-primary btn-sm" title="{{$t_work1->title}}">{{ substr($t_work1->title,0,10)?? '' }}@if($count > 10)...@endif</button></a>
        </div>
        <br>
    @endforeach
    @endif--}}
    <iframe src='{{url('/uploads/Scrom/'.$presentation->title.'/res/index.html')}}' title="W3Schools Free Online Web Tutorials" width="100%" height="500px">
</iframe>
</div>