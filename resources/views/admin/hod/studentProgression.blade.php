@if(Auth::User()->role == 6)
   @php $type = "layouts.hod.default";
      $deletmarks =    url('hod/deleteMarks'); 
     $deleteExternalMarks=url('/hod/deleteExternalMarks');
      $deleteOverallMarks=url('/hod/deleteOverallMarks');
      $deleteProjectMarks=url('/hod/deleteProjectMarks');
      $deleteIndustryMarks=url('/hod/deleteIndustryMarks');
     $updateExternalMarks= url('/hod/updateExternalMarks');
     $updateInternalMarks= url('/hod/updateInternalMarks');
     $updateOverallMarks = url('/hod/updateOverallMarks');
     $saveInternalMarks = url('/hod/saveInternalMarks');
     $editfetchExternalMarks = url('/hod/editfetchmarks_external');
     $fetchOverall= url('/hod/editfetchmarks_Overall');
     $editFetchMarks =url('/hod/editfetchmarks');
     $autocompleteSearch = url('/hod/autocompleteSearch');
     $saveExternalMarks = url('/hod/saveExternalMarks');
     $saveOverallMarks= url('/hod/saveOverallMarks');
     $saveProjectMarks = url('/hod/saveProjectMarks');
     $saveIndustryMarks = url('/hod/saveIndustryMarks');
     $fetchPapername= url('/hod/fetchPapername');
     
 @endphp   
    @elseif(Auth::User()->role == 2)
  
  @php $type = "layouts.faculty.default";
    $deletmarks =    url('faculty/deleteMarks'); 
     $deleteExternalMarks=url('/faculty/deleteExternalMarks');
      $deleteOverallMarks=url('/faculty/deleteOverallMarks');
      $deleteProjectMarks=url('/faculty/deleteProjectMarks');
      $deleteIndustryMarks=url('/faculty/deleteIndustryMarks');
     $updateExternalMarks= url('/faculty/updateExternalMarks');
     $updateInternalMarks= url('/faculty/updateInternalMarks');
     $updateOverallMarks = url('/faculty/updateOverallMarks');
     $saveInternalMarks = url('/faculty/saveInternalMarks');
     $editfetchExternalMarks = url('/faculty/editfetchmarks_external');
     $fetchOverall= url('/faculty/editfetchmarks_Overall');
     $editFetchMarks =url('/faculty/editfetchmarks');
     $autocompleteSearch = url('/faculty/autocompleteSearch');
     $saveExternalMarks = url('/faculty/saveExternalMarks');
     $saveOverallMarks= url('/faculty/saveOverallMarks');
     $saveProjectMarks = url('/faculty/saveProjectMarks');
     $saveIndustryMarks = url('/faculty/saveIndustryMarks');
     $fetchPapername= url('/faculty/fetchPapername');
 @endphp
 @endif
@extends($type)

