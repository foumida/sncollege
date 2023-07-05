@if(Auth::User()->role == 1)
   @php $type = "layouts.admin.default";
    $deleteScholarship=url('admin/deleteScholarship');
    $saveScholarship= url('/admin/saveScholarship');
   @endphp
 @elseif(Auth::User()->role == 2)
  
  @php 
  $type = "layouts.faculty.default";
   $deleteScholarship=url('faculty/deleteScholarship');
    $saveScholarship= url('/faculty/saveScholarship');
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
                    <h4 class="card-title">Add Scholarship</h4>
                    <div id="mainform">
                   <form id="fupForm" enctype="multipart/form-data">
                        @csrf  
              
                     
					         <div class="row">
                                    <div class="col-md-12">
                                        <label>Scholarship</label>
                                        <div class="table-responsive">
                                        <table class="table table-bordered w-100" id="tab_logic">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                  
                                                    <th>Scholarship Name</th>
                                                    <th>Period</th>
                                                    <th>Date Of Application</th>
                                                    <th>Date Of Entry</th>
                                                    <th>Date Of Sanction</th>
                                                    <th>Amount</th>
                                                    <th>Type</th>
                                                   <th>Document Upload</th>
                                                    
                                                    <th><input type="button" value="+" id="add" class="btn btn-primary"></th> 
                                                </tr>
                                            </thead>
                                            <tbody class="detail"> 
                                            <tr>
                                                <td class="no">1</td>  <input type="hidden" id="editid" name="editid" value="{{$id}}" />	
                                                
                                                  <td><select class="form-control" name="p_name[]" id="p_name_1">
                                                         @foreach($title as $row)
            								            <option value="{{ $row->keywordname }}">{{ $row->keywordname }}</option>
            						            	@endforeach
                                                    </select><span class="text-danger" ></td>
                                                <td><input type="text" class="form-control" name="p_period[]" id="p_period_1"><span class="text-danger" ></td>
                                                <td><input type="date" class="form-control" name="p_dateofApp[]" id="p_dateofApp_1"><span class="text-danger" ></td>
                                                <td><input type="date" class="form-control" name="p_dateofentry[]" id="p_dateofentry_1"><span class="text-danger" ></td>
                                                <td><input type="date" class="form-control" name="p_date[]" id="p_date_1"><span class="text-danger" ></td>
                                                 <td><input type="text" class="form-control" name="p_amt[]" id="p_amt_1"><span class="text-danger" ></td>
                                                <td>
                                                    <select class="form-control myselection" name="p_type[]" id="p_type_1" data-id="0">
                                                        <option value="">none</option>
                                                        <option value="Direct Account">Direct Account</option>
                                                        <option value="Through College">Through College</option>
                                                       
                                                   </td></td>
                                                    <td><input type="file" class="form-control" name="files[]" id="p_file_1"><span class="text-danger" ></td>
                                                </td>
                                             
                                                  
                                                <td><button class="remove btn btn-danger">-</button></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>     
						
						<br><br>
						
						 
					<button type="submit" class="btn btn-success btn-block enter-btn" style="float:right;">Submit</button> 
					</form>
				</div>
				
				 <div class="card-body">
				     
					 @if(!empty($list))
                    <h4 class="card-title"> Scholarship List</h4>
                  
   
    

                    <div class="table-responsive">
                      <table class="table table-bordered" id="myTable" >
                        <thead>
                          <tr>
                            <th>
                              
                            </th>
                            <th> Name</th>
                            <th> Period </th>
                            <th> Date of Application </th>
                            <th> Date of Entry </th>
							<th> Date of Sanction </th>
							
						   	<th> Type </th>
						   	<th> Amount </th>
                            <th> Document</th>
                            <th> Action</th>
                          </tr>
                        </thead>
                        <tbody>
						 <?php $i=1; ?>
                                    @foreach($list as $val)
                          <tr>
                           <td>{{$i}}</td>
                            <td>
                            
                               <span class="pl-2">{{$val->scholarship_name}}</span>
                            </td>
                            <td>{{$val->period}}</td>
                             <th> {{$val->date_of_application}}</th>
                            <th> {{$val->date_of_entry}}</th>
                            <td>{{$val->date_of_sanction}} </td>
						    
						     <td>{{$val->amount_type}}  </td>
						     <th>{{$val->amount}}  </th>
						      <td>{{$val->document}}  <a style="float:right;" class="btn btn-info mb-2" href="{{url('public/uploads/course/'.$val->document)}}" download="">Download</a> </td>
						     						    
 @if(Auth::User()->role == 1)  
 @php 
  
   $delete=url('admin/deleteScholarship',$val->id);
 @endphp
@elseif(Auth::User()->role == 2)
  
  @php 
  $delete=url('faculty/deleteScholarship',$val->id);
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
    alert("Pls add scholarship with all fields")
    return false;// you can submit form or send ajax or whatever you want here
 
  }
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url:"{{$saveScholarship}}",
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
                    alert('Scholarship details has been submitted successfully');
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

'<td><select class="form-control" name="p_name[]" id="p_name_1">  @foreach($title as $row)<option value="{{ $row->keywordname }}">{{ $row->keywordname }}</option>@endforeach</select><span class="text-danger" ></td>'+  
'<td><input type="text" class="form-control" name="p_period[]" id="p_period"><span class="text-danger" ></td>'+  
'<td><input type="date" class="form-control" name="p_dateofApp[]" id="p_dateofApp"><span class="text-danger" ></td>'+
'<td><input type="date" class="form-control" name="p_dateofentry[]" id="p_dateofentry"><span class="text-danger" ></td>'+
'<td><input type="date" class="form-control" name="p_date[]" id="p_date"><span class="text-danger" ></td>'+
'<td><input type="text" class="form-control" name="p_amt[]" id="p_amt"><span class="text-danger" ></td>'+
'<td><select class="form-control myselection" name="p_type[]" id="p_type" data-id='+n+'><option value="">none</option><option value="Direct Account">Direct Account</option><option value="Through College">Through College</option></select><span class="text-danger" ></td></td>'+
'<td><input type="file" class="form-control" name="files[]" id="p_file"><span class="text-danger" ></td></td></td>'+  
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
            url: "{{$deleteScholarship}}",
            method:"POST",
			data:{id:id},
            dataType: 'text',
            success: function(data) {
                 alert("Scholarship Details Deleted Successfully");
				location.reload();
            }
        });
    }
}
</script>
@endsection