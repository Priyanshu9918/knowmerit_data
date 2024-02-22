@extends('layouts.front.master')
@section('content')

<section class="course-content">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-12">
				<div class="blog">
					<div class="blog-image blog-details-img">
						<a href="#"><img class="img-fluid" src="{{asset('uploads/blogs/'.$data->b_image)}}" alt="Post Image"></a>
					</div>
					<div class="blog-info clearfix">
						<div class="post-left">
							<ul>
								<!-- <li>
									<div class="post-author">
										<a href="#"><img src="assets/img/user/user.jpg" alt="Post Author"> <span>Ruby Perrin</span></a>
									</div>
								</li> -->
								<li><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt>{{date('M d, Y', strtotime($data->created_at))}}</li>
								<!-- <li><img class="img-fluid" src="assets/img/icon/icon-23.svg" alt>Programming, Web Design</li> -->
							</ul>
						</div>
					</div>
					<h3 class="blog-title"><a href="#">{{$data->title ?? ''}}</a></h3>
					<div class="blog-content">
						<p>{!!$data->long_description!!}</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-12 sidebar-right theiaStickySidebar">

				<div class="card post-widget blog-widget">
					<div class="card-header">
						<h4 class="card-title">Recent Posts</h4>
					</div>
					@php
                        $recent = DB::table('blogs')->where('status',1)->orderBy('created_at','Desc')->take(5)->get();
                    @endphp
                    <div class="card-body">
                        <ul class="latest-posts">
                            @foreach($recent as $blogs1)
                            <li>
                                <div class="post-thumb">
                                    <a href="{{url('/blogs',['id'=> $blogs1->slug])}}">
                                        <img class="img-fluid" src="{{asset('uploads/blogs/'.$blogs1->image)}}" alt>
                                    </a>
                                </div>
                                <div class="post-info">
                                    <h4>
                                    <a href="{{url('/blogs',['id'=> $blogs1->slug])}}">{{$blogs1->title ?? ''}}</a>
                                    </h4>
                                    <p><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt>{{date('M d ,y', strtotime($blogs1->created_at));}}</p>
                                </div>
                            </li>
                            @endforeach
                            {{--<li>
                                <div class="post-thumb">
                                    <a href="#">
                                        <img class="img-fluid" src="assets/img/blog/blog-02.jpg" alt>
                                    </a>
                                </div>
                                <div class="post-info">
                                    <h4>
                                    <a href="#">Expand Your Career Opportunities With Python</a>
                                    </h4>
                                    <p><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt> 3 Dec 2019</p>
                                </div>
                            </li>
                            <li>
                                <div class="post-thumb">
                                    <a href="#">
                                        <img class="img-fluid" src="assets/img/blog/blog-03.jpg" alt>
                                    </a>
                                </div>
                                <div class="post-info">
                                    <h4>
                                    <a href="#">Complete PHP Programming Career Guideline</a>
                                    </h4>
                                    <p><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt> 3 Dec 2019</p>
                                </div>
                            </li>--}}
						</ul>
					</div>
				</div>
				{{--<div class="card category-widget blog-widget">
					<div class="card-header">
						<h4 class="card-title">Categories</h4>
					</div>
					<div class="card-body">
						<ul class="categories">
							<li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> Business </a></li>
							<li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> Courses </a></li>
							<li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> Education </a></li>
							<li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> Graphics Design </a></li>
							<li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> Programming </a></li>
							<li><a href="javascript:void(0);"><i class="fas fa-angle-right"></i> Web Design </a></li>
						</ul>
					</div>
				</div>--}}


			</div>
		</div>
	</div>
</section>
@endsection