@section('content')
<style>
label {
    font-size: 0.875rem;
    margin-top: 0.5rem;
    font-weight: 400;
    color:#fff;
}
div.scrollmenu {
  background-color:transparnt;
  overflow: auto;
  white-space: nowrap;
}
.form-controls, .asColorPicker-input, .dataTables_wrapper select, .jsgrid .jsgrid-table .jsgrid-filter-row input[type=text], .jsgrid .jsgrid-table .jsgrid-filter-row select, .jsgrid .jsgrid-table .jsgrid-filter-row input[type=number], .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--single .select2-search__field, .typeahead, .tt-query, .tt-hint {
    display: block;
    width: 13.8rem !improtant;
    height: 2.875rem;
    padding: 0.56rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #f5f9fc !important;
    background-color: #2A3038;
    background-clip: padding-box;
    border: 1px solid #2c2e33;
    border-radius: 2px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
</style>
         <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="row">
             
              
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h1 class="card-title">Student Progression</h1>
                    <div id="mainform">
                    <section id="section-linetriangle-3">
                    <h6 class="box-title"> Internal Marks Main</h6>
                    <span class="text-success" id="skilladd"></span>
                    <span class="text-danger" id="skillfail"></span>
                    
               <div class="row">
                    <input type="hidden" name="student_id" id="skill_student_id" value=""/>
             <div class="scrollmenu">                                 
                <table class="table skils">
                     <thead>
                          <tr>
                          
                            <th style="width: auto;"> Program</th>
							 <th style="width: auto;"> Batch</th>
							 <th style="width: auto;"> Student Name</th>
							 <th style="width: auto;"> Semester</th>
							 <th style="width: auto;"> Name of Paper</th>
							 <th style="width: auto;"> Paper Code</th>
							  <th style="width: auto;"> Assignment</th>
							 <th style="width: auto;">Seminar</th>
							  <th style="width: auto;"> Test</th>
							 <th style="width: auto;">Others</th>
							   <th style="width: auto;"> Sum</th>
							 <th style="width: auto;">Internal Grade</th>
							  <th style="width: auto;">Percentage</th>
							   <th style="width: auto;">Overall GradePoint</th>
                            <th> Action</th>
                            
                          </tr>
                        </thead>
                    <tbody>
                    @if(count($internalmarks)>0)
               
                         @foreach($internalmarks as $val) 
                        <tr id="skillrow_{{$val->id}}"">
                            <td style="width: auto;"> @if(!empty($val->program))  {{ $val->program }}  @endif </td>
                            <td style="width: auto;"> @if(!empty($val->batch))  {{ $val->batch }}  @endif</td>
                            <td style="width: auto;"> @if(!empty($val->stname))  {{ $val->stname }}  @endif </td>
                             <td style="width: auto;"> @if(!empty($val->Semester))  {{ $val->Semester }}  @endif </td>
                            <td style="width: auto;"> @if(!empty($val->name_of_paper))  {{ $val->name_of_paper }}  @endif</td>
                            <td style="width: auto;"> @if(!empty($val->paper_code))  {{ $val->paper_code }}  @endif </td>
                            <td style="width: auto;"> @if(!empty($val->assignment))  {{ $val->assignment }}  @endif</td>
                            <td style="width: auto;"> @if(!empty($val->seminar))  {{ $val->seminar }}  @endif</td>
                              <td style="width: auto;"> @if(!empty($val->test))  {{ $val->test }}  @endif</td>
                             <td style="width: auto;"> @if(!empty($val->others))  {{ $val->others }}  @endif</td>
                               <td style="width: auto;"> @if(!empty($val->sum))  {{ $val->sum }}  @endif</td>
                                 <td style="width: auto;"> @if(!empty($val->internalgrade))  {{ $val->internalgrade }}  @endif</td>
                                  <td style="width: auto;"> @if(!empty($val->percent))  {{ $val->percent }}   @endif</td>
                                   <td style="width: auto;"> @if(!empty($val->grade_point))  {{ $val->grade_point }} @endif</td>
                            <td><button class="btn btn-danger" onclick="removeSkillEdit({{$val->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button><button class="btn btn-danger" onclick="editSkillEdit({{$val->id}})" data-toggle="modal" data-target="#ajaxModel"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>                     
                        </tr>
                           @endforeach
                    
                        @endif
                        <tr>  
                            <td >
                                
                                <input type="text" id="program" name="program" value="{{$program}}"  class="form-controls" />
                               
                            </td>
                               <td>
                                
                                <input type="text" id="batch" name="batch" value="{{$batch}}" class="form-controls" />
                               
                            </td>
                            <td>
                                
                                <input type="text" id="stname" name="stname" value="{{$name}}" class="form-controls" />
                                <input type="hidden" id="stid" name="stid" value="{{$id}}"  />
                            </td>
                            <td>
                                
                                <select  id="Semester" name="Semester" class="form-controls">
                                <option value="" >Select Semester</option>    
                                <option value="Semester 1" >Semester 1</option>
                                <option value="Semester 2" >Semester 2</option>
                                <option value="Semester 3" >Semester 3</option>
                                <option value="Semester 4" >Semester 4</option>
                                <option value="Semester 5" >Semester 5</option>
                                <option value="Semester 6" >Semester 6</option>
                                <option value="Semester 7" >Semester 7</option>
                                <option value="Semester 8" >Semester 8</option>
                                <option value="Semester 9" >Semester 9</option>
                                <option value="Semester 10" >Semester 10</option>
                                </select>
                                <span id="Semester_Err" class="text-danger"></span> 
                            </td>
                            <td>
                               <select class="form-controls" name="name_of_paper" id="name_of_paper">
            										<option value="">Select Paper</option>
            										@foreach($papername as $row)
            								            <option value="{{ $row->p_name }}">{{ $row->p_name }}</option>
            						            	@endforeach
            									</select>
                    
                                <span id="name_of_paper_nameErr" class="text-danger"></span>
                               
                            </td>
                             <td>
                              <select class="form-controls" name="paper_code" id="paper_code">
            										<option value="">Select Paper Code</option>
            										@foreach($papercode as $row)
            								            <option value="{{ $row->p_code }}">{{ $row->p_code }}</option>
            						            	@endforeach
            									</select>
                             
                                <span id="paper_code_nameErr" class="text-danger"></span>
                               
                            </td>
                            
                             <td>
                              
                                <input type="text" id="assignment" name="assignment"  onChange="sum();" class="form-controls" Placeholder="Enter Assignment Marks"/>
                                <span id="assignment_nameErr" class="text-danger"></span>
                               
                            </td>
                             <td>
                              
                                <input type="text" id="seminar" name="seminar" onChange="sum();"  class="form-controls" Placeholder="Enter Seminar Marks" />
                                <span id="seminar_nameErr" class="text-danger"></span>
                               
                            </td>
                             <td>
                              
                                <input type="text" id="test" name="test"  onChange="sum();" class="form-controls" Placeholder="Enter Test Marks"/>
                                <span id="test_nameErr" class="text-danger"></span>
                               
                            </td>
                               <td>
                              
                                <input type="text" id="others" name="others" onChange="sum();"  class="form-controls" Placeholder="Enter Other Marks"/>
                                <span id="others_nameErr" class="text-danger"></span>
                               
                            </td>
                            
                             <td>
                              
                                <input type="text" id="sum" name="sum" class="form-controls sum" />
                                <span id="sum_nameErr" class="text-danger"></span>
                               
                            </td>
                             <td>
                              
                                <input type="text" id="maxmarks" name="maxmarks"  onChange="percentage();" class="form-controls" Placeholder="Enter Maxi Marks"/>
                                <span id="maxmarks_nameErr" class="text-danger"></span>
                               
                            </td>
                            <td>
                              
                                <select  id="internalgrade" name="internalgrade" class="form-controls">
                                <option value="" >Select Internal Grade </option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                <option value="FAILED" >FAILED</option>
                                </select>
                                <span id="internalgradeErr" class="text-danger"></span>
                               
                            </td>
                               <td>
                              
                               <input type="text" id="percent" name="percent" class="form-controls" />
                                <span id="percentErr" class="text-danger"></span>
                               
                            </td>
                             <td>
                              <label>(PASSED/FAILED/ABSENT/GRADEPOINT)</label>
                               <input type="text" id="gradepoint" name="gradepoint" class="form-controls" />
                                <span id="gradepointErr" class="text-danger"></span>
                               
                            </td>
                            <td>
                                <button class="btn btn-info" id="butsaveSkill">Save</button>
                            </td>
                        </tr>
                        </tbody>
                        </table>
                        </div> 
                        </div> <br> <br> <br> <br>
                        <hr>                    
                        <h6 class="box-title">Internal Marks Complimntery OR Language Papers</h6>
                    <span class="text-success" id="complimentadd"></span>
                    <span class="text-danger" id="complimentfail"></span>
            
             <div class="scrollmenu">                                 
                <table class="table compliment">
                     <thead>
                          <tr>
                          
                            <th> Program</th>
							 <th> Batch</th>
							 <th> Student Name</th>
							 <th> Semester</th>
							    <th> Type</th>
							 <th> Name of Paper</th>
							 <th> Paper Code</th>
							  <th> Assignment</th>
							 <th>Seminar</th>
							  <th> Test</th>
							 <th>Others</th>
							   <th> Sum</th>
							 <th>Internal Grade</th>
							  <th>Percentage</th>
							   <th>Overall GradePoint</th>
                            <th> Action</th>
                            
                          </tr>
                        </thead>
                    <tbody>
                    @if(count($commarks)>0)
               
                         @foreach($commarks as $val) 
                        <tr id="complimentrow_{{$val->id}}"">
                            <td style="width: 45%;"> @if(!empty($val->program))  {{ $val->program }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($val->batch))  {{ $val->batch }}  @endif</td>
                            <td style="width: 45%;"> @if(!empty($val->stname))  {{ $val->stname }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($val->Semester))  {{ $val->Semester }}  @endif </td>
                               <td style="width: 45%;"> @if(!empty($val->type))  {{ $val->type }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($val->name_of_paper))  {{ $val->name_of_paper }}  @endif</td>
                            <td style="width: 45%;"> @if(!empty($val->paper_code))  {{ $val->paper_code }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($val->assignment))  {{ $val->assignment }}  @endif</td>
                            <td style="width: 40%;"> @if(!empty($val->seminar))  {{ $val->seminar }}  @endif</td>
                              <td style="width: 40%;"> @if(!empty($val->test))  {{ $val->test }}  @endif</td>
                             <td style="width: 40%;"> @if(!empty($val->others))  {{ $val->others }}  @endif</td>
                               <td style="width: 40%;"> @if(!empty($val->sum))  {{ $val->sum }}  @endif</td>
                                 <td style="width: 40%;"> @if(!empty($val->internalgrade))  {{ $val->internalgrade }}  @endif</td>
                                  <td style="width: 40%;"> @if(!empty($val->percent))  {{ $val->percent }}   @endif</td>
                                    <td style="width: 40%;"> @if(!empty($val->grade_point))  {{ $val->grade_point }}   @endif</td>
                            <td><button class="btn btn-danger" onclick="removeComplimentEdit({{$val->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button><button class="btn btn-danger" onclick="editSkillEdit({{$val->id}})" data-toggle="modal" data-target="#ajaxModel"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>                     
                        </tr>
                           @endforeach
                    
                        @endif
                        <tr>  
                            <td >
                                
                                <input type="text" id="programcompliment" name="programcompliment" value="{{$program}}"  class="form-controls" />
                               
                            </td>
                               <td>
                                
                                <input type="text" id="batchcompliment" name="batchcompliment" value="{{$batch}}" class="form-controls" />
                               
                            </td>
                            <td>
                                
                                <input type="text" id="stnamecompliment" name="stnamecompliment" value="{{$name}}" class="form-controls" />
                                <input type="hidden" id="stidcompliment" name="stidcompliment" value="{{$id}}"  />
                            </td>
                            <td>
                                
                                <select  id="Semestercompliment" name="Semestercompliment" class="form-controls">
                                <option value="" >Select Semester</option>    
                                <option value="Semester 1" >Semester 1</option>
                                <option value="Semester 2" >Semester 2</option>
                                <option value="Semester 3" >Semester 3</option>
                                <option value="Semester 4" >Semester 4</option>
                                <option value="Semester 5" >Semester 5</option>
                                <option value="Semester 6" >Semester 6</option>
                                <option value="Semester 7" >Semester 7</option>
                                <option value="Semester 8" >Semester 8</option>
                                <option value="Semester 9" >Semester 9</option>
                                <option value="Semester 10" >Semester 10</option>
                                </select>
                                <span id="Semestercompliment_Err" class="text-danger"></span> 
                            </td>
                             <td>
                                
                                <select  id="typecompliment" name="typecompliment" class="form-controls">
                                <option value="" >Select Type</option>    
                                <option value="Complimentery" >Complimentery</option>
                                <option value="firstlanguage" >First Language</option>
                                <option value="secondlanguage" >Second Language</option>
                                
                                </select>
                                <span id="typecompliment_Err" class="text-danger"></span> 
                            </td>
                            <td>
                               <select class="form-controls" name="name_of_paper_compliment" id="name_of_paper_compliment">
            										<option value="">Select Paper</option>
            										
            									</select>
                    
                                <span id="name_of_paper_compliment_nameErr" class="text-danger"></span>
                               
                            </td>
                             <td>
                              <select class="form-controls" name="paper_code_compliment" id="paper_code_compliment">
            										<option value="">Select Paper Code</option>
            									
            									</select>
                             
                                <span id="paper_code_compliment_nameErr" class="text-danger"></span>
                               
                            </td>
                             <td>
                              
                                <input type="text" id="assignment_compliment" name="assignment_compliment"  onChange="sumcompliment();" class="form-controls" Placeholder="Enter Assignment Marks"/>
                                <span id="assignment_compliment_nameErr" class="text-danger"></span>
                               
                            </td>
                             <td>
                              
                                <input type="text" id="seminar_compliment" name="seminar_compliment" onChange="sumcompliment();"  class="form-controls" Placeholder="Enter Seminar Marks" />
                                <span id="seminar_compliment_nameErr" class="text-danger"></span>
                               
                            </td>
                             <td>
                              
                                <input type="text" id="test_compliment" name="test_compliment"  onChange="sumcompliment();" class="form-controls" Placeholder="Enter Test Marks"/>
                                <span id="test_compliment_nameErr" class="text-danger"></span>
                               
                            </td>
                               <td>
                              
                                <input type="text" id="others_compliment" name="others_compliment" onChange="sumcompliment();"  class="form-controls" Placeholder="Enter Other Marks"/>
                                <span id="others_compliment_nameErr" class="text-danger"></span>
                               
                            </td>
                             <td>
                              
                                <input type="text" id="sum_compliment" name="sum_compliment" class="form-controls" />
                                <span id="sum_compliment_nameErr" class="text-danger"></span>
                               
                            </td>
                            <td>
                              
                                <input type="text" id="maxmarks_compliment" name="maxmarks_compliment"  onChange="percentageCompliment();" class="form-controls" Placeholder="Enter Maxi Marks"/>
                                <span id="maxmarks_compliment_nameErr" class="text-danger"></span>
                               
                            </td>
                            <td>
                              
                                <select  id="internalgrade_compliment" name="internalgrade_compliment" class="form-controls">
                                <option value="" >Select Internal Grade </option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                <option value="FAILED" >FAILED</option>
                                </select>
                                <span id="internalgradecomplimentErr" class="text-danger"></span>
                               
                            </td>
                               <td>
                              
                               <input type="text" id="percent_compliment" name="percent_compliment" class="form-controls" />
                                <span id="percentcomplimentErr" class="text-danger"></span>
                               
                            </td>
                            <td>
                              <label>(PASSED/FAILED/ABSENT/GRADEPOINT)</label>
                               <input type="text" id="gradepointcompliment" name="gradepointcompliment" class="form-controls" />
                                <span id="gradepointErrcompliment" class="text-danger"></span>
                               
                            </td>
                            <td>
                                <button class="btn btn-info" id="butsavecompliment">Save</button>
                            </td>
                        </tr>
                        </tbody>
                        </table>
                        </div> 
                         <br> <br> <br> <br>
                        <hr>
                  <h6 class="box-title"> External Marks Main</h6>
                  <span class="text-success" id="experienceadd"></span>
                  <span class="text-danger" id="experiencefail"></span>
                  <div class="scrollmenu">  
                  <table class="table table-borderless experience">
                      <thead>
                          <tr>
                              <th> Program</th>
							 <th> Batch</th>
							 <th> Student Name</th>
						
							 <th> Semester</th>
							 <th> Name of Paper</th>
							 <th> Paper Code</th>
							  <th> Credits</th>
							 <th>External Grade</th>
							  <th> Internal Grade</th>
							 <th>Total Grade</th>
							   <th> Credit Point</th>
							 <th>Status</th>
							  
                            <th> Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if(count($externalmarks)>0)
                    @php $i=1; @endphp
                    
                        @foreach($externalmarks as $exp_val)
                        <tr id="experienceinfo_{{$exp_val->id}}">
                            <td style="width: 45%;"> @if(!empty($exp_val->program))  {{ $exp_val->program }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($exp_val->batch))  {{ $exp_val->batch }}  @endif</td>
                            <td style="width: 45%;"> @if(!empty($exp_val->stname))  {{ $exp_val->stname }}  @endif </td>
                          
                             <td style="width: 45%;"> @if(!empty($exp_val->Semester))  {{ $exp_val->Semester }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($exp_val->name_of_paper))  {{ $exp_val->name_of_paper }}  @endif</td>
                            <td style="width: 45%;"> @if(!empty($exp_val->paper_code))  {{ $exp_val->paper_code }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($exp_val->credits))  {{ $exp_val->credits }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($exp_val->external_grade))  {{ $exp_val->external_grade }}  @endif</td>
                            <td style="width: 45%;"> @if(!empty($exp_val->internal_grade))  {{ $exp_val->internal_grade }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($exp_val->total_grade))  {{ $exp_val->total_grade }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($exp_val->credit_point))  {{ $exp_val->credit_point }}  @endif</td>
                            <td style="width: 45%;"> @if(!empty($exp_val->status))  {{ $exp_val->status }}  @endif </td>
                            <td style="width: 6%;"> 
                            <button class="btn btn-danger" onclick="removeExperience({{$exp_val->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button><button class="btn btn-danger" onclick="editExternalEdit({{$exp_val->id}})" data-toggle="modal" data-target="#externalModel"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>                     
                        </tr>
                        </tr>
                      
                           @php $i++; @endphp
                        @endforeach
                    
                    @endif
                          
                          <tr>
                            <td >
                                
                                <input type="text" id="programexternal" name="programexternal" value="{{$program}}"  class="form-controls" />
                               
                            </td>
                               <td>
                                
                                <input type="text" id="batchexternal" name="batchexternal" value="{{$batch}}" class="form-controls" />
                               
                            </td>
                            <td>
                                
                                <input type="text" id="stnameexternal" name="stnameexternal" value="{{$name}}" class="form-controls" />
                                <input type="hidden" id="stidexternal" name="stidexternal" value="{{$id}}"  />
                            </td>
                            <td>
                                
                                <select  id="Semesterexternal" name="Semesterexternal" class="form-controls">
                                <option value="" >Select Semester</option>    
                                <option value="Semester 1" >Semester 1</option>
                                <option value="Semester 2" >Semester 2</option>
                                <option value="Semester 3" >Semester 3</option>
                                <option value="Semester 4" >Semester 4</option>
                                <option value="Semester 5" >Semester 5</option>
                                <option value="Semester 6" >Semester 6</option>
                                <option value="Semester 7" >Semester 7</option>
                                <option value="Semester 8" >Semester 8</option>
                                <option value="Semester 9" >Semester 9</option>
                                <option value="Semester 10" >Semester 10</option>
                                </select>
                                <span id="Semesterexternal_Err" class="text-danger"></span> 
                            </td>
                            
                            <td>
                               <select class="form-controls" name="name_of_paper_external" id="name_of_paper_external">
            										<option value="">Select Paper</option>
            										@foreach($papername as $row)
            								            <option value="{{ $row->p_name }}">{{ $row->p_name }}</option>
            						            	@endforeach
            									</select>
                    
                                <span id="name_of_paper_external_Err" class="text-danger"></span>
                               
                            </td>
                             <td>
                              <select class="form-controls" name="paper_code_external" id="paper_code_external">
            										<option value="">Select Paper Code</option>
            										@foreach($papercode as $row)
            								            <option value="{{ $row->p_code }}">{{ $row->p_code }}</option>
            						            	@endforeach
            									</select>
                             
                                <span id="paper_code_external_Err" class="text-danger"></span>
                               
                            </td>
                           
                            
                             <td>
                              
                                <input type="text" id="credits" name="credits" class="form-controls" Placeholder="Enter Credits"/>
                                <span id="credits_Err" class="text-danger"></span>
                               
                            </td>
                            <td>
                              
                                <select  id="externalgrade" name="externalgrade" class="form-controls" >
                                <option value="" >Select External Grade </option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                <option value="FAILED" >FAILED</option>
                                </select>
                                <span id="externalgrade_Err" class="text-danger"></span>
                               
                            </td>
                            <td>
                              
                                <select  id="internalgrade_exteranl" name="internalgrade_exteranl" class="form-controls">
                                <option value="" >Select Internal Grade </option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                <option value="FAILED" >FAILED</option>
                                </select>
                                <span id="internalgrade_exteranl_Err" class="text-danger"></span>
                               
                            </td>
                               <td>
                              
                                <select  id="totalgrade_external" name="totalgrade_external" class="form-controls">
                                <option value="" >Select Total Grade</option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                <option value="FAILED" >FAILED</option>
                                </select>
                                <span id="totalgrade_external_Err" class="text-danger"></span>
                               
                            </td>
                             <td>
                              
                                <input type="text" id="creditpoint" name="creditpoint"  Placeholder="Enter Credit Point" class="form-controls" />
                                <span id="creditpoint_Err" class="text-danger"></span>
                               
                            </td>
                            <td>
                              
                                <input type="text" id="status_external" name="status_external"  Placeholder="Exam Status" class="form-controls" />
                                <span id="status_external_Err" class="text-danger"></span>
                               
                            </td>
                              <td><button class="btn btn-info" id="exp_btn" name="exp_btn">Save</button></td>
                          </tr>
                      </tbody>
                  </table>
                 	</div>
                 	<br> <br> <br> <br><hr>
                 
                  <h6 class="box-title"> External Marks Complimntery OR Language Papers</h6>
                  <span class="text-success" id="experienceaddcompliment"></span>
                  <span class="text-danger" id="experiencefailcompliment"></span>
                  <div class="scrollmenu">  
                  <table class="table table-borderless experiencecompliment">
                      <thead>
                          <tr>
                              <th> Program</th>
							 <th> Batch</th>
							 <th> Student Name</th>
						
							 <th> Semester</th>
							 <th> Type</th>
							 <th> Name of Paper</th>
							 <th> Paper Code</th>
							  <th> Credits</th>
							 <th>External Grade</th>
							  <th> Internal Grade</th>
							 <th>Total Grade</th>
							   <th> Credit Point</th>
							 <th>Status</th>
							  
                            <th> Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if(count($externalmarkscompliment)>0)
                    @php $i=1; @endphp
                    
                        @foreach($externalmarkscompliment as $exp_val)
                        <tr id="experiencecomplimentinfo_{{$exp_val->id}}">
                            <td style="width: 45%;"> @if(!empty($exp_val->program))  {{ $exp_val->program }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($exp_val->batch))  {{ $exp_val->batch }}  @endif</td>
                            <td style="width: 45%;"> @if(!empty($exp_val->stname))  {{ $exp_val->stname }}  @endif </td>
                          
                             <td style="width: 45%;"> @if(!empty($exp_val->Semester))  {{ $exp_val->Semester }}  @endif </td>
                              <td style="width: 45%;"> @if(!empty($exp_val->type))  {{ $exp_val->type }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($exp_val->name_of_paper))  {{ $exp_val->name_of_paper }}  @endif</td>
                            <td style="width: 45%;"> @if(!empty($exp_val->paper_code))  {{ $exp_val->paper_code }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($exp_val->credits))  {{ $exp_val->credits }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($exp_val->external_grade))  {{ $exp_val->external_grade }}  @endif</td>
                            <td style="width: 45%;"> @if(!empty($exp_val->internal_grade))  {{ $exp_val->internal_grade }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($exp_val->total_grade))  {{ $exp_val->total_grade }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($exp_val->credit_point))  {{ $exp_val->credit_point }}  @endif</td>
                            <td style="width: 45%;"> @if(!empty($exp_val->status))  {{ $exp_val->status }}  @endif </td>
                            <td style="width: 6%;"> 
                            <button class="btn btn-danger" onclick="removeExperiencecompliment({{$exp_val->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button><button class="btn btn-danger" onclick="editExternalEdit({{$exp_val->id}})" data-toggle="modal" data-target="#externalModel"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>                     
                        </tr></td>
                        </tr>
                      
                           @php $i++; @endphp
                        @endforeach
                    
                    @endif
                          
                          <tr>
                            <td >
                                
                                <input type="text" id="programexternalcompliment" name="programexternalcompliment" value="{{$program}}"  class="form-controls" />
                               
                            </td>
                               <td>
                                
                                <input type="text" id="batchexternalcompliment" name="batchexternalcompliment" value="{{$batch}}" class="form-controls" />
                               
                            </td>
                            <td>
                                
                                <input type="text" id="stnameexternalcompliment" name="stnameexternalcompliment" value="{{$name}}" class="form-controls" />
                                <input type="hidden" id="stidexternalcompliment" name="stidexternalcompliment" value="{{$id}}"  />
                            </td>
                            <td>
                                
                                <select  id="Semesterexternalcompliment" name="Semesterexternalcompliment" class="form-controls">
                                <option value="" >Select Semester</option>    
                                <option value="Semester 1" >Semester 1</option>
                                <option value="Semester 2" >Semester 2</option>
                                <option value="Semester 3" >Semester 3</option>
                                <option value="Semester 4" >Semester 4</option>
                                <option value="Semester 5" >Semester 5</option>
                                <option value="Semester 6" >Semester 6</option>
                                <option value="Semester 7" >Semester 7</option>
                                <option value="Semester 8" >Semester 8</option>
                                <option value="Semester 9" >Semester 9</option>
                                <option value="Semester 10" >Semester 10</option>
                                </select>
                                <span id="Semesterexternalcompliment_Err" class="text-danger"></span> 
                            </td>
                              <td>
                                
                                <select  id="typeexternalcompliment" name="typeexternalcompliment" class="form-controls">
                                <option value="" >Select Type</option>    
                                <option value="Complimentery" >Complimentery</option>
                                <option value="firstlanguage" >First Language</option>
                                <option value="secondlanguage" >Second Language</option>
                                
                                </select>
                                <span id="typeexternalcompliment_Err" class="text-danger"></span> 
                            </td>
                            <td>
                               <select class="form-controls" name="name_of_paper_externalcompliment" id="name_of_paper_externalcompliment">
            										<option value="">Select Paper</option>
            									
            									</select>
                    
                                <span id="name_of_paper_externalcompliment_Err" class="text-danger"></span>
                               
                            </td>
                             <td>
                              <select class="form-controls" name="paper_code_externalcompliment" id="paper_code_externalcompliment">
            										<option value="">Select Paper Code</option>
            									
            									</select>
                             
                                <span id="paper_code_externalcompliment_Err" class="text-danger"></span>
                               
                            </td>
                           
                            
                             <td>
                              
                                <input type="text" id="creditscompliment" name="creditscompliment" class="form-controls" Placeholder="Enter Credits"/>
                                <span id="creditscompliment_Err" class="text-danger"></span>
                               
                            </td>
                            <td>
                              
                                <select  id="externalgradecompliment" name="externalgradecompliment" class="form-controls" >
                                <option value="" >Select External Grade </option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                <option value="FAILED" >FAILED</option>
                                </select>
                                <span id="externalgradecompliment_Err" class="text-danger"></span>
                               
                            </td>
                            <td>
                              
                                <select  id="internalgradecompliment_exteranl" name="internalgradecompliment_exteranl" class="form-controls">
                                <option value="" >Select Internal Grade </option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                <option value="FAILED" >FAILED</option>
                                </select>
                                <span id="internalgradecompliment_exteranl_Err" class="text-danger"></span>
                               
                            </td>
                               <td>
                              
                                <select  id="totalgrade_externalcompliment" name="totalgrade_externalcompliment" class="form-controls">
                                <option value="" >Select Total Grade</option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                <option value="FAILED" >FAILED</option>
                                </select>
                                <span id="totalgrade_externalcompliment_Err" class="text-danger"></span>
                               
                            </td>
                             <td>
                              
                                <input type="text" id="creditpointcompliment" name="creditpointcompliment"  Placeholder="Enter Credit Point" class="form-controls" />
                                <span id="creditpointcompliment_Err" class="text-danger"></span>
                               
                            </td>
                            <td>
                              
                                <input type="text" id="status_externalcompliment" name="status_externalcompliment"  Placeholder="Exam Status" class="form-controls" />
                                <span id="status_externalcompliment_Err" class="text-danger"></span>
                               
                            </td>
                              <td><button class="btn btn-info" id="exp_btncompliment" name="exp_btncompliment">Save</button></td>
                          </tr>
                      </tbody>
                  </table>
                 	</div>
                 	<br> <br> <br> <br><hr>
                 	  <h6 class="box-title"> Overall Points</h6>
                  <span class="text-success" id="overalladd"></span>
                  <span class="text-danger" id="overallfail"></span>
                           <div class="scrollmenu">  
                  <table class="table table-borderless overall">
                      <thead>
                          <tr>
                              <th> Program</th>
							 <th> Batch</th>
							 <th> Student Name</th>
						
							 <th> Semester</th>
							 <th> SGPA</th>
							 <th> Overall Grade</th>
							  <th> CGPA</th>
							
							  
                            <th> Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if(count($overall)>0)
                    @php $i=1; @endphp
                    
                        @foreach($overall as $overall_val)
                        <tr id="overallinfo_{{$overall_val->id}}">
                            <td style="width: 45%;"> @if(!empty($overall_val->program))  {{ $overall_val->program }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($overall_val->batch))  {{ $overall_val->batch }}  @endif</td>
                            <td style="width: 45%;"> @if(!empty($overall_val->stname))  {{ $overall_val->stname }}  @endif </td>
                          
                             <td style="width: 45%;"> @if(!empty($overall_val->Semester))  {{ $overall_val->Semester }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($overall_val->sgpa))  {{ $overall_val->sgpa }}  @endif </td>
                            <td style="width: 45%;"> @if(!empty($overall_val->grade))  {{ $overall_val->grade }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($overall_val->cgpa))  {{ $overall_val->cgpa }}  @endif </td>
                            <td style="width: 6%;"> 
                            <button class="btn btn-danger" onclick="removeOverall({{$overall_val->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button><button class="btn btn-danger" onclick="editOverallEdit({{$overall_val->id}})" data-toggle="modal" data-target="#overallModel"><i class="fa fa-pencil" aria-hidden="true"></i></button></td>
                        </tr>
                      
                           @php $i++; @endphp
                        @endforeach
                    
                    @endif
                          
                          <tr>
                            <td >
                                
                                <input type="text" id="programoverall" name="programoverall" value="{{$program}}"  class="form-controls" />
                               
                            </td>
                               <td>
                                
                                <input type="text" id="batchoverall" name="batchoverall" value="{{$batch}}" class="form-controls" />
                               
                            </td>
                            <td>
                                
                                <input type="text" id="stnameoverall" name="stnameoverall" value="{{$name}}" class="form-controls" />
                                <input type="hidden" id="stidoverall" name="stidoverall" value="{{$id}}"  />
                            </td>
                            <td>
                                
                                <select  id="Semesteroverall" name="Semesteroverall" class="form-controls">
                                <option value="" >Select Semester</option>    
                                <option value="Semester 1" >Semester 1</option>
                                <option value="Semester 2" >Semester 2</option>
                                <option value="Semester 3" >Semester 3</option>
                                <option value="Semester 4" >Semester 4</option>
                                <option value="Semester 5" >Semester 5</option>
                                <option value="Semester 6" >Semester 6</option>
                                <option value="Semester 7" >Semester 7</option>
                                <option value="Semester 8" >Semester 8</option>
                                <option value="Semester 9" >Semester 9</option>
                                <option value="Semester 10" >Semester 10</option>
                                </select>
                                <span id="Semesteroverall_Err" class="text-danger"></span> 
                            </td>
                           
                             
                            
                             <td>
                              
                                <input type="text" id="sgpa" name="sgpa" class="form-controls" Placeholder="Enter SGPA"/>
                                <span id="sgpa_Err" class="text-danger"></span>
                               
                            </td>
                          
                          <td>
                              
                                <select  id="gradeov" name="gradeov" class="form-controls">
                                <option value="" >Select Total Grade</option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                <option value="FAILED" >FAILED</option>
                                </select>
                                
                                <span id="gradeov_Err" class="text-danger"></span>
                               
                            </td>
                            
                             <td>
                              
                                <input type="text" id="cgpa" name="cgpa"  Placeholder="Enter CGPA" class="form-controls" />
                                <span id="cgpa_Err" class="text-danger"></span>
                               
                            </td>
                           
                              <td><button class="btn btn-info" id="overall_btn" name="overall_btn">Save</button></td>
                          </tr>
                      </tbody>
                  </table>
                 	</div>   
                 		<br> <br> <br> <br><hr>
                 	 <h6 class="box-title"> Project and Internship</h6>
                  <span class="text-success" id="projectadd"></span>
                  <span class="text-danger" id="projectfail"></span>
                           <div class="scrollmenu">  
                  <table class="table table-borderless project">
                      <thead>
                          <tr>
                              <th> Program</th>
							 <th> Batch</th>
							 <th> Student Name</th>
							 <th> Semester</th>
							 <th> Project Title</th>
							 <th>Supervising Teacher</th>
							 <th>Internship Note</th>
							<th>Name of Instituition</th>
							 <th>Period</th> 
                            <th> Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if(count($project)>0)
                    @php $i=1; @endphp
                    
                        @foreach($project as $project_val)
                        <tr id="projectinfo_{{$project_val->id}}">
                            <td style="width: 45%;"> @if(!empty($project_val->program))  {{ $project_val->program }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($project_val->batch))  {{ $project_val->batch }}  @endif</td>
                            <td style="width: 45%;"> @if(!empty($project_val->stname))  {{ $project_val->stname }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($project_val->Semester))  {{ $project_val->Semester }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($project_val->title_project))  {{ $project_val->title_project }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($project_val->supervising_teacher))  {{ $project_val->supervising_teacher }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($project_val->internship_note))  {{ $project_val->internship_note }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($project_val->name_of_institution))  {{ $project_val->name_of_institution }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($project_val->period))  {{ $project_val->period }}  @endif </td>
                            <td style="width: 6%;"> 
                            <button class="btn btn-danger" onclick="removeProject({{$project_val->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                        </tr>
                      
                           @php $i++; @endphp
                        @endforeach
                    
                    @endif
                          
                          <tr>
                            <td >
                                
                                <input type="text" id="programproject" name="programproject" value="{{$program}}"  class="form-controls" />
                               
                            </td>
                               <td>
                                
                                <input type="text" id="batchproject" name="batchproject" value="{{$batch}}" class="form-controls" />
                               
                            </td>
                            <td>
                                
                                <input type="text" id="stnameproject" name="stnameproject" value="{{$name}}" class="form-controls" />
                                <input type="hidden" id="stidproject" name="stidproject" value="{{$id}}"  />
                            </td>
                            <td>
                                
                                <select  id="Semesterproject" name="Semesterproject" class="form-controls">
                                <option value="" >Select Semester</option>    
                                <option value="Semester 1" >Semester 1</option>
                                <option value="Semester 2" >Semester 2</option>
                                <option value="Semester 3" >Semester 3</option>
                                <option value="Semester 4" >Semester 4</option>
                                <option value="Semester 5" >Semester 5</option>
                                <option value="Semester 6" >Semester 6</option>
                                <option value="Semester 7" >Semester 7</option>
                                <option value="Semester 8" >Semester 8</option>
                                <option value="Semester 9" >Semester 9</option>
                                <option value="Semester 10" >Semester 10</option>
                                </select>
                                <span id="Semesterproject_Err" class="text-danger"></span> 
                            </td>
                           
                             
                            
                             <td>
                              
                                <input type="text" id="project" name="project" class="form-controls" Placeholder="Title of Project"/>
                                <span id="project_Err" class="text-danger"></span>
                               
                            </td>
                          
                          <td>
                             
								   <input type="text" id="supervising_teacher" name="supervising_teacher"  Placeholder="Search Supervising Teacher" class="form-control skillitems" />
                                    <input type="hidden" id="skillid" name="skillid" value="0"/>
                                    <div id="skill_pos"></div> 
                              
                                <span id="supervising_teacher_Err" class="text-danger"></span>
                               
                            </td>
                            
                             <td>
                              
                                 <select  id="intership_note" name="intership_note" class="form-controls">
                                <option value="" >With Internship/ not</option>    
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                               
                                </select>
                                <span id="intership_note_Err" class="text-danger"></span> 
                               
                            </td>
                              <td>
                                <input type="text" id="name_of_instituition" name="name_of_instituition" class="form-controls" Placeholder="Name Of Instituition"/>
                                <span id="name_of_instituition_Err" class="text-danger"></span>
                              
                            </td>
                           <td>
                                <input type="text" id="Period" name="Period" class="form-controls" Placeholder="Period of Internship"/>
                                <span id="period_Err" class="text-danger"></span>
                              
                            </td>
                              <td><button class="btn btn-info" id="project_btn" name="project_btn">Save</button></td>
                          </tr>
                      </tbody>
                  </table>
                 	</div>   
                 		<br> <br> <br> <br><hr>
                 	 <h6 class="box-title"> Field Work & Industrial Visit</h6>
                  <span class="text-success" id="fieldadd"></span>
                  <span class="text-danger" id="fieldfail"></span>
                           <div class="scrollmenu">  
                  <table class="table table-borderless field">
                      <thead>
                          <tr>
                              <th> Program</th>
							 <th> Batch</th>
							 <th> Student Name</th>
							 <th> Semester</th>
							 <th>Industrial Visit Title</th>
							 <th>Supervising Teacher</th>
							 <th>No Of Days</th>
							<th>Name of Industry Visited</th>
							 <th>Period</th> 	
							  <th>Course Or Related Paper</th> 
                            <th> Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if(count($field)>0)
                    @php $i=1; @endphp
                    
                        @foreach($field as $field_val)
                        <tr id="fieldinfo_{{$field_val->id}}">
                            <td style="width: 45%;"> @if(!empty($field_val->program))  {{ $field_val->program }}  @endif </td>
                            <td style="width: 40%;"> @if(!empty($field_val->batch))  {{ $field_val->batch }}  @endif</td>
                            <td style="width: 45%;"> @if(!empty($field_val->stname))  {{ $field_val->stname }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($field_val->Semester))  {{ $field_val->Semester }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($field_val->title_industry))  {{ $field_val->title_industry }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($field_val->supervising_teacher))  {{ $field_val->supervising_teacher }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($field_val->no_of_days))  {{ $field_val->no_of_days }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($field_val->name_of_industry_visited))  {{ $field_val->name_of_industry_visited }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($field_val->period))  {{ $field_val->period }}  @endif </td>
                             <td style="width: 45%;"> @if(!empty($field_val->course_related))  {{ $field_val->course_related }}  @endif </td>
                            <td style="width: 6%;"> 
                            <button class="btn btn-danger" onclick="removeField({{$field_val->id}})"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                        </tr>
                      
                           @php $i++; @endphp
                        @endforeach
                    
                    @endif
                          
                          <tr>
                            <td >
                                
                                <input type="text" id="programfield" name="programfield" value="{{$program}}"  class="form-controls" />
                               
                            </td>
                               <td>
                                
                                <input type="text" id="batchfield" name="batchfield" value="{{$batch}}" class="form-controls" />
                               
                            </td>
                            <td>
                                
                                <input type="text" id="stnamefield" name="stnamefield" value="{{$name}}" class="form-controls" />
                                <input type="hidden" id="stidfield" name="stidfield" value="{{$id}}"  />
                            </td>
                            <td>
                                
                                <select  id="Semesterfield" name="Semesterfield" class="form-controls">
                                <option value="" >Select Semester</option>    
                                <option value="Semester 1" >Semester 1</option>
                                <option value="Semester 2" >Semester 2</option>
                                <option value="Semester 3" >Semester 3</option>
                                <option value="Semester 4" >Semester 4</option>
                                <option value="Semester 5" >Semester 5</option>
                                <option value="Semester 6" >Semester 6</option>
                                <option value="Semester 7" >Semester 7</option>
                                <option value="Semester 8" >Semester 8</option>
                                <option value="Semester 9" >Semester 9</option>
                                <option value="Semester 10" >Semester 10</option>
                                </select>
                                <span id="Semesterfield_Err" class="text-danger"></span> 
                            </td>
                           
                             
                            
                             <td>
                              
                                <input type="text" id="industrial_visit" name="industrial_visit" class="form-controls" Placeholder="Title of Industrial Visit"/>
                                <span id="industrial_visit_Err" class="text-danger"></span>
                               
                            </td>
                          
                          <td>
                             
								   <input type="text" id="supervising_teacher_field" name="supervising_teacher_field"  Placeholder="Search Supervising Teacher" class="form-control skillitems" />
                                    <input type="hidden" id="skillidfield" name="skillidfield" value="0"/>
                                    <div id="skill_pos_field"></div> 
                              
                                <span id="supervising_teacher_field_Err" class="text-danger"></span>
                               
                            </td>
                            
                             <td>
                              
                                <input type="text" id="name_of_industry" name="name_of_industry" class="form-controls" Placeholder="Name Of Industry Visited"/>
                                <span id="name_of_industry_Err" class="text-danger"></span> 
                               
                            </td>
                              <td>
                                <input type="text" id="num_of_days" name="num_of_days" class="form-controls" Placeholder="No Of Days"/>
                                <span id="num_of_days_Err" class="text-danger"></span>
                              
                            </td>
                           <td>
                                <input type="text" id="period_field" name="period_field" class="form-controls" Placeholder="Period of IV"/>
                                <span id="period_field_Err" class="text-danger"></span>
                              
                            </td>
                              <td>
                                <input type="text" id="course_paper" name="course_paper" class="form-controls" Placeholder="Course Or Related Paper"/>
                                <span id="course_paper_Err" class="text-danger"></span>
                              
                            </td>
                              <td><button class="btn btn-info" id="field_btn" name="field_btn">Save</button></td>
                          </tr>
                      </tbody>
                  </table>
                  <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Papercode</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="intpapercode" name="intpapercode" disabled>
                             <input type="hidden" class="form-control" id="editid" name="editid" disabled>
                        </div>
                    </div>
       
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Assignment</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control intassignment"  id="intassignment" name="intassignment" onChange="editsum();">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Seminar</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control intseminar" id="intseminar" name="intseminar" onChange="editsum();">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Test</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control inttest" id="inttest" name="inttest" onChange="editsum();">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Others</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control intothers" id="intothers" name="intothers" onChange="editsum();">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Sum</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control intsum" id="intsum" name="intsum" disabled>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Max Marks</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control intmax_mark" id="intmax_mark" name="intmax_mark" onChange="editpercentage();">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Percentage</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control intpercent" id="intpercent" name="intpercent" >
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Internal Grade</label>
                        <div class="col-sm-12">
                            <select  id="intinternalgrade" name="intinternalgrade" class="form-controls">
                                <option value="" >Select Total Grade</option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                 <option value="FAILED" >FAILED</option>
                                </select>
                        </div>
                    </div>
                       <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Internal Grade Point</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="intgrade_point" name="intgrade_point" >
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtnedit" value="create">Save changes
                     
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
                     </button>
                     
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
               <div class="modal fade" id="overallModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                  
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">SGPA</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control"  id="ovsgpa" name="ovsgpa" onChange="">
                            <input type="hidden" class="form-control" id="oveditid" name="oveditid" disabled>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">CGPA</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="ovcgpa" name="ovcgpa">
                        </div>
                    </div>
                   
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Grade</label>
                        <div class="col-sm-12">
                            <select  id="ovgrade" name="ovgrade" class="form-controls">
                                <option value="" >Select Grade</option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                 <option value="FAILED" >FAILED</option>
                                </select>
                        </div>
                    </div>
                      
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveOvledit" value="create">Save changes
                     
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
                     </button>
                     
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                  <div class="modal fade" id="externalModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Papercode</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="extpapercode" name="extpapercode" disabled>
                             <input type="" class="form-control" id="exteditid" name="exteditid" disabled>
                        </div>
                    </div>
       
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Credits</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control intassignment"  id="extcredits" name="extcredits" >
                        </div>
                    </div>
                       <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">External Grade</label>
                        <div class="col-sm-12">
                            <select  id="extexternalgrade" name="extexternalgrade" class="form-controls">
                                <option value="" >Select External Grade</option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                 <option value="FAILED" >FAILED</option>
                                </select>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Internal Grade</label>
                        <div class="col-sm-12">
                            <select  id="extinternalgrade" name="extinternalgrade" class="form-controls">
                                <option value="" >Select Internal Grade</option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                 <option value="FAILED" >FAILED</option>
                                </select>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Total Grade</label>
                        <div class="col-sm-12">
                            <select  id="exttotalgrade" name="exttotalgrade" class="form-controls">
                                <option value="" >Select Total Grade</option>    
                                <option value="O" >O</option>
                                <option value="A+">A+</option>
                                <option value="A" >A</option>
                                <option value="B" >B</option>
                                <option value="C" >C</option>
                                <option value="D" >D</option>
                                <option value="E" >E</option>
                                <option value="PASSED" >PASSED</option>
                                 <option value="FAILED" >FAILED</option>
                                </select>
                        </div>
                    </div>
                       <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Credit Point</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="extcreditpoint" name="extcreditpoint" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Exam Status</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="extexamstatus" name="extexamstatus" >
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtnextedit" value="create">Save changes
                     
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
                     </button>
                     
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                 	</div>   
      	</section>
        
				</div>
				
	
                
            </div>
          </div>
          </div>
          </div>
          </div>
          </div>
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
 function sum() {
            var txtFirstNumberValue = document.getElementById('assignment').value;
            var txtSecondNumberValue = document.getElementById('seminar').value;
            var txtThirdNumberValue = document.getElementById('test').value;
            var txtFourthNumberValue = document.getElementById('others').value;
            if (txtFirstNumberValue == "")
       txtFirstNumberValue = 0;
   if (txtSecondNumberValue == "")
       txtSecondNumberValue = 0;
   if (txtThirdNumberValue == "")
       txtThirdNumberValue = 0;
   if (txtFourthNumberValue == "")
       txtFourthNumberValue = 0;
            var result = parseFloat(txtFirstNumberValue) + parseFloat(txtSecondNumberValue) + parseFloat(txtThirdNumberValue) + parseFloat(txtFourthNumberValue);
           // var totalValue =  ((result/20)*100);     
            if (!isNaN(result)) {
                document.getElementById('sum').value = result;
               // document.getElementById('percent').value =totalValue;
            }
        }
       function editsum() {
            var txtFirstNumberValue = $('.intassignment').val();
            var txtSecondNumberValue = $('.intseminar').val();
            var txtThirdNumberValue = $('.inttest').val();
            var txtFourthNumberValue = $('.intothers').val();
          
           
            if (txtFirstNumberValue == "")
       txtFirstNumberValue = 0;
   if (txtSecondNumberValue == "")
       txtSecondNumberValue = 0;
   if (txtThirdNumberValue == "")
       txtThirdNumberValue = 0;
   if (txtFourthNumberValue == "")
       txtFourthNumberValue = 0;
            var result = parseFloat(txtFirstNumberValue) + parseFloat(txtSecondNumberValue) + parseFloat(txtThirdNumberValue) + parseFloat(txtFourthNumberValue);
           // var totalValue =  ((result/20)*100);     
            if (!isNaN(result)) {
            
             $('.intsum').val(result);
                //document.getElementById('sum').value = result;
               // document.getElementById('percent').value =totalValue;
            }
        }  
        
        function editpercentage() {
            var txtSumValue = $('.intsum').val();
             var maxmarkValue = $('.intmax_mark').val();
          
           var totalValue =  ((txtSumValue/maxmarkValue)*100);     
            if (!isNaN(totalValue)) {
               
                $('.intpercent').val(totalValue);
            }
        }
        
         function percentage() {
            var txtSumValue = document.getElementById('sum').value;
             var maxmarkValue = document.getElementById('maxmarks').value;
          
           var totalValue =  ((txtSumValue/maxmarkValue)*100);     
            if (!isNaN(totalValue)) {
               
                document.getElementById('percent').value =totalValue;
            }
        }
        
       function percentageCompliment() {
            var txtSumValue = document.getElementById('sum_compliment').value;
             var maxmarkValue = document.getElementById('maxmarks_compliment').value;
          
           var totalValue =  ((txtSumValue/maxmarkValue)*100);     
            if (!isNaN(totalValue)) {
               
                document.getElementById('percent_compliment').value =totalValue;
            }
        }
        
          
     $('body').on('click', '#saveBtnextedit', function(e) {
         e.preventDefault();
      var extcredits = $('#extcredits').val();
      var extexternalgrade = $('#extexternalgrade').val();
      var extinternalgrade = $('#extinternalgrade').val();
      var exttotalgrade =$('#exttotalgrade').val();
      var extcreditpoint = $('#extcreditpoint').val();
      var extexamstatus = $('#extexamstatus').val();
      var exteditid = $('#exteditid').val();
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$updateExternalMarks}}",
              type: "POST",
              dataType: 'text',
              data: {
               
                  extcredits: extcredits,
                  extexternalgrade:extexternalgrade,
                  extinternalgrade:extinternalgrade,
                  exttotalgrade:exttotalgrade,
                  extcreditpoint:extcreditpoint,
                  extexamstatus: extexamstatus,
                  exteditid:exteditid,
                 
              },
              cache: false,
              success: function(res){
                    // loader_off();
                            if(res=='successs'){
                               
                              alert("External marks updated");                              
                               window.location.reload();
                            }
              }
          });
      
     
  }); 
      $('body').on('click', '#saveBtnedit', function(e) {
            e.preventDefault();
      var intassignment = $('#intassignment').val();
      var intseminar = $('#intseminar').val();
      var inttest = $('#inttest').val();
      var intothers =$('#intothers').val();
      var intsum = $('#intsum').val();
   
      var intpercent = $('#intpercent').val();
      var intinternalgrade =$('#intinternalgrade').val(); 
      var intgrade_point = $('#intgrade_point').val();
       var inteditid = $('#editid').val();
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$updateInternalMarks}}",
              type: "POST",
              dataType: 'text',
              data: {
               
                  intassignment: intassignment,
                  intseminar:intseminar,
                  inttest:inttest,
                  intothers:intothers,
                  intsum:intsum,
                 
                  intpercent:intpercent,
                  intinternalgrade:intinternalgrade,
                  intgrade_point:intgrade_point,
                   inteditid:inteditid,
                 
              },
              cache: false,
              success: function(res){
                 
                            if(res=='success'){
                               alert("Internal marks updated");                              
                               window.location.reload();
                            }
              }
          });
      
     
  }); 
  
   $('body').on('click', '#saveOvledit', function(e) {
            e.preventDefault();
      var ovsgpa = $('#ovsgpa').val();
      var ovcgpa = $('#ovcgpa').val();
      var ovgrade = $('#ovgrade').val();
       var oveditid = $('#oveditid').val();
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$updateOverallMarks}}",
              type: "POST",
              dataType: 'text',
              data: {
               
                  ovsgpa: ovsgpa,
                  ovcgpa:ovcgpa,
                  ovgrade:ovgrade,
                  oveditid:oveditid,
                 
              },
              cache: false,
              success: function(res){
                    // loader_off();
                            if(res=='success'){
                               
                              alert("Overall marks updated");                              
                               window.location.reload();
                            }
              }
          });
      
     
  }); 
   function sumcompliment() {
     
            var txtFirstNumberValue = document.getElementById('assignment_compliment').value;
            var txtSecondNumberValue = document.getElementById('seminar_compliment').value;
            var txtThirdNumberValue = document.getElementById('test_compliment').value;
            var txtFourthNumberValue = document.getElementById('others_compliment').value;
            if (txtFirstNumberValue == "")
       txtFirstNumberValue = 0;
   if (txtSecondNumberValue == "")
       txtSecondNumberValue = 0;
   if (txtThirdNumberValue == "")
       txtThirdNumberValue = 0;
   if (txtFourthNumberValue == "")
       txtFourthNumberValue = 0;
            var result = parseFloat(txtFirstNumberValue) + parseFloat(txtSecondNumberValue) + parseFloat(txtThirdNumberValue) + parseFloat(txtFourthNumberValue);
            //var totalValue =  ((result/20)*100);     
            if (!isNaN(result)) {
                document.getElementById('sum_compliment').value = result;
                //document.getElementById('percent_compliment').value =totalValue;
            }
        }
        
             
