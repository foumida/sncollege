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
                                <h3 class="breadcrumb__title">Composition</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Composition</span>
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
                                            <h4>INTERNAL QUALITY ASSURANCE CELL (IQAC)</h4>
                                            <br />
                                            <table class="table table-bordered dataTable no-footer">
												<tbody>
												<tr>
													<td>Chairperson </td>
													<th>Dr. A Biju (Principal)</th>
												</tr>
												<tr>
													<td>Coordinator </td>
													<th>Dr. Shafeer P S</th>
												</tr>
												<tr>
													<td>NAAC Coordinator</td>
													<th>Dr.Amithabachan K H  </th>
												</tr>	
												<tr>
													<td>Joint Cordinator </td>
													<th>Dr. Sanand C Sadanadakumar  <br>
														Dr. Amitha P Mani  <br>
														Dr. Jisha K C  </th>
												</tr>		
												<tr>
													<td>Administrate Officers</td>
													<th>Smt. Nazeeha 	(Superintendent)  <br>
															Sri. Sadarudheen K A  </th>
												</tr>		
												<tr>
													<td>Teachers participation</td>
													<th>    Dr. Reena Mohamed P M <br>
															Dr. Sheena P A <br>
															Dr. Kesavan K K <br>
															Dr. Sefiya K M <br>
															Dr. Sumedhan K P <br>
															Dr. Ansar E B<br>
															Sri. Abdul Yafiz K. M <br>
															Smt. Shiji T. S </th>
												</tr>		
												<tr>
													<td>Member from management</td>
													<th>Adv. Navas Kattakath </th>
												</tr>		
												<tr>
													<td>Member from industry</td>
													<th>Sri. Habeeb Thangal (CEO, CTL Infocom Pvt. Limited, Oxford centre, Ravipuram, Kochi) </th>
												</tr>			
												<tr>
													<td>Member from society </td>
													<th>Smt. Krishnendu P.U (Ward member, Ward No. 21, S N Puram Panchayath)</th>
												</tr>
												<tr>
													<td>Members from students</td>
													<th> Sri. Jaseel P H (PhD Research scholar)<br>
															Miss. Nuhasin Banu (B.Com student)</th>
												</tr> 
												<tr>
													<td>Member from alumni 	</td>
													<th>Sri. Najeeb M K </th>
												</tr>
												<tr>
													<td>Criterion Heads</td>
													<th>    Smt. Sabitha M M (Criterion I)<br>
															Dr. Girija T P (Criterion II)<br>
															Dr. Dhanya P R (Criterion III)<br>
															Smt. Nasreen A (Criterion IV)<br>
															Smt. Nazeema M K (Criterion V)<br>
															Smt. Shiney CN (Criterion VI)<br>
															Sri. Mohammed Areej E M (Criterion VII)
													</th>
												</tr>
												<tbody>
											</table>
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



