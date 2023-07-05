@extends('layouts.front_end.default')
@section('content')


            <!-- breadcrumb-area-end -->

<section
                class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}"
            >
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">MEDIA LAB</h3>
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
                                   <h4>RECORDED VIDEOS IN MEDIA LAB</h4><br>

                                    <h6 class="text-black"><a href="">HINDI - Lecture by Dr. M. Ranjith</a></h6>
<br>
                                    <h6 class="text-black">MASS COMMUNICATION</h6>
<br>
                                    <h6 class="text-black">CHEMISTRY</h6>
<br>
                                    <h6 class="text-black"><a href=""> ENGLISH - Lecture by Dr. Muralikrishnan T R</a></h6>
                                </div>
                            </div>
                        </div>
                                           </div>
                </div>
            </section>
@endsection