$('body').on('click', '#butsavecompliment', function() {
      var programcompliment = $('#programcompliment').val();
      var batchcompliment = $('#batchcompliment').val();
      var stnamecompliment = $('#stnamecompliment').val();
      var stidcompliment =$('#stidcompliment').val();
      var Semestercompliment = $('#Semestercompliment').val();
      var name_of_paper_compliment = $('#name_of_paper_compliment').val();
      var paper_code_compliment = $('#paper_code_compliment').val();
      var assignment_compliment =$('#assignment_compliment').val(); 
      var seminar_compliment = $('#seminar_compliment').val();
      var typecompliment = $('#typecompliment').val();
      var test_compliment =$('#test_compliment').val(); 
       var others_compliment =$('#others_compliment').val(); 
      var sum_compliment = $('#sum_compliment').val();
       var maxmarks_compliment = $('#maxmarks_compliment').val();
      var internalgrade_compliment = $('#internalgrade_compliment').val();
      var percent_compliment = $('#percent_compliment').val();
      var gradepointcompliment = $('#gradepointcompliment').val();
      
      $("#complimentadd").html('');
      $("#complimentfail").html('');
      if(Semestercompliment==""){ $("#Semestercompliment_Err").html("Please Enter Semester"); }
      else{$("#Semestercompliment_Err").html(""); }
      if(name_of_paper_compliment==""){ $("#name_of_paper_compliment_nameErr").html("Please Enter Name of Paper"); }
      else{$("#name_of_paper_compliment_nameErr").html(""); }
      if(paper_code_compliment==""){ $("#paper_code_compliment_nameErr").html("Please Enter PaperCode"); }
      else{$("#paper_code_compliment_nameErr").html(""); }
      if(typecompliment==""){ $("#typecompliment_Err").html("Please Enter Type"); }
      else{$("#typecompliment_Err").html(""); }
      if(gradepointcompliment==""){ $("#gradepointErrcompliment").html("Please Enter Gradepoint"); }
      else{$("#gradepointErrcompliment").html(""); }
       if(maxmarks_compliment==""){ $("#maxmarks_compliment_nameErr").html("Please Enter Maxmarks"); }
      else{$("#maxmarks_compliment_nameErr").html(""); }
      if(Semestercompliment!="" && name_of_paper_compliment!="" && paper_code_compliment!=""  && typecompliment!="" && gradepointcompliment!=""){
        /*  $("#butsave").attr("disabled", "disabled"); */
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$saveInternalMarks}}",
              type: "POST",
              data: {
               
                  program: programcompliment,
                  batch:batchcompliment,
                  stname:stnamecompliment,
                  stid:stidcompliment,
                  Semester: Semestercompliment,
                  type:typecompliment,
                  name_of_paper:name_of_paper_compliment,
                  paper_code:paper_code_compliment,
                  assignment:assignment_compliment,
                  seminar: seminar_compliment,
                  test:test_compliment,
                  others:others_compliment,
                  sum:sum_compliment,
                  internalgrade:internalgrade_compliment,
                  percent:percent_compliment,
                  gradepoint:gradepointcompliment,
                 
              },
              cache: false,
              success: function(dataResult){
                 $("#complimentadd").html(dataResult.success);
                  $(".compliment tr:last").before('<tr id="complimentrow_'+dataResult.insertId+'"><td> '+programcompliment+' </td><td>'+batchcompliment+' </td><td> '+stnamecompliment+' </td><td>  '+Semestercompliment+' </td><td>  '+typecompliment+' </td><td>'+name_of_paper_compliment+' </td><td> '+paper_code_compliment+' </td><td> '+assignment_compliment+' </td><td> '+seminar_compliment+' </td><td>'+test_compliment+' </td><td> '+others_compliment+' </td><td> '+sum_compliment+' </td><td>'+internalgrade_compliment+' </td><td>'+percent_compliment+'</td><td>'+gradepointcompliment+'</td><td><button class="btn btn-danger" onclick="removeComplimentEdit('+dataResult.insertId+')"><i class="fa fa-trash" aria-hidden="true"></i></button><button class="btn btn-danger" onclick="editSkillEdit('+dataResult.insertId+')" data-toggle="modal" data-target="#ajaxModel"><i class="fa fa-pencil" aria-hidden="true"></i></button></td></tr>');
                   $('#programcompliment').val('');
                   $('#batchcompliment').val('');
                   $('#stnamecompliment').val('');
                   $('#Semestercompliment').val('');
                   $('#typecompliment').val('');
                   $('#name_of_paper_compliment').val('');
                   $('#paper_code_compliment').val('');
                   $('#assignment_compliment').val('');
                   $('#seminar_compliment').val('');
                     $('#maxmarks_compliment').val('');
                   $('#test_compliment').val('');
                   $('#others_compliment').val('');
                   $('#sum_compliment').val('');
                   $('#internalgrade_compliment').val('');
                   $('#percent_compliment').val('');
                    $('#gradepointcompliment').val('');
              }
          });
      }
      else{
        
          
      }
  });

   
