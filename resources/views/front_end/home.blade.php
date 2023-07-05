@extends('layouts.front_end.default')
@section('content')

<!-- slider-area start -->
      <div class="tp-slider__area">
         <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<div id="carrousel" class="carousel-inner">
				<div data-pause="true" data-interval="10000" class="carousel-item active">
					<div class="videoSlider">
						<video width="100%"  loop="loop"  autoPlay playsInline muted src="{{asset('front_end/assets/img/mesvideo/Mesasmabicollegev3-1.m4v')}}" id='video-slider-3'>
						</video>
					</div>
				</div>
			</div>
		</div>
      </div>
      <!-- slider-area end -->

      <!-- slider-area end -->

      <!-- feature-area start -->
  <!-- feature-area start -->
      <div class="tp-feature__section pt-50 pb-135" style="background-color:#f7f7f7;border-bottom: 1px solid #248859;">
         <div class="container">
            <div class="row">
               <div class="col-xl-10 offset-xl-1">
                  <div class="tp-feature__section-title-wrapper text-center mb-50 wow tpfadeUp" data-wow-delay=".4s">
                     <h2 class="tp-feature__section-title">
                        Announcements
                     </h2>
                  </div>
               </div>
            </div>
			<div class="row">
				<div class="product-additional-tab">
                     <ul class="nav nav-tabs grid" id="myTabs" role="tablist">
                        <li class="nav-item col" role="presentation">
                           <button class="nav-links active" id="home-tab-1" data-bs-toggle="tab"
                              data-bs-target="#Notification" type="button" role="tab" aria-controls="atab"
                              aria-selected="true"><i class="fa fa-bell" aria-hidden="true"> </i> Notification</button>
                        </li>
                        <li class="nav-item col" role="presentation">
                           <button class="nav-links" id="home-tab-2" data-bs-toggle="tab"
                              data-bs-target="#Upcoming-Events" type="button" role="tab" aria-controls="btab"
                              aria-selected="false"><i class="fa fa-calendar" aria-hidden="true"> </i> Upcoming Events</button>
                        </li>
                        <li class="nav-item col" role="presentation">
                           <button class="nav-links" id="home-tab-3" data-bs-toggle="tab" data-bs-target="#Events-tab" type="button" role="tab" aria-controls="ctab" aria-selected="false"><i class="fa fa-clock" aria-hidden="true"></i> Recent Events
                            </button>
                        </li>
                        <li class="nav-item col" role="presentation">
                           <button class="nav-links" id="home-tab-4" data-bs-toggle="tab" data-bs-target="#Awards-tab" type="button" role="tab" aria-controls="dtab" aria-selected="false"><i class="fa fa-trophy" aria-hidden="true"> </i> Awards</button>
                        </li>
						<li class="nav-item col" role="presentation">
                           <button class="nav-links" id="home-tab-5" data-bs-toggle="tab" data-bs-target="#Examinations-tab"
                              type="button" role="tab" aria-controls="etab" aria-selected="false"><i class="fa fa-book" aria-hidden="true"> </i> Examinations</button>
                        </li>
						<li class="nav-item col" role="presentation">
                           <button class="nav-links" id="home-tab-6" data-bs-toggle="tab" data-bs-target="#News-tab"
                              type="button" role="tab" aria-controls="ftab" aria-selected="false"><i class="fa fa-globe" aria-hidden="true"> </i> News</button>
                        </li>
						
                     </ul>
                     <div class="tab-content tp-content-tab" id="myTabContent-2">
                        <div class="tab-pane fade show active" id="Notification" role="tabpanel" aria-labelledby="home-tab-1">
							<div  class="owl-carousel owl-carouseldeo owl-theme">
							@if(!empty($notification))
					 @foreach($notification as $row)
								<div class="item">
									<div class="row">
									<?php 
	 $id = $row->cellid;
	
     $notificationpic = DB::select("select * from picture where fid='$id' order by pid desc limit 1");
	
?>
									<!--	<div class="col-lg-8 col-sm-12 no-pad"> <img src="{{url('public/uploads/faculty/'.$notificationpic[0]->picture)}}" class="slideranimage"  alt="Mindful Leadership ">  </div>-->
										<div class="col-lg-12 col-sm-12">
										<div class="anno-xtxs">
									  <h2>{{strip_tags($row->title)}}</h2>
										<p>{{strip_tags($row->descr)}}</p> 
                     <!--   <a href="" target="_blank" class="btn btn-primary ann-btnst"> Click here </a>  -->      </div>
										</div>
									</div>
								</div>
							  @endforeach	
                     @endif		
								
							</div>							
						</div>
                        <div class="tab-pane fade" id="Upcoming-Events" role="tabpanel" aria-labelledby="home-tab-2">
                           <div class="owl-carousel  owl-carouseldeo owl-theme">
						 	@if(!empty($upcomingevents))
					 @foreach($upcomingevents as $row)
								<div class="item">
									<div class="row">
										<?php 
	 $id = $row->id;
	
     $eventpic = DB::select("select * from picture where fid='$id' order by pid desc limit 1");
	
?>
									<!--	<div class="col-lg-8 col-sm-12 no-pad"> @if(!empty($eventpic))
										<img src="{{url('public/uploads/faculty/'.$eventpic[0]->picture)}}" class="slideranimage" alt="Mindful Leadership "> </img>@else<img src="https://iimk.ac.in/uploads/announcements/medium/leadban1.png" alt="Mindful Leadership "> </img> @endif	</div>
									!-->	<div class="col-lg-12 col-sm-12">
										<div class="anno-xtxs">
									  <h2>{{strip_tags($row->title)}}</h2>
										<p>{{strip_tags($row->description)}}</p>
                       <!-- <a href="" target="_blank" class="btn btn-primary ann-btnst"> Register Now </a> -->       </div>
										</div>
									</div>
								</div>
								 @endforeach	
                     @endif		
								
							</div>
                        </div>
                        <div class="tab-pane fade" id="Events-tab" role="tabpanel" aria-labelledby="home-tab-3">
                         <div class="owl-carousel  owl-carouseldeo owl-theme">
						 	@if(!empty($recentevents))
					 @foreach($recentevents as $row)
								<div class="item">
									<div class="row">
										<?php 
	 $id = $row->id;
	
     $eventpic = DB::select("select * from picture where fid='$id' order by pid desc limit 1");
	
?>
								<!--		<div class="col-lg-8 col-sm-12 no-pad"> @if(!empty($eventpic))
										<img src="{{url('public/uploads/faculty/'.$eventpic[0]->picture)}}" class="slideranimage"  alt="Mindful Leadership "> </img>@else<img src="https://iimk.ac.in/uploads/announcements/medium/leadban1.png" class="slideranimage"  alt="Mindful Leadership "> </img> @endif	</div>
										--><div class="col-lg-12 col-sm-12">
										<div class="anno-xtxs">
										
	                                    <h2>{{strip_tags($row->title)}}</h2>
										<p>{{strip_tags($row->description)}}</p> 										
                       <!-- <a href="" target="_blank" class="btn btn-primary ann-btnst"> Register Now </a> -->       </div>
										</div>
									</div>
								</div>
								 @endforeach	
                     @endif		
								
							</div>
                        </div>
                        <div class="tab-pane fade" id="Awards-tab" role="tabpanel" aria-labelledby="home-tab-4">
                           <div class="owl-carousel owl-carouseldeo owl-theme">
									@if(!empty($awards))
					 @foreach($awards as $row)
								<div class="item">
							
									<div class="row">
										<?php 
	 $id = $row->cellid;
	
     $awardspic = DB::select("select * from picture where fid='$id' order by pid desc limit 1");
	
