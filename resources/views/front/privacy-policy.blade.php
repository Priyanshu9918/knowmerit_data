@extends('layouts.front.master')
@section('content')
<!-- <section class="section share-knowledge">
<div class="container">
<div class="row">
<div class="col-md-6">
<div class="knowledge-img aos aos-init aos-animate mt-4" data-aos="fade-up">
<img src="assets/img/reviews-img-two.png" alt="" class="img-fluid">
</div>
</div>
<div class="col-md-6 d-flex align-items-center">
<div class="join-mentor aos aos-init aos-animate" data-aos="fade-up">
<h2>Want to share your knowledge? Join us a Mentor</h2>
<p>High-definition video is video of higher resolution and quality than standard-definition. While there is no standardized meaning for high-definition, generally any video.</p>


</div>
</div>
</div>
</div>
</section> -->
<div class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                @if($data->name  ?? '')
                <h2 class="text-center">{{$data->name}}</h2>
            @endif
            </div>
        </div>
    </div>
</div>
<section class="pt-5 pb-5">
        <!-- Start Checkout Area  -->
        <div class="axil-checkout-area axil-section-gap">
            <div class="container">
            
            @if($data->description  ?? '')
                <p class="w-100">{!!$data->description!!}</p>
            @else
            <span style="margin-left:42%; font-weight: bold;">No Any Policies</span>
            @endif

            </div>
        </div>
        <!-- End Checkout Area  -->
</section>
  @endsection