$('body').on('click', '#butsaveSkill', function() {
      var program = $('#program').val();
      var batch = $('#batch').val();
      var stname = $('#stname').val();
      var stid =$('#stid').val();
      var Semester = $('#Semester').val();
      var name_of_paper = $('#name_of_paper').val();
      var paper_code = $('#paper_code').val();
      var assignment =$('#assignment').val(); 
      var seminar = $('#seminar').val();
      var test =$('#test').val(); 
       var others =$('#others').val(); 
      var sum = $('#sum').val();
        var maxmarks = $('#maxmarks').val();
      var internalgrade = $('#internalgrade').val();
      var percent = $('#percent').val();
      var gradepoint = $('#gradepoint').val();
      var type='Main';
      $("#skilladd").html('');
      $("#skillfail").html('');
      if(Semester==""){ $("#Semester_Err").html("Please Enter Semester"); }
      else{$("#Semester_Err").html(""); }
      if(name_of_paper==""){ $("#name_of_paper_nameErr").html("Please Enter Name of Paper"); }
      else{$("#name_of_paper_nameErr").html(""); }
      if(paper_code==""){ $("#paper_code_nameErr").html("Please Enter PaperCode"); }
      else{$("#paper_code_nameErr").html(""); }
      if(gradepoint==""){ $("#gradepointErr").html("Please Enter GradePoint"); }
      else{$("#gradepointErr").html(""); }
      if(maxmarks==""){ $("#maxmarks_nameErr").html("Please Enter Maxmarks"); }
      else{$("#maxmarks_nameErr").html(""); }
      if(Semester!="" && name_of_paper!="" && paper_code!="" && gradepoint!=""){
        /*  $("#butsave").attr("disabled", "disabled"); */
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$saveInternalMarks}}",
              type: "POST",
              data: {
               
                  program: program,
                  batch:batch,
                  stname:stname,
                  stid:stid,
                  Semester: Semester,
                  name_of_paper:name_of_paper,
                  paper_code:paper_code,
                  assignment:assignment,
                  seminar: seminar,
                  test:test,
                  others:others,
                  sum:sum,
                  internalgrade:internalgrade,
                  percent:percent,
                  gradepoint:gradepoint,
                  type:type
              },
              cache: false,
              success: function(dataResult){
                 $("#skilladd").html(dataResult.success);
                  $(".skils tr:last").before('<tr id="skillrow_'+dataResult.insertId+'"><td> '+program+' </td><td>'+batch+' </td><td> '+stname+' </td><td>  '+Semester+' </td><td>'+name_of_paper+' </td><td> '+paper_code+' </td><td> '+assignment+' </td><td> '+seminar+' </td><td>'+test+' </td><td> '+others+' </td><td> '+sum+' </td><td>'+internalgrade+' </td><td>'+percent+' % </td><td>'+gradepoint+'</td><td><button class="btn btn-danger" onclick="removeSkillEdit('+dataResult.insertId+')"><i class="fa fa-trash" aria-hidden="true"></i></button><button class="btn btn-danger" onclick="editSkillEdit('+dataResult.insertId+')"><i class="fa fa-pencil" aria-hidden="true"></i></button></td></tr>');
                   $('#program').val('');
                   $('#batch').val('');
                   $('#stname').val('');
                   $('#Semester').val('');
                   $('#name_of_paper').val('');
                   $('#paper_code').val('');
                   $('#assignment').val('');
                   $('#seminar').val('');
                    $('#maxmarks').val('');
                   $('#test').val('');
                   $('#others').val('');
                   $('#sum').val('');
                   $('#internalgrade').val('');
                   $('#percent').val('');
                  $('#gradepoint').val('');
                   
                  
              }
          });
      }
      else{
        
          
      }
  });


