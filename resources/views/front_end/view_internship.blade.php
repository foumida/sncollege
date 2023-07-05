@extends('layouts.front_end.default')
@section('content')


            <!-- breadcrumb-area-end -->

	   <section class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">INTERNSHIPS</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Student Support</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->


            <!-- featured-courses -->
            <!-- blog-area -->
            <section class="blog-area gray-bg pt-80 pb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="classic-blog-post blog-details-wrap">
                                <div class="blog-content">
                                   <h4>INTERNSHIPS</h4><br>
     			<div class="row">
                              <div class="col-lg-6">
				   <ul class="blog-details-list">
                                          <li>Mangala Seafood </li>
 					  <li>KM Fisheries </li>
					  <li> Western Ghats </li>
					 <li> DP World </li>
	                                 <li> Malayalam University </li>
				   </ul>
 				</div>
				 <div class="col-lg-6">
				   <ul class="blog-details-list">
					<li>Port Trust</li>
					<li>MES Marampally 1</li>
					<li>MES Marampally 2</li>
					<li>Field Visit Chinnar</li>
				</ul>
  </div>

                                 </div>
                            </div>
                        </div>
                     </div>
                </div>
            </section>
@endsection