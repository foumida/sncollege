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
                                <h3 class="breadcrumb__title">Research Council</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Research Council</span>
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
                                            <h4>RESEARCH COUNCIL & PROPOSALS COMMITTEE</h4>
											
											{!!$research_council[0]->description!!}
                                            <br />
                                            <h5>Research Centers :</h5>
                                     <div class="row">
                                        <div class="col-lg-6" >      

                                            <p>
												@if(!empty($research_centres))
					 @foreach($research_centres as $row)
											<a href="{{url('research_guides/'.$row->id)}}"><h4>{{$row->name_research_centre}}</h4></a>
											  @endforeach	
                     @endif		
                                                </p>
                                           </div>    
											
                                    </div>
                                    <br />
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