?>
										<!--<div class="col-lg-8 col-sm-12 no-pad"> 
										@if(!empty($awardspic))
										<img src="{{url('public/uploads/faculty/'.$awardspic[0]->picture)}}" class="slideranimage"  alt="Mindful Leadership "> </img>@else<img class="slideranimage"  src="https://iimk.ac.in/uploads/announcements/medium/leadban1.png" alt="Mindful Leadership "> </img> @endif	 </div>-->
										<div class="col-lg-12 col-sm-12">
										<div class="anno-xtxs">
										<h2>{{strip_tags($row->title)}}</h2>
										<p>{{strip_tags($row->descr)}}</p> 
										<!--<a href="" target="_blank" class="btn btn-primary ann-btnst"> Register Now </a> -->       </div>
										</div>
									</div>
								</div>
								 @endforeach	
                     @endif		
								
								
							</div>
                        </div>
						<div class="tab-pane fade" id="Examinations-tab" role="tabpanel" aria-labelledby="home-tab-5">
                            <div class="owl-carousel owl-carouseldeo owl-theme">
							@if(!empty($exam))
					 @foreach($exam as $row)
								<div class="item">
									<div class="row">
										<?php 
	 $id = $row->cellid;
	
     $exampic = DB::select("select * from picture where fid='$id' order by pid desc limit 1");
	
?>
									<!--	<div class="col-lg-8 col-sm-12 no-pad"> @if(!empty($exampic))
										<img src="{{url('public/uploads/faculty/'.$exampic[0]->picture)}}" class="slideranimage"  alt="Mindful Leadership "> </img>@else<img src="https://iimk.ac.in/uploads/announcements/medium/leadban1.png" class="slideranimage"  alt="Mindful Leadership "> </img> @endif	  </div>-->
										<div class="col-lg-12 col-sm-12">
										<div class="anno-xtxs">
										<h2>{{strip_tags($row->title)}} </h2>
										<p>{{strip_tags($row->descr)}} </p> 
                      <!--  <a href="" target="_blank" class="btn btn-primary ann-btnst"> Register Now </a> -->       </div>
										</div>
									</div>
								</div>
								 @endforeach	
                     @endif		
							</div>
                        </div>
						<div class="tab-pane fade" id="News-tab" role="tabpanel" aria-labelledby="home-tab-6">
                            <div class="owl-carousel owl-carouseldeo owl-theme">
							@if(!empty($news))
					 @foreach($news as $row)
								<div class="item">
									<div class="row">
									<?php 
	 $id = $row->cellid;
	
     $newspic = DB::select("select * from picture where fid='$id' order by pid desc limit 1");
	
