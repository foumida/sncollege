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
                                <h3 class="breadcrumb__title">{{$type}}</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>{{$type}}</span>
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
                                            <div class="blog-content">
                                               

                                                <table class="table table-bordered" id="users-list">
                                                    <thead>
                                                        <tr>
                                                           
                                                            <th>TITLE</th>
															<th>DESCRIPTION</th>
															<th>FROM DATE</th>
															<th>TO DATE</th>
															<th>VENUE</th>
															<th>PICTURE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
													@if(!empty($eventslist))
					 @foreach($eventslist as $row)
                                                        <tr>
                                                           <td>{{$row->title}}</td>
                                                            <td>{{$row->description}}</td>
															<td>{{$row->from_date}}</td>
                                                            <td>{{$row->to_date}}</td>
															<td>{{$row->venue}}</td>
															@if(!empty($row->picture))<td><a class="image-popup-vertical-fit"  href="{{url('public/uploads/faculty/'.$row->picture)}}" >
													  <img src="{{url('public/uploads/faculty/'.$row->picture)}}" width = "50" height = "50" class="img-fluid"  />
													</a></td>@else <td></td>@endif															
                                                        </tr>

                                                     
                                                      @endforeach	
                                                      @endif		
                                                     
                                                    </tbody>
                                                </table>
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
			 
           
            <!-- about area end -->

@endsection