
<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>MES ASMABI COLLEGE </title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Place favicon.ico in the root directory -->
   <link rel="shortcut icon" type="image/x-icon" href="{{asset('front_end/assets/img/logo/favicon.png')}}">

   <!-- CSS here -->
   <link rel="stylesheet" href="{{asset('front_end/assets/css/bootstrap.css')}}">
   <link rel="stylesheet" href="{{asset('front_end/assets/css/meanmenu.css')}}">
   <link rel="stylesheet" href="{{asset('front_end/assets/css/animate.css')}}">
   <link rel="stylesheet" href="{{asset('front_end/assets/css/swiper-bundle.css')}}">
   <link rel="stylesheet" href="{{asset('front_end/assets/css/magnific-popup.css')}}">
   <link rel="stylesheet" href="{{asset('front_end/assets/css/nice-select.css')}}">
   <link rel="stylesheet" href="{{asset('front_end/assets/css/font-awesome-pro.css')}}">
   <link rel="stylesheet" href="{{asset('front_end/assets/css/flaticon.css')}}">
   <link rel="stylesheet" href="{{asset('front_end/assets/css/spacing.css')}}">
   <link rel="stylesheet" href="{{asset('front_end/assets/css/main.css')}}">
   
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="https://raw.githack.com/SochavaAG/example-mycode/master/pens/slick-slider/plugins/slick/slick.css">
<link rel="stylesheet" href="https://rawcdn.githack.com/SochavaAG/example-mycode/master/_common/css/reset.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" />
   

</head>

