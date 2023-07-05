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
                                <h3 class="breadcrumb__title">Objectives</h3>
                                <div class="breadcrumb__list">
                                    <span><a href="{{ route('index') }}">Home</a></span>
                                    <span class="dvdr"><i class="fa-regular fa-angle-right"></i></span>
                                    <span>Objectives</span>
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
                                            <h4>IQAC</h4>
                                            <p>
                                                Internal Quality Assurance Cell (IQAC) is the superlative body accommodating
                                                stakeholder representatives from all spheres of the institution. The cell is
                                                a compulsory set-up constituted as per the guidelines of National Assessment
                                                and Accreditation Council (NAAC) of UGC. The IQAC is a guide cum facilitator
                                                to point out and initiate critical areas of quality enhancement and
                                                sustenance. <br /><br />The NAAC’s advocacy of establishment of IQAC by
                                                every accredited institution as a post-accreditation measure is the first
                                                step towards institutionalization and internalization. IQAC got established
                                                in M.E.S. Asmabi College in 2004 i.e post-accreditation.
                                            </p>
                                        </div>
                                        <h5>Vision</h5>
                                        <p>
                                            To transform organizational and individual potential to create productive and
                                            responsible citizens.
                                        </p>
                                        <h5>Mission</h5>
                                        <p>
                                            To stimulate an academic environment for promotion of teaching- learning process
                                            and research. To channelize changes towards all round development of students
                                            through facilitation, community participation and sensitization to social and
                                            ethical issues.
                                        </p>
                                        <h5>Objectives</h5><br><br>
                                        <ul class="blog-details-list">
                                          <li> To develop realistic and attainable quality benchmarks for each of the academic and administrative activities</li> 
										<li>To keep the institution abreast of and abuzz with quality sustenance activities on a wide gamut of pertinent issues through Workshops / Seminars / Panel Discussions etc.</li>
										<li>To ensure continuous improvement in all the operational aspects of the college and assure its stakeholders of the accountability of the institution for its own qualityli>
										<li>To encourage the quest for learning and research.</li>
										<li>To bring efficient governance.</li>
										<li>To inculcate and spread social responsibility in the campus community.</li>
                                        </ul>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection