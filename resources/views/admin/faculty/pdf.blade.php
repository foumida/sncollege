<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Detail Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" />
  </head>
  <body>
      <div class="container text-center">
          <div class="row" style="margin-top: 2%;margin-bottom: 2%;">
              <div class="col-lg-1"></div>
              <div class="col-lg-10 text-center">
                  <table class="table table-borderless text-center" style="border: 2px solid #11111152;background:#d9d5d5;">
                      <thead style="border-bottom: 2px solid #c6c6c6;">
                          <tr>
                              <th colspan="4"><img src="{{asset('theme/admin/assets/images/logo.png')}}"" /></th>
                          </tr>
                          <tr>
                              <th colspan="4"><h2>Individual Detail Report</h2></th>
                          </tr>
                      </thead>
                      <tbody  class="text-left" style="text-align:left !important;font-size: 14px;color: #000;border-bottom: 2px solid #11111152;">
                          <tr style="text-align:left !important;">
                              <td>Title</td>
                              <td>: @if(!empty($list[0]->title)){{$list[0]->title}}@endif</td>
                              <td>Venue</td>
                              <td>: @if(!empty($list[0]->venue)){{$list[0]->venue}}@endif</td>
                          </tr>
                          <tr style="text-align:left !important;">
                              <td>From Date</td>
                              <td>: @if(!empty($list[0]->title)){{$list[0]->from_date}}@endif</td>
                              <td>To Date</td>
                              <td>: @if(!empty($list[0]->title)){{$list[0]->to_date}}@endif</td>
                          </tr>
                          <tr style="text-align:left !important;">
                              <td>Category</td>
                              <td>: @if(!empty($list[0]->category)){{$list[0]->category}}@endif</td>
                              <td>Event Type</td>
                              <td>: @if(!empty($list[0]->eventtype)){{$list[0]->eventtype}}@endif</td>
                          </tr>
                          <tr style="border-bottom: 2px solid #f0f0f0;">
                              <td colspan="4"><b>Agenda</b></td>
                          </tr>   
                          <tr style="text-align:left !important;">
                              <td colspan="4">  @if(!empty($list[0]->agenda)){{$list[0]->agenda}}@endif</td>
                          </tr>
                          <tr style="border-bottom: 2px solid #f0f0f0;">
                              <td colspan="4"><b>Description</b></td>
                          </tr>   
                          <tr style="text-align:left !important;">
                              <td colspan="4"> @if(!empty($list[0]->description)){{$list[0]->description}}@endif</td>
                          </tr>
                          <tr style="border-bottom: 2px solid #f0f0f0;">
                              <td colspan="4"><b>Teachers</b></td>
                          </tr>
                          <tr style="text-align:left !important;">
                              <td>No of Teachers : @if(!empty($list[0]->no_teachers)){{$list[0]->no_teachers}}@endif </td>
                              <td>Female Teachers : @if(!empty($list[0]->male_teacher)){{$list[0]->male_teacher}}@endif</td>
                              <td>Male Teachers : @if(!empty($list[0]->female_teacher)){{$list[0]->female_teacher}}@endif </td>
                              <td>Other Teachers : @if(!empty($list[0]->other_teacher)){{$list[0]->other_teacher}}@endif</td>
                          </tr>
                          <tr style="border-bottom: 2px solid #f0f0f0;">
                              <td colspan="4"><b>Students</b></td>
                          </tr>
                          <tr style="text-align:left !important; border-bottom: 2px solid #f0f0f0;">
                              <td>No of students : @if(!empty($list[0]->no_students)){{$list[0]->no_students}}@endif</td>
                              <td>Female students : @if(!empty($list[0]->female_student)){{$list[0]->female_student}}@endif</td>
                              <td>Male students : @if(!empty($list[0]->male_student)){{$list[0]->male_student}}@endif</td>
                              <td>Other students : @if(!empty($list[0]->other_student)){{$list[0]->other_student}}@endif</td>
                          </tr>
                          <tr style="text-align:left !important; border-bottom: 2px solid #f0f0f0;">
                              <td>SpeciallyAbled : @if(!empty($list[0]->specially_abled)){{$list[0]->specially_abled}}@endif</td>
                              <td>SC : @if(!empty($list[0]->caste_sc)){{$list[0]->caste_sc}}@endif</td>
                              <td>ST : @if(!empty($list[0]->caste_st)){{$list[0]->caste_st}}@endif</td>
                              <td>OBC : @if(!empty($list[0]->caste_obc)){{$list[0]->caste_obc}}@endif</td>
                          </tr>
                          <tr style="border-bottom: 2px solid #f0f0f0;">
                              <td colspan="4"><b>Criteria</b></td>
                          </tr>
                            @if(!empty($list[0]->main_criteria))	
                        	<?php
                            // explode the saved data back into an array                    
                            $project_type_naac = explode(',', $list[0]->main_criteria);
                            ?>
                          <tr style="text-align:left !important;">
                              <td colspan="4">Naac Criteria : @foreach ($project_type_naac as $key)
                                 @foreach($naac as $val)
                                	 @if($val->id==$key) <br>{{$val->name}}  @endif
                                   @endforeach 
                                   @endforeach</td>
                          </tr>
                           @endif
                           <tr style="border-bottom: 2px solid #f0f0f0;">
                              <td colspan="4"><b>Collaborators</b></td>
                          </tr>
                             @if(!empty($list[0]->collaborators))	
                             <?php
                             // explode the saved data back into an array                    
                             $project_type_collabrator = explode(',', $list[0]->collaborators);
                             ?>
                          <tr style="text-align:left !important;">
                              <td colspan="4">Collabrators :  @foreach ($project_type_collabrator as $key)
                                 @foreach($collabrators as $val)
                                	 @if($val->fid==$key) <br>{{$val->name}}  @endif
                                	 
                                   @endforeach 
                                   @endforeach </td>
                          </tr>
                           @endif
                           <tr style="border-bottom: 2px solid #f0f0f0;">
                              <td colspan="4"><b>Cell</b></td>
                          </tr>
                            @if(!empty($list[0]->cell))
                        	<?php
                            // explode the saved data back into an array                    
                            $project_type_cells = explode(',', $list[0]->cell);
                            ?>
                          <tr style="text-align:left !important;">
                              <td colspan="4">Cells :  @foreach ($project_type_cells as $key)
                                 @foreach($cells as $val)
                                	 @if($val->id==$key) <br>{{$val->name_of_the_cell}}  @endif
                                	 
                                   @endforeach 
                                   @endforeach	</td>
                          </tr>
                           @endif
                           <tr style="border-bottom: 2px solid #f0f0f0;">
                              <td colspan="4"><b>Department</b></td>
                          </tr>
                             @if(!empty($list[0]->dept))
                            <?php
                             // explode the saved data back into an array                    
                             $project_type_dept = explode(',', $list[0]->dept);
                            ?>
                          <tr style="text-align:left !important;">
                              <td colspan="4">Department :  @foreach ($project_type_dept as $key)
                                 @foreach($departments as $val)
                                	 @if($val->id==$key) <br>{{$val->department}}  @endif
                                   @endforeach 
                                   @endforeach</td>
                          </tr>
                          
                           @endif <br>
                            <tr style="text-align:left !important;">
                              <td >
                                @foreach($imagelist as $val)
                                	<img height="100" width="100" src='{{url("uploads/faculty/".$val->picture)}}'  />
                                   @endforeach 
                                   
                                  </td>
                          </tr>
                                   
                      </tbody>
                     
                  </table>
              </div>
              <div class="col-lg-1"></div>
          </div>
      </div>
  												
		
  </body>
</html>