<body>
   <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->
   <!-- pre loader area start -->
   <div class="tp-preloader">
      <div class="tp-preloader__bars">
         <div class="tp-preloader__bar"></div>
         <div class="tp-preloader__bar"></div>
         <div class="tp-preloader__bar"></div>
         <div class="tp-preloader__bar"></div>
         <div class="tp-preloader__bar"></div>
         <div class="tp-preloader__ball"></div>
      </div>
   </div>
   <!-- pre loader area end -->

   <!-- back to top start -->
   <button class="tp-backtotop">
      <span><i class="fa-thin fa-chevrons-up"></i></span>
   </button>
   <!-- back to top end -->

   <!-- header area start -->

   <header>
      <div class="tp-header__section tp-header__transparent black-bg">
         
         <div class="tp-header__main p-relative" id="header-sticky">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xl-2 col-lg-2 col-6 d-flex align-items-center">
                     <div class="logo">
                        <a href="{{ route('index') }}"><img src="{{asset('front_end/assets/img/logo/logo-white.png')}}" alt="logo" /></a>
                     </div>
                  </div>
                   <div class="col-xl-9 col-lg-9 d-none d-lg-block">
                     <div class="main-menu text-end">
                        <nav id="mobile-menu">
                           <ul>
						      <li><a href="{{ route('index') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
							  <li class="nav-item dropdown">
								  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									The College
								  </a>
								  <div class="dropdown-menu">
									<ul class="submenus">
									<h5> The College</h5>
										<li><a class="dropdown-item" href="{{ route('menu.vision') }}">Vision &amp; Mission</a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.about') }}">About MES</a> </li>
										<li><a class="dropdown-item" href="{{ route('menu.collegeprofile') }}">College Profile</a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.management') }}">Management</a></li>
									        <li><a class="dropdown-item" href="{{ route('menu.principal') }}">Principal</a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.collegecouncil') }}">College Council</a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.administrativestaff') }}">Administrative staff </a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.staffassociation') }}">Staff Association </a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.qualitypolicy') }}">Quality Policy</a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.codeofconduct') }}">Code of conduct</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.gallery') }}">Gallery</a></li>
										
									 	<!--<li><a class="dropdown-item" href="img/Mandatory_disclosure.docx" target="_blank">Mandatory Disclosures</a></li>
									 	<li><a class="dropdown-item" href="">Organizational Structure</a></li>-->
									 </ul>
								     <ul class="submenus">
									 <h5>Student Support</h5>
										<!--<li><a class="dropdown-item" href="{{ route('menu.syllabus') }}">Syllabus</a></li>-->
										<li><a class="dropdown-item" href="http://asmabi.mestutors.com/" target="_blank">LMS</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.internship') }}">Internship</a></li>
										<li><a class="dropdown-item" href="{{url('committies')}}">Cells</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.pta') }}">PTA</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.college_reunion') }}">College Union</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.tutorial_system') }}">Tutorial System</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.centre') }}">Pre Marital Counselling Centre</a></li>
										<li><a class="dropdown-item" href="{{url('skill')}}" target="_blank">Skill Development</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.scholarship') }}">Scholarship</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.fellowship') }}">Fellowship</a></li>
									 </ul>
								     <ul class="submenus">
									   <h5>Facilities</h5>
										<li><a class="dropdown-item" href="{{ route('menu.library') }}">Library</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.media_lab') }}">Media Lab</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.dubbing_studio') }}">Dubbing studio </a></li>
										<li><a class="dropdown-item" href="{{ route('menu.language_lab') }}">Language Lab</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.sports') }}">Sports</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.hostel') }}">Hostel</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.canteen') }}">Canteen</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.coperative_society') }}">Coop Society</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.college_bus') }}">College Bus</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.counselling_center') }}">Counselling Centre</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.health_club') }}">Health club/Yoga centre</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.day_care') }}">Day care centre</a></li>
									 </ul>
								  </div>
							  </li>                              <li class="has-dropdown">
							     <a href="#">Faculty & Programmes </a>
							     <ul class="submenu">
									<li><a href="{{ route('menu.departments') }}">Departments</a></li>
									<li><a href="{{ route('menu.programmes') }}">Programmes</a></li>
									<li><a href="{{ route('menu.departments') }}">Admission</a></li>
									<li><a href="{{ route('menu.academiccalendar') }}">Academic Calendar</a></li>
								    <li><a href="{{url('greeninitiative')}}" target="_blank">Green Initiative</a></li>
									<li><a href="{{url('gender')}}" target="_blank">Gender</a></li>
									<li><a href="{{url('ethics')}}" target="_blank">Ethics & HumanValues</a></li>
									<li><a href="{{url('environment')}}" target="_blank">Environment & Sustainability</a></li>
									<li><a href="{{url('bestpractice')}}" target="_blank">Best Practice</a></li>
									<li><a href="{{ route('menu.mou') }}">Mou</a></li>
									<li><a href="{{ route('menu.project') }}">Project</a></li>
								    <li><a href="{{ route('menu.grant') }}">Grants</a></li>
								</ul>
							  </li>
							  <li class="has-dropdown">
							  <a href="#">Research @ Asmabi</a>
							     <ul class="submenu">
								 <?php 
	 
	
     $ipr = DB::select("select * from cell where id='160' order by id desc limit 1");
	 $iedc = DB::select("select * from cell where id='134' order by id desc limit 1");
	 $incubation = DB::select("select * from cell where id='151' order by id desc limit 1");
	  $awards = DB::select("select * from cell where id='142' order by id desc limit 1");
	    $nirf = DB::select("select * from cell where id='141' order by id desc limit 1");
		  $aishe = DB::select("select * from cell where id='152' order by id desc limit 1");
		  $researchextension= DB::select("select * from cell where id='127' order by id desc limit 1");
