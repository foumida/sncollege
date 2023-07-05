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
                                <h3 class="breadcrumb__title">Workshops &amp; Seminars</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Workshops &amp; Seminars</span>
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
                                            <h4>WORKSHOP AND SEMINARS</h4>
                                            <ul class="blog-details-list">
											@if(!empty($sw))
					 @foreach($sw as $row)
                                                <li>
                                                    <a href=""
                                                        >{{$row->department}}- {{$row->title}}
                                                    </a>
                                                </li>
                                               	  @endforeach	
                     @endif		
                                                <br />
                                            </ul>
                                        </div>
                                    </div>

                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection