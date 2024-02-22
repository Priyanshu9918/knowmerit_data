@extends('layouts.front.master')
@section('content')
<!-- <div class="page-banner">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-12">
				<h1 class="mb-0">Blog</h1>
			</div>
		</div>
	</div>
</div> -->
<section class="course-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12">
                <div class="row">
                @if($blogs)
			        @foreach($blogs as $blog)
                    <div class="col-md-6 col-sm-12">
                        <div class="blog grid-blog">
                            <div class="blog-image">
                                <a href="{{url('/blogs',['id'=> $blog->slug])}}" ><img class="img-fluid" src="{{asset('uploads/blogs/'.$blog->image)}}" alt="Post Image"></a>
                            </div>
                            <div class="blog-grid-box">
                                <div class="blog-info clearfix">
                                    <div class="post-left">
                                        <ul>
                                            <li><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt>{{date('M d ,y', strtotime($blog->created_at));}}</li>
                                            <!-- <li><img class="img-fluid" src="assets/img/icon/icon-23.svg" alt>Programming, Web Design</li> -->
                                        </ul>
                                    </div>
                                </div>
                                <h3 class="blog-title"><a href="{{url('/blogs',['id'=> $blog->slug])}}">{{$blog->title ?? ''}}</a></h3>
                                <div class="blog-content blog-read">
                                    <p>{{$blog->short_description ?? ''}}</p>
                                    <a href="{{url('/blogs',['id'=> $blog->slug])}}" class="read-more btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            @else
                <h1>No Blog Found</h1>
            @endif
                    {{--<div class="col-md-6 col-sm-12">
                        <div class="blog grid-blog">
                            <div class="blog-image">
                                <a href="#"><img class="img-fluid" src="assets/img/blog/blog-09.jpg" alt="Post Image"></a>
                            </div>
                            <div class="blog-grid-box">
                                <div class="blog-info clearfix">
                                    <div class="post-left">
                                        <ul>
                                            <li><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt>May 24, 2022</li>
                                            <li><img class="img-fluid" src="assets/img/icon/icon-23.svg" alt>Programming, Courses</li>
                                        </ul>
                                    </div>
                                </div>
                                <h3 class="blog-title"><a href="blog-details.php">Expand Your Career Opportunities With Python</a></h3>
                                <div class="blog-content blog-read">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Sed egestas, ante et vulputate volutpat, eros pede </p>
                                    <a href="blog-details.php" class="read-more btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="blog grid-blog">
                            <div class="blog-image">
                                <a href="#"><img class="img-fluid" src="assets/img/blog/blog-10.jpg" alt="Post Image"></a>
                            </div>
                            <div class="blog-grid-box">
                                <div class="blog-info clearfix">
                                    <div class="post-left">
                                        <ul>
                                            <li><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt>Jun 14, 2022</li>
                                            <li><img class="img-fluid" src="assets/img/icon/icon-23.svg" alt>Programming, Web Design</li>
                                        </ul>
                                    </div>
                                </div>
                                <h3 class="blog-title"><a href="blog-details.php">Complete PHP Programming Career Guideline</a></h3>
                                <div class="blog-content blog-read">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Sed egestas, ante et vulputate volutpat, eros pede </p>
                                    <a href="blog-details.php" class="read-more btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="blog grid-blog">
                            <div class="blog-image">
                                <a href="#"><img class="img-fluid" src="assets/img/blog/blog-11.jpg" alt="Post Image"></a>
                            </div>
                            <div class="blog-grid-box">
                                <div class="blog-info clearfix">
                                    <div class="post-left">
                                        <ul>
                                            <li><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt>Sep 18, 2022</li>
                                            <li><img class="img-fluid" src="assets/img/icon/icon-23.svg" alt>Programming, Courses</li>
                                        </ul>
                                    </div>
                                </div>
                                <h3 class="blog-title"><a href="blog-details.php">Programming Content Guideline For Beginners</a></h3>
                                <div class="blog-content blog-read">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Sed egestas, ante et vulputate volutpat, eros pede </p>
                                    <a href="blog-details.php" class="read-more btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="blog grid-blog">
                            <div class="blog-image">
                                <a href="#"><img class="img-fluid" src="assets/img/blog/blog-12.jpg" alt="Post Image"></a>
                            </div>
                            <div class="blog-grid-box">
                                <div class="blog-info clearfix">
                                    <div class="post-left">
                                        <ul>
                                            <li><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt>Jun 26, 2022</li>
                                            <li><img class="img-fluid" src="assets/img/icon/icon-23.svg" alt>Programming, Web Design</li>
                                        </ul>
                                    </div>
                                </div>
                                <h3 class="blog-title"><a href="blog-details.php">The Complete JavaScript Course for Beginners</a></h3>
                                <div class="blog-content blog-read">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Sed egestas, ante et vulputate volutpat, eros pede </p>
                                    <a href="blog-details.php" class="read-more btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="blog grid-blog">
                            <div class="blog-image">
                                <a href="#"><img class="img-fluid" src="assets/img/blog/blog-13.jpg" alt="Post Image"></a>
                            </div>
                            <div class="blog-grid-box">
                                <div class="blog-info clearfix">
                                    <div class="post-left">
                                        <ul>
                                            <li><img class="img-fluid" src="assets/img/icon/icon-22.svg" alt>Feb 14, 2022</li>
                                            <li><img class="img-fluid" src="assets/img/icon/icon-23.svg" alt>Programming, Courses</li>
                                        </ul>
                                    </div>
                                </div>
                                <h3 class="blog-title"><a href="blog-details.php">Learn Mobile Applications Development from Experts</a></h3>
                                <div class="blog-content blog-read">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Sed egestas, ante et vulputate volutpat, eros pede </p>
                                    <a href="blog-details.php" class="read-more btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
                {{--<div class="row">
                    <div class="col-md-12">
                        <ul class="pagination lms-page">
                            <li class="page-item prev">
                                <a class="page-link" href="javascript:void(0);" tabindex="-1"><i class="fas fa-angle-left"></i></a>
                            </li>
                            <li class="page-item first-page active">
                                <a class="page-link" href="javascript:void(0);">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);">4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);">5</a>
                            </li>
                            <li class="page-item next">
                                <a class="page-link" href="javascript:void(0);"><i class="fas fa-angle-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>--}}
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
