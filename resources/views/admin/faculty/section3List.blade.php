
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
						     <div class="table-responsive">
							 @if(!empty($projects))
								<table class="table table-bordered">
									<p>Details of Internship, Apprenticeship, Industrial Visit, Study tour, OJT, Student Projects etc.</p>
									<thead>
										<tr>
											<th>Sl No</th>
											<th>Batch</th>
											<th>Programme</th>
											<th>Total no. of Student projects (Attach details separately)</th>
											<th>Total no. of Internship/Apprentice ship/ Industrial Visit/ OJT (Attach details separately)</th>
											<th>No of students not submitted report in time</th>
										</tr>
									</thead>
									<tbody>
									 <?php $i=1; ?>
                                    @foreach($projects as $data)
								  @foreach($data as $val)
										<tr>
											<td>{{$i}}</td>
											<td><input type="hidden" class="forms-control" id="pjbatch" name="pjbatch[]" value="{{$val->batch}}" >{{$val->batch}}</td>
											<td><input type="hidden" class="forms-control" id="pjpgm" name="pjpgm[]" value="{{$val->program}}" >{{$val->program}}</td>
											<td><input type="hidden" class="forms-control" id="prj" name="prj[]" value="{{$val->project}}" >{{$val->project}}</td>
											<td><input type="hidden" class="forms-control" id="industry" name="industry[]" value="{{$val->industry}}" >{{$val->industry}}</td>
											<td><span><input type="text" class="forms-control" id="notsubmit" name="notsubmit[]" ></span></td>

										</tr>
										<?php $i++; ?>
                                    @endforeach
									   @endforeach
									</tbody>
							</table>
							@endif
						</div>

						<div class="table-responsive">
						 @if(!empty($methods))
							<table class="table table-bordered">
							<p>Student Centric and Innovative teaching methods</p>
									<thead>
										<tr>
										<th>Sl No</th>
										 <th>Programme</th>
										<th>Student Centric teaching & Learning & Innovative methods introduced by the departments</th>
										
										</tr>
									</thead>
									<tbody>
									 <?php $i=1; ?>
                                    @foreach($methods as $data)
								  @foreach($data as $val)
										<tr>
										<td>{{$i}}</td>
										<td><input type="hidden" class="forms-control" id="teachpgm" name="teachpgm[]" value="{{$val->program}}" >{{$val->program}}</td>
										<td><input type="hidden" class="forms-control" id="teachmtd" name="teachmtd[]" value="{{$val->method}}" >{{$val->method}}</td>
										</tr>
										<?php $i++; ?>
                                    @endforeach
									   @endforeach
									</tbody>
							</table>
								@endif
						</div>

						<div class="table-responsive">
						 @if(!empty($scholarship))
							<table class="table table-bordered">
								<p>Scholarship, Freeship, Financial Support such as Lap Top, free uniform, Bus fee waiver, Hostel fee etcs</p>
								<thead>
									<tr>
									<th>Sl No</th>
									<th>Programme</th>
									<th>Batch</th>
									<th>Name of the scholarship, Free ship, Financial Support</th>
									<th>Number ofstudents Receiving</th>
									
									</tr>
								</thead>
								<tbody>
								 <?php $i=1; ?>
                                    @foreach($scholarship as $data)
								  @foreach($data as $val)
									<tr>
										<td>{{$i}}</td>
										<td><input type="hidden" class="forms-control" id="schpgm" name="schpgm[]" value="{{$val->program}}" >{{$val->program}}</td>
										<td><input type="hidden" class="forms-control" id="schbatch" name="schbatch[]" value="{{$val->batch}}" >{{$val->batch}}</td>
										<td><input type="hidden" class="forms-control" id="schname" name="schname[]" value="{{$val->scholarship_name}}" >{{$val->scholarship_name}}</td>
										<td><input type="hidden" class="forms-control" id="schcount" name="schcount[]" value="{{$val->studentcount}}" >{{$val->studentcount}}</td>
									</tr>
									<?php $i++; ?>
                                    @endforeach
									   @endforeach
								</tbody>
							</table>
							@endif
						</div>

						<div class="table-responsive">
							<table  id="ptaTable"  class="table table-bordered">
								<p> Details of Class PTA Conducted</p>
								<thead>
									<tr>
									<th>Sl No</th>
									<th>Programme</th>
									<th>Number of Class PTA Conducted with Dates</th>
									<th>Number of Parents Participated</th>
									<th>No of parents not participated</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td><span><input type="text" class="forms-control" id="ptaprogram" name="ptaprogram[]" ></span></td>
										<td><span><input type="text" class="forms-control" id="classconduct" name="classconduct" ></span></td>
										<td><span><input type="text" class="forms-control" id="parentspart" name="parentspart[]" ></span></td>
										<td><span><input type="text" class="forms-control" id="notparticipate" name="notparticipate[]" ></span></td>
									</tr>
								</tbody>
							</table>
							<button type="button" onclick="addRow()">Add Row</button>
						</div>
						<div class="table-responsive">
							<table id="ptaTable1"  class="table table-bordered">
							<p> Details of Department/Class Alumni Organised</p>
								<thead>
									<tr>
									<th>Sl No</th>
									<th>Dept./Class Alumni.</th>
									<th>Date</th>
									<th>Number of Alumni Participated</th>
									<th>Number of Faculty members participated</th>
									<th>Remarks including Alumni Support</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td><span><input type="text" class="forms-control" id="alprogram" name="alprogram[]" ></span></td>
										<td><span><input type="text" class="forms-control" id="aldate" name="aldate[]" ></span></td>
										<td><span><input type="text" class="forms-control" id="alpart" name="alpart[]" ></span></td>
										<td><span><input type="text" class="forms-control" id="facmem" name="facmem[]" ></span></td>
										<td><span><input type="text" class="forms-control" id="alrem" name="alrem[]" ></span></td>
									</tr>
								</tbody>
							</table>
								<button type="button" onclick="addRow1()">Add Row</button>
						</div>
						<p> Details of Placement and Recruitment drives (Both internal & External): <span><textarea id="placement_data" class="forms-control"name="placement_data" rows="4" cols="100">

