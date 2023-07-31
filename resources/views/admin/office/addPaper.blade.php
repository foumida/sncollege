@if(Auth::User()->role == 1)
   @php $type = "layouts.admin.default";
    $deletepaper=url('admin/deletePaper');
    $savepaper= url('/admin/savePaper');
     $fetcheditPaper=url('admin/fetchPaperValues');
     $updatePaper=url('admin/updatePaper');
     
   @endphp
@elseif(Auth::User()->role == 3)
   @php $type = "layouts.office.default";
      $deletepaper=url('office/deletePaper');
      $savepaper= url('/office/savePaper');
        $fetcheditPaper=url('office/fetchPaperValues');
         $updatePaper=url('office/updatePaper');
   @endphp
@elseif(Auth::User()->role == 6)
   @php $type = "layouts.hod.default";
      $deletepaper=url('hod/deletePaper');
      $savepaper= url('/hod/savePaper');
      $fetcheditPaper=url('hod/fetchPaperValues');
       $updatePaper=url('hod/updatePaper');
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
</style>
         <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="row">
             
              
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Paper</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
              
                     
					         <div class="row">
                                    <div class="col-md-12">
                                        <label>Papers</label>
                                        <table class="table table-bordered" id="tab_logic">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Paper Code</th>
                                                    <th>Paper Name</th>
                                                    <th>Credit</th>
                                                    <th>Hours</th>
                                                    <th>Type</th>
                                                   <!-- <th  id="blethry" style="display:none">Theory</th>-->
                                                    <th>Syllabus</th>
                                                    <th>Semester</th>
                                                    <th><input type="button" value="+" id="add" class="btn btn-primary"></th> 
                                                </tr>
                                            </thead>
                                            <tbody class="detail"> 
                                            <tr>
                                                <td class="no">1</td>  <input type="hidden" id="editid" name="editid" value="{{$id}}" />	
                                                <td><input type="text" class="form-control" name="p_code[]" id="p_code_1"><span class="text-danger" ></td>
                                                <td><input type="text" class="form-control" name="p_name[]" id="p_name_1"><span class="text-danger" ></td>
                                                <td><input type="text" class="form-control" name="p_credit[]" id="p_credit_1"><span class="text-danger" ></td>
                                                <td><input type="text" class="form-control" name="p_hourse[]" id="p_hourse_1"><span class="text-danger" ></td>
                                                <td>
                                                    <select class="form-control myselection" name="p_type[]" id="p_type_1" data-id="0">
                                                        <option value="">none</option>
                                                        <option value="Theory">Theory</option>
                                                        <option value="Practical">Practical</option>
                                                        <option value="Viva">Viva</option>
                                                        <option value="Project">Project</option>
                                                        <option value="Internship">Internship</option>
                                                    </select><span class="text-danger" ><br> <select class="form-control checklist" name="p_theory[]" id="p_theory_1" style="display:none">
                                                        <option value="">Please Select </option>
                                                        <option value="Main">Main</option>
                                                        <option value="Complimentery">Complimentery</option>
                                                        <option value="firstlanguage">Ist Language</option>
                                                        <option value="secondlanguage">2nd Language</option>
                                                        
                                                    </select></td></td>
                                                </td>
                                              <!--   <td class="float_form" style="display:none">
                                                    <select class="form-control" name="p_theory[]" id="p_theory_1">
                                                        <option value="">none</option>
                                                        <option value="Main">Main</option>
                                                        <option value="Complimentery">Complimentery</option>
                                                        <option value="firstlanguage">Ist Language</option>
                                                        <option value="secondlanguage">2nd Language</option>
                                                        
                                                    </select><span class="text-danger" ></td>
                                                </td>-->
                                                 <td><input type="file" class="form-control" name="files[]" id="p_file_1"><span class="text-danger" ></td>
                                                   <td>
                                                    <select class="form-control" name="p_semester[]" id="p_semester_1">
                                                        <option value="">none</option>
                                                        <option value="Semester 1">Semester 1</option>
                                                        <option value="Semester 2">Semester 2</option>
                                                        <option value="Semester 3">Semester 3</option>
                                                        <option value="Semester 4">Semester 4</option>
                                                        <option value="Semester 5">Semester 5</option>
                                                        <option value="Semester 6">Semester 6</option>
                                                        <option value="Semester 7">Semester 7</option>
                                                        <option value="Semester 8">Semester 8</option>
                                                    </select><span class="text-danger" >
                                                </td>
                                                <td><button class="remove btn btn-danger">-</button></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>     
						
						<br><br>
						
						 
					<button type="submit" class="btn btn-success btn-block enter-btn" style="float:right;">Submit</button> 
					</form>
				</div>
				
				 <div class="card-body">
				     
					 @if(!empty($list))
                    <h4 class="card-title"> Paper List</h4>
                  
   
    

                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Paper</th>
                            <th> Code </th>
							<th> Credit </th>
							<th> Hours </th>
						   	<th> Type </th>
                            <th> Syllabus</th>
                            <th> Semester</th>
                            <th> Action</th>
                          </tr>
                        </thead>
                        <tbody>
						 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            
                               <span class="pl-2">{{$val->p_name}}</span>
                            </td>
                            <td>{{$val->p_code}}</td>
                            <td>{{$val->p_credit}}  </td>
						     <td>{{$val->p_hourse}}  </td>
						     <td>{{$val->p_type}} {{$val->theory_subdivision}} </td>
						     <td>{{$val->p_syllabus}}  <a style="float:right;" class="btn btn-info mb-2" href="{{url('uploads/course/'.$val->p_syllabus)}}" download="">Download</a> </td>
						     <td>{{$val->p_semester}} </td>
						     						    
 @if(Auth::User()->role == 1)  
 @php 
  
   $delete=url('admin/deletePaper',$val->id);
   $editPaper=url('admin/editPaper',$val->id);
   
   
 @endphp
