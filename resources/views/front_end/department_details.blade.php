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
                                <h3 class="breadcrumb__title">{{$department[0]->department}}</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Departments</span>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

            <!-- about area start -->
            <div class="tp-about__section-2 pt-50 pb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="classic-blog-post blog-details-wrap">
                                <div class="blog-content">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <img src="{{asset('front_end/assets/img/about-us/aboutmesbanner.jpg')}}" class="img-fluid" alt="">
                                        
                                        <br><br>
                                           
                                            <p class="text-justify">{!!$department[0]->descn!!}
                                            </p>
                                            </div>
                                        <div class="col-lg-12">
                                          <div class="row">
                                            @if(!empty($department[0]->vision))
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="seo-faq-cotent mb-30">
                                                    <div class="accordion tp-accordion" id="accordionExample">
                                                        <div class="accordion-item aos-init" data-aos="fade-up" data-aos-duration="1000">
                                                           <h2 class="accordion-header" id="faq1">
                                                              <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                                 data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                 Our Vision
                                                              </button>
                                                           </h2>
                                                           <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="faq1"
                                                              data-bs-parent="#accordionExample">
                                                              <div class="accordion-body">
                                                              {!! $department[0]->vision !!}
                                                              </div>
                                                           </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(!empty($department[0]->mission))
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="seo-faq-cotent mb-30">
                                                    <div class="accordion tp-accordion" id="accordionExample1">
                                                        <div class="accordion-item">
                                                           <h2 class="accordion-header" id="faq11">
                                                              <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                                 data-bs-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                                                                 Our Mission
                                                              </button>
                                                           </h2>
                                                           <div id="collapseOne1" class="accordion-collapse collapse show" aria-labelledby="faq11"
                                                              data-bs-parent="#accordionExample">
                                                              <div class="accordion-body">
                                                              {!!$department[0]->mission!!}
                                                              </div>
                                                           </div>
                                                        </div>    
                                                    </div>    
                                                </div>    
                                            </div>
                                            @endif    
                                        </div>    
                                    </div>    
                                        
                                        <br><br>
                                        @if(!empty($course))
                                    <div class="row">
                                        <div class="col-lg-12 mt-3 tblsecdet">
                                           <h4> PROGRAMME DETAILS</h4>
                                            <table class="table table-hover">
                                              <thead>
                                              
                                                <tr>
                                                    <td></td>
                                                    <th>Max Intake</th>
                                                    <th>Date of introduction</th>
                                                    <th>Download Syllabus</th>
                                                </tr>
                                              
                                              </thead>
                                            <tbody> 
                                            @foreach($course as $row) 
                                             <tr>
                                              <td><p>{{$row->course_type}} ({{$row->course_name}})</p></td>
                                              <td>{{$row->maxintake}}</td>
                                              <td>{{$row->date_of_intro}}</td>
                                             <!-- <td><a href="{{url('public/uploads/course/'.$row->syllabus)}}" download target="_blank">@if(!empty($row->syllabus))<img src="{{asset('front_end/assets/img//pdf.png')}}" width="60px" height="auto">@endif</a></td>-->
											  <td> 	@if(!empty($row->syllabus))<td><a href="{{url('public/uploads/course/'.$row->syllabus)}}">@if(!empty($row->syllabus))<img src="{{asset('front_end/assets/img//pdf.png')}}" width="60px" height="auto">@endif</a></td>@else <td></td>  @endif	</td>
                                             </tr>
                                             @endforeach
                                            
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif
                                        @if(!empty($faculity))
                                        <h4> Faculty: </h4>
                                        <div class="row mainperson pb-20 pt-20">
                                        @foreach($faculity as $row)
                                            <div class="col-lg-3 text-center tecyimag">
                                                @if(!empty($row->picture))
    											<img src="{{url('public/uploads/facultyimg/'.$row->picture)}}" class="img-fluid" alt="{{$row->name}}">
                                                @else
                                                <img src="{{url('public/uploads/images.png')}}" class="img-fluid" alt="{{$row->name}}">
                                                @endif
                                                <h4 class="mt-5">{{$row->name}}</h4>
    											<p>{{$row->designation}}</p>
												 @if(!empty($row->resume))<a style="float:Centre;" class="btn btn-info mb-2" href="{{url('public/uploads/facultyresume/'.$row->resume)}}">Resume</a> @endif
                                            </div>
                                            @endforeach
                                        </div>  
                                        @endif                                 
                                    <br><br>
                                   <h4> Recent Activities</h4> 
                                       
                                    <div class="row">  
                                    @foreach($events as $row)
                                        <div class="col-xl-4 col-lg-4 wow fadeInUp animated" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                    						<div class="card-box recentsec">
                        						<div class="card-text">
												  <div class="magnific-img card-img recent-img">
													<a class="image-popup-vertical-fit" href="{{url('public/uploads/faculty/'.$row->picture)}}" title="Event Image">
													  <img src="{{url('public/uploads/faculty/'.$row->picture)}}" class="img-fluid" alt="Event Image" />
													</a>
												  </div>
                        						  <div class="card-data">
                        							<p class="data-text">{{$row->from_date}}</p>
                        						  </div>
                        
                        						  <div class="card-title">
                        							<h3> {{$row->title}}</h3>
                        						  </div>
                        						  <div class="card-btn">
                        							 <a href="{{url('event_details/'.$deptid)}}" class="btn btn-arrow">
                        								<i class="fa fa-arrow-right" aria-hidden="true"></i>
                        							  </a>
                        						  </div>
                        						</div>
                    					     </div>
                    					</div>
                    					@endforeach
                                        @if(!empty($upcoming))
                                        <div class="col-xl-4 col-lg-4 wow fadeInUp animated" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                    						<div class="card-box recentsec">
                        						<div class="card-text">
												   <div class="magnific-img card-img recent-img">
													<a class="image-popup-vertical-fit" href="{{url('public/uploads/faculty/'.$upcoming[0]->picture)}}" title="upcoming Image">
													  <img src="{{url('public/uploads/faculty/'.$upcoming[0]->picture)}}" class="img-fluid" alt="upcoming Image" />
													</a>
												  </div>
                        						  <div class="card-data">
                        							<p class="data-text">{{$upcoming[0]->from_date}}</p>
                        						  </div>
                        
                        						  <div class="card-title">
                        							<h3> {{$upcoming[0]->title}}</h3>
                        						  </div>
                        						  <div class="card-btn">
                        							  <a href="{{url('event_details_upcoming/'.$deptid)}}" class="btn btn-arrow">
                        								<i class="fa fa-arrow-right" aria-hidden="true"></i>
                        							  </a>
                        						  </div>
                        						</div>
                    					     </div>
                    					</div>
                                        @endif
                    				</div>
                                      <div class="clear"></div>  
                                        
                                        
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
			.tecyimag img {
				width: 100%;
				height: 290px;
				border: 2px solid #248859;
				padding: 7px;
			}
			.tecyimag p {
				text-align: center !important;
				margin-left: 1.1rem;
				margin-top: -0.51rem;
			}
			</style>
			
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script>
$(document).ready(function(){
$('.image-popup-vertical-fit').magnificPopup({
  type: 'image',
  mainClass: 'mfp-with-zoom', 
  gallery:{
      enabled:true
    },

  zoom: {
    enabled: true, 

    duration: 300, // duration of the effect, in milliseconds
    easing: 'ease-in-out', // CSS transition easing function

    opener: function(openerElement) {

      return openerElement.is('img') ? openerElement : openerElement.find('img');
  }
}

});

});
</script>