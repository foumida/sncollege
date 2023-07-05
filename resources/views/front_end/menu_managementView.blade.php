@extends('layouts.front_end.default')
@section('content')

 <!-- breadcrumb area start -->

            <section class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">MANAGEMENT</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>MANAGEMENT</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

            <!-- about area start -->
            <div class="tp-about__section-2 pt-50 pb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="classic-blog-post blog-details-wrap">
                                <div class="blog-content">
								    <div class="abutmes text-center">
									   <h2>M.E.S. STATE COMMITTEE</h2>
								    </div>
									<div class="row mainperson pt-50">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-4 text-center mainimg">
											<img src="{{asset('front_end/assets/img/management/fazalgafoor.jpeg')}}" class="img-fluid" alt="meslogo">
                                            <h4 class="mt-5" style="color: #57c507;font-size: 27px;">Dr. P A Fazal Gafoor</h4>
											<p style="color: #0556a6;font-size: 22px;font-weight: 700;">PRESIDENT</p>
                                        </div>
										<div class="col-lg-4"></div>
                                    </div>
                                    <div class="row mainperson pt-50">
                                        <div class="col-lg-4 text-center maximg">
											<img src="{{asset('front_end/assets/img/management/kunjimoideen.jpg')}}" class="img-fluid" alt="meslogo">
                                            <h4 class="mt-5">Jb. K.K. Kunjumoideen</h4>
											<p>GENERAL SECRETARY</p>
                                        </div>
										<div class="col-lg-4 text-center maximg">
											<img src="{{asset('front_end/assets/img/management/salhudheen.jpg')}}" class="img-fluid" alt="meslogo">
                                            <h4 class="mt-5">Jb OC Salahudeen </h4>
											<p>TREASURER</p>
                                        </div>
										<div class="col-lg-4 text-center maximg">
											<img src="{{asset('front_end/assets/img/management/Hasim.jpg')}}" class="img-fluid" alt="meslogo">
                                            <h4 class="mt-5">Dr. K A Hashim </h4>
											<p>CORPORATE MANAGER</p>
                                        </div>
                                    </div>
									<div class="abutmes text-center pt-50">
									   <h2>M.E.S. LOCAL MANAGEMENT COMMITTEE</h2>
								    </div>
                                    <div class="row mainperson pt-50">
                                        <div class="col-lg-4 text-center maximg">
											<img src="{{asset('front_end/assets/img/management/aspin.jpg')}}" class="img-fluid" alt="meslogo">
                                            <h4 class="mt-5">Jb. Aspin Ashraf</h4>
											<p>Chairman</p>
                                        </div>
                                        <div class="col-lg-4 text-center maximg">
											<img src="{{asset('front_end/assets/img/management/navas.jpg')}}" class="img-fluid" alt="meslogo">
                                            <h4 class="mt-5">Adv K M Navas</h4>
											<p>Secretary & Correspondent</p>
                                        </div>
										<div class="col-lg-4 text-center maximg">
											<img src="{{asset('front_end/assets/img/management/mustaq.jpg')}}" class="img-fluid" alt="meslogo">
                                            <h4 class="mt-5">Jb. K.M. Mushtak Moideen</h4>
											<p>Treasurer</p>
                                        </div>
                                    </div>
									
					<!---<div class="row mainperson pt-50">
                                        <div class="col-lg-3 text-center maximg">
                                            <h4 class="mt-5">Jb. P.M. Mohiyudheen</h4>
											<p>VICE PRESIDENT</p>
                                        </div>
                                        <div class="col-lg-3 text-center maximg">
                                            <h4 class="mt-5">Jb. A.T. Ibrahimkutty</h4>
											<p>VICE PRESIDENT</p>
                                        </div>
										<div class="col-lg-3 text-center maximg">
                                            <h4 class="mt-5">Jb. K.M. Abdul Jamal</h4>
											<p>JOINT SECRETARY</p>
                                        </div>
										<div class="col-lg-3 text-center maximg">
                                            <h4 class="mt-5">Jb. P.K. Abdul Rahiman</h4>
											<p>JOINT SECRETARY</p>
                                        </div>
                                    </div>
									<div class="pt-50 abutmes text-center">
									   <h2>MEMBERS</h2>
								    </div>
									<div class="row mainperson pt-50">
                                        <div class="col-lg-4 text-left">
                                            <h4 class="mt-5">Jb. K.K. Kunjumoideen</h4>
                                            <h4 class="mt-5">Jb. A.A. Mohamed Iqbal</h4>
                                            <h4 class="mt-5">Jb. K.M. Abdul Salam</h4>
                                            <h4 class="mt-5">Jb. K.A. Mohamed</h4>
                                            <h4 class="mt-5">Jb. P.K. Abdul Jabbar</h4>
                                            <h4 class="mt-5">Adv. K.A. Mohamed Siddique</h4>
                                            <h4 class="mt-5">Jb. E.K. Shamsudheen</h4>
                                        </div>
										<div class="col-lg-4 text-left">
                                            <h4 class="mt-5">Jb. M.A. Rasheed</h4>
                                            <h4 class="mt-5">Jb. K.M. Abdul Kader</h4>
                                            <h4 class="mt-5">Jb. K.M. Mohamed</h4>
                                            <h4 class="mt-5">Dr. K.K. Nassir</h4>
                                            <h4 class="mt-5">Jb. A.B. Mohamed</h4>
                                            <h4 class="mt-5">Jb. R.B. Mohamed Ali</h4>
                                            <h4 class="mt-5">Er. Shimna Shakker</h4>
                                        </div>
										<div class="col-lg-4 text-left">
                                            <h4 class="mt-5">Er. V.A. Shahul Hameed</h4>
                                            <h4 class="mt-5">Jb. Mohamed Sherief</h4>
                                            <h4 class="mt-5">Jb. P.H. Ziyavudeehn Ahammed</h4>
                                            <h4 class="mt-5">Jb. M.A. Nazeer</h4>
                                            <h4 class="mt-5">Jb. E.I. Mujeeb</h4>
                                            <h4 class="mt-5">Dr. P.K. Shabana</h4>
                                        </div>
                                    </div>--->
				   <div class="row mainperson pt-50">
                                        <div class="col-lg-6 text-center maximg">
                                            <h4 class="mt-5">Jb. V.M. Shine</h4>
					    <p>President, M.E.S. Thrissur District</p>
                                        </div>
                                        <div class="col-lg-6 text-center maximg">
                                            <h4 class="mt-5">Jb. P.K. Mohammed Shameer</h4>
					    <p>Secretary, M.E.S. Thrissur District</p>
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