@extends('layouts.front_end.default')
@section('content')


            <!-- breadcrumb-area-end -->

	   <section class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">CRITERION 6</h3>
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
                             <h4>Criterion 6- Governance, Leadership and Management</h4>
                            
                                
                            <h5><a href="{{ route('menu.criterion6_1') }}" target="_blank">6.1 Institutional Vision and Leadership</a></h5>
                            <h5><a href="#!"  target="_blank">6.2 Strategy Development and Deployment</a></h5>
                            <h5><a href="#!"  target="_blank">6.3 Faculty Empowerment Strategies</a></h5>
                            <h5><a href="{{ route('menu.criterion6_4') }}"  target="_blank">6.4	Financial Management and Resource Mobilization</a></h5>
                            <h5><a href="#!"  target="_blank">6.5	Internal Quality Assurance System</a></h5>
                                
                                
                                
                               
                              
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