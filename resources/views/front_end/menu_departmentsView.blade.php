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
                                <h3 class="breadcrumb__title">DEPARTMENTS</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>DEPARTMENTS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

            <!-- about area start -->
            <div class="tp-about__section-2 pt-110 text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
						  <div class="abutmes">
						    <h2>Major Departments</h2>
						  </div> 
						  						  
                        </div>
                    </div>
                </div>
            </div>
			
   <div class="product-additional-info pt-50 pb-110">
	 <div class="container">
		<div class="row">
		   <div class="col-xl-12">
			  <div class="product-additional-tab">
				 <ul class="nav nav-tabs" id="myTabs" role="tablist">
					<li class="nav-item" role="presentation">
					   <button class="nav-links active" id="home-tab-1" data-bs-toggle="tab"
						  data-bs-target="#home-1" type="button" role="tab" aria-controls="home"
						  aria-selected="true">AIDED</button>
					</li>
					<li class="nav-item" role="presentation">
					   <button class="nav-links" id="Additional-Information-tab" data-bs-toggle="tab"
						  data-bs-target="#Additional-Information" type="button" role="tab" aria-controls="profile"
						  aria-selected="false">SELF FINANCING</button>
					</li>
					<li class="nav-item" role="presentation">
					   <button class="nav-links" id="Reviews-tab" data-bs-toggle="tab" data-bs-target="#Reviews"
						  type="button" role="tab" aria-controls="contact" aria-selected="false">RESEARCH CENTRES</button>
					</li>
				 </ul>
				 <div class="tab-content tp-content-tab" id="myTabContent-2">
					<div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab-1">
					   <h4 style="color: #000;margin-bottom: 2rem;text-align: center;font-weight: 900;">AIDED</h4>
					   <?php $i=1; ?>
					   <div class="row">
					   @foreach($aided as $row)
					   
					    
							<div class="col-lg-4">

							   <ul class="blog-details-lists">
							    
								  <li><a href="{{url('departments_details/'.$row->id.'/'.$row->department)}}">{{$row->department}}</a></li>
								 
                              </ul>
							</div>
						
						
							@if($i%3==0)
</div>
<div class="row">
						@endif	
						
						<?php $i++;?>
						@endforeach
						</div>
					</div>
					<div class="tab-pane fade" id="Additional-Information" role="tabpanel" aria-labelledby="Additional-Information-tab">
						<h4 style="color: #000;margin-bottom: 2rem;text-align: center;font-weight: 900;">SELF FINANCING</h4>
						<?php $i=1; ?>
						<div class="row">
					   @foreach($self as $row)
						
						
							<div class="col-lg-6">
							   <ul class="blog-details-lists">
								  <li><a href="{{url('departments_details/'.$row->id.'/'.$row->department)}}">{{$row->department}}</a></li>
                               </ul>
							</div>
							@if($i%2==0)
							</div>
							<div class="row">
						@endif
						
						<?php $i++;?>
						@endforeach
						</div>
					</div>
					<div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
					<h4 style="color: #000;margin-bottom: 2rem;text-align: center;font-weight: 900;">RESEARCH CENTRES</h4>
						<?php $i=1; ?>
						<div class="row">
					   @foreach($research as $row)
						
						
							<div class="col-lg-6">
							   <ul class="blog-details-lists">
								  <li><a href="{{url('departments_details/'.$row->id.'/'.$row->department)}}">{{$row->department}}</a></li>
                               </ul>
							</div>
						@if($i%2==0)
						</div>
							<div class="row">
						@endif
						
						<?php $i++;?>
						@endforeach
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