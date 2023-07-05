
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
							
						<!--	<div class="table-responsive">
								<table class="table table-bordered">
									<p>4) Socio Economic Profile</p>
									<thead>
										<tr>
											<th>Sl No</th>
											<th>Programme (UG, PG etc)</th>
											<th>Batch</th>
											<th>Total No of boys</th>
											<th>Total No of students girls</th>
											<th>Minorities boys</th>
											<th>Minorities girls</th>
											<th>OBC boys</th>
											<th>OBC girls</th>
											<th>SC/ST boys</th>
											<th>SC/ST girls</th>
											<th>From Other state boys</th>
											<th>From Other state girls</th>
											<th>Divyangjan boys</th>
											<th>Divyangjan girls</th>
											<th>Transgender if any</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>UG</td>
											<td>I year</td>
											<td>6</td>
											<td>22</td>
											<td>0</td>
											<td>0</td>
											<td>4</td>
											<td>16</td>
											<td>0</td>
											<td>3</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
										</tr>
									</tbody>
								 </table>
							</div>-->
							<div class="table-responsive">
							 @if(!empty($data_programs))
								<table class="table table-bordered">
								<p> Programmes offered by the department (UG, PG, MPhil and PhD):</p>
									<thead>
										<tr>
											<th>Sl No</th>
											<th>Programme</th>
											<th>Batch</th>
											<th>No of Students Admitted</th>
											<th>Current Strength</th>
											<th>Student-Teacher Ratio</th>
											<th>Drop out ratio</th>
										</tr>
									</thead>
									<tbody>
									 <?php $i=1; ?>
                                    @foreach($data_programs as $val)
									 @foreach($val as $data)
										<tr>
											<td>{{$i}}</td>
											<td> <input type="hidden" class="forms-control" id="program" name="program[]" value="{{$data->program}}" >{{$data->program}}</td>
											<td> <input type="hidden" class="forms-control" id="batch" name="batch[]" value="{{$data->batch}}" >{{$data->batch}}</td>
											<td><input type="hidden" class="forms-control" id="stcount" name="stcount[]" value="{{$data->stcount}}" >{{$data->stcount}}</td>
											<td><span><input type="text" class="forms-control" id="current_strength" name="current_strength[]" ></span></td>
											<td><span><input type="text" class="forms-control" id="st_ratio" name="st_ratio[]" ></span></td>
											<td><span><input type="text" class="forms-control" id="drop_ratio" name="drop_ratio[]" ></span></td>
										</tr>
										 <?php $i++; ?>
                                    @endforeach
									  @endforeach
									</tbody>
								</table>
									@endif
							</div>	
							<div class="table-responsive">
							 @if(!empty($faculity_details))
								<table class="table table-bordered">
								<p>Faculty details including Guest/Visiting Faculty</p>
									<thead>
										<tr>
											<th>Sl No</th>
											<th>Name</th>
											<th>Permanent/ temporary/  Visiting</th>
											<th>Designation</th>
											<th>Qualification</th>
											<th>Experience</th>
										</tr>
									</thead>
									<tbody>
									 <?php $i=1; ?>
                                    @foreach($faculity_details as $val)
									
										<tr>
											<td>{{$i}}</td>
											<td><input type="hidden" class="forms-control" id="facname" name="facname[]" value="{{$val->name}}" >{{$val->name}}</td>
											<td><span><input type="text" class="forms-control" id="type" name="type[]" ></span></td>
											<td><input type="hidden" class="forms-control" id="facdesig" name="facdesig[]" value="{{$val->designation}}" >{{$val->designation}}</td>
											<td><input type="hidden" class="forms-control" id="highest_edu" name="highest_edu[]" value="{{$val->highest_edu}}" >{{$val->highest_edu}}</td>
											 <td><span><input type="text" class="forms-control" id="experience" name="experience[]" ></span></td>
										</tr>
										<?php $i++; ?>
                                    @endforeach
									 
									</tbody>
								</table>
								@endif
							</div>	
								<p> Number of teachers awarded Ph.D. during the year: <span><input type="text" class="forms-control" id="no_teachers" name="no_teachers" ></span></p>
								
								<p> No of teachers doing Ph.D.: <span><input type="text" class="forms-control" id="no_phd" name="no_phd" ></span></p>
								
								<p> Actual work load:<span><input type="text" class="forms-control" id="work_load" name="work_load" ></span></p>
								
								<p> Number of Sanctioned Teaching Posts:<span><input type="text" class="forms-control" id="teaching_post" name="teaching_post" ></span></p>
								
								<p> Current Vacancy:<span><input type="text" class="forms-control" id="current_vac" name="current_vac" ></span></p>
							<div class="table-responsive">
							@if(!empty($non_teaching))
								<table class="table table-bordered">
								<p> Details of Supporting Staff</p>
									<thead>
										<tr>
										<th>Sl No</th>
										<th>Name</th>
										<th>Qualification</th>
										<th>Designation</th>
										<th>Experience</th>
										<th>Permanent/Temporary</th>
										</tr>
									</thead>
									<tbody>
									<?php $i=1; ?>
                                    @foreach($non_teaching as $val)
										<tr>
											<td>{{$i}}</td>
											<td><input type="hidden" class="forms-control" id="teachname" name="teachname[]" value="{{$val->name}}" >{{$val->name}}</td>
											<td><span><input type="text" class="forms-control" id="qualification" name="qualification[]"></span></td>  
											<td><input type="hidden" class="forms-control" id="teacdesig" name="teacdesig[]" value="{{$val->designation}}" >{{$val->designation}}</td>
											<td><span><input type="text" class="forms-control" id="teachexperience" name="teachexperience[]" ></span></td>
											<td><input type="hidden" class="forms-control" id="aided_temp" name="aided_temp[]" value="{{$val->aided_temp}}" >{{$val->aided_temp}}</td>				
										</tr>
										<?php $i++; ?>
                                    @endforeach
									 
									</tbody>
								</table>
								@endif
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
        var url = "{{ url('/hod/generateSection1')}}";

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
<!--<script type="text/javascript">

$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{ url('/hod/generateSection1')}}",
            type: 'POST',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#fupForm').css("opacity",".5");
            },
            success: (response) => {
                if (response) {
                  
				//window.location.href = "{{ url('/faculty/methodologyList')}}";
                }
            },
        });
    });
});

 </script>-->
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