?> 
								<!--	<li><a href="{{ route('menu.researchcenters') }}">Research Centres</a></li>-->
									<li><a href="{{ route('menu.researchpromotioncouncil') }}">Research Council</a> </li>
									<li><a href="{{ route('menu.researchguide') }}">Research Guides</a> </li>
									<li><a href="{{ route('menu.researchstudent') }}">Research Fellow</a> </li>
									<li><a href="{{ route('menu.publications') }}">Publications</a> </li>	
								<!--	<li><a href="{{ route('menu.journal') }}">Journals</a></li>-->
							
									<li><a href="{{ url('cell/142') }}">Achievements</a></li>
										
								@if(!empty($ipr))	<li><a href="{{ url('cell/160') }}">IPR Cell</a></li> @endif
								@if(!empty($iedc))	<li><a href="{{ url('cell/134') }}">IEDC</a></li>@endif
								@if(!empty($incubation))	<li><a href="{{url('cell/151')}}">Incubation Centre</a></li>@endif
									<li><a href="{{url('seminar')}}">Workshops &amp; Seminars</a></li>
									<li><a href="{{url('extensionactivity')}}">Extension Activity</a></li>
									@if(!empty($researchextension))<li><a href="{{ url('cell/127')}}">Hornbill Foundation Research Extention Centre</a></li>@endif
								</ul>
							  </li>
                              <li class="has-dropdown">
							  <a href="#">IQAC</a>
							    <ul class="submenu">
								    <li><a href="{{ route('menu.ariia') }}">ARIIA</a></li>
									<li><a href="{{ route('menu.objectives') }}">Objectives</a></li>
									<li><a href="{{ route('menu.composition') }}">Composition </a> </li>
									<li><a href="{{ route('menu.aqar') }}">AQAR</a></li>
									<li><a href="{{ route('menu.minutes and atr') }}">Minutes and ATR</a></li>
									<li><a href="{{ route('menu.activities') }}">Activities</a></li>
									<li><a href="{{ route('menu.ssr reports') }}">SSR Reports</a></li>
									@if(!empty($nirf))<li><a href="{{url('cell/141')}}">NIRF</a></li>@endif
									@if(!empty($aishe))<li><a href="{{ url('cell/152')}}">AISHE</a></li>@endif
									

								</ul>
							  </li>
							
					<!-- <li><a href="https://mesasmabicollege.edu.in/demo/history.html">Facilities</a></li>-->
                           </ul>
                        </nav>
                     </div>
                  </div>

                  <div class="col-lg-1 col-6">
                     <div class="tp-header__right d-flex align-items-center justify-content-end">
                        
                        <!-- search  pop end -->
                        <button class="tp-header__nav sm offcanvas-open-btn">
                           <span></span>
                           <span></span>
                           <span></span>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>
   <div class="tp-mobile-menu d-none fix">
      <div class="main-menu text-end">
         <nav id="mobile-menu-large">
            <ul>
                <li><a href="{{ route('index') }}">Home</a></li>
               <li class="has-dropdown">
                  <a href="{{ route('index') }}">ACADEMICS</a>
                  <ul class="submenu">
                  <li><a href="{{ route('menu.departments') }}">Departments</a></li>
									<li><a href="{{ route('menu.programmes') }}">Programmes</a></li>
									<li><a href="{{ route('menu.admission') }}">Admission</a></li>
									<li><a href="{{ route('menu.academiccalendar') }}">Academic Calendar</a></li>
									<li><a href="http://asmabi.mestutors.com/" target="_blank">LMS</a></li>
                  </ul>
               </li>
               <li class="has-dropdown">
                  <a href="#!">The College</a>
                  <ul class="submenu">
                     <li><a class="dropdown-item" href="{{ route('menu.vision') }}">Vision &amp; Mission</a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.about') }}">About MES</a> </li>
										<li><a class="dropdown-item" href="{{ route('menu.collegeprofile') }}">College Profile</a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.management') }}">Management</a></li>
									        <li><a class="dropdown-item" href="{{ route('menu.principal') }}">Principal</a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.collegecouncil') }}">College Council</a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.administrativestaff') }}">Administrative staff </a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.staffassociation') }}">Staff Association </a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.qualitypolicy') }}">Quality Policy</a></li>
									 	<li><a class="dropdown-item" href="{{ route('menu.codeofconduct') }}">Code of conduct</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.gallery') }}">Gallery</a></li>
										
									 	
									 <h5>Student Support</h5>
										<!--<li><a class="dropdown-item" href="{{ route('menu.syllabus') }}">Syllabus</a></li>-->
										<li><a class="dropdown-item" href="http://asmabi.mestutors.com/" target="_blank">LMS</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.internship') }}">Internship</a></li>
										<li><a class="dropdown-item" href="{{url('committies')}}">Cells</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.pta') }}">PTA</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.college_reunion') }}">College Union</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.tutorial_system') }}">Tutorial System</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.centre') }}">Pre Marital Counselling Centre</a></li>
										<li><a class="dropdown-item" href="{{url('skill')}}" target="_blank">Skill Development</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.scholarship') }}">Scholarship</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.fellowship') }}">Fellowship</a></li>
									
									   <h5>Facilities</h5>
										<li><a class="dropdown-item" href="{{ route('menu.library') }}">Library</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.media_lab') }}">Media Lab</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.dubbing_studio') }}">Dubbing studio </a></li>
										<li><a class="dropdown-item" href="{{ route('menu.language_lab') }}">Language Lab</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.sports') }}">Sports</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.hostel') }}">Hostel</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.canteen') }}">Canteen</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.coperative_society') }}">Coop Society</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.college_bus') }}">College Bus</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.counselling_center') }}">Counselling Centre</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.health_club') }}">Health club/Yoga centre</a></li>
										<li><a class="dropdown-item" href="{{ route('menu.day_care') }}">Day care centre</a></li>
								
                  </ul>
               </li>
               <li class="has-dropdown"><a href="#!">Research @ Asmabi</a>
                  <ul class="submenu">
                  <!--   <li><a href="{{ route('menu.researchcenters') }}">Research Centres</a></li>-->
                   <li><a href="{{ route('menu.researchpromotioncouncil') }}">Research Council</a> </li>
					<li><a href="{{ route('menu.researchguide') }}">Research Guides</a> </li>	
					<li><a href="{{ route('menu.researchstudent') }}">Research Fellow</a> </li>
					<li><a href="{{ route('menu.publications') }}">Publications</a> </li>			
									<!--<li><a href="{{ route('menu.journal') }}">Journals</a></li>-->
							
									<li><a href="{{ url('cell/142') }}">Achievements</a></li>
										
								@if(!empty($ipr))	<li><a href="{{ url('cell/128') }}">IPR Cell</a></li> @endif
								@if(!empty($iedc))	<li><a href="{{ url('cell/134') }}">IEDC</a></li>@endif
								@if(!empty($incubation))	<li><a href="{{url('cell/151')}}">Incubation Centre</a></li>@endif
									<li><a href="{{url('seminar')}}">Workshops &amp; Seminars</a></li>
									<li><a href="{{ route('menu.mou') }}">MoU</a></li>
										<li><a href="{{ route('menu.project') }}">Project</a></li>
									<li><a href="{{ route('menu.fellowship') }}">Fellowship</a></li>
									<li><a href="{{ route('menu.grant') }}">Grants</a></li>

                  </ul>
               </li>
               <li class="has-dropdown"><a href="#!">IQAC</a>
                  <ul class="submenu">
                   <li><a href="{{ route('menu.ariia') }}">ARIIA</a></li>
									<li><a href="{{ route('menu.objectives') }}">Objectives</a></li>
									<li><a href="{{ route('menu.composition') }}">Composition </a> </li>
									<li><a href="{{ route('menu.aqar') }}">AQAR</a></li>
									<li><a href="{{ route('menu.minutes and atr') }}">Minutes and ATR</a></li>
									<li><a href="{{ route('menu.activities') }}">Activities</a></li>
									<li><a href="{{ route('menu.ssr reports') }}">SSR Reports</a></li>
									@if(!empty($nirf))<li><a href="{{url('cell/141')}}">NIRF</a></li>@endif
									@if(!empty($aishe))<li><a href="{{ url('cell/152')}}">AISHE</a></li>@endif
                           
                  </ul>
               </li>
                <li><a href="{{ route('menu.gallery') }}">Gallery</a></li>
               
            </ul>
         </nav>
      </div>
   </div>

   <!-- offcanvas area start -->
   <div class="offcanvas__area" data-background="{{asset('front_end/assets/img/hero/sidearea-bg-img.png')}}">
      <div class="offcanvas__wrapper">
         <div class="offcanvas__content">
            <div class="offcanvas__close text-end">
               <button class="offcanvas__close-btn offcanvas-close-btn">
                  <i class="fal fa-times"></i>
               </button>
            </div>
            <div class="offcanvas__top mb-40">
               <div class="offcanvas__logo mb-40">
                  <a href="{{ route('index') }}">
                     <img src="{{asset('front_end/assets/img/logo/logo-white.png')}}" alt="logo">
                  </a>
               </div>
               
            </div>
            <div class="mobile-menu fix mb-40"></div>
           
         </div>
      </div>
   </div>

   <div class="body-overlay"></div>
   <!-- offcanvas area end -->
   <main>
      
	  
