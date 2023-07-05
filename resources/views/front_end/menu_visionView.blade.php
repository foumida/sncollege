@extends('layouts.front_end.default')
@section('content')



      <!-- breadcrumb area start -->

      <section class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
         data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}">
         <div class="container">
            <div class="row">
               <div class="col-xxl-12">
                  <div class="breadcrumb__content text-center p-relative z-index-1">
                     <h3 class="breadcrumb__title">VISION & MISSION</h3>
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


<div class="about-area about-us-area padding-bottom">
        <div class="about-wrapper">
            <div class="container">
			
                <div class="row">
                    <div class="col-lg-6 col-sm-12 visionblock">
					<div class="visionhead">Our Vision</div>
                       <div>                            
                            <ul class="blog-detailslist">
								<li>To provide affordable and quality higher education to all.</li>
								<li>Focuses on the backward and the marginalized people, women,    scheduled castes and scheduled tribes.</li>
								<li>Empowering the less- privileged through education.</li>
								<li>Providing education in tune with national and international standards.</li>
							</ul>                         
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 visionblock">
					<div class="visionhead">Core Values</div>
                        <div>                            
                            <ul class="blog-detailslist">
								<li>Pursuit for Academic Excellence</li>
								<li>Inclusivity in Diversity</li>
								<li>Respect for Culture and Heritage</li>
								<li>Honesty and Integrity</li>
								<li>Social Responsibility and Environmental Sustainability</li>
							</ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-sm-12 pb-30">
                       <img src="{{asset('front_end/assets/img/about-us/visionmission.jpg')}}" alt="" class="img-fluid" />
                    </div>
                    
                    
                   <div class="col-lg-12 col-sm-12 visionblocks">
					<div class="visionhead">Our Mission</div>
                       <div>                            
                            <ul class="blog-detailslist">
								<li>Empowerment of the downtrodden and backward classes.</li>
								<li>Imparting quality higher education for women.</li>
								<li>Promotion of secularism and democracy.</li>
								<li>Moral uplift and trust in God.</li>
								<li>Moulding a self-reliant and socially-accountable young generation.</li>
								<li>Emphasis on modern methods and tools of teaching and learning, with sufficient access to value added education.</li>
								<li>Inculcating social responsibility in student clan by involving them in community oriented activities.</li>
								<li>Promote life skills, employability entrepreneurial, organizational and leadership qualities in students.</li>
								<li>Creating and maintaining an atmosphere of oneness among staff, students and society.</li>
								<li>Evolve a student community having academic and professional excellence.</li>
								<li>Infuse eco-consciousness among students and community.</li>
							</ul>                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    

@endsection