</script>

<script type="text/javascript">
function removeSkillEdit(editid)
{
    //alert(editid);
    $('#skillrow_'+editid).remove();
    $("#skilladd").html('');
      	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
		 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$deletmarks}}", //url('/hod/deleteMarks')
              type: "POST",
              data: {id:editid},
             cache: false,
              success: function(dataResult)
              {
                 $("#skilladd").html(dataResult.success);
                // alert(dataResult.success);
                
                  if(dataResult.statusCode==200){
                   // window.location = "/userData";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
            }
        });
    }
}

function editExternalEdit(editid)
{
  // alert(editid);

      	event.preventDefault();

        $.ajax({
		 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$editfetchExternalMarks}}", //url('/hod/editfetchmarks_external')
              type: "GET",
              data: {id:editid},
               dataType: 'json',
             cache: false,
              success: function(res)
              {
          
                         
                      if (res == null) {
                         
                      } else {
                           $("#extpapercode").val(res[0]['paper_code']);
                            $("#extcredits").val(res[0]['credits']);
					        $("#extexternalgrade").val(res[0]['external_grade']);
					         $("#extinternalgrade").val(res[0]['internal_grade']);
					          $("#exttotalgrade").val(res[0]['total_grade']);
					           $("#extcreditpoint").val(res[0]['credit_point']);
					             $("#extexamstatus").val(res[0]['status']);
					           $("#exteditid").val(editid);
                      }
            }
        });
    
}
function editOverallEdit(editid)
{
  // alert(editid);

      	event.preventDefault();

        $.ajax({
		 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$fetchOverall}}",//url('/hod/editfetchmarks_Overall')
              type: "GET",
              data: {id:editid},
               dataType: 'json',
             cache: false,
              success: function(res)
              {
          
                         
                      if (res == null) {
                         
                      } else {
                         
					          $("#ovsgpa").val(res[0]['sgpa']);
					          $("#ovcgpa").val(res[0]['cgpa']);
					          $("#ovgrade").val(res[0]['grade']);
					          $("#oveditid").val(editid);
                      }
            }
        });
    
}
function editSkillEdit(editid)
{
   // alert(editid);

      	event.preventDefault();

        $.ajax({
		 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$editFetchMarks}}",  // url('/hod/editfetchmarks')
              type: "GET",
              data: {id:editid},
               dataType: 'json',
             cache: false,
              success: function(res)
              {
          
                         
                      if (res == null) {
                         
                      } else {
                           $("#intpapercode").val(res[0]['paper_code']);
                            $("#intassignment").val(res[0]['assignment']);
					        $("#intseminar").val(res[0]['seminar']);
					         $("#inttest").val(res[0]['test']);
					          $("#intothers").val(res[0]['others']);
					           $("#intsum").val(res[0]['sum']);
					            $("#intinternalgrade").val(res[0]['internalgrade']);
					         $("#intpercent").val(res[0]['percent']);
					          $("#intgrade_point").val(res[0]['grade_point']);
					           $("#intmax_mark").val(res[0]['max_mark']);
					            $("#editid").val(editid);
                      }
            }
        });
    
}
function removeComplimentEdit(editid)
{
   // alert(editid);
    $('#complimentrow_'+editid).remove();
    $("#complimentadd").html('');
      	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
		 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$deletmarks}}",
              type: "POST",
              data: {id:editid},
             cache: false,
              success: function(dataResult)
              {
                 $("#complimentadd").html(dataResult.success);
                // alert(dataResult.success);
                
                  if(dataResult.statusCode==200){
                   // window.location = "/userData";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
            }
        });
    }
}


  $(document).ready(function(){
	  $( "#supervising_teacher" ).autocomplete({
        source: function( request, response ) {
           $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{$autocompleteSearch}}",
            type: 'POST',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('.skillitems').val(ui.item.label);// display the selected text
          $('#skillidfield').val(ui.item.value); // save selected id to input
		 
          return false;
        },
appendTo: "#skill_pos_field",
      });
        });


  $(document).ready(function(){
	  $( "#supervising_teacher_field" ).autocomplete({
        source: function( request, response ) {
           $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ $autocompleteSearch }}",
            type: 'POST',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('.skillitems').val(ui.item.label);// display the selected text
          $('#skillid').val(ui.item.value); // save selected id to input
		 
          return false;
        },
appendTo: "#skill_pos",
      });
        });




