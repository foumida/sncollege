@extends('layouts.front_end.default')
@section('content')

 <section
                class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}"
            >
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">SSR Reports</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>SSR Reports</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->
            <!-- about area start -->
            <div class="tp-about__section-2 pt-50 pb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="classic - blog-post blog-details-wrap">
                                <div class="blog-content">
								<h4>SSR DOCUMENTS</h4>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul class="blog-details-list">
                                                <li><a href="{{ route('menu.criterion1') }}">CRITERION 1</a></li>
                                                <li><a href="{{ route('menu.criterion2') }}">CRITERION 2</a></li>
                                                <li><a href="{{ route('menu.criterion3') }}">CRITERION 3</a></li>
                                                <li><a href="{{ route('menu.criterion4') }}">CRITERION 4</a></li>
					</ul>
					</div>	
					<div class="col-lg-6">
					    <ul class="blog-details-list">	
                                                <li><a href="{{ route('menu.criterion5') }}"> CRITERION 5</a></li>
                                                <li><a href="{{ route('menu.criterion6') }}">CRITERION 6 </a></li>
                                                <li><a href="{{ route('menu.criterion7') }}">CRITERION 7 </a></li>
                                                <li><a href="#!">EXTENDED TEMPLATES</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection