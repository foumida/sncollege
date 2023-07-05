@extends('layouts.front_end.default')
@section('content')


            <!-- breadcrumb-area-end -->

	   <section class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">HEALTH CLUB</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Facilities</span>
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
                                   <h4>HEALTH CLUB & YOGA CENTRE</h4><br>
					<p>Personal Hygene and clean surroundings are the pre requisite of a healthy society. The Health Club unit of M.E.S Asmabi 
College envisages awareness programmes and consultations on the health related matters to make its neighbourhood more clean and healthy. The college health club 
also ensures that every student has undergone the compulsory medical checkup conducted in the college.</p><br>
					<br><h6><b>Teacher In Charge: Lt. M. B. Bindil</b></h6>
                                 </div>
                            </div>
                        </div>
                     </div>
                </div>
            </section>
@endsection