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
                                <h3 class="breadcrumb__title">Administrative staff</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Administrative staff</span>
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
                                <div class="blog-contentss">
								    <div class="pb-90 abutmes text-center">
									   <h2>NON TEACHING STAFF</h2>
								    </div>
									<div class="row">
										<div class="col-lg-4">
											<ul>
											<h4>Junior Superintendent</h4>
											<li>Nazeeha C N</li></ul><br><br>
											<h4>Head Accountant</h4>
											<li>Sadarudeeen K A</li><br><br>
											<h4>Clerks</h4>
											<li>Haseena M H (Scholarship Section)</li>
											<li>Suresh Babu P V (Examination Section) </li>
											<li>Rajeeb P B (Establishment Section)</li>
											<li>Zeenath P A (Fee Section)</li>
											<li>Sajitha P A (Bill Section) </li>
											<li>Anees V A </li><br><br>
											<h4>Computer Assistant </h4>
											<li>Naseeba P A</li><br><br>
											<h4>Mechanic</h4>
											<li>Mohammed Hijas P S</li><br><br>
										</div>	
										<div class="col-lg-4">	
											
											<h4>Office Assistants</h4>
											<li>Sheji Shanoj </li>
											<li>Mohammed Muneer K J</li>
											<li>Kareem N M </li>
											<li>Jasmine A K </li>
											<li>Haseena P H </li><br><br>
											<h4>System Administrator</h4>
											<li>Jaseer P M</li><br><br>
											<h4>Accountant</h4>
											<li>Soudha Ismayl </li><br><br>
											<h4>Supervisor</h4>
											<li>Safaralighan K A</li><br><br>
											<h4>Office Administrator</h4>
											<li>P M Moideen </li><br><br>
										</div>	
										<div class="col-lg-4">
											<h4>Audit Assistant</h4>
											<li>Suharabee A A</li><br><br>
											<h4>Herbarium Keeper</h4>
											<li>Vacant </li>/ul&gt;<br><br>
											<h4>Gardener</h4>
											<li>Raji V R</li><br><br>
											<h4>Security Staff</h4>
											<li>Iqbal K M </li>
											<li>Muhammed </li>
											<li>Siddique K M</li><br><br>
											<h4>Cleaning Staff</h4>
											<li>Zeenath M A</li>
											<li>Sheji Udayan </li>
											<li>Sajitha Babu </li>
											<li>Rafiyath P M</li>
											<li>Shareena K A</li>
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