@yield('content')	 
	  
   </main>

   <!-- footer start -->
   <footer>
      <div class="tp-footer__area-1 footer-bg">
         <div class="tp-footer__top pt-80 pb-30">
		   <div class="container">
			 <div class="row">
                  <div class="col-xl-3 col-lg-6 col-md-6">
                     <div class="footer__widget mb-50 footer-col-2">
                        <div class="tp-footer__logo mb-35">
                            <a href="{{ route('index') }}"><img src="{{asset('front_end/assets/img/logo/logo-white.png')}}" alt="logo" /></a>
                        </div>
						<div class="tp-footer__address">
							<strong>M.E.S Asmabi College Thrissur</strong> <br>
							<p>P. Vemballur P.O., Kodungallur,<br>
							Thrissur Dist., Kerala<br>
							PIN-680671<br>
							<i class="fa fa-phone" aria-hidden="true"> </i> 0480 - 2850596, 2851171<br>
							Principal: 0480 - 2859032<br>
							<i class="fa fa-envelope" aria-hidden="true"> </i>  principal.mesasmabi@gmail.com</p>
						</div>
						<div class="tp-footer__social-3">
                           <span><a href="#"><i class="fab fa-facebook-f"></i></a></span>
                           <span><a href="#"><i class="fab fa-twitter"></i></a></span>
                           <span><a href="#"><i class="fab fa-youtube"></i></a></span>
                           <span><a href="#"><i class="fab fa-linkedin"></i></a></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-6 col-md-6" style="border-left:3px solid #5d5d5da3;">
                     <div class="footer__widget mb-50 footer-col-2">
                        <div class="footer-widget mb-50">
                           <h4>The College</h4>
                            <hr class="foot-lne3">
						<div class="clearfix"></div>
                            <div class="fw-links">
                                <ul>
                                     <li class="current"><a href="{{ route('menu.vision') }}">Vision &amp; Mission</a></li>
									 <li class="current"><a href="{{ route('menu.about') }}">About MES</a> </li>
									 <li class="current"><a href="{{ route('menu.collegeprofile') }}">College Profile</a></li>
									 <li class="current"><a href="{{ route('menu.management') }}">Management</a></li>
									 <li class="current"><a href="{{ route('menu.principal') }}">Principal</a></li>
									 <li class="current"><a href="{{ route('menu.collegecouncil') }}">College Council</a></li>
									 <li class="current"><a href="{{ route('menu.administrativestaff') }}">Administrative staff </a></li>
									 <li class="current"><a href="{{ route('menu.staffassociation') }}">Staff Association </a></li>
									 <li class="current"><a href="{{ route('menu.qualitypolicy') }}">Quality Policy</a></li>
									 <li class="current"><a href="{{ route('menu.codeofconduct') }}">Code of conduct</a></li>
									 <li class="current"><a href="img/Mandatory_disclosure.docx" target="_blank">Mandatory Disclosures</a></li>
									 <li class="current"><a href="">Organizational Structure</a></li>
								 </ul>
                                </ul>
                            </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-6 col-md-6">
                     <div class="footer__widget mb-50 footer-col-2">
                        <h4> Academics </h4>
						<hr class="foot-lne3">
						<div class="clearfix"></div>
					    <div class="fw-links">
                            <ul>
								<li  class="current"><a href="{{ route('menu.departments') }}">Departments</a></li>
								<li  class="current"><a href="{{ route('menu.programmes') }}">Programmes</a></li>
								<li  class="current"><a href="{{ route('menu.admission') }}">Admission</a></li>
								<li  class="current"><a href="{{ route('menu.academiccalendar') }}">Academic Calendar</a></li>
								<li  class="current"><a href="http://asmabi.mestutors.com/" target="_blank">LMS</a></li>
                            </ul>
                        </div>
						<h4> Research Centres </h4>
						<hr class="foot-lne3">
						<div class="clearfix"></div>
					    <div class="fw-links">
                            <ul>
									<!--<li class="current"><a href="{{ route('menu.researchcenters') }}">Research Centres</a></li>-->
								  <li><a href="{{ route('menu.researchpromotioncouncil') }}">Research Council</a> </li>
									<li><a href="{{ route('menu.researchguide') }}">Research Guides</a> </li>
									<li><a href="{{ route('menu.researchstudent') }}">Research Fellow</a> </li>
									<li><a href="{{ route('menu.publications') }}">Publications</a> </li>	
									<!--<li><a href="{{ route('menu.journal') }}">Journals</a></li>-->
							
									<li><a href="{{ url('cell/142') }}">Achievements</a></li>
										
								@if(!empty($ipr))	<li><a href="{{ url('cell/128') }}">IPR Cell</a></li> @endif
								@if(!empty($iedc))	<li><a href="{{ url('cell/134') }}">IEDC</a></li>@endif
								@if(!empty($incubation))	<li><a href="{{url('cell/151')}}">Incubation Centre</a></li>@endif
									<li><a href="{{url('seminar')}}">Workshops &amp; Seminars</a></li>
									<li><a href="{{ route('menu.mou') }}">Mou</a></li>
										<li><a href="{{ route('menu.project') }}">Project</a></li>
									<li><a href="{{ route('menu.fellowship') }}">Fellowship</a></li>
									<li><a href="{{ route('menu.grant') }}">Grants</a></li>
											<li><a href="{{ route('menu.scholarship') }}">Scholarship</a></li>
                            </ul>
                        </div>
					  </div>
                  </div>
                  <div class="col-xl-3 col-lg-6 col-md-6">
                     <div class="footer__widget mb-50 footer-col-2">
                        <h4> IQAC  </h4>
						<hr class="foot-lne3">
						<div class="clearfix"></div>
					    <div class="fw-links">
                            <ul>
                                <li><a href="{{ route('menu.ariia') }}">ARIIA</a></li>
									<li><a href="{{ route('menu.objectives') }}">Objectives</a></li>
									<li><a href="{{ route('menu.composition') }}">Composition </a> </li>
									<li><a href="{{ route('menu.aqar') }}">AQAR</a></li>
									<li><a href="{{ route('menu.minutes and atr') }}">Minutes and ATR</a></li>
									<li><a href="{{ route('menu.activities') }}">Activities</a></li>
									<li><a href="{{ route('menu.ssr reports') }}">SSR Reports</a></li>
									@if(!empty($nirf))<li><a href="{{url('cell/141')}}">NIRF</a></li>@endif
									@if(!empty($aishe))<li><a href="{{ url('cell/152')}}">AISHE</a></li>@endif
                            </ul>
                        </div>
						<h4> MANADATORY  INFO  </h4>
						<hr class="foot-lne3">
						<div class="clearfix"></div>
					    <div class="fw-links">
                            <ul>
                                <li  class="current"><a href="#">Contact</a></li>
								<li class="current"><a href="#">Privacy Policy</a></li>
								<li class="current"><a href="#">Terms & Conditions </a> </li>
                            </ul>
                        </div>
					  </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="tp-footer__copyright text-center pt-25 pb-25 footer-bg-2">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <span>COPYRIGHT @ 2023.MES ASMABI COLLEGE. ALL RIGHTS RESERVED.</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>
   <!-- footer end  -->



   
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="{{asset('front_end/assets/js/vendor/jquery.js')}}"></script>
   <script src="{{asset('front_end/assets/js/vendor/waypoints.js')}}"></script>
   <script src="{{asset('front_end/assets/js/bootstrap-bundle.js')}}"></script>
   <script src="{{asset('front_end/assets/js/meanmenu.js')}}"></script>
   <script src="{{asset('front_end/assets/js/swiper-bundle.js')}}"></script>
   <script src="{{asset('front_end/assets/js/magnific-popup.js')}}"></script>
   <script src="{{asset('front_end/assets/js/parallax.js')}}"></script>
   <script src="{{asset('front_end/assets/js/nice-select.js')}}"></script>
   <script src="{{asset('front_end/assets/js/counterup.js')}}"></script>
   <script src="{{asset('front_end/assets/js/wow.js')}}"></script>
   <script src="{{asset('front_end/assets/js/isotope-pkgd.js')}}"></script>
   <script src="{{asset('front_end/assets/js/imagesloaded-pkgd.js')}}"></script>
   <script src="{{asset('front_end/assets/js/ajax-form.js')}}"></script>
   <script src="{{asset('front_end/assets/js/main.js')}}"></script>
   
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
   <script src="https://raw.githack.com/SochavaAG/example-mycode/master/pens/slick-slider/plugins/slick/slick.min.js"></script>
   

  


