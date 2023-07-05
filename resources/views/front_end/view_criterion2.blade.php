@extends('layouts.front_end.default')
@section('content')


            <!-- breadcrumb-area-end -->

	   <section class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">CRITERION 2</h3>
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
             <section class="blog-area gray-bg pt-80 pb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="classic-blog-post blog-details-wrap">
                                <div class="blog-content">
                                    <h4>Criterion 2 - Teaching Learning and Evaluation</h4><br>
                                    <h5><a href="{{ route('menu.criterion2_1') }}" target="_blank">2.1 - Student Enrolment and Profile</a></h5>
                                    <h5><a href="{{ route('menu.criterion2_2') }}" target="_blank">2.2 - Catering to Student Diversity</a></h5>
                                    <h5><a href="{{ route('menu.criterion2_3') }}" target="_blank">2.3 - Teaching Learning Process</a></h5>
                                    <h5><a href="{{ route('menu.criterion2_4') }}" target="_blank">2.4 - Teacher Profile and Quality</a></h5>
                                    <h5><a href="{{ route('menu.criterion2_5') }}" target="_blank">2.5 - Evaluation Process and Reforms</a></h5>
                                    <h5><a href="{{ route('menu.criterion2_6') }}" target="_blank">2.6 - Student Performance and Learning Outcomes</a></h5>
                                    <h5><a href="{{ route('menu.criterion2_7') }}" target="_blank">2.7 - Student Satisfaction Survey</a></h5>
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