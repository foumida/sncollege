@extends('layouts.front_end.default')
@section('content')


            <!-- breadcrumb-area-end -->

	   <section class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">LANGUAGE LAB</h3>
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
                                   <h4>LANGUAGE LAB</h4><br>

				   <p>
                                        In order to provide computer education to all desirous students a computer centre is
                                        functioning in the campus. The facilities like Internet, inflibnet, E-mail and DTP
                                        are also available in the centre. The Language Lab provides facilities for B.A.
                                        Literature (English) students.
                                    </p>
				    <br>
                                    <h6><b>Teacher in Charge : Reshmi. S., Amitha.P. Mani.</b></h6>

                                 </div>
                            </div>
                        </div>
                     </div>
                </div>
            </section>
@endsection