$('body').on('click', '#exp_btn', function() {
       var programexternal = $('#programexternal').val();
      var batchexternal = $('#batchexternal').val();
      var stnameexternal = $('#stnameexternal').val();
      var stidexternal =$('#stidexternal').val();
      var Semesterexternal = $('#Semesterexternal').val();
      var name_of_paper_external = $('#name_of_paper_external').val();
      var paper_code_external = $('#paper_code_external').val();
      var credits =$('#credits').val(); 
      var externalgrade = $('#externalgrade').val();
      var internalgrade_exteranl =$('#internalgrade_exteranl').val(); 
       var totalgrade_external =$('#totalgrade_external').val(); 
      var creditpoint = $('#creditpoint').val();
      var status_external = $('#status_external').val();
       var type='Main';
     $("#experiencefail").html("");
      $("#experienceadd").html("");
      
      
      
     if(Semesterexternal==""){ $("#Semesterexternal_Err").html("Please Enter Semester"); }
      else{$("#Semesterexternal_Err").html(""); }
      if(name_of_paper_external==""){ $("#name_of_paper_external_Err").html("Please Enter Name of Paper"); }
      else{$("#name_of_paper_external_Err").html(""); }
      if(paper_code_external==""){ $("#paper_code_external_Err").html("Please Enter PaperCode"); }
      else{$("#paper_code_external_Err").html(""); }
    //   if(credits==""){ $("#credits_Err").html("Please Enter Credits"); }
    //   else{$("#credits_Err").html(""); }
    //     if(externalgrade==""){ $("#externalgrade_Err").html("Please Enter External Grade"); }
    //   else{$("#externalgrade_Err").html(""); }
    //     if(internalgrade_exteranl==""){ $("#internalgrade_exteranl_Err").html("Please Enter Internal Grade"); }
    //   else{$("#internalgrade_exteranl_Err").html(""); }
    // if(totalgrade_external==""){ $("#totalgrade_external_Err").html("Please Enter Total Grade"); }
    //   else{$("#totalgrade_external_Err").html(""); }
    //   if(creditpoint==""){ $("#creditpoint_Err").html("Please Enter Credit Point"); }
    //   else{$("#creditpoint_Err").html(""); }
    //   if(status_external==""){ $("#status_external_Err").html("Please Enter Status"); }
    //   else{$("#status_external_Err").html(""); }
      
     if(Semesterexternal!="" && name_of_paper_external!="" && paper_code_external!=""){
        
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$saveExternalMarks}}",
              type: "POST",
              data: {
               
                  programexternal : programexternal,
                  batchexternal:batchexternal,
                  stnameexternal:stnameexternal,
                  stidexternal:stidexternal,
                  Semesterexternal: Semesterexternal,
                  name_of_paper_external:name_of_paper_external,
                  paper_code_external:paper_code_external,
                  credits:credits,
                  externalgrade: externalgrade,
                  internalgrade_exteranl:internalgrade_exteranl,
                  totalgrade_external:totalgrade_external,
                  creditpoint:creditpoint,
                  status_external:status_external,
                  type:type,
                 
              },
               cache: false,
              success: function(dataResult){
                $("#experienceadd").html(dataResult.success);
                $("#Semesterexternal_Err").html("");
                $("#name_of_paper_external_Err").html("");
                $("#paper_code_external_Err").html("");
                $("#credits_Err").html("");
                $("#externalgrade_Err").html("");
                $("#internalgrade_exteranl_Err").html("");
                $("#totalgrade_external_Err").html("");
                $("#creditpoint_Err").html("");
                $("#status_external_Err").html("");
                $(".experience tr:last").before('<tr id="experienceinfo_'+dataResult.insertId+'"><td>'+programexternal+'</td><td>'+batchexternal+'</td><td>'+stnameexternal+'</td><td>'+Semesterexternal+'</td><td>'+name_of_paper_external+'</td><td>'+paper_code_external+'</td><td>'+credits+'</td><td>'+externalgrade+'</td><td>'+internalgrade_exteranl+'</td><td>'+totalgrade_external+'</td><td>'+creditpoint+'</td><td>'+status_external+'</td><td><button class="btn btn-danger" onclick="removeExperience('+dataResult.insertId+')"><i class="fa fa-trash" aria-hidden="true"></i></button><button class="btn btn-danger" onclick="editExternalEdit('+dataResult.insertId+')" data-toggle="modal" data-target="#externalModel"><i class="fa fa-pencil" aria-hidden="true"></i></button></td></tr>');
                $('#programexternal').val('');
                $('#batchexternal').val('');
                $('#stnameexternal').val('');
                $('#Semesterexternal').val('');
                $('#name_of_paper_external').val('');
                $('#paper_code_external').val('');
                $('#credits').val('');
                $('#externalgrade').val('');
                $('#internalgrade_exteranl').val('');
                $('#totalgrade_external').val('');
                $('#creditpoint').val('');
                $('#status_external').val('');
                
                  if(dataResult.statusCode==200){
                   // window.location = "/userData";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
      }
      else{
         // $("#experiencefail").html('Please fill all the fields !');
         // alert('Please fill all the fields !');
      }
  });
  
  
  $('body').on('click', '#exp_btncompliment', function() {
       var programexternal = $('#programexternalcompliment').val();
      var batchexternal = $('#batchexternalcompliment').val();
      var stnameexternal = $('#stnameexternalcompliment').val();
      var stidexternal =$('#stidexternalcompliment').val();
      var Semesterexternal = $('#Semesterexternalcompliment').val();
      var name_of_paper_external = $('#name_of_paper_externalcompliment').val();
      var paper_code_external = $('#paper_code_externalcompliment').val();
      var credits =$('#creditscompliment').val(); 
      var externalgrade = $('#externalgradecompliment').val();
      var internalgrade_exteranl =$('#internalgradecompliment_exteranl').val(); 
       var totalgrade_external =$('#totalgrade_externalcompliment').val(); 
      var creditpoint = $('#creditpointcompliment').val();
      var status_external = $('#status_externalcompliment').val();
       var type = $('#typeexternalcompliment').val();
      
     $("#experiencefailcompliment").html("");
      $("#experienceaddcompliment").html("");
      
      
      
     if(Semesterexternal==""){ $("#Semesterexternalcompliment_Err").html("Please Enter Semester"); }
      else{$("#Semesterexternalcompliment_Err").html(""); }
      if(name_of_paper_external==""){ $("#name_of_paper_externalcompliment_Err").html("Please Enter Name of Paper"); }
      else{$("#name_of_paper_externalcompliment_Err").html(""); }
      if(paper_code_external==""){ $("#paper_code_externalcompliment_Err").html("Please Enter PaperCode"); }
      else{$("#paper_code_externalcompliment_Err").html(""); }
       if(type==""){ $("#typeexternalcompliment_Err").html("Please Enter Type"); }
      else{$("#typeexternalcompliment_Err").html(""); }
    //   if(credits==""){ $("#creditscompliment_Err").html("Please Enter Credits"); }
    //   else{$("#creditscompliment_Err").html(""); }
    //     if(externalgrade==""){ $("#externalgradecompliment_Err").html("Please Enter External Grade"); }
    //   else{$("#externalgradecompliment_Err").html(""); }
    //     if(internalgrade_exteranl==""){ $("#internalgradecompliment_exteranl_Err").html("Please Enter Internal Grade"); }
    //   else{$("#internalgradecompliment_exteranl_Err").html(""); }
    // if(totalgrade_external==""){ $("#totalgrade_externalcompliment_Err").html("Please Enter Total Grade"); }
    //   else{$("#totalgrade_externalcompliment_Err").html(""); }
    //   if(creditpoint==""){ $("#creditpointcompliment_Err").html("Please Enter Credit Point"); }
    //   else{$("#creditpointcompliment_Err").html(""); }
    //   if(status_external==""){ $("#status_externalcompliment_Err").html("Please Enter Status"); }
    //   else{$("#status_externalcompliment_Err").html(""); }
      
     if(Semesterexternal!="" && name_of_paper_external!="" && paper_code_external!=""  && type!=""){
        
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$saveExternalMarks}}",
              type: "POST",
              data: {
               
                  programexternal : programexternal,
                  batchexternal:batchexternal,
                  stnameexternal:stnameexternal,
                  stidexternal:stidexternal,
                  Semesterexternal: Semesterexternal,
                  name_of_paper_external:name_of_paper_external,
                  paper_code_external:paper_code_external,
                  credits:credits,
                  externalgrade: externalgrade,
                  internalgrade_exteranl:internalgrade_exteranl,
                  totalgrade_external:totalgrade_external,
                  creditpoint:creditpoint,
                  status_external:status_external,
                  type:type
                 
              },
               cache: false,
              success: function(dataResult){
                $("#experienceaddcompliment").html(dataResult.success);
                $("#Semesterexternalcompliment_Err").html("");
                $("#name_of_paper_externalcompliment_Err").html("");
                $("#paper_code_externalcompliment_Err").html("");
                $("#creditscompliment_Err").html("");
                $("#externalgradecompliment_Err").html("");
                $("#internalgradecompliment_exteranl_Err").html("");
                $("#totalgrade_externalcompliment_Err").html("");
                $("#creditpointcompliment_Err").html("");
                $("#status_externalcompliment_Err").html("");
                $(".experiencecompliment tr:last").before('<tr id="experiencecomplimentinfo_'+dataResult.insertId+'"><td>'+programexternal+'</td><td>'+batchexternal+'</td><td>'+stnameexternal+'</td><td>'+Semesterexternal+'</td><td>'+type+'</td><td>'+name_of_paper_external+'</td><td>'+paper_code_external+'</td><td>'+credits+'</td><td>'+externalgrade+'</td><td>'+internalgrade_exteranl+'</td><td>'+totalgrade_external+'</td><td>'+creditpoint+'</td><td>'+status_external+'</td><td><button class="btn btn-danger" onclick="removeExperiencecompliment('+dataResult.insertId+')"><i class="fa fa-trash" aria-hidden="true"></i></button><button class="btn btn-danger" onclick="editExternalEdit('+dataResult.insertId+')" data-toggle="modal" data-target="#externalModel"><i class="fa fa-pencil" aria-hidden="true"></i></button></td></tr>');
                $('#programexternalcompliment').val('');
                $('#batchexternalcompliment').val('');
                $('#stnameexternalcompliment').val('');
                $('#Semesterexternalcompliment').val('');
                $('#name_of_paper_externalcompliment').val('');
                $('#paper_code_externalcompliment').val('');
                $('#creditscompliment').val('');
                $('#externalgradecompliment').val('');
                $('#internalgradecompliment_exteranl').val('');
                $('#totalgrade_externalcompliment').val('');
                $('#creditpointcompliment').val('');
                $('#status_externalcompliment').val('');
                $('#typeexternalcompliment').val('');
                
                
                  if(dataResult.statusCode==200){
                   // window.location = "/userData";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
      }
      else{
         // $("#experiencefail").html('Please fill all the fields !');
         // alert('Please fill all the fields !');
      }
  });

 
 