@elseif(Auth::User()->role == 3)
   @php 
   
    $delete=url('office/deletePaper',$val->id);
     $editPaper=url('office/editPaper',$val->id);
    
 @endphp
 @elseif(Auth::User()->role == 6)
   @php 
   
    $delete=url('hod/deletePaper',$val->id);
     $editPaper=url('hod/editPaper',$val->id);
   
 @endphp
 @endif
                            <td>
                             
							   <div class="badge badge-outline-success"> <a href="{{ $delete }}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
							    <div class="badge badge-outline-success"> <button class="btn btn-danger" onclick="editPaperEdit({{$val->id}})" data-toggle="modal" data-target="#externalModel"><i class="fa fa-pencil" aria-hidden="true"></i></button>
							  </div>
							  
                            </td>
                          </tr>
                          <?php $i++; ?>
                                    @endforeach
                                       
                       
                          
                         
                        </tbody>
                      </table>
                    </div>
					@endif
				
                  </div>	
                
            </div>
            
                  <div class="modal fade" id="externalModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
               <form id="paperForm" enctype="multipart/form-data">
                        @csrf  
                    <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">Papercode</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="extpapercode" name="extpapercode" >
                             <input type="hidden" class="form-control" id="exteditid" name="exteditid" >
                        </div>
                    </div>
       
                    <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">PaperName</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control intassignment"  id="pname" name="pname" >
                        </div>
                    </div>
                        <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">Credit</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control intassignment"  id="credit" name="credit" >
                        </div>
                    </div>
                      <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">Hours</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control intassignment"  id="hours" name="hours" >
                        </div>
                    </div>
                        <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">Type</label>
                        <div class="col-sm-12">
                             <select class="form-control myselection" name="type" id="type">
                                                        <option value="">none</option>
                                                        <option value="Theory">Theory</option>
                                                        <option value="Practical">Practical</option>
                                                        <option value="Viva">Viva</option>
                                                        <option value="Project">Project</option>
                                                        <option value="Internship">Internship</option>
                                                    </select> 
                        </div>
                    </div>
                     <div class="form-group">
                      
                        <div class="col-sm-12">
                             <select class="form-control myselection" name="subdivision" id="subdivision" >
                                                        
                                                        <option value="">Please Select Theory subdivision </option>
                                                        <option value="Main">Main</option>
                                                        <option value="Complimentery">Complimentery</option>
                                                        <option value="firstlanguage">Ist Language</option>
                                                        <option value="secondlanguage">2nd Language</option>
                                                        
                                                    </select>
                        </div>
                    </div>
                      <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">Syllabus</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" name="file1" id="file1">
                            <input type="hidden" name="current_file" id="current_file">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">Select Semester</label>
                        <div class="col-sm-12">
                           <select class="form-control" name="semester" id="semester">
                                                        <option value="">none</option>
                                                        <option value="Semester 1">Semester 1</option>
                                                        <option value="Semester 2">Semester 2</option>
                                                        <option value="Semester 3">Semester 3</option>
                                                        <option value="Semester 4">Semester 4</option>
                                                        <option value="Semester 5">Semester 5</option>
                                                        <option value="Semester 6">Semester 6</option>
                                                        <option value="Semester 7">Semester 7</option>
                                                        <option value="Semester 8">Semester 8</option>
                                                    </select>
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
          </div>
          </div>
          </div>
          </div>
	

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

  <script type="text/javascript">
        var subcategory = {
            UG: ["BA", "BSC", "Bcom", "Bvoc"],
            PG: ["MA", "MSC", "Mcom","Mvoc"],
            Certificate: ["Diploma", "Advanced Diploma", "Certificate", "Mooc"],
           
        }

        function makeSubmenu(value) {
            if (value.length == 0) document.getElementById("categorySelect").innerHTML = "<option></option>";
            else {
                var citiesOptions = "NA";
                for (categoryId in subcategory[value]) {
                    citiesOptions += "<option value="+subcategory[value][categoryId]+" >" + subcategory[value][categoryId] + "</option>";
                }
                document.getElementById("categorySelect").innerHTML = citiesOptions;
            }
        }


    </script>

<script type="text/javascript">
$(document).ready(function(){
$(".teachernew").on("change", function(){
   var total=0;
      $(".teachernew").each(function(){
          if(!isNaN(parseInt($(this).val())))
          {
            total+=parseInt($(this).val());  
          }
      });
      $(".total").val(total);
});
})
$(document).ready(function() {
    $('.detail').on('click', '.myselection', function() {

   // $('.myselection').on('change', function(){
        var ID = $(this).attr("data-id");
        
        if ($(this).val() === "Theory") {
           
          
            $('.checklist').show();
            if($('.checklist').show())
            {
   alert('Please enter Main OR Complimentory OR 1st-Language OR 2ND-Language');
            }
        }
        else
        {
            
             // blethry.style.display="none"
              $('.checklist').hide();
        }
    });
});

$(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
        e.preventDefault();  
    
     var validate = false;
    $('#tab_logic').find('tr input[class=form-control],select[class=form-control]').each(function(){
    if($(this).val() == ""){
        $(this).next( ".text-danger").html("required");
        validate = true;
        
    }
    
  });
  
   if(validate==true){
    alert("Pls add a paper with all fields")
    return false;// you can submit form or send ajax or whatever you want here
 
  }
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$savepaper}}",
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
                   // this.reset();
                    alert('Paper details has been submitted successfully');
				    window.location.reload();
                }
            },
        });
    });
});
    $("#paperForm").on('submit', function(e){
         e.preventDefault();
      var extpapercode = $('#extpapercode').val();
     
      var pname = $('#pname').val();
      var credit = $('#credit').val();
      var hours =$('#hours').val();
      var type = $('#type').val();
      var subdivision = $('#subdivision').val();
       var semester = $('#semester').val();
      var exteditid = $('#exteditid').val();
          $.ajax({
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$updatePaper}}",
            type: 'POST',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
              success: (response) => {
               alert('Paper Details has been updated successfully');
					window.location.reload();
            },
          });
      
     
  }); 