?>
									<!--	<div class="col-lg-8 col-sm-12 no-pad"> @if(!empty($newspic))
										<img src="{{url('public/uploads/faculty/'.$newspic[0]->picture)}}"  class="slideranimage"  alt="Mindful Leadership "> </img>@else<img src="https://iimk.ac.in/uploads/announcements/medium/leadban1.png"  class="slideranimage"  alt="Mindful Leadership "> </img> @endif  </div>
										--><div class="col-lg-12 col-sm-12">
										<div class="anno-xtxs">
									   <h2>{{strip_tags($row->title)}} </h2>
										<p>{{strip_tags($row->descr)}} </p> 
										<!--<a href="" target="_blank" class="btn btn-primary ann-btnst"> Register Now </a>  -->      </div>
										</div>
									</div>
								</div>
							 @endforeach	
                     @endif		
							</div>
                        </div>
						
                     </div>
                  </div>
            </div>
         </div>
      </div>
      <!-- feature-area end -->

      <!-- about section start  -->
      <div class="tp-about__section aboutbanner pt-120 pb-60" style="border-bottom: 1px solid #248859;">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6">
                  <div class="tp-about__left ms-5 pr-70 mb-60 wow tpfadeRight">
                     <div class="tp-section__title-wrapper">
                        <h3 class="tp-section__title mb-10 text-white">About The MES Asmabi College</h3>
                        <p class="text-white">M.E.S Asmabi College, a premier educational institution managed by the Muslim Educational Society (Regd.) Calicut, owes its existence to the remarkable foresight and unremitting zeal of the late Dr. P.K.Abdul Gafoor, the late P.K. Abdulla and late Dr. A.K Siddiq Karikulam Azhikode.
						<br><br>
						Started in the year 1968 at P. Vemballur, Kodungallur, a remote coastal backward village in the S N Puram Panchayath of Thrissur District with the main objective of uplifting the educationally backward community especially muslims of the area who had been denied of the right to education for generations. The college now caters to the needs of the students throughout Kerala and Lakshadweep , cutting across the barriers of class, caste, creed and religion. Hajee Ismail Essa Sait of Cochin initially donated the land and the building and the college was named after his mother Asmabi.</p>
                     </div>
                     <div class="tp-about__author d-flex align-items-center">
                        <div class="tp-about__author-info">
                           <h4 class="tp-about__author-name text-white">Dr. A. Biju</h4>
                           <span class="text-white">M.Sc., B.Ed., M.Phil., PhD.</span>
                        </div>
                     </div>
                  </div>

               </div>
               <div class="col-lg-6">
                  <div class="tp-about__right wow tpfadeLeft">
                     <div class="tp-cta__img mb-30 pt-10 w-img mr-30 wow tpfadeUp" data-wow-delay=".3s">
                     
                     <div class="ag-format-container">
                        <div class="layout">
                          <ul class="aboutslider">
                            <li>
                              <img src="{{asset('front_end/assets/img/testimonail/principal.png')}}" alt="" />
                            </li>
                            <li>
                              <img src="{{asset('front_end/assets/img/testimonail/welcome.jpg')}}" alt="" />
                            </li>
                            <li>
                              <img src="{{asset('front_end/assets/img/testimonail/principal.png')}}" alt="" />
                            </li>
                            <li>
                              <img src="{{asset('front_end/assets/img/testimonail/welcome.jpg')}}" alt="" />
                            </li>
                            <li>
                              <img src="{{asset('front_end/assets/img/testimonail/welcome.jpg')}}" alt="" />
                            </li>
                          </ul>
                        </div>
                      </div>
                    
                    
                      <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
                        <symbol id="ei-arrow-left-icon" viewBox="0 0 50 50">
                          <path d="M25 42c-9.4 0-17-7.6-17-17S15.6 8 25 8s17 7.6 17 17-7.6 17-17 17zm0-32c-8.3 0-15 6.7-15 15s6.7 15 15 15 15-6.7 15-15-6.7-15-15-15z"></path>
                          <path d="M25.3 34.7L15.6 25l9.7-9.7 1.4 1.4-8.3 8.3 8.3 8.3z"></path>
                          <path d="M17 24h17v2H17z"></path>
                        </symbol>
                    
                        <symbol id="ei-arrow-right-icon" viewBox="0 0 50 50">
                          <path d="M25 42c-9.4 0-17-7.6-17-17S15.6 8 25 8s17 7.6 17 17-7.6 17-17 17zm0-32c-8.3 0-15 6.7-15 15s6.7 15 15 15 15-6.7 15-15-6.7-15-15-15z"></path>
                          <path d="M24.7 34.7l-1.4-1.4 8.3-8.3-8.3-8.3 1.4-1.4 9.7 9.7z"></path>
                          <path d="M16 24h17v2H16z"></path>
                        </symbol>
                      </svg>
                    
                   </div>
                     
                  </div>
               </div>
            </div>
         </div>
         <!-- about section start  -->
      </div>
      <!-- about section end  -->

      
      <!-- fanfacet area  end -->
	  <div class="pt-120 pb-60 aboutimagebanner">
		<div class="container-fluid">
         <div class="progms-wrp-xb">
          <div class="containe-wd row">
             <div class="col-lg-4 col-sm-12 col-md-4 ac-p-hd-sh1">
				  <div class="ac-hds">
					<div class="comn-hds4">
					<h1 class="wow fadeInRight">Academic @ Asambi</h1>
					</div>
					<div class="btnview">
						<a href=""><ul>
							  <li>
								<i class="fas fa-play"></i>
							  </li>
						 </ul></a>
					   </div>
				   </div>
			 </div>
			 <div class="col-sm-12 col-sm-12 col-md-8 no-pad">
				<div class="c-prog">
					<div id="owl-demo5" class="owl-carousel owl-demo5 owl-theme" style="opacity: 1; display: block;">
					<!--	<div class="item wow fadeInLeft">
							<a href="{{ route('menu.departments') }}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
										<img src="{{asset('front_end/assets/img/sliders/thumb1.jpg')}}" class="img-fluid" class="img-responsive zoom">
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;"> Admission </h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>-->
						<div class="item wow fadeInLeft">
							<a href="{{ route('menu.departments') }}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
										<img src="{{asset('public/front_end/assets/img/images/teachingdept.jpg')}}" class="img-fluid" class="img-responsive zoom">
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;"> Teaching Department </h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>
						<div class="item wow fadeInLeft">
							<a href="{{ route('menu.programmes') }}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
										<img src="{{asset('public/front_end/assets/img/images/programmes.jpg')}}" class="img-fluid" class="img-responsive zoom">
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;">Programmes</h4>
									</div>
								</div>
						   </div>
						   </a>
						</div><div class="item wow fadeInLeft">
							<a href="{{ route('menu.departments') }}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
										<img src="{{asset('public/front_end/assets/img/images/faculty.jpg')}}" class="img-fluid" class="img-responsive zoom">
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;"> Faculty </h4>
									</div>
								</div>
						   </div>
						   </a>
						</div><div class="item wow fadeInLeft">
							<a href="{{ route('menu.teachingmethod') }}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
										<img src="{{asset('public/front_end/assets/img/images/thumb6.png')}}" class="img-fluid" class="img-responsive zoom">
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;"> Teaching methodologies </h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>
					</div>
				</div>
    	   </div>
        </div>
	</div>

    </div>
    </div>
	  <!-----area---->
	  
	  

      <!-- counter area start -->
      <div class="tp-counter__section pt-70 pb-30">
         <div class="container">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                  <div class="tp-counter__item d-flex align-items-center mb-30 wow tpfadeRight">
                     
                     <div class="tp-counter__content">
                        <h2 class="tp-counter__number"><span class="counter">@if(!empty($studentcount))  {{$studentcount[0]->st}}@endif		</span> +</h2>
                        <span class="tp-counter__status">Students</span>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                  <div class="tp-counter__item d-flex align-items-center mb-30 wow tpfadeRight">
                     
                     <div class="tp-counter__content">
                        <h2 class="tp-counter__number"><span class="counter">@if(!empty($departmentcount))  {{$departmentcount[0]->dt}}@endif	</span> + </h2>
                        <span class="tp-counter__status">Departments</span>
                     </div>
                  </div>
               </div>
			   <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                  <div class="tp-counter__item d-flex align-items-center mb-30 wow tpfadeRight">
                     
                     <div class="tp-counter__content">
                        <h2 class="tp-counter__number"><span class="counter">@if(!empty($facultycount))  {{$facultycount[0]->ft}}@endif	</span> + </h2>
                        <span class="tp-counter__status">Faculty</span>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                  <div class="tp-counter__item d-flex align-items-center mb-30 wow tpfadeLeft">
                     
                     <div class="tp-counter__content">
                        <h2 class="tp-counter__number"><span class="counter">@if(!empty($coursecount))  {{$coursecount[0]->cs}}@endif	</span> + </h2>
                        <span class="tp-counter__status">courses</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- counter area end -->
	  
	  
	  
	        <!-- fanfacet area  end -->
	  <div class=" pt-120 pb-60 Researchbanner" style="border-bottom: 1px solid #248859;">
		<div class="container-fluid">
         <div class="progms-wrp-xb">
          <div class="containe-wd row">
             
			 <div class="col-sm-12 col-sm-12 col-md-8 no-pad">
				<div class="c-prog">
					<div id="owl-demo5" class="owl-carousel owl-demo5 owl-theme" style="opacity: 1; display: block;">
					@if(!empty($research))
					 @foreach($research as $row)
						<div class="item wow fadeInLeft">
							<a href="{{url('departments_details/'.$row->id.'/'.$row->department)}}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
									 @if(!empty($row->picture))
										<img src="{{url('public/uploads/department/'.$row->picture)}}" class="img-fluid" class="img-responsive zoom"> </img>@else<img src="{{asset('front_end/assets/img/sliders/thumb2.jpg')}}" class="img-fluid" class="img-responsive zoom"> @endif 
										
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;"> {{$row->department}} </h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>	
				     @endforeach	
                     @endif					 
					</div>
				</div>
    	   </div>
		   <div class="col-lg-4 col-sm-12 col-md-4 ac-p-hd-sh1">
				  <div class="ac-hds">
					<div class="comn-hds4">
					<h1 class="wow fadeInRight"> Research  @ Asmabi</h1>
					</div>
					<div class="btnview">
						<a href=""><ul>
							  <li>
								<i class="fas fa-play"></i>
							  </li>
						 </ul></a>
					   </div>
				   </div>
			 </div>
		   
        </div>
	</div>

    </div>
    </div>
	  <!-----area---->
	  
	  <!-- fanfacet area  end -->
	  <div class="section  theme-bg pt-50 pb-60 researchbanner" style="border-bottom: 1px solid #248859;">
		<div class="container-fluid">
         <div class="progms-wrp-xb">
          <div class="containe-wd row">
             <div class="col-lg-12 col-sm-12 col-md-4 ac-p-hd-sh1">
			
			 <div class="comn-hds4">
			    <h1 class="wow fadeInRight"> Exposure @ Asmabi</h1>
			</div>
			<div class="c-prog">
					<div id="owl-demo5" class="owl-carousel owl-demo6 owl-theme" style="opacity: 1; display: block;">
						<div class="item wow fadeInLeft">
							<a href="{{url('committies')}}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
									<img src="{{asset('public/front_end/assets/img/images/clubscellscomms.jpg')}}" class="img-fluid" class="img-responsive zoom">
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;">Clubs / Cells & Committees </h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>
						
						<!--<div class="item wow fadeInLeft">
							<a href="">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
									<img src="{{asset('front_end/assets/img/sliders/thumb1.jpg')}}" class="img-fluid" class="img-responsive zoom">
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;">Student Support</h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>-->
							
						<div class="item wow fadeInLeft">
							<a href="https://sites.google.com/view/mesasmabicollegelibrary/home">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
										<img src="{{asset('public/front_end/assets/img/images/library.jpg')}}" class="img-fluid" class="img-responsive zoom">
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;">Library </h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>
						@if(!empty($fine))
							 @foreach($fine as $val)
						<div class="item wow fadeInLeft">
							<a href="{{url('cell/'.$val->id)}}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
									<img src="{{asset('public/front_end/assets/img/images/finearts.jpg')}}" class="img-fluid" class="img-responsive zoom">
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;"> Fine Arts</h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>
						@endforeach
						@endif
						@if(!empty($sports))
							 @foreach($sports as $val)
						<div class="item wow fadeInLeft">
							<a href="{{url('departments_details/'.$val->id.'/'.$val->department)}}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
								<img src="{{asset('public/front_end/assets/img/images/sportsacademy.jpg')}}" class="img-fluid" class="img-responsive zoom">
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;">Sports Academy </h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>
							@endforeach
						@endif
						@if(!empty($alumni))
							 @foreach($alumni as $val)
						<div class="item wow fadeInLeft">
							<a href="{{url('cell/'.$val->id)}}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
									<img src="{{asset('public/front_end/assets/img/images/alumni.jpg')}}" class="img-fluid" class="img-responsive zoom">
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;"> Alumni</h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>
						@endforeach
						@endif
						@if(!empty($infrastructure))
							 @foreach($infrastructure as $val)
						<div class="item wow fadeInLeft">
							<a href="{{url('cell/'.$val->id)}}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
										<img src="{{asset('public/front_end/assets/img/images/academicinfra.jpg')}}" class="img-fluid" class="img-responsive zoom">
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;"> Academic Infrastructures</h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>
					</div>
				</div>
            @endforeach
						@endif
			<div class="row justify-content-center pt-20 wow tpfadeUp" data-wow-delay=".5s">
               <div class="col-12 text-center">
                  <div class="tp-testimonial-dot">
                  </div>
               </div>
            </div>
            </div>
    	   </div>
		   
		   
        </div>
	</div>

    </div>
	  <!-----area---->
	  
	    
	        <!-- fanfacet area  end -->
	  <div class="pt-120 pb-60 Studentbanner" style="border-bottom: 1px solid #248859;">
		<div class="container-fluid">
         <div class="progms-wrp-xb">
          <div class="containe-wd row">  
             
			 <div class="col-sm-12 col-sm-12 col-md-8 no-pad">
				<div class="c-prog">
					<div id="owl-demo5" class="owl-carousel owl-demo5 owl-theme" style="opacity: 1; display: block;">
					@if(!empty($iqac))
							 @foreach($iqac as $val)
						<div class="item wow fadeInLeft">
							<a href="{{url('cell/'.$val->id)}}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
									@if(!empty($val->picture))
