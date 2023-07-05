@extends('layouts.front_end.default')
@section('content')


            <!-- breadcrumb-area-end -->

	   <section class="breadcrumb__area include-bg breadcrumb__area breadcrumb__space"
                data-background="{{asset('front_end/assets/img/breadcrumb/breadcam-bg-1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content text-center p-relative z-index-1">
                                <h3 class="breadcrumb__title">All-Programmes</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Student Support</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->


            <!-- featured-courses -->
            <!-- blog-area -->
            <section class="blog-area gray-bg pt-80 pb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="classic-blog-post blog-details-wrap">
                                <div class="product-additional-tab">
                                   <ul class="nav nav-tabs" id="myTab" role="tablist">
									  <li class="nav-item" role="presentation">
										<button class="nav-links active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">UG</button>
									  </li>
									  <li class="nav-item" role="presentation">
										<button class="nav-links " id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">PG</button>
									  </li>
									</ul>
									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
											<div class="row no-gutters">
												<div class="col-lg-4 col-sm-4 col-xl-4 col-md-4">
													<div class="imgscrool text-center">
													   <div class='embed-container'>
															<iframe src="https://www.adventistchurchconnect.com/site/1/docs/test.pdf" width="100%" height="500px" style="border:0"></iframe>
														   </div>
													   <h3>B.Sc. Botany</h3>
													</div>
											    </div>
												<div class="col-lg-4 col-sm-4 col-xl-4 col-md-4">
													<div class="imgscrool text-center">
													   <div class='embed-container'>
															<iframe src="https://www.adventistchurchconnect.com/site/1/docs/test.pdf" width="100%" height="500px" style="border:0"></iframe>
														   </div>
													   <h3>B.Sc. Botany</h3>
													</div>
											    </div>
											    <div class="col-lg-4 col-sm-4 col-xl-4 col-md-4">
													<div class="imgscrool text-center">
													   <div class='embed-container'>
															<iframe src="https://www.adventistchurchconnect.com/site/1/docs/test.pdf" width="100%" height="500px" style="border:0"></iframe>
														   </div>
													   <h3>B.Sc. Botany</h3>
													</div>
											    </div>
											</div>
										  </div>
										  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
												<div class="row no-gutters">
												<div class="col-lg-4 col-sm-4 col-xl-4 col-md-4">
													<div class="imgscrool text-center">
													   <div class='embed-container'>
															<iframe src="https://www.adventistchurchconnect.com/site/1/docs/test.pdf" width="100%" height="500px" style="border:0"></iframe>
														   </div>
													   <h3>B.Sc. Botany</h3>
													</div>
											    </div>
												<div class="col-lg-4 col-sm-4 col-xl-4 col-md-4">
													<div class="imgscrool text-center">
													   <div class='embed-container'>
															<iframe src="https://www.adventistchurchconnect.com/site/1/docs/test.pdf" width="100%" height="500px" style="border:0"></iframe>
														   </div>
													   <h3>B.Sc. Botany</h3>
													</div>
											    </div>
											    <div class="col-lg-4 col-sm-4 col-xl-4 col-md-4">
													<div class="imgscrool text-center">
													   <div class='embed-container'>
															<iframe src="https://www.adventistchurchconnect.com/site/1/docs/test.pdf" width="100%" height="500px" style="border:0"></iframe>
														   </div>
													   <h3>B.Sc. Botany</h3>
													</div>
											    </div>
											</div>
										  </div>
									</div>
                                 </div>
                            </div>
                        </div>
                     </div>
                </div>
            </section>


<style>
.embed-container {
    position: relative;
    padding-bottom: 120.25%;
    height: 0;
    overflow: hidden;
    max-width: 100%;
    border: 3px solid #01005e8a;
    margin-top: 2rem;
    margin-bottom: 1rem;
}
.imgscrool h3 {
    font-size: 18px;
    margin-bottom: 1rem;
    color: black;
}
.embed-container iframe, .embed-container object, .embed-container embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}</style>


@endsection