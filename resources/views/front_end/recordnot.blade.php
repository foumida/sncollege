@extends('layouts.front_end.default')
@section('content')

<!-- breadcrumb area start -->

            <section
                class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}"
            >
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">Journals</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Journals</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

             <!-- about area start -->
             <div class="tp-about__section-2 pt-100 pb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="classic-blog-post blog-details-wrap">
                                <div class="blog-content">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4>JOURNAL(Meridian)</h4>
											<a href="#!">Click Here to go to Journal Website:</a>
											<p><b>Teachers in charge: Dr. Amitha Bachan K.H., Dr. Kesavan. K., Sanand C. Sadanandakumar, Dr. JishaK.C., Amitha P. Mani, Dr. Shahida A.T., Dr. Ranjith M. </b> </p>

											
											<hr>
											
											<h4>HORIZON INTERNATIONAL JOURNAL</h4>
											<p><b>Teachers in charge : Deepa K.A., Princy Francis, Dhini. K.V.</b> </p>
                                           
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- about area end -->

@endsection