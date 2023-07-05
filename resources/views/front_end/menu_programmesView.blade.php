@extends('layouts.front_end.default')
@section('content')

            <!-- breadcrumb area start -->
           
            <section
                class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background=" {{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">Programmes</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Programmes</span>
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
							<div class="row programmes product-additional-tab">
								<div class="col-md-3">
									<!-- Tabs nav -->
									<ul class="nav nav-tabs" id="myTabs" role="tablist">
										<li class="nav-item" role="presentation">
										   <button class="nav-links headlines py-2 w-100" id="home" data-bs-toggle="tab"
											  data-bs-target="" type="button" role="tab" aria-controls="atab"
											  aria-selected="true">PG Programmes</button>
										</li>
										<?php $i=1 ?>
                                        @foreach($pgpgm as $row)
										<li class="nav-item" role="presentation">
										   <button class="nav-links w-100" id="home-tab-<?php echo $i ; ?>" data-bs-toggle="tab"
											  data-bs-target="#Notification<?php echo $i ; ?>" type="button" role="tab" aria-controls="atab"
											  aria-selected="true">{{$row->course_name}}</button>
										</li>
										<?php $i++?>
                                        @endforeach
									</ul>
									
									<ul class="nav nav-tabs mt-50" id="myTabs" role="tablist">
										<li class="nav-item" role="presentation">
										   <button class="nav-links headlines py-2 w-100" id="home" data-bs-toggle="tab"
											  data-bs-target="" type="button" role="tab" aria-controls="atab"
											  aria-selected="true">UG Programmes</button>
										</li>
										<?php $j=1 ?>
                                        @foreach($ugpgm as $row)
										<li class="nav-item" role="presentation">
										   <button class="nav-links w-100" id="home-tabs-<?php echo $j ; ?>" data-bs-toggle="tab"
											  data-bs-target="#Upcoming-Events<?php echo $j ; ?>" type="button" role="tab" aria-controls="atab"
											  aria-selected="true">{{$row->course_name}}</button>
										</li>
										<?php $j++?>
                                        @endforeach
										
									</ul>
									
								</div>


								<div class="col-md-9">
									<!-- Tabs content -->
									<div class="tab-content tp-content-tab" id="myTabContent-2">
									<div class="tab-pane fade show active" id="Notification1" role="tabpanel" aria-labelledby="home-tab-1">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/common.jpg')}}" alt="Mindful Leadership ">
													
												</div>
											</div>							
										</div>
										<div class="tab-pane fade" id="Notification1" role="tabpanel" aria-labelledby="home-tab-1">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/physicspg.jpg')}}" alt="Mindful Leadership ">
													
												</div>
											</div>							
										</div>
										<div class="tab-pane fade " id="Notification2" role="tabpanel" aria-labelledby="home-tab-2">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/mcomfinance.jpg')}}" alt="Mindful Leadership ">
													
												</div>
											</div>							
										</div>
										<div class="tab-pane fade" id="Notification3" role="tabpanel" aria-labelledby="home-tab-3">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/mscenglish.jpg')}}" alt="Mindful Leadership ">
													
												</div>
											</div>							
										</div>
										<div class="tab-pane fade" id="Notification4" role="tabpanel" aria-labelledby="home-tab-4">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/mscbotony.jpg')}}" alt="Mindful Leadership ">
													
												</div>
											</div>							
										</div>
										<div class="tab-pane fade" id="Notification5" role="tabpanel" aria-labelledby="home-tab-5">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/maeconomics.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>							
										</div>
										<div class="tab-pane fade" id="Notification6" role="tabpanel" aria-labelledby="home-tab-6">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/mcommarketing.jpg')}}" alt="Mindful Leadership ">
													
												</div>
											</div>							
										</div>
										<div class="tab-pane fade" id="Upcoming-Events1" role="tabpanel" aria-labelledby="home-tabs-1">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/bscbotony.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events2" role="tabpanel" aria-labelledby="home-tabs-2">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/bscphysics.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events3" role="tabpanel" aria-labelledby="home-tabs-3">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/baeconomics.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events4" role="tabpanel" aria-labelledby="home-tabs-4">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/baenglish.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events5" role="tabpanel" aria-labelledby="home-tabs-5">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/becomcor.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events6" role="tabpanel" aria-labelledby="home-tabs-6">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/bscaqa.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events7" role="tabpanel" aria-labelledby="home-tabs-7">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/bcomaompu.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events8" role="tabpanel" aria-labelledby="home-tabs-8">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/bcomfina.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events9" role="tabpanel" aria-labelledby="home-tabs-9">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/bba.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events10" role="tabpanel" aria-labelledby="home-tabs-10">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/bca.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events11" role="tabpanel" aria-labelledby="home-tabs-11">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/bacommunication.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events12" role="tabpanel" aria-labelledby="home-tabs-12">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/balogist.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events13" role="tabpanel" aria-labelledby="home-tabs-13">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/badigital.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events14" role="tabpanel" aria-labelledby="home-tabs-14">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/fishing.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events15" role="tabpanel" aria-labelledby="home-tabs-15">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/tourism.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events16" role="tabpanel" aria-labelledby="home-tabs-16">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/bscmaths.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events17" role="tabpanel" aria-labelledby="home-tabs-17">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/bscpsyco.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events18" role="tabpanel" aria-labelledby="home-tabs-18">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/common.jpg')}}" alt="Mindful Leadership ">
												</div>
											</div>	
										</div>
										<div class="tab-pane fade" id="Upcoming-Events19" role="tabpanel" aria-labelledby="home-tabs-19">
											<div  class="owl-carousel owl-carouseldeo owl-theme">
												<div class="item">
													<img src="{{asset('public/uploads/course/coursedetail/common.jpg')}}" alt="Mindful Leadership ">
												</div>     
											</div>	
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
<style>
   .product-additional-tab {
    background-color: #fff;
    box-shadow: 0px 0px 0px #11111124 !important;
    padding: 0px !important;
    border-bottom: 0px solid #fff !important;
}
</style>