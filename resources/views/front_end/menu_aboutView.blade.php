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
                                <h3 class="breadcrumb__title">About MES</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>About Us</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

            <!-- about area start -->
            <div class="tp-about__section-2 pt-100 pb-10">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
						  <div class="abutmes text-center">
					 <h2>ABOUT MES</h2>
						  </div> 
						   <div class="row">
                                        <div class="col-lg-4  pb-50">
											<div class="circle text-center">
												<img style="border-radius:50%;width:100%" src="{{asset('front_end/assets/img/pkabdulgafoor.jpeg')}}" class="img-fluid" alt="meslogo">
												<h5>Dr. P.K. Abdul Gafoor</h5>
											</div>
                                        </div>
							  <div class="col-lg-8 abtmestext">
								  <p>The Muslim Educational Society (MES) is an educational organisation established under the leadership of late Dr. P K Abdul Gafoor in 1964 at Calicut. This organisation is supported by a group of socially committed, well known professionals, industrialists, intellectuals and educationists and has its branches in all districts in Kerala. MES operates 150 educational facilities across Kerala, including Professional institutions, Arts and Science Colleges, Aided and CBSE Schools and so on. During the last five decades MES played a significant role in upbringing a remarkable and glorious transformation in the educational scenario of the Muslims and other backward community in Kerala. MES has tried to uplift the backward community of our nation socially, economically and educationally. MES endeavours to help the budding youth to meet all the challenges in the modern society and to emerge themselves as fitting professionals or architects of the new era. MES aims not only to emerge as a center for teaching technology and management, but also to become a center for research and development. They carry on with their mission under the inspiring leadership of the present MES President, Dr. P A Fazal Gafoor.</p>
							 </div>
							 </div>
						</div> 
					</div> 
				</div> 
		    </div> 
				
			<div class="tp-about__section-2 pt-10 pb-10">
			   <img src="{{asset('front_end/assets/img/about-us/aboutmesbanner.jpg')}}" class="img-fluid" alt="meslogo">
			</div>	
			<div class="tp-about__section-2 pt-100 pb-90">	
			    <div class="container">	  
				    <div class="row">
				        <div class="col-lg-3">
						  <div class="abutmesimg">
							<img src="{{asset('front_end/assets/img/meslogo.jpg')}}" class="img-fluid" alt="meslogo">
						  </div> 
					  </div> 
					  <div class="col-lg-9 abtmestext">
						<p>The MES Logo Crest is an apt representation of the organization's vision and mission. It begins with an invocation to the Almighty, an inscription of a verse from the Holy Quran which means "Oh Lord, Enlighten Us". The mass balance below symbolizes the prevailing justice in Islam. The crescent moon and star in the middle of the balance represent the muslims all over the world. The Holy Quran, the source of all knowledge is placed open below. Beside it the flambeau of Islamic culture is held in sturdy hands. The letters MES in the middle is the acronym for Muslim Educational Society.
						<br><br>
						The coconut trees on the left below denote the scenic beauty of Kerala which is enriched by the cultural values of MES. The quill pen held in a bangled hand shows the importance given to women's education by the organization. The bottom of the crest is inscribed with the full name of the organization and the year of inception.</p>
					  </div>
					  						  
				   </div>						  
                </div>
            </div>
        
            <!-- about area end -->

@endsection