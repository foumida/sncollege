
@extends('layouts.hod.default')

@section('content')
       <div class="main-panel">
          <div class="content-wrapper">
			<div class="page-header">
			  <h3 class="page-title"> Section List </h3>
			</div>
                <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
						<div class="container">
						<p> Name of the Department : <span><input type="text" class="forms-control" id="department" name="department" ></span></p>
								
							<p> Year of Establishment  : <span><input type="text" class="forms-control" id="establishment" name="establishment" ></span></p>

							<p> Aided/Self Financing Specify: <span><input type="text" class="forms-control" id="category" name="category" ></span></p>
						<div class="row">
						<div class="col-xl-12 col-lg-12">
							<p>Curriculum design (New programme) and Restructuring of syllabi, if any : <span><input type="text" class="forms-control" id="curriculam" name="curriculam"></span></p>
							<!--14-->
							<p>Demand Ratio and Unit Cost  </p>

							<div class="table-responsive">
								<table id="ptaTable" class="table table-bordered">
									<thead>
										<tr>
											<tr>
												<th rowspan="2">Sl No</th>
												<th rowspan="2">Programme</th>
												<th rowspan="2">Unit Cost of Education</th>
												<th colspan="2">Admission Eligibility Mark % </th>
												<th rowspan="2">Demand Ratio</th>
											</tr>
											 <tr>
												<th>Top Rank </th>
												<th>Last Rank </th>
											 </tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td><span><input type="text" class="forms-control" id="demandprogram" name="demandprogram[]" ></span></td>
											<td><span><input type="text" class="forms-control" id="demandunitcost" name="demandunitcost[]" ></span></td>
											<td><span><input type="text" class="forms-control" id="toprank" name="toprank[]" ></span></td>
											<td><span><input type="text" class="forms-control" id="lastrank" name="lastrank[]" ></span></td>
											<td><span><input type="text" class="forms-control" id="demandratio" name="demandratio[]" ></span></td>
										</tr>
									</tbody>
								</table>
								<button type="button" onclick="addRow()">Add Row</button>
							</div>
							<br />
							<!--15-->
							<p> Details of Value Added Courses (Certificate, Diploma etc. ) Conducted by the department</p>
							<div class="table-responsive">
							 @if(!empty($addon))
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Sl No</th>
											
											<th>Value Added Courses (Certificate, Diploma etc. ) </th>
											<th>Curriculum designed by</th>
											<th>Duration</th>
											<th>Names of Faculty Engaged.</th>
											<th>Number of students participated</th>
										</tr>
									</thead>
									<tbody>
									 <?php $i=1; ?>
                                    @foreach($addon as $val)
								
										<tr>
											<td>{{$i}}</td>
											<td><input type="hidden" class="forms-control" id="val_add_course" name="val_add_course[]" value="{{$val->course_type}}-{{$val->course_name}}" >{{$val->course_type}}-{{$val->course_name}}</td>
											<td><span><input type="text" class="forms-control" id="designedby" name="designedby[]" ></span></td>
											<td><input type="hidden" class="forms-control" id="tenure" name="tenure[]" value="{{$val->tenure}}" >{{$val->tenure}} </td>
											<td><span><input type="text" class="forms-control" id="facultyeng" name="facultyeng[]" ></span></td>
											<td><span><input type="text" class="forms-control" id="stpart" name="stpart[]" ></span></td>
										</tr>
										<?php $i++; ?>
                                   
									   @endforeach
									</tbody>
								</table>
								@endif
							</div>
							<br />
							<!--16-->
							<p>Result Analysis</p>
							<div class="table-responsive">
							 @if(!empty($overall_marks))
								<table class="table table-bordered">
									<thead>
										<tr>
											<th rowspan="2">Sl No</th>
											<th rowspan="2">Programme</th>
											<th rowspan="2">Batch</th>
											<th rowspan="2">Semester</th>
											<th rowspan="2">Number of students appeared</th>
											<th rowspan="2">Number of students passed (Eligible For Higher Studies</th>
											<th rowspan="2">Percentage of pass</th>
											<th colspan="10">Grade</th>
											<th rowspan="2">Remarks</th>
										</tr>
										<tr>
											<th>P</th>
											<th>A+</th>
											<th>A</th>
											<th>B+</th>
											<th>B</th>
											<th>C</th>
											<th>D</th>
											<th>E</th>
											<th>O</th>
											<th>F</th>
										</tr>
									</thead>
									<tbody>
									 <?php $i=1; ?>
                                    @foreach($overall_marks as $data)
								  @foreach($data as $val)
										<tr>
											<td>{{$i}}</td>
											<td><input type="hidden" class="forms-control" id="overallpgm" name="overallpgm[]" value="{{$val->program}}" >{{$val->program}}</td>
											<td><input type="hidden" class="forms-control" id="overallbatch" name="overallbatch[]" value="{{$val->batch}}" >{{$val->batch}} </td>
											<td><input type="hidden" class="forms-control" id="overallsemester" name="overallsemester[]" value="{{$val->semester}}" >{{$val->semester}} </td>
											<td><input type="hidden" class="forms-control" id="total_students" name="total_students[]" value="{{$val->total_students}}" >{{$val->total_students}}</td>
											<td><input type="hidden" class="forms-control" id="total_pass_count" name="total_pass_count[]" value="{{$val->total_pass_count}}" >{{$val->total_pass_count}}</td>
											<td><input type="hidden" class="forms-control" id="pass_percentage" name="pass_percentage[]" value="{{$val->pass_percentage}}" >{{$val->pass_percentage}}% </td>
											<td><input type="hidden" class="forms-control" id="passed_grade" name="passed_grade[]" value="{{$val->passed_grade}}" >{{$val->passed_grade}} </td>
											<td><input type="hidden" class="forms-control" id="A_plus_count" name="A_plus_count[]" value="{{$val->A_plus_count}}" >{{$val->A_plus_count}} </td>
											<td><input type="hidden" class="forms-control" id="A_count" name="A_count[]" value="{{$val->A_count}}" >{{$val->A_count}}</td>
											<td><input type="hidden" class="forms-control" id="B_plus_count" name="B_plus_count[]" value="{{$val->B_plus_count}}" >{{$val->B_plus_count}}</td>
											<td><input type="hidden" class="forms-control" id="B_count" name="B_count[]" value="{{$val->B_count}}" >{{$val->B_count}} </td>
											<td><input type="hidden" class="forms-control" id="C_count" name="C_count[]" value="{{$val->C_count}}" >{{$val->C_count}}</td>
											<td><input type="hidden" class="forms-control" id="D_count" name="D_count[]" value="{{$val->D_count}}" >{{$val->D_count}}</td>
											<td><input type="hidden" class="forms-control" id="E_count" name="E_count[]" value="{{$val->E_count}}" >{{$val->E_count}}</td>
											<td><input type="hidden" class="forms-control" id="O_count" name="O_count[]" value="{{$val->O_count}}" >{{$val->O_count}}</td>
											<td><input type="hidden" class="forms-control" id="failed_grade" name="failed_grade[]" value="{{$val->failed_grade}}" >{{$val->failed_grade}}</td>
											<td><span><input type="text" class="forms-control" id="remarks" name="remarks[]" ></span></td>
										</tr>
											<?php $i++; ?>
                                    @endforeach
									   @endforeach
									</tbody>
								</table>
								@endif
							</div>
							<br />

								<!--17-->

								<p>Programme outcome details</p>
								<div class="table-responsive">
									<table class="table table-bordered" id="ptaTable6">
										<thead>
											<tr>
												<th>Sl No</th>
												<th>Programme</th>
												<th>Programme Outcome (PO)</th>
												<th>Programme Specific Outcome (PSO)</th>
												<th>Analysis
												</th>
											   
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td><span><input type="text" class="forms-control" id="pg" name="pg[]" ></span></td>
												<td><span><input type="text" class="forms-control" id="po" name="po[]" ></span></td>
												<td><span><input type="text" class="forms-control" id="pso" name="pso[]" ></span></td>
												<td><span><input type="text" class="forms-control" id="analysis" name="analysis[]" ></span></td>
												
											  </tr>
											</tbody>
										</table>
											<button type="button" onclick="addRow6()">Add Row</button>
									</div>
									<br />
									
									<p>Class engagement details of the department </p>
									<div class="table-responsive">
										<table class="table table-bordered" id="ptaTable7">
											<thead>
												<tr>
													<th>Sl No</th>
													<th>Course (including OC, courses for programmes of other departments)</th>
													<th>Semester</th>
													<th>Total hours allotted</th>
													<th>Total hours engaged</th>
													<th>Extra hours taken in addition to total allotted hours</th>
													<th>Remedial Classes taken</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td><span><input type="text" class="forms-control" id="course" name="course[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="semester" name="semester[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="tothours" name="tothours[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="toteng" name="toteng[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="extrahrs" name="extrahrs[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="remedial" name="remedial[]" ></span></td>
												</tr>
											</tbody>
										</table>
										<button type="button" onclick="addRow7()">Add Row</button>
									</div>
									<br />
									<!--18.b-->

									<!--20-->
									<p> Continuous Internal Evaluation Details </p>

									<div class="table-responsive">
										<table class="table table-bordered" id="ptaTable8">
											<thead>
												<tr>
													<th>Sl No</th>
													<th>Course (including courses for programmes of other departments)</th>
														<th>Semester</th>
													<th>No. of students having shortage of attendance</th>
													<th>No. of assignments given to each student </th>
													<th>No. of Seminars presented By Each student</th>
													<th>No. of Internal Examinations Conducted</th>
													<th>No. of Projects given</th>
													<th>No. of Students failed in internal evaluation</th>
													<th>No. of Students grievances received</th>
													<th>No. of grievances redressed</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td><span><input type="text" class="forms-control" id="continuouscourse" name="continuouscourse[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="csem" name="csem[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="attendance" name="attendance[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="assignments" name="assignments[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="Seminars" name="Seminars[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="Internal" name="Internal[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="Projects" name="Projects[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="evaluation" name="evaluation[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="grievances" name="grievances[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="redressed" name="redressed[]" ></span></td>
													
												</tr>
											</tbody>
										</table>
										<button type="button" onclick="addRow8()">Add Row</button>
									</div>
									<br />
									<!--20.b-->
									

									<p> Reforms introduced in Continuous Internal Evaluation (CIE)</p>
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>
														Brief description of Reforms introduced in Continues Internal Evaluation (CIE)
													</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<span><textarea class="forms-control" id="reforms" name="reforms" rows="4" cols="100">  </textarea></span>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<br />
									<!--22-->
									<p>Tutorial System</p>
									<div class="table-responsive">
										<table class="table table-bordered" id="ptaTable9">
											<thead>
												<tr>
													<th>Sl No</th>
													<th>Class</th>
													<th>Tutor</th>
													<th>Total No. of Tutorial Hours during the year</th>
													<th>Major Discussions in the Tutorial Hour</th>
													<th>Tutorial Report Submitted or Not</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td><span><input type="text" class="forms-control" id="class" name="class[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="tutor" name="tutor[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="tutorialhrs" name="tutorialhrs[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="discussions" name="discussions[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="report" name="report[]" ></span></td>
												</tr>
											</tbody>
										</table>
											<button type="button" onclick="addRow9()">Add Row</button>
									</div>
									<br />
									<!--23-->
									<p>Details of Bridge Courses Conducted and its Outcome</p>
									<div class="table-responsive">
										<table class="table table-bordered" id="ptaTable10">
											<thead>
												<tr>
												    <th>Sl No</th>
													<th>Class</th>
													<th>Total No of Classes Conducted </th>
													<th>No of students attended </th>
													<th>No of Students Benefitted</th>
													<th>Remarks</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
												    <td><span><input type="text" class="forms-control" id="bridgeclass" name="bridgeclass[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="bridgeclass_nos" name="bridgeclass_nos[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="st_attend" name="st_attend[]" ></span></td>
												    <td><span><input type="text" class="forms-control" id="st_benefit" name="st_benefit[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="brremarks" name="brremarks[]" ></span></td>
												</tr>
											</tbody>
										</table>
											<button type="button" onclick="addRow10()">Add Row</button>
									</div>
									<br />
									<!--24-->
									<p>Details of Remedial Classes conducted and its Outcome</p>
									<div class="table-responsive">
										<table class="table table-bordered" id="ptaTable5">
											<thead>
												<tr>
												   <th>Sl. No</th>
													<th>Class</th>
													<th>Total No of Classes Conducted </th>
													<th>No of students attended </th>
													<th>No of Students Benefitted</th>
													<th>Outcome</th>
												</tr>
											</thead>
											<tbody>
												<tr>
												<td>1</td>
													<td><span><input type="text" class="forms-control" id="remedialclass" name="remedialclass[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="totremedial" name="totremedial[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="remedialstudents" name="remedialstudents[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="studentsbenefit" name="studentsbenefit[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="outcome" name="outcome[]" ></span></td>
												</tr>
												
											</tbody>
											
										</table>
										<button type="button" onclick="addRow5()">Add Row</button>
									</div>
									<br />

									<!--25-->
									<p> Details of Programmes for Advanced Learners and Outcome</p>
									<div class="table-responsive">
										<table class="table table-bordered" id="ptaTable4">
											<thead>
												<tr>
													<th>Sl. No</th>
													<th>Programme</th>
													<th>No of students attended </th>
													<th>No of Students Benefitted</th>
													<th>Outcome</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td><span><input type="text" class="forms-control" id="advanceprogram" name="advanceprogram[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="advancest" name="advancest[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="advancebenefit" name="advancebenefit[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="advanceoutcome" name="advanceoutcome[]" ></span></td>
												</tr>
											</tbody>
										</table>
										<button type="button" onclick="addRow4()">Add Row</button>
									</div>
									<br />
									<!--26-->
									<p> Details of Programmes for Slow Learners and Outcome</p>
									<div class="table-responsive">
										<table class="table table-bordered" id="ptaTable3">
											<thead>
												<tr>
													<th>Sl. No</th>
													<th>Programme</th>
													<th>No of students attended </th>
													<th>No of Students Benefitted</th>
													<th>Outcome</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td><span><input type="text" class="forms-control" id="slowprogram" name="slowprogram[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="slowsts" name="slowsts[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="slowbenefit" name="slowbenefit[]" ></span></td>
													<td><span><input type="text" class="forms-control" id="slowoutcome" name="slowoutcome[]" ></span></td>
												</tr>
											</tbody>
										</table>
										<button type="button" onclick="addRow3()">Add Row</button>
									</div>
									<br />

									<!--39-->
									<p> Consultancy : <span><input type="text" class="forms-control" id="consultancy" name="consultancy"></span></p>

									<!--40-->
									<p> Details of Seminars, Workshops, FDP, Training Programmes, Skill enrichment programmes, Fests, camps, invited talks, Association
									activities etc. organised by the dept.</p>

									<div class="table-responsive">
									 @if(!empty($fdp))
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Sl. No</th>
													<th>Title of the programme</th>
													<th>Category</th>
													<th>Department</th>
													<th>Dates</th>
													<th>No of Participants</th>
													<th>From college</th>
													<th>From Outside</th>
													<th>Funding Agency With fund sanctioned</th>
													<th>Fund enerated from any other sources</th>
													<th>Total funds received</th>
													<th>Total expenditure</th>
												</tr>
											</thead>	
											 <tbody>
											 <?php $i=1; ?>
                                    @foreach($fdp as $val)
								
										<tr>
											<td>{{$i}}</td>
											<td><input type="hidden" class="forms-control" id="eventtitle" name="eventtitle[]" value="{{$val->title}}" >{{$val->title}}</td>
											<td><input type="hidden" class="forms-control" id="eventcat" name="eventcat[]" value="{{$val->category}}" >{{$val->category}}</td>
											<td><input type="hidden" class="forms-control" id="eventdept" name="eventdept[]" value="{{$val->department}}" >{{$val->department}}</td>
											<td><input type="hidden" class="forms-control" id="eventfromdate" name="eventfromdate[]" value="{{$val->from_date}}" >{{$val->from_date}}</td>
											<td><input type="hidden" class="forms-control" id="eventsts" name="eventsts[]" value="{{$val->no_students}}" >{{$val->no_students}}</td>
											<td><span><input type="text" class="forms-control" id="college" name="college[]" ></span></td>
											<td><span><input type="text" class="forms-control" id="outside" name="outside[]" ></span></td>
											<td><span><input type="text" class="forms-control" id="fundingagency" name="fundingagency[]" ></span></td>
											<td><span><input type="text" class="forms-control" id="othersource" name="othersource[]" ></span></td>
											<td><span><input type="text" class="forms-control" id="totfunds" name="totfunds[]" ></span></td>
											<td><span><input type="text" class="forms-control" id="totexp" name="totexp[]" ></span></td>
										</tr>
										<?php $i++; ?>
                                   
									   @endforeach
											</tbody>
										</table>
										@endif
									</div>

					   
									<!--41-->
									<p> Details of Extension/ Out-reach programmes organised: <span><input type="text" class="forms-control" id="outreach" name="outreach"></span></p>
									
									<!--42-->
									<p>Publications of Faculty in journals,Articles etc </p>

									<div class="table-responsive">
									 @if(!empty($journal))
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Sl. No</th>
													<th>Title </th>
													<th>Name of the Journal </th>
													<th>Type </th>
													<th>Department</th>
													<th>Impact Factor</th>
													<th>ISSN/ISBN No.</th>
													<th> Volume,Page No., Year</th>
													<th>Authorship</th>
												</tr>
											</thead>	
											<tbody>
											 <?php $i=1; ?>
                                    @foreach($journal as $val)
												<tr>
													<td>{{$i}}</td>
													<td><input type="hidden" class="forms-control" id="pubtitle" name="pubtitle[]" value="{{$val->title}}" >{{$val->title}}</td>
													<td><input type="hidden" class="forms-control" id="journalname" name="journalname[]" value="{{$val->journalname}}" >{{$val->journalname}}</td>
													<td><input type="hidden" class="forms-control" id="typepublication" name="typepublication[]" value="{{$val->typepublication}}" >{{$val->typepublication}}</td>
													<td><input type="hidden" class="forms-control" id="pubdept" name="pubdept[]" value="{{$val->department}}" >{{$val->department}}</td>
													<td><input type="hidden" class="forms-control" id="impactfactor" name="impactfactor[]" value="{{$val->impactfactor}}" >{{$val->impactfactor}}</td>
													<td><input type="hidden" class="forms-control" id="issn" name="issn[]" value="{{$val->issn}}" >{{$val->issn}}</td>
													<td><input type="hidden" class="forms-control" id="vol" name="vol[]" value="{{$val->volume}},{{$val->pages}},{{$val->year}}" >{{$val->volume}},{{$val->pages}},{{$val->year}}</td>
													<td><input type="hidden" class="forms-control" id="author" name="author[]" value="{{$val->author}}" >{{$val->author}}</td>
												</tr>
												<?php $i++; ?>
                                   
									   @endforeach
											</tbody>
										</table>
											@endif
									</div>     
		<p>Publications of Faculty in Books,Book Chapters etc</p>

									<div class="table-responsive">
									 @if(!empty($book))
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Sl. No</th>
													<th>Title </th>
													<th>Name of the Paper </th>
													<th>Type </th>
													<th>Department</th>
													<th>Impact Factor</th>
													<th>ISSN/ISBN No.</th>
													<th> Volume,Page No., Year</th>
													<th>Authorship</th>
												</tr>
											</thead>	
											<tbody>
											 <?php $i=1; ?>
                                    @foreach($book as $val)
												<tr>
													<td>{{$i}}</td>
													<td><input type="hidden" class="forms-control" id="booktitle" name="booktitle[]" value="{{$val->title}}" >{{$val->title}}</td>
													<td><input type="hidden" class="forms-control" id="papername" name="papername[]" value="{{$val->papername}}" >{{$val->papername}}</td>
													<td><input type="hidden" class="forms-control" id="booktype" name="booktype[]" value="{{$val->booktype}}" >{{$val->booktype}}</td>
													<td><input type="hidden" class="forms-control" id="bookdept" name="bookdept[]" value="{{$val->department}}" >{{$val->department}}</td>
													<td><input type="hidden" class="forms-control" id="bookfactor" name="bookfactor[]" value="{{$val->impactfactor}}" >{{$val->impactfactor}}</td>
													<td><input type="hidden" class="forms-control" id="bookissn" name="bookissn[]" value="{{$val->issn}}" >{{$val->issn}}</td>
													<td><input type="hidden" class="forms-control" id="bookvol" name="bookvol[]" value="{{$val->volume}},{{$val->pages}},{{$val->year}}" >{{$val->volume}},{{$val->pages}},{{$val->year}}</td>
													<td><input type="hidden" class="forms-control" id="bookauthor" name="bookauthor[]" value="{{$val->author}}" >{{$val->author}}</td>
												</tr>
												<?php $i++; ?>
                                   
									   @endforeach
											</tbody>
										</table>
											@endif
									</div> 
									<!--46-->
									<p> Faculty as Invited speaker/Resource persons/ Paper presenter etc.,
								
									<div class="table-responsive">
										<table class="table table-bordered" id="ptaTable2">
											<thead>
												<tr>
													<th>Sl. No</th>
													<th>Title of topic </th>
													<th>Details of Programme </th>
													<th>Name Of Faculty </th>
													<th>Date</th>
													<th>Organised by</th>
													<th>Invited Speaker/Resource person</th>
												</tr>
											</thead>	
											<tbody>
												<tr>
													<td>1</td>
													<td><input type="text" class="forms-control" id="topic" name="topic[]"></td>
													<td><input type="text" class="forms-control" id="speakerdept" name="speakerdept[]"></td>
													<td><input type="text" class="forms-control" id="namfac" name="namfac[]"></td>
													<td><input type="text" class="forms-control" id="datecon" name="datecon[]"></td>
													<td><input type="text" class="forms-control" id="organisedby" name="organisedby[]"></td>
													<td><input type="text" class="forms-control" id="resourseperson" name="resourseperson[]"></td>
												</tr>
											</tbody>
										</table>
										<button type="button" onclick="addRow2()">Add Row</button>
									</div>    

									<p>Any other relevant information: <span><input type="text" class="forms-control" id="name" name="name"></span></p>
						     </div>
					       </div>
					    </div>
					  </div>
				   </div>
				</div>
				<button type="submit" class="btn btn-success btn-block enter-btn" style="float:right;">Submit</button> 
			</form>
			</div>
		</div>
            
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    document.getElementById('fupForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var form = e.target;
        var url = "{{ url('/hod/generateSection2')}}";

        // Create a new FormData object and append form data to it
        var formData = new FormData(form);

        // Send an AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('POST', url);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.responseType = 'blob';

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Create a download link
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(xhr.response);
                link.download = 'generated_pdf.pdf';
                link.click();
            }
        };

        xhr.send(formData);
    });
</script>
@endsection


<style>
h6{
    font-size: 0.875rem;
    margin-top: 1rem !important;
}
p {
    font-size: 0.875rem;
    margin-top: 1rem !important;
}
div.dataTables_wrapper div.dataTables_length label {
    font-weight: normal;
    text-align: left !important;
    white-space: nowrap !important;
    color: #000 !important;
}
div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    margin-top: -48px !important;
    color: #000 !important;
}
div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 0.5em;
    display: inline-block;
    width: auto !important;
    padding: 8px !important;
}
</style>
<script>
    function addRow() {
    var table = document.getElementById("ptaTable").getElementsByTagName("tbody")[0];
    var newRow = table.insertRow(table.rows.length);

    var slNo = newRow.insertCell(0);
    slNo.innerHTML = table.rows.length;

    var inputNames = ["demandprogram[]", "demandunitcost[]", "toprank[]", "lastrank[]", "demandratio[]"];
    
    for (var i = 1; i <= 5; i++) {
        var cell = newRow.insertCell(i);
        var input = document.createElement("input");
        input.type = "text";
        input.className = "forms-control";
        input.name = inputNames[i - 1];
        cell.appendChild(input);
    }
}
	function addRow1() {
        var table = document.getElementById("ptaTable1").getElementsByTagName("tbody")[0];
        var newRow = table.insertRow(table.rows.length);

        var slNo = newRow.insertCell(0);
        slNo.innerHTML = table.rows.length;

        for (var i = 1; i <= 5; i++) {
            var cell = newRow.insertCell(i);
            var input = document.createElement("input");
            input.type = "text";
            input.className = "forms-control";
            input.name = "dynamicInput" + i;
            cell.appendChild(input);
        }
    }
	function addRow2() {
    var table = document.getElementById("ptaTable2").getElementsByTagName("tbody")[0];
    var newRow = table.insertRow(table.rows.length);

    var slNo = newRow.insertCell(0);
    slNo.innerHTML = table.rows.length;

    var inputNames = ["topic[]", "speakerdept[]", "namfac[]", "datecon[]", "organisedby[]", "resourseperson[]"];

    for (var i = 1; i <= 6; i++) {
        var cell = newRow.insertCell(i);
        var input = document.createElement("input");
        input.type = "text";
        input.className = "forms-control";
        input.name = inputNames[i - 1];
        cell.appendChild(input);
    }
}
	function addRow3() {
    var table = document.getElementById("ptaTable3").getElementsByTagName("tbody")[0];
    var newRow = table.insertRow(table.rows.length);

    var slNo = newRow.insertCell(0);
    slNo.innerHTML = table.rows.length;

    var inputNames = ["slowprogram[]", "slowsts[]", "slowbenefit[]", "slowoutcome[]"];

    for (var i = 1; i <= 4; i++) {
        var cell = newRow.insertCell(i);
        var input = document.createElement("input");
        input.type = "text";
        input.className = "forms-control";
        input.name = inputNames[i - 1];
        cell.appendChild(input);
    }
}
	function addRow4() {
    var table = document.getElementById("ptaTable4").getElementsByTagName("tbody")[0];
    var newRow = table.insertRow(table.rows.length);

    var slNo = newRow.insertCell(0);
    slNo.innerHTML = table.rows.length;

    var inputNames = ["advanceprogram[]", "advancest[]", "advancebenefit[]", "advanceoutcome[]"];

    for (var i = 1; i <= 4; i++) {
        var cell = newRow.insertCell(i);
        var input = document.createElement("input");
        input.type = "text";
        input.className = "forms-control";
        input.name = inputNames[i - 1];
        cell.appendChild(input);
    }
}
function addRow5() {
    var table = document.getElementById("ptaTable5").getElementsByTagName("tbody")[0];
    var newRow = table.insertRow(table.rows.length);

    var slNo = newRow.insertCell(0);
    slNo.innerHTML = table.rows.length;

    var inputNames = ["remedialclass[]", "totremedial[]", "remedialstudents[]", "studentsbenefit[]", "outcome[]"];

    for (var i = 1; i <= 5; i++) {
        var cell = newRow.insertCell(i);
        var input = document.createElement("input");
        input.type = "text";
        input.className = "forms-control";
        input.name = inputNames[i - 1];
        cell.appendChild(input);
    }
}
	function addRow6() {
    var table = document.getElementById("ptaTable6").getElementsByTagName("tbody")[0];
    var newRow = table.insertRow(table.rows.length);

    var slNo = newRow.insertCell(0);
    slNo.innerHTML = table.rows.length;

    var inputNames = ["pg[]", "po[]", "pso[]", "analysis[]"];

    for (var i = 1; i <= 4; i++) {
        var cell = newRow.insertCell(i);
        var input = document.createElement("input");
        input.type = "text";
        input.className = "forms-control";
        input.name = inputNames[i - 1];
        cell.appendChild(input);
    }
}
	function addRow7() {
    var table = document.getElementById("ptaTable7").getElementsByTagName("tbody")[0];
    var newRow = table.insertRow(table.rows.length);

    var slNo = newRow.insertCell(0);
    slNo.innerHTML = table.rows.length;

    var inputNames = ["course[]", "semester[]", "tothours[]", "toteng[]", "extrahrs[]", "remedial[]"];

    for (var i = 1; i <= 6; i++) {
        var cell = newRow.insertCell(i);
        var input = document.createElement("input");
        input.type = "text";
        input.className = "forms-control";
        input.name = inputNames[i - 1];
        cell.appendChild(input);
    }
}
	function addRow8() {
    var table = document.getElementById("ptaTable8").getElementsByTagName("tbody")[0];
    var newRow = table.insertRow(table.rows.length);

    var slNo = newRow.insertCell(0);
    slNo.innerHTML = table.rows.length;

    var inputNames = ["continuouscourse[]", "csem[]", "attendance[]", "assignments[]", "Seminars[]", "Internal[]", "Projects[]", "evaluation[]", "grievances[]", "redressed[]"];

    for (var i = 1; i <= 10; i++) {
        var cell = newRow.insertCell(i);
        var input = document.createElement("input");
        input.type = "text";
        input.className = "forms-control";
        input.name = inputNames[i - 1];
        cell.appendChild(input);
    }
}
	function addRow9() {
    var table = document.getElementById("ptaTable9").getElementsByTagName("tbody")[0];
    var newRow = table.insertRow(table.rows.length);

    var slNo = newRow.insertCell(0);
    slNo.innerHTML = table.rows.length;

    var inputNames = ["class[]", "tutor[]", "tutorialhrs[]", "discussions[]", "report[]"];

    for (var i = 1; i <= 5; i++) {
        var cell = newRow.insertCell(i);
        var input = document.createElement("input");
        input.type = "text";
        input.className = "forms-control";
        input.name = inputNames[i - 1];
        cell.appendChild(input);
    }
}
	function addRow10() {
    var table = document.getElementById("ptaTable10").getElementsByTagName("tbody")[0];
    var newRow = table.insertRow(table.rows.length);

    var slNo = newRow.insertCell(0);
    slNo.innerHTML = table.rows.length;

    var inputNames = ["bridgeclass[]", "bridgeclass_nos[]", "st_attend[]", "st_benefit[]", "brremarks[]"];

    for (var i = 1; i <= 5; i++) {
        var cell = newRow.insertCell(i);
        var input = document.createElement("input");
        input.type = "text";
        input.className = "forms-control";
        input.name = inputNames[i - 1];
        cell.appendChild(input);
    }
}
</script>