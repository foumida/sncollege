
@if(Auth::User()->role == 6)
   @php $type = "layouts.hod.default";
        $saveTutor= url('/hod/saveTutor');
          $deleteTutor=url('hod/deleteTutor');
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
                    <h4 class="card-title">Add Tutor</h4> <br>  <input type="text"  value="{{$coursename}}" />
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
              
                     
					         <div class="row">
                                    <div class="col-md-12">
                                        <label></label>
                                        <table class="table table-bordered" id="tab_logic">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                   
                                                    <th>Faculty Name</th>
                                                    
                                                    <th>Batch</th>
                                                   <!-- <th  id="blethry" style="display:none">Theory</th>-->
                                                 
                                                    <th>Semester</th>
                                                    <th><input type="button" value="+" id="add" class="btn btn-primary"></th> 
                                                </tr>
                                            </thead>
                                            <tbody class="detail"> 
                                            <tr>
                                                <td class="no">1</td>  <input type="hidden" id="editidcourse" name="editidcourse" value="{{$courseid}}" />	 <input type="hidden" id="editid" name="editid" value="{{$coursename}}" />
                                               
                                                <td> <select class="form-control myselection" name="p_name[]" id="p_name_1" >
                                                        <option value="">none </option>
            									
            										@foreach($faculty as $row)
            								            <option value="{{ $row->name }}">{{ $row->name }}</option>
            						            	@endforeach
                                                    </select></td>
                                               
                                                <td>
                                                    <select class="form-control myselection" name="p_type[]" id="p_type_1" >
                                                        <option value="">none </option>
            									
            										@foreach($batch as $row)
            								            <option value="{{ $row->batch }}">{{ $row->batch }}</option>
            						            	@endforeach
                                                    </select></td>
                                                </td>
                                            
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
                             <th> Faculty Name </th>
                            <th> Batch</th>
    
						    <th> Semester </th>
                            <th> Action</th>
                          </tr>
                        </thead>
                        <tbody>
						 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            
                               <span class="pl-2">{{$val->tutor}}</span>
                            </td>
                            <td>{{$val->batch}}</td>
                            <td>{{$val->semester}}  </td>
						     
						  

 @if(Auth::User()->role == 6)
   @php 
    $delete=url('hod/deleteTutor',$val->id);
 
 @endphp
 @endif
                            <td>
                             
							   <div class="badge badge-outline-success"> <a href="{{$delete}}" title="Delete" onclick="return confirm('Are you sure you want to delete the record?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
           
           // blethry.style.display="block";
            $('.checklist').show();
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
			url:"{{$saveTutor}}",
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
                    alert('Tutor Assign has been Done successfully');
				    window.location.reload();
                }
            },
        });
    });
});
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
'<td> <select class="form-control myselection" name="p_name[]" id="p_name_1" ><option value="">none </option>@foreach($faculty as $row)<option value="{{ $row->name }}">{{ $row->name }}</option>@endforeach </select></td>'+  
 '<td><select class="form-control myselection" name="p_type[]" id="p_type" >  <option value="">none </option>	@foreach($batch as $row) <option value="{{ $row->batch }}">{{ $row->batch }}</option>@endforeach</select></td></td>'+ 
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
            url: "{{$deleteTutor}}",
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