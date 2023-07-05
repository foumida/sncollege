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
                                <h3 class="breadcrumb__title">IEDC</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>IEDC</span>
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
                                            
                                            
											<div class="row" style="background: #fff;">
												<div class="col-lg-8">
												<h4>KERALA STARTUP MISSION</h4>
                                            <p class="text-justify">
                                                Kerala Startup Mission (KSUM) is the State nodal agency for the promotion of
                                                innovation and entrepreneurship under Department of Electronics and IT,
                                                Government of Kerala. Kerala Startup Mission plays a pivotal role in
                                                developing a vibrant Startup ecosystem in the State of Kerala.<br /><br />

                                                The primary objectives of KSUM is to undertake the planning, establishment
                                                and management of Technology Business Incubators/Accelerators in Kerala and
                                                thereby promote technology-based entrepreneurship activities and develop a
                                                conducive environment required for promoting high technology-based business
                                                activities.<br /><br />

                                                To promote knowledge driven and technology based Startup ventures<br />
                                                To establish and Management of Technology Business Incubators and thereby
                                                create the infrastructure and environment required for promoting
                                                technology-based start-ups<br />
                                                To encourage leading entrepreneurs and companies to set up high technology
                                                business activities in the region<br />
                                                To undertake major initiatives in Innovation promotion in the region.<br />
                                                To build appropriate models for Entrepreneurship Development through
                                                research<br />
                                                To create a knowledge, innovation and entrepreneurial support system through
                                                a collaborative community of national and international experts,
                                                practitioners and other partners.<br />
                                            </p>
											</div>
											<div class="col-lg-4">
											<img src="{{asset('front_end/assets/img/research/keralastartup.jpg')}}" width="300" height="auto" class="logo-sticky-none pt-50" alt="Logo"/>
											</div>
											</div>
                                            <br>
											<div class="row" style="background: #fff;">
												<div class="col-lg-4">
											<img src="{{asset('front_end/assets/img/research/iedc.jpg')}}" width="300" height="auto" class="logo-sticky-none pt-50" alt="Logo"/>
											</div>
												<div class="col-lg-8">
												<h4>Innovation and Entrepreneurship Development Centres (IEDC)</h4>
                                            
											<p class="text-justify">
                                                The Innovation and Entrepreneurship Development Centres (IEDC) are platforms
                                                set up in Engineering, Management, Arts & Science Colleges, Medical
                                                Institutions, Polytechnics and Universities with an aim to provide students
                                                with an opportunity to experiment and innovate. Kerala Startup Mission has
                                                set up IEDCs in 341 institutions across the State which provide avenues for
                                                creative students to learn, collaborate and transform their innovative ideas
                                                into prototypes of viable products and services. IEDCs works as the first
                                                launch pad for a student’s entrepreneurial journey and provide them with
                                                access to cutting edge technology, world-class infrastructure, high-quality
                                                mentorship, early risk capital and global exposure.<br /><br />

                                                IEDC MES Asmabi constitued in 2021 with an aim to findout the innovative
                                                ideas of students and mainstream socially significant ideas. <br />
                                                Nodal officer: Chithra P<br />
                                                Assi. Nodal officer : Dr. Dhanya PR<br />
                                                Mail ID for communication :iedcmesac@gmail.com<br />
                                            </p>
											</div>
											</div>
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