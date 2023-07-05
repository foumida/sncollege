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
                                <h3 class="breadcrumb__title">  @if(!empty($eventdata[0]->title)){{$eventdata[0]->title}}@endif</h3>
                                <div class="breadcrumb__list">
                                   <!-- <span><a href="#">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Green Initiative </span>-->
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
                                            <img src="" class="img-fluid" alt="">
                                        
                                        <br><br>
                                           
     @if(!empty($eventdata[0]->description))    <p class="text-justify">{{strip_tags( $eventdata[0]->description)}}
                                            </p>  @endif
                                            </div>
                                      
                                        
                                        <br><br>
                                      
                                    <div class="row">
                                        <div class="col-lg-12 mt-3 tblsecdet">
                                           <h4> Event Report</h4>
                                            <table class="table table-hover">
                                              <thead>
                                              
                                                <tr>
                                                   
                                                    <th>Download Report</th>
                                                </tr>
                                              
                                              </thead>
                                            <tbody> 
                                         
                                             <tr>
                                               @if(!empty($eventdata[0]->uploadfile))   
                                              <td><a href="{{url('public/uploads/facultyfile/'.$eventdata[0]->uploadfile)}}" download="" target="_blank">@if(!empty($eventdata[0]->uploadfile))<img src="{{asset('front_end/assets/img//pdf.png')}}" width="60px" height="auto">@endif</a></td>
										  @endif
                                             </tr>
                                           
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                
                                                        
                                    <br><br>
                                   <h4> Recent Activities</h4> 
                                       
                                    <div class="row"> 
                                  @if(!empty($events))									
                                    @foreach($events as $row)
                                        <div class="col-xl-4 col-lg-4 wow fadeInUp animated" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                    						<div class="card-box">
                        						<div class="card-text">
                        						   <div class="card-img recent-img">
                        						       <img src="{{url('public/uploads/faculty/'.$row->picture)}}" class="img-fluid" alt="#">
                        						   </div> 
                        						 
                        
                        					
                        						  <div class="card-btn">
                        							 <!-- <a href="#" class="btn btn-arrow">
                        								<i class="fa fa-arrow-right" aria-hidden="true"></i>
                        							  </a>-->
                        						  </div>
                        						</div>
                    					     </div>
                    					</div>
                    					@endforeach
										@endif
                                        @if(!empty($upcoming))
                                        <div class="col-xl-4 col-lg-4 wow fadeInUp animated" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                    						<div class="card-box">
                        						<div class="card-text">
                        						   <div class="card-img recent-img">
                        						       <img src="{{url('public/uploads/faculty/'.$upcoming[0]->picture)}}" class="img-fluid" alt="#">
                        						   </div> 
                        						
                        
                        						 
                        						  <div class="card-btn">
                        							 <!-- <a href="#" class="btn btn-arrow">
                        								<i class="fa fa-arrow-right" aria-hidden="true"></i>-->
                        							  </a>
                        						  </div>
                        						</div>
                    					     </div>
                    					</div>
                                        @endif
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