<img src="{{url('public/uploads/cell/'.$val->picture)}}" class="img-fluid" class="img-responsive zoom"> </img>@else<img src="{{asset('front_end/assets/img/sliders/thumb1.jpg')}}" alt="img-fluid" class="img-responsive zoom"> </img> @endif 
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;">IQAC & NAAC</h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>
						@endforeach
						@endif
							
						 @if(!empty($nirf))
							 @foreach($nirf as $val)
						<div class="item wow fadeInLeft"> 
							<a href="{{url('cell/'.$val->id)}}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
									@if(!empty($val->picture))
<img src="{{url('public/uploads/cell/'.$val->picture)}}" class="img-fluid" class="img-responsive zoom"> </img>@else<img src="{{asset('front_end/assets/img/sliders/thumb4.jpg')}}" alt="img-fluid" class="img-responsive zoom"> </img> @endif 
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;"> NIRF</h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>
						 @endforeach
						@endif
						 @if(!empty($aishe))
							 @foreach($aishe as $val)
						<div class="item wow fadeInLeft">
							<a href="{{url('cell/'.$val->id)}}">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
								@if(!empty($val->picture))
<img src="{{url('public/uploads/cell/'.$val->picture)}}" class="img-fluid" class="img-responsive zoom"> </img>@else<img src="{{asset('front_end/assets/img/sliders/thumb4.jpg')}}" alt="img-fluid" class="img-responsive zoom"> </img> @endif 
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;"> AISHE</h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>
						 @endforeach
						@endif
						<!--<div class="item wow fadeInLeft">
							<a href="#">
							<div class="ac-itms-tcts">
								<div class="program-tct-color1" style=" border-bottom:3px solid #248859 !important;">
									<div class="prog-immg2">
										<img src="{{asset('front_end/assets/img/sliders/thumb4.jpg')}}" class="img-fluid" class="img-responsive zoom">
									</div>
									<div class="prog-immg3">
										<h4 style="color:#248859!important;">Policy Documents</h4>
									</div>
								</div>
						   </div>
						   </a>
						</div>-->
					
					</div>
				</div>
    	   </div>
		   <div class="col-lg-4 col-sm-12 col-md-4 ac-p-hd-sh1">
				  <div class="ac-hds">
					<div class="comn-hds4">
					<h1 class="wow fadeInRight"> Quality & Standards @ Asmabi</h1>
					</div>
					 <div class="btnview">
						<a href=""><ul>
							  <li>
								<i class="fas fa-play"></i>
							  </li>
						 </ul></a>
					   </div>
				   </div>
			 </div>
		   
        </div>
	</div>

    </div>
    </div>
	  <!-----area---->

<div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="padding: 9px;">
        <h4 class="modal-title" style="color:red;"><a href="#"> <i style="color:red;" class="fa fa-file-pdf" aria-hidden="true"></i> Download Prospectus </a></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
		<div class="modal-body" style="padding: 4px;">
          <img src="{{asset('front_end/assets/img/mesposter.jpg')}}" alt="" style="width: 100%;" class="img-fluid">
        </div>
    </div>
  </div>
</div>


@endsection




 <script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.1.js" type="text/javascript"></script>


 <script type="text/javascript">
    $(window).on('load', function() {
        $('#addmodal').modal('show');
    });
</script>