</textarea></p>
						<div class="table-responsive">
						 @if(!empty($progression))
							<table class="table table-bordered">
								<p> Progression to Higher Studies</p>
								<thead>
									<tr>
									<th>Sl No</th>
									<th>Programme completed in the dept.</th>
									<th>Batch</th>
									<th>Progression</th>
									<th>Number of Students</th>
									<th>Remarks</th>
									
									</tr>
								</thead>
								<tbody>
							 <?php $i=1; ?>
                                    @foreach($progression as $data)
								  @foreach($data as $val)
									<tr>
										<td>{{$i}}</td>
										<td>{{$val->program}}</td>
										<td>{{$val->batch}}</td>
										<td>{{$val->category}}</td>
										<td>{{$val->studentcount}}</td>
										<td><span><input type="text" class="forms-control" id="program" name="program" ></span></td>
									</tr>
									<?php $i++; ?>
                                    @endforeach
									   @endforeach
								</tbody>
							</table>
							@endif
						</div>
						<div class="table-responsive">
							<table id="ptaTable2" class="table table-bordered">
							<p> Details of Competitive Exams (NET/SLET/SET/UPSC/PSC/Civil Service etc.)</p>
								<thead>
									<tr>
									<th>Sl No</th>
									<th>Name of Competitive Examination</th>
									<th>Number of Student Appeared</th>
									<th>Number of Students Selected with details</th>
									<th>Remarks</th>
									
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td><span><input type="text" class="forms-control" id="program" name="program" ></span></td>
										<td><span><input type="text" class="forms-control" id="program" name="program" ></span></td>
										<td><span><input type="text" class="forms-control" id="program" name="program" ></span></td>
										<td><span><input type="text" class="forms-control" id="program" name="program" ></span></td>
									</tr>
								</tbody>
								<button type="button" onclick="addRow2()">Add Row</button>
							</table>
						</div>

						

						<p> Details of Career guidance, Counselling Class, Soft skill training, Awareness Programmes offered : <span><textarea id="w3review" class="forms-control"name="w3review" rows="4" cols="100">

</textarea></span></p>
						<div class="table-responsive">
						 @if(!empty($ict))
							<table class="table table-bordered">
								<p>Usage of ICT/LMS by the Department</p>
								<thead>
									<tr>
										<th>Sl No</th>
										<th> Batch</th>
										<th>Programme</th>
										<th>Semester</th>
										<th>Name of the Teacher</th>
										<th>Type of ICT/E-resource</th>
										
									</tr>
								</thead>
								<tbody>
								 <?php $i=1; ?>
                                    @foreach($ict as $data)
								  @foreach($data as $val)
									<tr>
										<td>{{$i}}</td>
										<td>{{$val->batch}} </td>
										<td>{{$val->program}} </td>
										<td>{{$val->sem}}</td>
										<td>{{$val->faculty}} </td>
										<td>{{$val->title}}</td>
										
									</tr>
									<?php $i++; ?>
                                    @endforeach
									   @endforeach
								</tbody>
							</table>
							@endif
						</div>

					<p>Sports Achievements of the department (from University level onwards): <span><textarea id="w3review" class="forms-control"name="w3review" rows="4" cols="100">

</textarea></span></p>

					<p>Fine Arts and Literary Achievements of the department (from University level onwards): <span><textarea id="w3review" class="forms-control"name="w3review" rows="4" cols="100">

</textarea></p>
					<div class="table-responsive">
						<table class="table table-bordered">
							<p>Feed back system and Analysis</p>
							<thead>
								<tr>
								<th>Brief report of the Feed back system and Analysis</th>
								
								</tr>
							</thead>
								<tbody>
									<tr>
										<td><span>
										<textarea id="w3review" class="forms-control"name="w3review" rows="4" cols="100">

</textarea></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-success btn-block enter-btn" style="float:right;">Submit</button> 
			</form>
		   </div>
		   
		</div>
	</div>
</div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    document.getElementById('fupForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var form = e.target;
        var url = "{{ url('/hod/generateSection3')}}";

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

    var inputNames = ["ptaprogram[]", "classconduct[]", "parentspart[]", "notparticipate[]"];

    for (var i = 1; i <= 4; i++) {
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

    var inputNames = ["alprogram[]", "aldate[]", "alpart[]", "facmem[]", "alrem[]"];

    for (var i = 1; i <= 5; i++) {
        var cell = newRow.insertCell(i);
        var input = document.createElement("input");
        input.type = "text";
        input.className = "forms-control";
        input.name = inputNames[i - 1];
        cell.appendChild(input);
    }
}
	function addRow2() {
        var table = document.getElementById("ptaTable2").getElementsByTagName("tbody")[0];
        var newRow = table.insertRow(table.rows.length);

        var slNo = newRow.insertCell(0);
        slNo.innerHTML = table.rows.length;

        for (var i = 1; i <= 4; i++) {
            var cell = newRow.insertCell(i);
            var input = document.createElement("input");
            input.type = "text";
            input.className = "forms-control";
            input.name = "dynamicInput" + i;
            cell.appendChild(input);
        }
    }
</script>