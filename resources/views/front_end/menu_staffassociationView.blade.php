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
                                <h3 class="breadcrumb__title">Staff Association</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Staff Association</span>
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
                                    <div class="col-xxl-12">
									  <div class="abutmes">
										<h2>STAFF ASSOCIATION</h2>
									  </div> 
									  <div class="row">
										  <div class="col-lg-12 abtmestext text-center">
											<p>Staff club of MES Asmabi College is a platform of the teaching and non-teaching members of the college. The objective of the cell is to promote the cultural, literary and social activities of the staff members. The club used to arrange social gatherings like Iftar party, family meet, Onam, Christmas, new year celebrations etc. Competitions are arranged at regular intervals and prizes are distributed from time to time. <br></p>
											<div class="row">
												<div class="col-lg-3"></div>
												<div class="col-lg-3">
													<div class="squreimg text-center">
														<img src="{{asset('front_end/assets/img/management/sanand.jpg')}}" class="img-fluid" alt="">
														<h5>Dr Sanand Sadanandan</h5>
														<p>Secretary</p>
													</div>
												</div>
												<div class="col-lg-3">
													<div class="squreimg text-center">
														<img src="{{asset('front_end/assets/img/management/latheef.jpg')}}" class="img-fluid" alt="">
														<h5>Sri Lathif Penath</h5>
														<p>Jt. Secretary</p>
													</div>
												</div>
												<div class="col-lg-3"></div>
											</div>
											<p>The staff club arranges meetings on regular basis: starting from the very first day of the academic year to assign duties for the teaching staff, which continues until the end of the academic year. Meetings are organised to discuss all the important matters that are related to the teaching and non teaching staff and students. Staff club arranges a trip every year. It also arranges sent of meeting to retiring staff members by inviting all the retired staff of the college. The club warmly welcomes new members and recognises the outstanding achievements of the staff members by honouring them. The club collects a nominal amount from the teaching staff every month to meet the expenses of the activities. The account is kept transparent by sharing the income and expenditure details with the staff members. Various activities of the club helps to foster fraternal feeling among the members of the staff. The club is a grand success, since it is capable of creating a healthy and positive working atmosphere in the college, to maintain the emotional and physical well-being of the staff members.
											</p>
										  </div>
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


<style>
.squreimg img {
    border: 3px solid #111111b0;
    border-style: inset;
    box-sizing: border-box;
    display: inline-block;
    margin: 0px !important;
    border-color: #b9b9b9d6;
    border-width: 10px;
    text-align: center;
    color: white;
    line-height: 180px;
}
</style>