$('body').on('click', '#overall_btn', function() {
       var programoverall = $('#programoverall').val();
      var batchoverall = $('#batchoverall').val();
      var stnameoverall = $('#stnameoverall').val();
      var stidoverall =$('#stidoverall').val();
      var Semesteroverall = $('#Semesteroverall').val();
      var sgpa = $('#sgpa').val();
      var gradeov = $('#gradeov').val();
      var cgpa =$('#cgpa').val(); 
     
     $("#overallfail").html("");
      $("#overalladd").html("");
      

      
     if(Semesteroverall==""){ $("#Semesteroverall_Err").html("Please Enter Semester"); }
      else{$("#Semesteroverall_Err").html(""); }
      if(sgpa==""){ $("#sgpa_Err").html("Please Enter SGPA"); }
      else{$("#sgpa_Err").html(""); }
      if(gradeov==""){ $("#gradeov_Err").html("Please Enter GRADE"); }
      else{$("#gradeov_Err").html(""); }
       if(cgpa==""){ $("#cgpa_Err").html("Please Enter CGPA"); }
      else{$("#cgpa_Err").html(""); }
      
      
     if(Semesteroverall!="" && sgpa!="" && paper_code_external!=""  && gradeov!="" && cgpa!="" ){
        
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$saveOverallMarks}}",
              type: "POST",
              data: {
               
                  programoverall : programoverall,
                  batchoverall:batchoverall,
                  stnameoverall:stnameoverall,
                  stidoverall:stidoverall,
                  Semesteroverall: Semesteroverall,
                  sgpa:sgpa,
                  gradeov:gradeov,
                  cgpa:cgpa,
                 
                 
              },
               cache: false,
              success: function(dataResult){
                $("#overalladd").html(dataResult.success);
                $("#Semesteroverall_Err").html("");
                $("#sgpa_Err").html("");
                $("#gradeov_Err").html("");
                $("#cgpa_Err").html("");
               
                $(".overall tr:last").before('<tr id="overallinfo_'+dataResult.insertId+'"><td>'+programoverall+'</td><td>'+batchoverall+'</td><td>'+stnameoverall+'</td><td>'+Semesteroverall+'</td><td>'+sgpa+'</td><td>'+gradeov+'</td><td>'+cgpa+'</td><td><button class="btn btn-danger" onclick="removeOverall('+dataResult.insertId+')"><i class="fa fa-trash" aria-hidden="true"></i></button><button class="btn btn-danger" onclick="editOverallEdit('+dataResult.insertId+')" data-toggle="modal" data-target="#overallModel"><i class="fa fa-pencil" aria-hidden="true"></i></button></td></tr>');
                $('#programoverall').val('');
                $('#batchoverall').val('');
                $('#stnameoverall').val('');
                $('#Semesteroverall').val('');
                $('#sgpa').val('');
                $('#gradeov').val('');
                $('#cgpa').val('');
                
                
                  if(dataResult.statusCode==200){
                   // window.location = "/userData";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
      }
      else{
         // $("#experiencefail").html('Please fill all the fields !');
         // alert('Please fill all the fields !');
      }
  });
 
  