<script>
$(document).ready(function() {
    $('#users-list').DataTable();
} );
</script> 
<script>
$(document).ready(function() {
    $('#users-list2').DataTable();
} );
</script> 
   <!-- JS here -->


   <script>
   
   (function ($) {
  $(function () {


    $('.aboutslider').slick({
      dots: true,
      autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
      prevArrow: '<a class="slick-prev slick-arrow" href="#" style=""><div class="icon icon--ei-arrow-left"><svg class="icon__cnt"><use xlink:href="#ei-arrow-left-icon"></use></svg></div></a>',
      nextArrow: '<a class="slick-next slick-arrow" href="#" style=""><div class="icon icon--ei-arrow-right"><svg class="icon__cnt"><use xlink:href="#ei-arrow-right-icon"></use></svg></div></a>',
      customPaging: function (slick, index) {
        var targetImage = slick.$slides.eq(index).find('img').attr('src');
        return '<img src=" ' + targetImage + ' "/>';
      }
    });


  });
})(jQuery);
   
   
   
   
   
   
   
   
   
   
   
// Owlcarousel
$(document).ready(function(){
  $(".owl-demo5").owlCarousel({
  	loop:true,
    margin:10,
    nav:true,
	autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    center: true,
    navText: [
	    "<i class='fa fa-angle-left'></i>",
	    "<i class='fa fa-angle-right'></i>"
	],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:3
        }
    }
  });
});


// Owlcarousel
$(document).ready(function(){
  $(".owl-demo6").owlCarousel({
  	loop:true,
    margin:10,
    nav:true,
	autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    center: true,
    navText: [
	    "<i class='fa fa-angle-left'></i>",
	    "<i class='fa fa-angle-right'></i>"
	],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:4
        }
    }
  });
});
      


     $(function() {
  // Owl Carousel
  var owl = $(".owl-carouseldeo");
  owl.owlCarousel({
    items: 1,
    margin:10,
    loop: true,
    nav: true,
    autoplay: {
			delay: 2000,
		},
  });
});

   </script>
</body>

</html>