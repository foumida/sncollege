@extends('layouts.front_end.default')
@section('content')


            <!-- breadcrumb-area-end -->

	   <section class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">CRITERION 5</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>IQAC</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->


            <!-- featured-courses -->
            <!-- blog-area -->
              <section class="blog-area gray-bg pt-120 pb-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="classic-blog-post blog-details-wrap">
                                <div class="blog-content">
                                    <h4>CRITERION 5 - STUDENT SUPPORT AND PROGRESSION</h4><br>
                                    <h5>5.1 Student Support</h5>
                                    
				<ul class="blog-details-list">
                                        <li> 5.1.1 -Students benefited by scholarships and free ships provided by the Government during the year 2020-21 </li>
                                        <li> 5.1.2 - Students benefited by scholarships, free ships, etc provided by the institution /non- government agencies during the year 2020-21</li>
                                        <li> 5.1.3 - Capacity building and skills enhancement initiatives taken by the institution </li>
                                        <li> 5.1.4 - Students benefited by guidance for competitive examinations and career counseling offered by the institution during the year 2020-21   </li>
					<li> 5.1.5 - Mechanism for timely redressal of student grievances including sexual harassment and ragging cases</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>











<style>
.blog-content h5{
   color:#000 ;
}
.blog-content h5:hover{
   color:#002d58;
}

</style>
@endsection