function editPaperEdit(editid)
{
  

      	event.preventDefault();

 $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$fetcheditPaper}}",
             type: "GET",
            data: {id:editid},
            dataType: 'json',
           
            cache: false,
         
         success: function(res)
              {
          
                         
                      if (res == null) {
                         
                      } else {
                           $("#extpapercode").val(res[0]['p_code']);
                           $("#pname").val(res[0]['p_name']);
					       $("#credit").val(res[0]['p_credit']);
					       $("#hours").val(res[0]['p_hourse']);
					       $("#type").val(res[0]['p_type']);
					       $("#subdivision").val(res[0]['theory_subdivision']);
					       $("#current_file").val(res[0]['p_syllabus']);
					       $("#semester").val(res[0]['p_semester']);
					       $("#exteditid").val(editid);
                      }
            }
        });

      
}

 $("#image").change(function() {
    var file = this.files[0];
    var fileType = file.type;
    var match = ['image/jpeg', 'image/png', 'image/jpg'];
    if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))){
        alert('Sorry JPG, JPEG, & PNG files are allowed to upload.');
        $("#image").val('');
        return false;
    }
});   
 $("#file1").change(function() {
    var file = this.files[0];
    var fileType = file.type;
    var match = ['application/pdf', 'application/msword'];
    if(!((fileType == match[0]) || (fileType == match[1]))){
        alert('Sorry only Pdf or Doc files are allowed to upload.');
        $("#file1").val('');
        return false;
    }
});   
</script>
<script type="text/javascript">  
$(function()  
{  
    
$('#add').click(function()  
{  

addnewrow();  
});  
$('body').delegate('.remove','click',function()  
{  
$(this).parent().parent().remove();  
});  
}); 
   
function addnewrow()   
{ 
    var count=1;
 //   count++;
var n=($('.detail tr').length-0)+1;  
var tr = '<tr>'+  
'<td class="no">'+n+'</td>'+  
'<td><input type="text" class="form-control" name="p_code[]" id="p_code"><span class="text-danger" ></td>'+  
'<td><input type="text" class="form-control" name="p_name[]" id="p_name"><span class="text-danger" ></td>'+  
'<td><input type="text" class="form-control" name="p_credit[]" id="p_credit"><span class="text-danger" ></td>'+  
'<td><input type="text" class="form-control" name="p_hourse[]" id="p_hourse"><span class="text-danger" ></td>'+
'<td><select class="form-control myselection" name="p_type[]" id="p_type" data-id='+n+'><option value="">none</option><option value="Theory">Theory</option><option value="Practical">Practical</option><option value="Viva">Viva</option><option value="Project">Project</option><option value="Internship">Internship</option></select><span class="text-danger" ><br><select class="form-control checklist" name="p_theory[]" id="p_theory" style="display:none"><option value="">Please Select </option><option value="Main">Main</option><option value="Complimentery">Complimentery</option><option value="firstlanguage">Ist Language</option><option value="secondlanguage">2nd Language</option></select></td></td>'+ 
//'<td class="float_form" style="display:none"><select class="form-control" name="p_theory[]" id="p_theory"><option value="">none</option><option value="Main">Main</option><option value="Complimentery">Complimentery</option><option value="firstlanguage">Ist Language</option><option value="secondlanguage">2nd Language</option></select></td></td>'+
'<td><input type="file" class="form-control" name="files[]" id="p_file"><span class="text-danger" ></td></td></td>'+  
'<td><select class="form-control" name="p_semester[]" id="p_semester"><option value="">none</option><option value="Semester 1">Semester 1</option><option value="Semester 2">Semester 2</option><option value="Semester 3">Semester 3</option><option value="Semester 4">Semester 4</option><option value="Semester 5">Semester 5</option><option value="Semester 6">Semester 6</option></select><span class="text-danger" ></td>'+  
'<td><button class="remove btn btn-danger">-</button></td>'+
'</tr>';  

$('.detail').append(tr); 
console.log(n);
count++;  
}  
</script>    
<script>
function deletePaper(id)
{
//	alert(id);
	event.preventDefault();
if (confirm("Are you sure you want to delete?") == true) {
        $.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{$deletepaper}}",
            method:"POST",
			data:{id:id},
            dataType: 'text',
            success: function(data) {
                
            }
        });
    }
}
</script>
@endsection