$('body').on('click', '#project_btn', function() {
       var programproject = $('#programproject').val();
      var batchproject = $('#batchproject').val();
      var stnameproject = $('#stnameproject').val();
      var stidproject =$('#stidproject').val();
      var Semesterproject = $('#Semesterproject').val();
      var project = $('#project').val();
      var supervising_teacher = $('#supervising_teacher').val();
      var name_of_instituition =$('#name_of_instituition').val(); 
      var intership_note =$('#intership_note').val(); 
      var Period =$('#Period').val(); 
     
     $("#projectfail").html("");
      $("#projectadd").html("");
      

      
     if(Semesterproject==""){ $("#Semesterproject_Err").html("Please Enter Semester"); }
      else{$("#Semesterproject_Err").html(""); }
      if(project==""){ $("#project_Err").html("Please Enter Project Title"); }
      else{$("#project_Err").html(""); }
     if(supervising_teacher==""){ $("#supervising_teacher_Err").html("Please Enter Supervising Faculty"); }
      else{$("#supervising_teacher_Err").html(""); }
      
     if(Semesteroverall!="" && project!="" && supervising_teacher){
        
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$saveProjectMarks}}",
              type: "POST",
              data: {
               
                  programproject : programproject,
                  batchproject:batchproject,
                  stnameproject:stnameproject,
                  stidproject:stidproject,
                  Semesterproject: Semesterproject,
                  project:project,
                  supervising_teacher:supervising_teacher,
                  name_of_instituition:name_of_instituition,
                  intership_note:intership_note,
                  Period:Period
              },
               cache: false,
              success: function(dataResult){
                $("#projectadd").html(dataResult.success);
                $("#Semesterproject_Err").html("");
                $("#project_Err").html("");
                $("#supervising_teacher_Err").html("");
              
                $(".project tr:last").before('<tr id="projectinfo_'+dataResult.insertId+'"><td>'+programproject+'</td><td>'+batchproject+'</td><td>'+stnameproject+'</td><td>'+Semesterproject+'</td><td>'+project+'</td><td>'+supervising_teacher+'</td><td>'+name_of_instituition+'</td><td>'+intership_note+'</td><td>'+Period+'</td><td><button class="btn btn-danger" onclick="removeOverall('+dataResult.insertId+')"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>');
                $('#programproject').val('');
                $('#batchproject').val('');
                $('#stnameproject').val('');
                $('#Semesterproject').val('');
                $('#project').val('');
                $('#supervising_teacher').val('');
                $('#name_of_instituition').val('');
                $('#intership_note').val('');
                $('#Period').val('');
                
                
                  if(dataResult.statusCode==200){
                   // window.location = "/userData";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
      }
      else{
         // $("#experiencefail").html('Please fill all the fields !');
         // alert('Please fill all the fields !');
      }
  });
 
 $('body').on('click', '#field_btn', function() {
       var programfield = $('#programfield').val();
      var batchfield = $('#batchfield').val();
      var stnamefield = $('#stnamefield').val();
      var stidfield = $('#stidfield').val();
      var Semesterfield = $('#Semesterfield').val();
      var industrial_visit = $('#industrial_visit').val();
      var supervising_teacher_field = $('#supervising_teacher_field').val();
      var name_of_industry =$('#name_of_industry').val(); 
      var num_of_days =$('#num_of_days').val(); 
      var period_field =$('#period_field').val(); 
      var course_paper =$('#course_paper').val(); 
     
     $("#fieldadd").html("");
     $("#fieldfail").html("");
      

      
     if(Semesterfield==""){ $("#Semesterfield_Err").html("Please Enter Semester"); }
      else{$("#Semesterfield_Err").html(""); }
      if(industrial_visit==""){ $("#industrial_visit_Err").html("Please Enter Industrial Visit Title"); }
      else{$("#industrial_visit_Err").html(""); }
     if(supervising_teacher_field==""){ $("#supervising_teacher_field_Err").html("Please Enter Supervising Faculty"); }
      else{$("#supervising_teacher_field_Err").html(""); }
      
     if(Semesterfield!="" && industrial_visit!="" && supervising_teacher_field){
        
          $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{$saveIndustryMarks}}",
              type: "POST",
              data: {
               
                  programfield : programfield,
                  batchfield:batchfield,
                  stnamefield:stnamefield,
                  stidfield:stidfield,
                  Semesterfield: Semesterfield,
                  industrial_visit:industrial_visit,
                  supervising_teacher_field:supervising_teacher_field,
                  name_of_industry:name_of_industry,
                  num_of_days:num_of_days,
                  period_field:period_field,
                  course_paper:course_paper
              },
               cache: false,
              success: function(dataResult){
                $("#fieldadd").html(dataResult.success);
                $("#Semesterfield_Err").html("");
                $("#industrial_visit_Err").html("");
                $("#supervising_teacher_field_Err").html("");
              
                $(".field tr:last").before('<tr id="fieldinfo_'+dataResult.insertId+'"><td>'+programfield+'</td><td>'+batchfield+'</td><td>'+stnamefield+'</td><td>'+Semesterfield+'</td><td>'+industrial_visit+'</td><td>'+supervising_teacher_field+'</td><td>'+name_of_industry+'</td><td>'+num_of_days+'</td><td>'+period_field+'</td><td>'+course_paper+'</td><td><button class="btn btn-danger" onclick="removeOverall('+dataResult.insertId+')"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>');
                $('#programfield').val('');
                $('#batchfield').val('');
                $('#stnamefield').val('');
                $('#Semesterfield').val('');
                $('#industrial_visit').val('');
                $('#supervising_teacher_field').val('');
                $('#name_of_industry').val('');
                $('#num_of_days').val('');
                $('#period_field').val('');
                $('#course_paper').val('');
                
                  if(dataResult.statusCode==200){
                   // window.location = "/userData";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
      }
      else{
         // $("#experiencefail").html('Please fill all the fields !');
         // alert('Please fill all the fields !');
      }
  });
 
 
function removeExperience(editid){
   
    $('#experienceinfo_'+editid).remove();
    $("#experienceadd").html("");
        $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{ $deleteExternalMarks }}",
              type: "POST",
              data: {
                
                  id: editid,
              },
              cache: false,
              success: function(dataResult){
                // alert(dataResult.success);
                 $("#experienceadd").html(dataResult.success);
                 
                  if(dataResult.statusCode==200){
                   // window.location = "/userData";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
}

function removeExperiencecompliment(editid){
   
    $('#experiencecomplimentinfo_'+editid).remove();
    $("#experiencecomplimentadd").html("");
        $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{ $deleteExternalMarks }}",
              type: "POST",
              data: {
                
                  id: editid,
              },
              cache: false,
              success: function(dataResult){
                // alert(dataResult.success);
                 $("#experiencecomplimentadd").html(dataResult.success);
                 
                  if(dataResult.statusCode==200){
                   // window.location = "/userData";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
}

 function removeField(editid){
   
    $('#fieldinfo_'+editid).remove();
    $("#fieldadd").html("");
        $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{ $deleteIndustryMarks }}",
              type: "POST",
              data: {
                
                  id: editid,
              },
              cache: false,
              success: function(dataResult){
                // alert(dataResult.success);
                 $("#fieldadd").html(dataResult.success);
                 
                  if(dataResult.statusCode==200){
                   // window.location = "/userData";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
}
  function removeProject(editid){
   
    $('#projectinfo_'+editid).remove();
    $("#projectadd").html("");
        $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{ $deleteProjectMarks }}",
              type: "POST",
              data: {
                
                  id: editid,
              },
              cache: false,
              success: function(dataResult){
                // alert(dataResult.success);
                 $("#projectadd").html(dataResult.success);
                 
                  if(dataResult.statusCode==200){
                   // window.location = "/userData";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
}
  
function removeOverall(editid){
   
    $('#overallinfo_'+editid).remove();
    $("#overalladd").html("");
        $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url: "{{ $deleteOverallMarks }}",
              type: "POST",
              data: {
                
                  id: editid,
              },
              cache: false,
              success: function(dataResult){
                // alert(dataResult.success);
                 $("#overalladd").html(dataResult.success);
                 
                  if(dataResult.statusCode==200){
                   // window.location = "/userData";				
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
}
  $("#typecompliment").change(function()
{
var id=$(this).val();


 $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$fetchPapername}}",
            type: 'GET',
            data:{'id':id},
            dataType: 'json',
           success: function(result) {
               $('#name_of_paper_compliment').html('<option value="">-- Select Paper --</option>');
                        $.each(result.complimentry, function (key, value) {
                            $("#name_of_paper_compliment").append('<option value="' + value
                                .p_name + '">' + value.p_name + '</option>');
                        });
                       
             $('#paper_code_compliment').html('<option value="">-- Select Code --</option>');
                        $.each(result.complimentry, function (key, value) {
                            $("#paper_code_compliment").append('<option value="' + value
                                .p_code + '">' + value.p_code + '</option>');
                        });      
					



                }
                  
        });
});
  $("#typeexternalcompliment").change(function()
{
var id=$(this).val();


 $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$fetchPapername}}",
            type: 'GET',
            data:{'id':id},
            dataType: 'json',
           success: function(result) {
               $('#name_of_paper_externalcompliment').html('<option value="">-- Select Paper --</option>');
                        $.each(result.complimentry, function (key, value) {
                            $("#name_of_paper_externalcompliment").append('<option value="' + value
                                .p_name + '">' + value.p_name + '</option>');
                        });
                       
             $('#paper_code_externalcompliment').html('<option value="">-- Select Code --</option>');
                        $.each(result.complimentry, function (key, value) {
                            $("#paper_code_externalcompliment").append('<option value="' + value
                                .p_code + '">' + value.p_code + '</option>');
                        });      
					



                }
                  
        });
});
</script>
@endsection