	<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\front_end\HomeController ::class, 'index'])->name('index');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Projects in the Admin
Route::middleware(['middleware'=>'PreventBackHistory'])->group(function(){ Auth::routes(); });



Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

///************************************************************Office*******************************************************///

Route::group(['prefix'=>'admin','middleware'=>['isAdmin','auth','PreventBackHistory']],function(){
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/facultyList', [App\Http\Controllers\Office\OfficeController::class, 'facultyList'])->name('facultyList');
Route::get('/deptList', [App\Http\Controllers\Office\OfficeController::class, 'deptList'])->name('deptList');
Route::get('/cellList', [App\Http\Controllers\Office\OfficeController::class, 'cellList'])->name('cellList');
Route::get('/tcList', [App\Http\Controllers\Office\OfficeController::class, 'tcList'])->name('tcList');
Route::get('/editTc/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editTc'])->name('editTc');
Route::get('/addCertificate', [App\Http\Controllers\HomeController::class, 'addCertificate'])->name('admin.addCertificate');
Route::post('/downloadCertificate', [App\Http\Controllers\HomeController::class, 'downloadCertificate'])->name('downloadCertificate');
Route::post('/editTcUpdate', [App\Http\Controllers\Office\OfficeController::class, 'editTcUpdate'])->name('editTcUpdate');
Route::get('deleteTc/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteTc'])->name('deleteTc');
Route::get('/courseList', [App\Http\Controllers\Office\OfficeController::class, 'courseList'])->name('courseList');

Route::get('/fetchPaperValues', [App\Http\Controllers\Office\OfficeController::class, 'fetchPaperValues'])->name('fetchPaperValues');
Route::post('/updatePaper', [App\Http\Controllers\Office\OfficeController::class, 'updatePaper'])->name('updatePaper');
Route::get('editPaper/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editPaper'])->name('editPaper');

Route::get('deleteFaculty/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteFaculty'])->name('deleteFaculty');
Route::get('/editFaculty/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editFaculty'])->name('editFaculty');
Route::get('/editDept/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editDept'])->name('editDept');
Route::get('/editCell/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editCell'])->name('editCell');
Route::get('/editCourse/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editCourse'])->name('editCourse');
Route::post('/editFacultyinfo', [App\Http\Controllers\Office\OfficeController::class, 'editFacultyinfo'])->name('editFacultyinfo');
Route::post('/editDeptinfo', [App\Http\Controllers\Office\OfficeController::class, 'editDeptinfo'])->name('editDeptinfo');
Route::post('/saveCourseinfo', [App\Http\Controllers\Office\OfficeController::class, 'saveCourseinfo'])->name('saveCourseinfo');
Route::post('/editCellinfo', [App\Http\Controllers\Office\OfficeController::class, 'editCellinfo'])->name('editCellinfo');
Route::get('deleteDept/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteDept'])->name('deleteDept');
Route::get('deleteCell/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteCell'])->name('deleteCell');
Route::get('deletePaper/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deletePaper'])->name('deletePaper');
Route::get('deleteCourse/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteCourse'])->name('deleteCourse');
Route::get('/addPaper/{id}', [App\Http\Controllers\Office\OfficeController::class, 'addPaper'])->name('addPaper');
Route::post('/savePaper', [App\Http\Controllers\Office\OfficeController::class, 'savePaper'])->name('savePaper');
Route::get('/addStudent', [App\Http\Controllers\HomeController::class, 'addStudent'])->name('admin.addStudent');
Route::get('/addTc', [App\Http\Controllers\HomeController::class, 'addTc'])->name('admin.addTc');
Route::get('/fetchRecords', [App\Http\Controllers\HomeController::class, 'fetchRecords'])->name('admin.fetchRecords');
Route::post('/autocompleteSearch', [App\Http\Controllers\HomeController::class, 'autocompleteSearch'])->name('admin.autocompleteSearch');
Route::post('/saveStudent', [App\Http\Controllers\HomeController::class, 'saveStudent'])->name('saveStudent');
Route::get('/studentList', [App\Http\Controllers\HomeController::class, 'studentList'])->name('studentList');
Route::get('/studentListscholarship', [App\Http\Controllers\HomeController::class, 'studentListscholarship'])->name('studentListscholarship');
Route::get('/editStudent/{id}', [App\Http\Controllers\HomeController::class, 'editStudent'])->name('editStudent');
Route::post('/editStudentinfo', [App\Http\Controllers\HomeController::class, 'editStudentinfo'])->name('editStudentinfo');
Route::get('deleteStudent/{id}', [App\Http\Controllers\HomeController::class, 'deleteStudent'])->name('deleteStudent');
Route::get('/addScholarship/{id}', [App\Http\Controllers\HomeController::class, 'addScholarship'])->name('addScholarship');
Route::post('/saveScholarship', [App\Http\Controllers\HomeController::class, 'saveScholarship'])->name('saveScholarship');
Route::get('deleteScholarship/{id}', [App\Http\Controllers\HomeController::class, 'deleteScholarship'])->name('deleteScholarship');
//Route::get('/pdf', [App\Http\Controllers\HomeController::class, 'createPDF']);
Route::post('/storeTc', [App\Http\Controllers\HomeController::class, 'storeTc'])->name('storeTc');
Route::post('/fetchStates', [App\Http\Controllers\HomeController::class, 'fetchStates'])->name('fetchStates');
Route::post('/getStatebyid', [App\Http\Controllers\HomeController::class, 'getStatebyid'])->name('getStatebyid');
Route::post('/getCityid', [App\Http\Controllers\HomeController::class, 'getCityid'])->name('getCityid');
Route::post('/fetchCities', [App\Http\Controllers\HomeController::class, 'fetchCities'])->name('fetchCities');

//for add scholarsship title i have used same naackeyeord function

Route::get('/addNaacKeyword', [App\Http\Controllers\HomeController::class, 'addNaacKeyword'])->name('office.addNaacKeyword');
Route::get('deleteNaackeyword/{id}', [App\Http\Controllers\HomeController::class, 'deleteNaackeyword'])->name('deleteNaackeyword');
Route::post('/checkKeyword', [App\Http\Controllers\HomeController::class, 'checkKeyword'])->name('office.checkKeyword'); //newone server
Route::post('/saveNaacKeyword', [App\Http\Controllers\HomeController::class, 'saveNaacKeyword'])->name('saveNaacKeyword');
Route::get('/nonfacultyList', [App\Http\Controllers\Office\OfficeController::class, 'nonfacultyList'])->name('nonfacultyList');
Route::get('/editNonFaculty/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editNonFaculty'])->name('editNonFaculty');
Route::get('deleteNonFaculty/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteNonFaculty'])->name('deleteNonFaculty');
Route::post('/editNonFacultyinfo', [App\Http\Controllers\Office\OfficeController::class, 'editNonFacultyinfo'])->name('editNonFacultyinfo');
});


///************************************************************Superadmin(Principal)*******************************************************///
Route::group(['prefix'=>'office','middleware'=>['isOffice','auth','PreventBackHistory']],function(){
Route::get('/dashboard', [App\Http\Controllers\Office\OfficeController::class, 'dashboard'])->name('office.dashboard');
Route::get('/PhdprogressList', [App\Http\Controllers\Faculty\FacultyController::class, 'PhdprogressList'])->name('PhdprogressList');
 Route::post('/store-multi-file-ajax_seller', [App\Http\Controllers\Faculty\FacultyController::class, 'storeMultiFile'])->name('store-multi-file-ajax_seller');
 Route::get('deleteEventImage/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteEventImage'])->name('deleteEventImage');
 Route::get('/downloadPhdProgressListAdmin',[App\Http\Controllers\Faculty\FacultyController::class, 'downloadPhdProgressListAdmin']);
 Route::get('/downloadProgramListExcel',[App\Http\Controllers\Office\OfficeController::class, 'downloadProgramListExcel']);
  Route::get('/downloadResearchCentreExcel',[App\Http\Controllers\Office\OfficeController::class, 'downloadResearchCentreExcel']);
  Route::get('/downloadResearchGuideExcel',[App\Http\Controllers\Office\OfficeController::class, 'downloadResearchGuideExcel']);
  Route::get('/downloadResearchFellowExcel',[App\Http\Controllers\Office\OfficeController::class, 'downloadResearchFellowExcel']);
  Route::get('/downloadDepartmentExcel',[App\Http\Controllers\Office\OfficeController::class,'downloadDepartmentExcel']);
   Route::get('/exportCell',[App\Http\Controllers\Office\OfficeController::class,'exportCell']);
   Route::get('/downloadStudentProgressionExcel',[App\Http\Controllers\Faculty\FacultyController::class,'downloadStudentProgressionExcel']);
  Route::get('/downloadFacultyInfo',[App\Http\Controllers\Faculty\FacultyController::class, 'downloadFacultyInfo']);
  Route::get('/studentList', [App\Http\Controllers\HomeController::class, 'studentList'])->name('studentList');
  Route::get('/studentListscholarshipAdmin', [App\Http\Controllers\HomeController::class, 'studentListscholarshipAdmin'])->name('studentListscholarshipAdmin');
   Route::get('/exportStudentList',[App\Http\Controllers\HomeController::class,'exportStudentList']);
   Route::get('/exportScholarshipList',[App\Http\Controllers\HomeController::class,'exportScholarshipList']);
 Route::get('/studentProgressionList', [App\Http\Controllers\Faculty\FacultyController::class, 'studentProgressionList'])->name('studentProgressionList');
Route::get('/nonfacultyList', [App\Http\Controllers\Office\OfficeController::class, 'nonfacultyList'])->name('nonfacultyList');
Route::get('/editNonFaculty/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editNonFaculty'])->name('editNonFaculty');
Route::post('/editNonFacultyinfo', [App\Http\Controllers\Office\OfficeController::class, 'editNonFacultyinfo'])->name('editNonFacultyinfo');
Route::get('deleteNonFaculty/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteNonFaculty'])->name('deleteNonFaculty');
Route::get('/generalList', [App\Http\Controllers\Office\OfficeController::class, 'generalList'])->name('generalList');
Route::get('/addGeneral', [App\Http\Controllers\Office\OfficeController::class, 'addGeneral'])->name('office.addGeneral');
Route::get('deleteGeneral/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteGeneral'])->name('deleteGeneral');
Route::post('/saveGeneral', [App\Http\Controllers\Office\OfficeController::class, 'saveGeneral'])->name('saveGeneral');
Route::get('/fapiAcademicBodyList', [App\Http\Controllers\Faculty\FacultyController::class, 'fapiAcademicBodyList'])->name('fapiAcademicBodyList');
Route::get('deletefapiAcademicBody/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deletefapiAcademicBody'])->name('deletefapiAcademicBody');
Route::get('/downloadfapiAcademicadmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportCsvfapiAcademicadmin']);
Route::get('/hodList', [App\Http\Controllers\Office\OfficeController::class, 'hodList'])->name('hodList');

Route::post('/fetchguide', [App\Http\Controllers\Office\OfficeController::class, 'fetchguide'])->name('fetchguide');
Route::get('/editResearchFellow/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editResearchFellow'])->name('editResearchFellow');
Route::post('/editInfoResearchFellow', [App\Http\Controllers\Office\OfficeController::class, 'editInfoResearchFellow'])->name('editInfoResearchFellow');
      Route::get('/addMou', [App\Http\Controllers\Faculty\FacultyController::class, 'addMou'])->name('faculty.addMou');    //add Mou
      Route::post('/saveMou', [App\Http\Controllers\Faculty\FacultyController::class, 'saveMou'])->name('saveMou');
      Route::get('/mouList', [App\Http\Controllers\Faculty\FacultyController::class, 'mouList'])->name('mouList');
      Route::get('deleteMou/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteMou'])->name('deleteMou');
      Route::get('/editMou/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editMou'])->name('editMou');
      Route::post('/editInfoMou', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoMou'])->name('editInfoMou');
      Route::get('/editMouImage/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editMouImage'])->name('editMouImage');
      Route::get('/downloadMouadmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportMouadmin']);   
      Route::post('/autosearchMou', [App\Http\Controllers\Faculty\FacultyController::class, 'autosearchMou'])->name('faculty.autosearchMou');
    
Route::get('/addNaacKeyword', [App\Http\Controllers\Office\OfficeController::class, 'addNaacKeyword'])->name('office.addNaacKeyword');
Route::get('deleteNaackeyword/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteNaackeyword'])->name('deleteNaackeyword');
Route::post('/checkKeyword', [App\Http\Controllers\Office\OfficeController::class, 'checkKeyword'])->name('office.checkKeyword'); //newone server
Route::post('/saveNaacKeyword', [App\Http\Controllers\Office\OfficeController::class, 'saveNaacKeyword'])->name('saveNaacKeyword');


Route::get('/fetchPaperValues', [App\Http\Controllers\Office\OfficeController::class, 'fetchPaperValues'])->name('fetchPaperValues');
Route::post('/updatePaper', [App\Http\Controllers\Office\OfficeController::class, 'updatePaper'])->name('updatePaper');
Route::get('editPaper/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editPaper'])->name('editPaper');

Route::get('/CellEventList', [App\Http\Controllers\Office\OfficeController::class, 'CellEventList'])->name('CellEventList');
Route::get('/downloadcelleventadmin',[App\Http\Controllers\Office\OfficeController::class, 'exportCsvCellEventadmin']);

Route::get('/editHod/{id}/{profileid}', [App\Http\Controllers\Office\OfficeController::class, 'editHod']);
Route::get('/facultyList', [App\Http\Controllers\Office\OfficeController::class, 'facultyList'])->name('facultyList');
Route::get('/deptList', [App\Http\Controllers\Office\OfficeController::class, 'deptList'])->name('deptList');
Route::get('/cellList', [App\Http\Controllers\Office\OfficeController::class, 'cellList'])->name('cellList');
Route::get('/courseList', [App\Http\Controllers\Office\OfficeController::class, 'courseList'])->name('courseList');
Route::get('/logBook', [App\Http\Controllers\Office\OfficeController::class, 'logBook'])->name('logBook');
Route::get('deletelogBook/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deletelogBook'])->name('deletelogBook');
Route::get('deleteFaculty/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteFaculty'])->name('deleteFaculty');
Route::get('/addFaculty', [App\Http\Controllers\Office\OfficeController::class, 'addFaculty'])->name('office.addFaculty');

Route::get('/loginStaff', [App\Http\Controllers\Office\OfficeController::class, 'loginStaff'])->name('office.loginStaff');
Route::post('/saveLogininfo', [App\Http\Controllers\Office\OfficeController::class, 'saveLogininfo'])->name('saveLogininfo');
Route::get('/addDept', [App\Http\Controllers\Office\OfficeController::class, 'addDept'])->name('office.addDept');
Route::get('/addCell', [App\Http\Controllers\Office\OfficeController::class, 'addCell'])->name('office.addCell');
Route::post('/checkemail', [App\Http\Controllers\Office\OfficeController::class, 'checkemail'])->name('office.checkemail'); //newone server
Route::get('/addPaper/{id}', [App\Http\Controllers\Office\OfficeController::class, 'addPaper'])->name('addPaper');
Route::get('/addCourse', [App\Http\Controllers\Office\OfficeController::class, 'addCourse'])->name('office.addCourse');
Route::get('/researchList', [App\Http\Controllers\Office\OfficeController::class, 'researchList'])->name('researchList');
Route::get('/editResearchGuide/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editResearchGuide'])->name('editResearchGuide');
Route::post('/editInfoResearchGuide', [App\Http\Controllers\Office\OfficeController::class, 'editInfoResearchGuide'])->name('editInfoResearchGuide');


Route::get('/addResearchCentre', [App\Http\Controllers\Office\OfficeController::class, 'addResearchCentre'])->name('office.addResearchCentre');
Route::post('/saveResearch', [App\Http\Controllers\Office\OfficeController::class, 'saveResearch'])->name('saveResearch');
Route::get('/addResearchGuide', [App\Http\Controllers\Office\OfficeController::class, 'addResearchGuide'])->name('office.addResearchGuide');
Route::post('/saveResearchGuide', [App\Http\Controllers\Office\OfficeController::class, 'saveResearchGuide'])->name('saveResearchGuide');
Route::post('/fetchResearch_type', [App\Http\Controllers\Office\OfficeController::class, 'fetchResearch_type'])->name('fetchResearch_type');
Route::get('/researchGuideList', [App\Http\Controllers\Office\OfficeController::class, 'researchGuideList'])->name('researchGuideList');
Route::get('/addResearchFellow', [App\Http\Controllers\Office\OfficeController::class, 'addResearchFellow'])->name('office.addResearchFellow');
Route::post('/fetchSupervisor', [App\Http\Controllers\Office\OfficeController::class, 'fetchSupervisor'])->name('fetchSupervisor');
Route::post('/saveResearchFellow', [App\Http\Controllers\Office\OfficeController::class, 'saveResearchFellow'])->name('saveResearchFellow');
Route::get('/researchFellowList', [App\Http\Controllers\Office\OfficeController::class, 'researchFellowList'])->name('researchFellowList');
Route::post('/saveCourse', [App\Http\Controllers\Office\OfficeController::class, 'saveCourse'])->name('saveCourse');
Route::post('/savePaper', [App\Http\Controllers\Office\OfficeController::class, 'savePaper'])->name('savePaper');
Route::post('/saveCell', [App\Http\Controllers\Office\OfficeController::class, 'saveCell'])->name('saveCell');
Route::post('/saveFaculty', [App\Http\Controllers\Office\OfficeController::class, 'saveFaculty'])->name('saveFaculty');
Route::post('/saveDept', [App\Http\Controllers\Office\OfficeController::class, 'saveDept'])->name('saveDept');
Route::get('/editFaculty/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editFaculty'])->name('editFaculty');
Route::get('/editDept/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editDept'])->name('editDept');
Route::get('/editCell/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editCell'])->name('editCell');
Route::get('/editCourse/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editCourse'])->name('editCourse');
Route::post('/editFacultyinfo', [App\Http\Controllers\Office\OfficeController::class, 'editFacultyinfo'])->name('editFacultyinfo');
Route::post('/hodUpdateInfo', [App\Http\Controllers\Office\OfficeController::class, 'hodUpdateInfo'])->name('hodUpdateInfo');
Route::post('/editDeptinfo', [App\Http\Controllers\Office\OfficeController::class, 'editDeptinfo'])->name('editDeptinfo');
Route::post('/saveCourseinfo', [App\Http\Controllers\Office\OfficeController::class, 'saveCourseinfo'])->name('saveCourseinfo');
Route::post('/editCellinfo', [App\Http\Controllers\Office\OfficeController::class, 'editCellinfo'])->name('editCellinfo');
Route::get('deleteDept/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteDept'])->name('deleteDept');
Route::get('deleteCell/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteCell'])->name('deleteCell');
Route::get('deletePaper/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deletePaper'])->name('deletePaper');
Route::get('deleteCourse/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteCourse'])->name('deleteCourse');
Route::get('deleteResearchFellow/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteResearchFellow'])->name('deleteResearchFellow');
Route::get('deleteResearchGuide/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteResearchGuide'])->name('deleteResearchGuide');
Route::get('deleteResearchCenter/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteResearchCenter'])->name('deleteResearchCenter');
Route::get('/eventList', [App\Http\Controllers\Faculty\FacultyController::class, 'eventList'])->name('eventList');
Route::get('/editFileImage/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editFileImage'])->name('editFileImage');
Route::get('/editImage/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editImage'])->name('editImage');
Route::get('/downloadadmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportCsvadmin']);
Route::get('/pdf/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'createPDF']);
Route::get('/fdpList', [App\Http\Controllers\Faculty\FacultyController::class, 'fdpList'])->name('fdpList');
Route::get('/downloadfapiadmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportCsvfapiadmin']);

  Route::get('/QuestionPaperSettingList', [App\Http\Controllers\Faculty\FacultyController::class, 'QuestionPaperSettingList'])->name('QuestionPaperSettingList');
  Route::get('/downloadQuestionSettingadmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportCsvDownloadQuestionadmin']);
  Route::get('/CuriculamDevelopmentList', [App\Http\Controllers\Faculty\FacultyController::class, 'CuriculamDevelopmentList'])->name('CuriculamDevelopmentList');
  Route::get('/downloadCuriculamDevelopmentadmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportCuriculamDevelopmentadmin']);
  Route::get('/valuationList', [App\Http\Controllers\Faculty\FacultyController::class, 'valuationList'])->name('valuationList');
  Route::get('/downloadValuationadmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportValuationadmin']);
  Route::get('/downloadInternalValuationadmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportInternalValuationadmin']);
  Route::get('/downloadExternalValuationadmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportExternalValuationadmin']);
  Route::get('/methodologyList', [App\Http\Controllers\Faculty\FacultyController::class, 'methodologyList'])->name('methodologyList');
  Route::get('/downloadMethodologyadmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportMethodologyadmin']);
  Route::get('/IctList', [App\Http\Controllers\Faculty\FacultyController::class, 'IctList'])->name('IctList');
  Route::get('/downloadIctadmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportIctadmin']);
  
  Route::get('/journalList', [App\Http\Controllers\Faculty\FacultyController::class, 'journalList'])->name('journalList');
  Route::get('/downloadJournaladmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportJournaladmin']);
  Route::get('/bookList', [App\Http\Controllers\Faculty\FacultyController::class, 'bookList'])->name('bookList');
  Route::get('/downloadBookadmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportBookadmin']);
  Route::get('/patentList', [App\Http\Controllers\Faculty\FacultyController::class, 'patentList'])->name('patentList');
  Route::get('/downloadPatentadmin',[App\Http\Controllers\Faculty\FacultyController::class, 'exportPatentadmin']);
  Route::get('/editImagePublication/{id}/{type}', [App\Http\Controllers\Faculty\FacultyController::class, 'editImagePublication'])->name('editImagePublication');
});

///*****************************************************************Faculty*******************************************************///

	Route::group(['prefix'=>'faculty','middleware'=>['isFaculty','auth','PreventBackHistory']],function(){
    Route::get('/dashboard', [App\Http\Controllers\Faculty\FacultyController::class, 'dashboard'])->name('faculty.dashboard');
	Route::post('/store-profile-image', [App\Http\Controllers\Faculty\FacultyController::class, 'storeProfileImage'])->name('storeProfileImage');
	Route::get('/eventList', [App\Http\Controllers\Faculty\FacultyController::class, 'eventList'])->name('eventList');
	Route::get('/fdpList', [App\Http\Controllers\Faculty\FacultyController::class, 'fdpList'])->name('fdpList');
	Route::get('/pdf/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'createPDF']);
	Route::post('/eventdateList', [App\Http\Controllers\Faculty\FacultyController::class, 'eventdateList'])->name('eventdateList');
	Route::get('/downloadstudent',[App\Http\Controllers\Faculty\FacultyController::class, 'exportCsv']);
//	Route::match(array('GET','POST'),'/eventList', 'AuthController@login');

 Route::get('/addStudentProgression', [App\Http\Controllers\Faculty\FacultyController::class, 'addStudentProgression'])->name('faculty.addStudentProgression');    //add addStudentProgression
       Route::post('/autocompleteSearchstudent', [App\Http\Controllers\HomeController::class, 'autocompleteSearchstudent'])->name('admin.autocompleteSearchstudent');
       Route::post('/saveStudentProgression', [App\Http\Controllers\Faculty\FacultyController::class, 'saveStudentProgression'])->name('saveStudentProgression');
       Route::get('/studentProgressionList', [App\Http\Controllers\Faculty\FacultyController::class, 'studentProgressionList'])->name('studentProgressionList');
       Route::get('deleteStudentProgression/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteStudentProgression'])->name('deleteStudentProgression');
      Route::get('/editStudentProgression/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editStudentProgression'])->name('editStudentProgression');
        Route::post('/editInfoStudentProgression', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoStudentProgression'])->name('editInfoStudentProgression');
      
//for add scholarsship title i have used same naackeyeord function

Route::get('/addNaacKeyword', [App\Http\Controllers\HomeController::class, 'addNaacKeyword'])->name('office.addNaacKeyword');
Route::get('deleteNaackeyword/{id}', [App\Http\Controllers\HomeController::class, 'deleteNaackeyword'])->name('deleteNaackeyword');
Route::post('/checkKeyword', [App\Http\Controllers\HomeController::class, 'checkKeyword'])->name('office.checkKeyword'); //newone server
Route::post('/saveNaacKeyword', [App\Http\Controllers\HomeController::class, 'saveNaacKeyword'])->name('saveNaacKeyword');

Route::get('/studentListscholarship/{id}', [App\Http\Controllers\HomeController::class, 'studentListscholarship'])->name('studentListscholarship');
Route::get('/addScholarship/{id}', [App\Http\Controllers\HomeController::class, 'addScholarship'])->name('addScholarship');
Route::post('/saveScholarship', [App\Http\Controllers\HomeController::class, 'saveScholarship'])->name('saveScholarship');
Route::get('deleteScholarship/{id}', [App\Http\Controllers\HomeController::class, 'deleteScholarship'])->name('deleteScholarship');

//REport///

Route::get('/section1List', [App\Http\Controllers\Faculty\FacultyController::class, 'section1List'])->name('faculty.section1List');
Route::get('/section2List', [App\Http\Controllers\Faculty\FacultyController::class, 'section2List'])->name('faculty.section2List');
Route::get('/section3List', [App\Http\Controllers\Faculty\FacultyController::class, 'section3List'])->name('faculty.section3List');
Route::get('/section4List', [App\Http\Controllers\Faculty\FacultyController::class, 'section4List'])->name('faculty.section4List');
Route::get('/section2Add', [App\Http\Controllers\Faculty\FacultyController::class, 'section2Add'])->name('faculty.section2Add');
Route::get('/section3Add', [App\Http\Controllers\Faculty\FacultyController::class, 'section3Add'])->name('faculty.section3Add');
Route::get('/section4Add', [App\Http\Controllers\Faculty\FacultyController::class, 'section4Add'])->name('faculty.section4Add');

      Route::get('/addMou', [App\Http\Controllers\Faculty\FacultyController::class, 'addMou'])->name('faculty.addMou');    //add Mou
      Route::post('/saveMou', [App\Http\Controllers\Faculty\FacultyController::class, 'saveMou'])->name('saveMou');
      Route::get('/mouList', [App\Http\Controllers\Faculty\FacultyController::class, 'mouList'])->name('mouList');
      Route::get('deleteMou/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteMou'])->name('deleteMou');
      Route::get('/editMou/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editMou'])->name('editMou');
      Route::post('/editInfoMou', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoMou'])->name('editInfoMou');
      Route::get('/editMouImage/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editMouImage'])->name('editMouImage');
      Route::get('/downloadMou',[App\Http\Controllers\Faculty\FacultyController::class, 'exportMou']);
      Route::post('/autosearchMou', [App\Http\Controllers\Faculty\FacultyController::class, 'autosearchMou'])->name('faculty.autosearchMou');
    



 Route::get('/courseListHod', [App\Http\Controllers\Hod\HodController::class, 'courseListHod'])->name('courseListHod'); //NEW	
      Route::get('semPaperView/{id}', [App\Http\Controllers\Hod\HodController::class, 'semPaperView'])->name('semPaperView');
	  Route::get('/editStudent/{id}', [App\Http\Controllers\Hod\HodController::class, 'editStudent'])->name('editStudent');
	  Route::get('/studentProgression/{id}/{batch}', [App\Http\Controllers\Hod\HodController::class, 'studentProgression'])->name('studentProgression');
      Route::get('/individualMarks/{id}/{batch}', [App\Http\Controllers\Hod\HodController::class, 'individualMarks'])->name('individualMarks');
	  Route::get('/fetchSem', [App\Http\Controllers\Hod\HodController::class, 'fetchSem'])->name('fetchSem');
	  Route::post('/editStudentinfo', [App\Http\Controllers\HomeController::class, 'editStudentinfo'])->name('editStudentinfo');
      Route::post('/fetchStates', [App\Http\Controllers\HomeController::class, 'fetchStates'])->name('fetchStates');
      Route::post('/getStatebyid', [App\Http\Controllers\HomeController::class, 'getStatebyid'])->name('getStatebyid');
      Route::post('/getCityid', [App\Http\Controllers\HomeController::class, 'getCityid'])->name('getCityid');
      Route::post('/fetchCities', [App\Http\Controllers\HomeController::class, 'fetchCities'])->name('fetchCities');
      	 Route::post('/deleteMarks', [App\Http\Controllers\Hod\HodController::class, 'deleteMarks'])->name('deleteMarks');
     	 Route::post('deleteExternalMarks', [App\Http\Controllers\Hod\HodController::class, 'deleteExternalMarks'])->name('deleteExternalMarks');
     	 Route::post('deleteOverallMarks', [App\Http\Controllers\Hod\HodController::class, 'deleteOverallMarks'])->name('deleteOverallMarks');
     	 Route::post('deleteProjectMarks', [App\Http\Controllers\Hod\HodController::class, 'deleteProjectMarks'])->name('deleteProjectMarks');
     	 Route::post('deleteIndustryMarks', [App\Http\Controllers\Hod\HodController::class, 'deleteIndustryMarks'])->name('deleteIndustryMarks');
     	  Route::post('/saveInternalMarks', [App\Http\Controllers\Hod\HodController::class, 'saveInternalMarks'])->name('saveInternalMarks');
     	 Route::post('/updateInternalMarks', [App\Http\Controllers\Hod\HodController::class, 'updateInternalMarks'])->name('updateInternalMarks');
     	 Route::post('/updateExternalMarks', [App\Http\Controllers\Hod\HodController::class, 'updateExternalMarks'])->name('updateExternalMarks');
     	 Route::post('/updateOverallMarks', [App\Http\Controllers\Hod\HodController::class, 'updateOverallMarks'])->name('updateOverallMarks');
     	 Route::post('/saveExternalMarks', [App\Http\Controllers\Hod\HodController::class, 'saveExternalMarks'])->name('saveExternalMarks');
     	 Route::post('/saveOverallMarks', [App\Http\Controllers\Hod\HodController::class, 'saveOverallMarks'])->name('saveOverallMarks');
     	 Route::post('/saveProjectMarks', [App\Http\Controllers\Hod\HodController::class, 'saveProjectMarks'])->name('saveProjectMarks');
     	 Route::post('/saveIndustryMarks', [App\Http\Controllers\Hod\HodController::class, 'saveIndustryMarks'])->name('saveIndustryMarks');
     	  Route::get('/fetchPapername', [App\Http\Controllers\Hod\HodController::class, 'fetchPapername'])->name('fetchPapername');
     	  	Route::get('/editfetchmarks', [App\Http\Controllers\Hod\HodController::class, 'editfetchmarks'])->name('editfetchmarks');
     	Route::get('/editfetchmarks_external', [App\Http\Controllers\Hod\HodController::class, 'editfetchmarks_external'])->name('editfetchmarks_external');
     	Route::get('/editfetchmarks_Overall', [App\Http\Controllers\Hod\HodController::class, 'editfetchmarks_Overall'])->name('editfetchmarks_Overall');
     	Route::post('/externalmark_download', [App\Http\Controllers\Hod\HodController::class, 'externalmark_download'])->name('externalmark_download');
		
	  Route::post('/autocompleteSearch', [App\Http\Controllers\Hod\HodController::class, 'autocompleteSearch']);
	  
	    Route::get('/fetchExternal_marksheet', [App\Http\Controllers\Hod\HodController::class, 'fetchExternal_marksheet'])->name('fetchExternal_marksheet'); 
	    Route::post('/searchList', [App\Http\Controllers\Hod\HodController::class, 'searchList'])->name('searchList');


 Route::get('/addQuestionPaperSetting', [App\Http\Controllers\Faculty\FacultyController::class, 'addQuestionPaperSetting'])->name('faculty.addQuestionPaperSetting');
    Route::post('/storeQuestionpaper', [App\Http\Controllers\Faculty\FacultyController::class, 'storeQuestionpaper'])->name('faculty.storeQuestionpaper');
    Route::get('/QuestionPaperSettingList', [App\Http\Controllers\Faculty\FacultyController::class, 'QuestionPaperSettingList'])->name('QuestionPaperSettingList');
     Route::get('/editQuestionPaperSetting/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editQuestionPaperSetting'])->name('editQuestionPaperSetting');
     Route::post('/editInfoQuestionpaper', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoQuestionpaper'])->name('editInfoQuestionpaper');
    Route::get('deleteQuestion/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteQuestion'])->name('deleteQuestion');
    Route::get('/downloadQuestionSettingfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportCsvDownloadQuestionfac']);
    Route::get('/addCuriculamDevelopment', [App\Http\Controllers\Faculty\FacultyController::class, 'addCuriculamDevelopment'])->name('faculty.addCuriculamDevelopment');
    Route::post('/storeCuriculamDevelopment', [App\Http\Controllers\Faculty\FacultyController::class, 'storeCuriculamDevelopment'])->name('faculty.storeCuriculamDevelopment');
    Route::get('/CuriculamDevelopmentList', [App\Http\Controllers\Faculty\FacultyController::class, 'CuriculamDevelopmentList'])->name('CuriculamDevelopmentList');
    Route::get('/editCuriculamDevelopment/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editCuriculamDevelopment'])->name('editCuriculamDevelopment');
     Route::post('/editInfoCuriculamDevelopment', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoCuriculamDevelopment'])->name('editInfoCuriculamDevelopment');
    Route::get('deleteCuriculamDevelopment/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteCuriculamDevelopment'])->name('deleteCuriculamDevelopment');
    Route::get('/downloadCuriculamDevelopment',[App\Http\Controllers\Faculty\FacultyController::class, 'exportCuriculamDevelopment']);
      Route::get('/addExamValuation', [App\Http\Controllers\Faculty\FacultyController::class, 'addExamValuation'])->name('faculty.addExamValuation');
    Route::post('/storeExamValuation', [App\Http\Controllers\Faculty\FacultyController::class, 'storeExamValuation'])->name('faculty.storeExamValuation');
    Route::get('/valuationList', [App\Http\Controllers\Faculty\FacultyController::class, 'valuationList'])->name('valuationList');
    Route::get('deleteValuation/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteValuation'])->name('deleteValuation');
      Route::get('/editValuation/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editValuation'])->name('editValuation');
     Route::post('/editInfoValuation', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoValuation'])->name('editInfoValuation');
    Route::get('/downloadValuationfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportValuationfac']);
    Route::get('/downloadInternalValuationfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportInternalValuationfac']);
    Route::get('/downloadExternalValuationfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportExternalValuationfac']);
    Route::get('/addTeachingMethodology', [App\Http\Controllers\Faculty\FacultyController::class, 'addTeachingMethodology'])->name('faculty.addTeachingMethodology');
    Route::post('/storeTeachingMethodology', [App\Http\Controllers\Faculty\FacultyController::class, 'storeTeachingMethodology'])->name('faculty.storeTeachingMethodology');
    Route::get('/methodologyList', [App\Http\Controllers\Faculty\FacultyController::class, 'methodologyList'])->name('methodologyList');
      Route::get('/editMethodology/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editMethodology'])->name('editMethodology');
     Route::post('/editInfoMethodology', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoMethodology'])->name('editInfoMethodology');
    Route::get('deleteMethodology/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteMethodology'])->name('deleteMethodology');
    Route::get('/downloadMethodologyfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportMethodologyfac']);
   Route::get('/addIct', [App\Http\Controllers\Faculty\FacultyController::class, 'addIct'])->name('faculty.addIct');
    Route::post('/storeIct', [App\Http\Controllers\Faculty\FacultyController::class, 'storeIct'])->name('faculty.storeIct');
    Route::get('/IctList', [App\Http\Controllers\Faculty\FacultyController::class, 'IctList'])->name('IctList');
     Route::get('/editIct/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editIct'])->name('editIct');
     Route::post('/editInfoIct', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoIct'])->name('editInfoIct');
    Route::get('deleteIct/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteIct'])->name('deleteIct');
    Route::get('/downloadIctfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportIctfac']);
    

    Route::get('/addJournalPublication', [App\Http\Controllers\Faculty\FacultyController::class, 'addJournalPublication'])->name('faculty.addJournalPublication');
    Route::post('/autocompleteSearchResearchPerson', [App\Http\Controllers\Faculty\FacultyController::class, 'autocompleteSearchResearchPerson'])->name('faculty.autocompleteSearchResearchPerson');
    Route::post('/saveJournal', [App\Http\Controllers\Faculty\FacultyController::class, 'saveJournal'])->name('saveJournal');
     Route::get('/journalList', [App\Http\Controllers\Faculty\FacultyController::class, 'journalList'])->name('journalList');
	 
	  Route::get('/editJournal/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editJournal'])->name('editJournal');
     Route::post('/editInfoJournal', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoJournal'])->name('editInfoJournal');
     Route::get('/downloadJournalfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportJournalfac']);
      Route::get('/editBook/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editBook'])->name('editBook');
     Route::post('/editInfoBook', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoBook'])->name('editInfoBook');
     Route::get('/downloadBookfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportBookfac']);
      Route::get('/editPatent/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editPatent'])->name('editPatent');
     Route::post('/editInfoPatent', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoPatent'])->name('editInfoPatent');
     Route::get('/downloadPatentfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportPatentfac']);
    Route::get('/editImagePublication/{id}/{type}', [App\Http\Controllers\Faculty\FacultyController::class, 'editImagePublication'])->name('editImagePublication');
	   Route::get('/editfapiAcademicBody/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editfapiAcademicBody'])->name('editfapiAcademicBody');
     Route::post('/editInfofapiAcademicBody', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfofapiAcademicBody'])->name('faculty.editInfofapiAcademicBody');
	 
    Route::get('deleteJournal/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteJournal'])->name('deleteJournal');
     Route::get('/addBookChapter', [App\Http\Controllers\Faculty\FacultyController::class, 'addBookChapter'])->name('faculty.addBookChapter');
     Route::get('/addPatentFilled', [App\Http\Controllers\Faculty\FacultyController::class, 'addPatentFilled'])->name('faculty.addPatentFilled');
      Route::post('/saveBookChapter', [App\Http\Controllers\Faculty\FacultyController::class, 'saveBookChapter'])->name('saveBookChapter');
      Route::post('/savePatent', [App\Http\Controllers\Faculty\FacultyController::class, 'savePatent'])->name('savePatent');
        Route::get('/bookList', [App\Http\Controllers\Faculty\FacultyController::class, 'bookList'])->name('bookList');
     Route::get('deleteBook/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteBook'])->name('deleteBook');
        Route::get('/patentList', [App\Http\Controllers\Faculty\FacultyController::class, 'patentList'])->name('patentList');
     Route::get('deletePatent/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deletePatent'])->name('deletePatent');

	Route::get('/deletefaculty/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deletefaculty'])->name('deletefaculty');
    Route::get('/addEvent', [App\Http\Controllers\Faculty\FacultyController::class, 'addEvent'])->name('faculty.addEvent');
	Route::get('/addUpcominEvent', [App\Http\Controllers\Faculty\FacultyController::class, 'addUpcominEvent'])->name('faculty.addUpcominEvent');
	Route::get('/addFdp', [App\Http\Controllers\Faculty\FacultyController::class, 'addFdp'])->name('faculty.addFdp');
	Route::get('/fapiAcademicBodyList', [App\Http\Controllers\Faculty\FacultyController::class, 'fapiAcademicBodyList'])->name('fapiAcademicBodyList');
    Route::get('deletefapiAcademicBody/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deletefapiAcademicBody'])->name('deletefapiAcademicBody');
    Route::get('/downloadfapiAcademicfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportCsvfapiAcademicfac']);
	Route::get('/addFapiAcademicBody', [App\Http\Controllers\Faculty\FacultyController::class, 'addFapiAcademicBody'])->name('faculty.addFapiAcademicBody');
	Route::get('/editEvent/{id}/{type}', [App\Http\Controllers\Faculty\FacultyController::class, 'editEvent'])->name('editEvent');
	Route::get('/editFdp/{id}/{type}', [App\Http\Controllers\Faculty\FacultyController::class, 'editFdp'])->name('editFdp');
	Route::get('/editProfile', [App\Http\Controllers\Faculty\FacultyController::class, 'editProfile'])->name('editProfile');
	Route::get('/editImage/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editImage'])->name('editImage');
	Route::get('/editFileImage/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editFileImage'])->name('editFileImage');
	Route::get('deleteEvent/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteEvent'])->name('deleteEvent');
	Route::get('deleteEventImage/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteEventImage'])->name('deleteEventImage');
	Route::post('/fetchBarchart', [App\Http\Controllers\Faculty\FacultyController::class, 'fetchBarchart'])->name('fetchBarchart');
	Route::post('/fetchLinechart', [App\Http\Controllers\Faculty\FacultyController::class, 'fetchLinechart'])->name('fetchLinechart');
	Route::post('/updateEvent', [App\Http\Controllers\Faculty\FacultyController::class, 'updateEvent'])->name('updateEvent');
	Route::post('/updateProfile', [App\Http\Controllers\Faculty\FacultyController::class, 'updateProfile'])->name('updateProfile');
	Route::post('/updateFileUpload', [App\Http\Controllers\Faculty\FacultyController::class, 'updateFileUpload'])->name('updateFileUpload');
	Route::post('/editupdateFileUpload', [App\Http\Controllers\Faculty\FacultyController::class, 'editupdateFileUpload'])->name('editupdateFileUpload');
	Route::post('/updateUpcomingEvent', [App\Http\Controllers\Faculty\FacultyController::class, 'updateUpcomingEvent'])->name('updateUpcomingEvent');
	Route::post('/updateFdp', [App\Http\Controllers\Faculty\FacultyController::class, 'updateFdp'])->name('updateFdp');
	Route::post('/storeevent', [App\Http\Controllers\Faculty\FacultyController::class, 'store'])->name('faculty.storeevent');
	Route::post('/storeevent_upcoming', [App\Http\Controllers\Faculty\FacultyController::class, 'storeevent_upcoming'])->name('faculty.storeevent_upcoming');
	Route::post('/storefdp', [App\Http\Controllers\Faculty\FacultyController::class, 'storefdp'])->name('faculty.storefdp');
	Route::post('/storefapiAcademicBody', [App\Http\Controllers\Faculty\FacultyController::class, 'storefapiAcademicBody'])->name('faculty.storefapiAcademicBody');
    Route::post('/store-multi-file-ajax_seller', [App\Http\Controllers\Faculty\FacultyController::class, 'storeMultiFile'])->name('store-multi-file-ajax_seller');
	Route::get('/change-password', [App\Http\Controllers\Faculty\FacultyController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password', [App\Http\Controllers\Faculty\FacultyController::class, 'updatePassword'])->name('update-password');
     Route::get('/editProfileImage', [App\Http\Controllers\Faculty\FacultyController::class, 'editProfileImage'])->name('editProfileImage');
   Route::get('/facultyIndividualList', [App\Http\Controllers\Faculty\FacultyController::class, 'facultyIndividualList'])->name('facultyIndividualList');
  Route::get('/editFaculty/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editFaculty'])->name('editFaculty');
  Route::post('/editFacultyinfo', [App\Http\Controllers\Faculty\FacultyController::class, 'editFacultyinfo'])->name('editFacultyinfo');
  Route::get('/downloadfapifac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportCsvfapifac']);
});

////****************************HOD*******************//////////////////////
Route::group(['prefix'=>'hod','middleware'=>['isHod','auth','PreventBackHistory']],function(){
    Route::get('/dashboard', [App\Http\Controllers\Hod\HodController::class, 'dashboard'])->name('hod.dashboard');
	 Route::post('/generateSection1', [App\Http\Controllers\Faculty\FacultyController::class, 'generateSection1'])->name('faculty.generateSection1');
	  Route::post('/generateSection2', [App\Http\Controllers\Faculty\FacultyController::class, 'generateSection2'])->name('faculty.generateSection2');
	   Route::post('/generateSection3', [App\Http\Controllers\Faculty\FacultyController::class, 'generateSection3'])->name('faculty.generateSection3');
  Route::get('/section1List', [App\Http\Controllers\Faculty\FacultyController::class, 'section1List'])->name('faculty.section1List');
  Route::get('/section2List', [App\Http\Controllers\Faculty\FacultyController::class, 'section2List'])->name('faculty.section2List');
Route::get('/section3List', [App\Http\Controllers\Faculty\FacultyController::class, 'section3List'])->name('faculty.section3List');
Route::get('/section4List', [App\Http\Controllers\Faculty\FacultyController::class, 'section4List'])->name('faculty.section4List');
	Route::get('/editDept/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editDept'])->name('editDept');
	Route::post('/editDeptinfo', [App\Http\Controllers\Office\OfficeController::class, 'editDeptinfo'])->name('editDeptinfo');
	Route::get('/deptList', [App\Http\Controllers\Office\OfficeController::class, 'deptList'])->name('deptList');
	 Route::get('/editStudent/{id}', [App\Http\Controllers\Hod\HodController::class, 'editStudent'])->name('editStudent');
    Route::post('/editStudentinfo', [App\Http\Controllers\Hod\HodController::class, 'editStudentinfo'])->name('editStudentinfo');
	 Route::post('/fetchStates', [App\Http\Controllers\HomeController::class, 'fetchStates'])->name('fetchStates');
Route::post('/getStatebyid', [App\Http\Controllers\HomeController::class, 'getStatebyid'])->name('getStatebyid');
Route::post('/getCityid', [App\Http\Controllers\HomeController::class, 'getCityid'])->name('getCityid');
Route::post('/fetchCities', [App\Http\Controllers\HomeController::class, 'fetchCities'])->name('fetchCities');
  Route::get('/mouList', [App\Http\Controllers\Faculty\FacultyController::class, 'mouList'])->name('mouList');
 Route::post('/autocompleteSearchPaper', [App\Http\Controllers\Hod\HodController::class, 'autocompleteSearchPaper'])->name('hod.autocompleteSearchPaper');
 Route::post('/autocompleteSearchBatch', [App\Http\Controllers\Hod\HodController::class, 'autocompleteSearchBatch'])->name('hod.autocompleteSearchBatch');
    Route::post('/autosearchMou', [App\Http\Controllers\Faculty\FacultyController::class, 'autosearchMou'])->name('faculty.autosearchMou');   

 Route::get('addPaperAssign/{id}', [App\Http\Controllers\Hod\HodController::class, 'addPaperAssign'])->name('addPaperAssign');
 Route::post('/savePaperAssign', [App\Http\Controllers\Hod\HodController::class, 'savePaperAssign'])->name('savePaperAssign');
 Route::get('deletePaperAssign/{id}', [App\Http\Controllers\Hod\HodController::class, 'deletePaperAssign'])->name('deletePaperAssign');

Route::get('/fetchPaperValues', [App\Http\Controllers\Office\OfficeController::class, 'fetchPaperValues'])->name('fetchPaperValues');
Route::post('/updatePaper', [App\Http\Controllers\Office\OfficeController::class, 'updatePaper'])->name('updatePaper');
Route::get('editPaper/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editPaper'])->name('editPaper');

    Route::get('/facultyList', [App\Http\Controllers\Office\OfficeController::class, 'facultyList'])->name('facultyList');
    Route::get('deleteFaculty/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteFaculty'])->name('deleteFaculty');
    Route::get('/addFaculty', [App\Http\Controllers\Office\OfficeController::class, 'addFaculty'])->name('office.addFaculty');
    Route::post('/saveFaculty', [App\Http\Controllers\Office\OfficeController::class, 'saveFaculty'])->name('saveFaculty');
    Route::get('/courseListHod', [App\Http\Controllers\Hod\HodController::class, 'courseListHod'])->name('courseListHod');
     Route::get('semPaperView/{id}', [App\Http\Controllers\Hod\HodController::class, 'semPaperView'])->name('semPaperView');
      Route::get('markSheet/{id}', [App\Http\Controllers\Hod\HodController::class, 'markSheet'])->name('markSheet');
      Route::get('addTutor/{id}', [App\Http\Controllers\Hod\HodController::class, 'addTutor'])->name('addTutor');
       Route::get('assignSem/{id}', [App\Http\Controllers\Hod\HodController::class, 'assignSem'])->name('assignSem');
     	Route::post('/searchList', [App\Http\Controllers\Hod\HodController::class, 'searchList'])->name('searchList');
     	Route::post('/searchMarksheet', [App\Http\Controllers\Hod\HodController::class, 'searchMarksheet'])->name('searchMarksheet');
     	 Route::get('/fetchSem', [App\Http\Controllers\Hod\HodController::class, 'fetchSem'])->name('fetchSem');
     	  Route::get('/fetchExternal_marksheet', [App\Http\Controllers\Hod\HodController::class, 'fetchExternal_marksheet'])->name('fetchExternal_marksheet'); 
     	  Route::get('/fetchPapername', [App\Http\Controllers\Hod\HodController::class, 'fetchPapername'])->name('fetchPapername');
     	 Route::post('/saveTutor', [App\Http\Controllers\Hod\HodController::class, 'saveTutor'])->name('saveTutor');
     	 Route::post('/updateSemester', [App\Http\Controllers\Hod\HodController::class, 'updateSemester'])->name('updateSemester');
     	 Route::get('deleteTutor/{id}', [App\Http\Controllers\Hod\HodController::class, 'deleteTutor'])->name('deleteTutor');
     
     	 Route::post('/deleteMarks', [App\Http\Controllers\Hod\HodController::class, 'deleteMarks'])->name('deleteMarks');
     	 Route::post('deleteExternalMarks', [App\Http\Controllers\Hod\HodController::class, 'deleteExternalMarks'])->name('deleteExternalMarks');
     	 Route::post('deleteOverallMarks', [App\Http\Controllers\Hod\HodController::class, 'deleteOverallMarks'])->name('deleteOverallMarks');
     	 Route::post('deleteProjectMarks', [App\Http\Controllers\Hod\HodController::class, 'deleteProjectMarks'])->name('deleteProjectMarks');
     	 Route::post('deleteIndustryMarks', [App\Http\Controllers\Hod\HodController::class, 'deleteIndustryMarks'])->name('deleteIndustryMarks');
     	 Route::get('/studentProgression/{id}/{batch}', [App\Http\Controllers\Hod\HodController::class, 'studentProgression'])->name('studentProgression');
     	 Route::get('/individualMarks/{id}/{batch}', [App\Http\Controllers\Hod\HodController::class, 'individualMarks'])->name('individualMarks');
     	 Route::post('/saveInternalMarks', [App\Http\Controllers\Hod\HodController::class, 'saveInternalMarks'])->name('saveInternalMarks');
     	 Route::post('/saveExternalMarks', [App\Http\Controllers\Hod\HodController::class, 'saveExternalMarks'])->name('saveExternalMarks');
     	 Route::post('/saveOverallMarks', [App\Http\Controllers\Hod\HodController::class, 'saveOverallMarks'])->name('saveOverallMarks');
     	 Route::post('/saveProjectMarks', [App\Http\Controllers\Hod\HodController::class, 'saveProjectMarks'])->name('saveProjectMarks');
     	 Route::post('/saveIndustryMarks', [App\Http\Controllers\Hod\HodController::class, 'saveIndustryMarks'])->name('saveIndustryMarks');
     	 	 Route::post('/updateInternalMarks', [App\Http\Controllers\Hod\HodController::class, 'updateInternalMarks'])->name('updateInternalMarks');
     	 Route::post('/updateExternalMarks', [App\Http\Controllers\Hod\HodController::class, 'updateExternalMarks'])->name('updateExternalMarks');
     	 Route::post('/updateOverallMarks', [App\Http\Controllers\Hod\HodController::class, 'updateOverallMarks'])->name('updateOverallMarks');
		 	Route::get('/editfetchmarks', [App\Http\Controllers\Hod\HodController::class, 'editfetchmarks'])->name('editfetchmarks');
     	Route::get('/editfetchmarks_external', [App\Http\Controllers\Hod\HodController::class, 'editfetchmarks_external'])->name('editfetchmarks_external');
     	Route::get('/editfetchmarks_Overall', [App\Http\Controllers\Hod\HodController::class, 'editfetchmarks_Overall'])->name('editfetchmarks_Overall');
     Route::post('/autocompleteSearch', [App\Http\Controllers\Hod\HodController::class, 'autocompleteSearch'])->name('hod.autocompleteSearch');
	  Route::get('/fapiAcademicBodyList', [App\Http\Controllers\Faculty\FacultyController::class, 'fapiAcademicBodyList'])->name('fapiAcademicBodyList');
	 Route::get('deletefapiAcademicBody/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deletefapiAcademicBody'])->name('deletefapiAcademicBody');
	  Route::get('/downloadfapiAcademichod',[App\Http\Controllers\Faculty\FacultyController::class, 'exportCsvfapiAcademichod']); 
     	 
Route::get('/courseList', [App\Http\Controllers\Office\OfficeController::class, 'courseList'])->name('courseList');     	 
Route::get('/addPaper/{id}', [App\Http\Controllers\Office\OfficeController::class, 'addPaper'])->name('addPaper');
Route::get('/addCourse', [App\Http\Controllers\Office\OfficeController::class, 'addCourse'])->name('office.addCourse');
Route::post('/saveCourse', [App\Http\Controllers\Office\OfficeController::class, 'saveCourse'])->name('saveCourse');
Route::post('/savePaper', [App\Http\Controllers\Office\OfficeController::class, 'savePaper'])->name('savePaper');
Route::get('/editCourse/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editCourse'])->name('editCourse');
Route::post('/saveCourseinfo', [App\Http\Controllers\Office\OfficeController::class, 'saveCourseinfo'])->name('saveCourseinfo');
Route::get('deletePaper/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deletePaper'])->name('deletePaper');
Route::get('deleteCourse/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteCourse'])->name('deleteCourse');

Route::get('/cellList', [App\Http\Controllers\Office\OfficeController::class, 'cellList'])->name('cellList');
Route::get('/addCell', [App\Http\Controllers\Office\OfficeController::class, 'addCell'])->name('office.addCell');
Route::post('/saveCell', [App\Http\Controllers\Office\OfficeController::class, 'saveCell'])->name('saveCell');
Route::get('/editCell/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editCell'])->name('editCell');
Route::post('/editCellinfo', [App\Http\Controllers\Office\OfficeController::class, 'editCellinfo'])->name('editCellinfo');
Route::get('deleteCell/{id}', [App\Http\Controllers\Office\OfficeController::class, 'deleteCell'])->name('deleteCell');
     Route::get('/downloadfapihod',[App\Http\Controllers\Faculty\FacultyController::class, 'exportCsvfapihod']);
    Route::get('/pdf/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'createPDF']);
	Route::get('/eventList', [App\Http\Controllers\Faculty\FacultyController::class, 'eventList'])->name('eventList');
	Route::get('/fdpList', [App\Http\Controllers\Faculty\FacultyController::class, 'fdpList'])->name('fdpList');
	Route::get('/pdf/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'createPDF']);
	Route::post('/eventdateList', [App\Http\Controllers\Faculty\FacultyController::class, 'eventdateList'])->name('eventdateList');
    Route::get('/downloadhod',[App\Http\Controllers\Faculty\FacultyController::class, 'exportCsvhod']);
//	Route::match(array('GET','POST'),'/eventList', 'AuthController@login');
	Route::get('/deletefaculty/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deletefaculty'])->name('deletefaculty');
    Route::get('/addEvent', [App\Http\Controllers\Faculty\FacultyController::class, 'addEvent'])->name('faculty.addEvent');
	Route::get('/addUpcominEvent', [App\Http\Controllers\Faculty\FacultyController::class, 'addUpcominEvent'])->name('faculty.addUpcominEvent');
	Route::get('/addFdp', [App\Http\Controllers\Faculty\FacultyController::class, 'addFdp'])->name('faculty.addFdp');
	Route::get('/editEvent/{id}/{type}', [App\Http\Controllers\Faculty\FacultyController::class, 'editEvent'])->name('editEvent');
	Route::get('/editFdp/{id}/{type}', [App\Http\Controllers\Faculty\FacultyController::class, 'editFdp'])->name('editFdp');
	Route::get('/editProfile', [App\Http\Controllers\Faculty\FacultyController::class, 'editProfile'])->name('editProfile');
	Route::get('/editImage/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editImage'])->name('editImage');
	Route::get('/editFileImage/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editFileImage'])->name('editFileImage');
	Route::get('deleteEvent/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteEvent'])->name('deleteEvent');
	Route::get('deleteEventImage/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteEventImage'])->name('deleteEventImage');
	Route::post('/fetchBarchart', [App\Http\Controllers\Faculty\FacultyController::class, 'fetchBarchart'])->name('fetchBarchart');
	Route::post('/fetchLinechart', [App\Http\Controllers\Faculty\FacultyController::class, 'fetchLinechart'])->name('fetchLinechart');
	Route::post('/updateEvent', [App\Http\Controllers\Faculty\FacultyController::class, 'updateEvent'])->name('updateEvent');
	Route::post('/updateProfile', [App\Http\Controllers\Faculty\FacultyController::class, 'updateProfile'])->name('updateProfile');
	Route::post('/updateFileUpload', [App\Http\Controllers\Faculty\FacultyController::class, 'updateFileUpload'])->name('updateFileUpload');
	Route::post('/editupdateFileUpload', [App\Http\Controllers\Faculty\FacultyController::class, 'editupdateFileUpload'])->name('editupdateFileUpload');
	Route::post('/updateUpcomingEvent', [App\Http\Controllers\Faculty\FacultyController::class, 'updateUpcomingEvent'])->name('updateUpcomingEvent');
	Route::post('/updateFdp', [App\Http\Controllers\Faculty\FacultyController::class, 'updateFdp'])->name('updateFdp');
	Route::post('/storeevent', [App\Http\Controllers\Faculty\FacultyController::class, 'store'])->name('faculty.storeevent');
	Route::post('/storeevent_upcoming', [App\Http\Controllers\Faculty\FacultyController::class, 'storeevent_upcoming'])->name('faculty.storeevent_upcoming');
		Route::post('/storefdp', [App\Http\Controllers\Faculty\FacultyController::class, 'storefdp'])->name('faculty.storefdp');
    Route::post('/store-multi-file-ajax_seller', [App\Http\Controllers\Faculty\FacultyController::class, 'storeMultiFile'])->name('store-multi-file-ajax_seller');
   Route::post('/checkemail', [App\Http\Controllers\Office\OfficeController::class, 'checkemail'])->name('office.checkemail'); //newoneserver
});
/*///////////////////////////////////////////////////////////////CELL ////////////////////////////////////////////////////////////*/


Route::group(['prefix'=>'cell','middleware'=>['isCell','auth','PreventBackHistory']],function(){
    Route::get('/dashboard', [App\Http\Controllers\Cell\CellController::class, 'dashboard'])->name('cell.dashboard');
	
	 Route::get('/editCell/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editCell'])->name('editCell');
    Route::post('/editCellinfo', [App\Http\Controllers\Office\OfficeController::class, 'editCellinfo'])->name('editCellinfo');
     Route::get('/editProfileImage', [App\Http\Controllers\Cell\CellController::class, 'editProfileImage'])->name('editProfileImage');
      Route::post('/store-profile-image', [App\Http\Controllers\Cell\CellController::class, 'storeProfileImage'])->name('storeProfileImage');
	
    Route::get('/addEvent', [App\Http\Controllers\Cell\CellController::class, 'addEvent'])->name('cell.addEvent');
    Route::post('/storeevent', [App\Http\Controllers\Cell\CellController::class, 'store'])->name('faculty.storeevent');
    Route::post('/store-multi-file-ajax_seller', [App\Http\Controllers\Cell\CellController::class, 'storeMultiFile'])->name('store-multi-file-ajax_seller');
    Route::post('/updateFileUpload', [App\Http\Controllers\Cell\CellController::class, 'updateFileUpload'])->name('updateFileUpload');
    Route::get('/eventList', [App\Http\Controllers\Cell\CellController::class, 'eventList'])->name('eventList');
   	Route::post('/eventdateList', [App\Http\Controllers\Cell\CellController::class, 'eventdateList'])->name('eventdateList');
   	Route::get('deleteEvent/{id}', [App\Http\Controllers\Cell\CellController::class, 'deleteEvent'])->name('deleteEvent');
   	Route::get('/editEvent/{id}/{type}', [App\Http\Controllers\Cell\CellController::class, 'editEvent'])->name('editEvent');
   	Route::get('/editImage/{id}', [App\Http\Controllers\Cell\CellController::class, 'editImage'])->name('editImage');
   	Route::get('/editFileImage/{id}', [App\Http\Controllers\Cell\CellController::class, 'editFileImage'])->name('editFileImage');
   	Route::get('/pdf/{id}', [App\Http\Controllers\Cell\CellController::class, 'createPDF']);
   	Route::post('/editupdateFileUpload', [App\Http\Controllers\Cell\CellController::class, 'editupdateFileUpload'])->name('editupdateFileUpload');
   	Route::post('/updateEvent', [App\Http\Controllers\Cell\CellController::class, 'updateEvent'])->name('updateEvent');
   	Route::get('deleteEventImage/{id}', [App\Http\Controllers\Cell\CellController::class, 'deleteEventImage'])->name('deleteEventImage');
   	Route::get('/downloadcellevent',[App\Http\Controllers\Cell\CellController::class, 'exportCsvcell']);
	Route::get('/addReport', [App\Http\Controllers\Cell\CellController::class, 'addReport'])->name('cell.addReport');
   	 Route::post('/saveReport', [App\Http\Controllers\Cell\CellController::class, 'saveReport'])->name('cell.saveReport');
   	 Route::get('/reportList', [App\Http\Controllers\Cell\CellController::class, 'reportList'])->name('reportList');
   	 Route::get('deleteReport/{id}', [App\Http\Controllers\Cell\CellController::class, 'deleteReport'])->name('deleteReport');
	  Route::get('/addwebEvent', [App\Http\Controllers\Cell\CellController::class, 'addwebEvent'])->name('cell.addwebEvent');
   	 Route::post('/storewebevent', [App\Http\Controllers\Cell\CellController::class, 'storewebevent'])->name('faculty.storewebevent');
   	 Route::get('/editwebEvent/{id}/{type}', [App\Http\Controllers\Cell\CellController::class, 'editwebEvent'])->name('editwebEvent');
   	 Route::post('/updatewebEvent', [App\Http\Controllers\Cell\CellController::class, 'updatewebEvent'])->name('updatewebEvent');
});

////////////////////  ***************************  Research Guide *****************************************////////////////////////////////////


Route::group(['prefix'=>'researchguide','middleware'=>['isResearchguide','auth','PreventBackHistory']],function(){
     Route::get('/dashboard', [App\Http\Controllers\Research\ResearchController::class, 'dashboard'])->name('researchguide.dashboard');
    Route::get('/editResearchGuide/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editResearchGuide'])->name('editResearchGuide');
    Route::post('/editInfoResearchGuide', [App\Http\Controllers\Office\OfficeController::class, 'editInfoResearchGuide'])->name('editInfoResearchGuide');
    Route::get('/editProfileImage', [App\Http\Controllers\Research\ResearchController::class, 'editProfileImage'])->name('editProfileImage');
    Route::post('/store-profile-image', [App\Http\Controllers\Research\ResearchController::class, 'storeProfileImage'])->name('storeProfileImage');
     Route::get('/addJournalPublication', [App\Http\Controllers\Faculty\FacultyController::class, 'addJournalPublication'])->name('faculty.addJournalPublication');
    Route::post('/autocompleteSearchResearchPerson', [App\Http\Controllers\Faculty\FacultyController::class, 'autocompleteSearchResearchPerson'])->name('faculty.autocompleteSearchResearchPerson');
    Route::post('/saveJournal', [App\Http\Controllers\Faculty\FacultyController::class, 'saveJournal']);
     
     Route::get('/journalList', [App\Http\Controllers\Faculty\FacultyController::class, 'journalList'])->name('journalList');
     Route::post('/fetchResearch_type', [App\Http\Controllers\Office\OfficeController::class, 'fetchResearch_type'])->name('fetchResearch_type');
     
     Route::get('/editJournal/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editJournal'])->name('editJournal');
     Route::post('/editInfoJournal', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoJournal'])->name('editInfoJournal');
     Route::get('/downloadJournalfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportJournalfac']);
      Route::get('/editBook/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editBook'])->name('editBook');
     Route::post('/editInfoBook', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoBook'])->name('editInfoBook');
     Route::get('/downloadBookfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportBookfac']);
      Route::get('/editPatent/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editPatent'])->name('editPatent');
     Route::post('/editInfoPatent', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoPatent'])->name('editInfoPatent');
     Route::get('/downloadPatentfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportPatentfac']);
    Route::get('/editImagePublication/{id}/{type}', [App\Http\Controllers\Faculty\FacultyController::class, 'editImagePublication'])->name('editImagePublication');
     Route::get('/editfapiAcademicBody/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editfapiAcademicBody'])->name('editfapiAcademicBody');
     Route::post('/editInfofapiAcademicBody', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfofapiAcademicBody'])->name('faculty.editInfofapiAcademicBody');
    
    Route::get('deleteJournal/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteJournal'])->name('deleteJournal');
     Route::get('/addBookChapter', [App\Http\Controllers\Faculty\FacultyController::class, 'addBookChapter'])->name('faculty.addBookChapter');
     Route::get('/addPatentFilled', [App\Http\Controllers\Faculty\FacultyController::class, 'addPatentFilled'])->name('faculty.addPatentFilled');
      Route::post('/saveBookChapter', [App\Http\Controllers\Faculty\FacultyController::class, 'saveBookChapter'])->name('saveBookChapter');
      Route::post('/savePatent', [App\Http\Controllers\Faculty\FacultyController::class, 'savePatent'])->name('savePatent');
        Route::get('/bookList', [App\Http\Controllers\Faculty\FacultyController::class, 'bookList'])->name('bookList');
     Route::get('deleteBook/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteBook'])->name('deleteBook');
        Route::get('/patentList', [App\Http\Controllers\Faculty\FacultyController::class, 'patentList'])->name('patentList');
     Route::get('deletePatent/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deletePatent'])->name('deletePatent');
	  Route::get('/addMou', [App\Http\Controllers\Faculty\FacultyController::class, 'addMou'])->name('faculty.addMou');    //add Mou
      Route::post('/saveMou', [App\Http\Controllers\Faculty\FacultyController::class, 'saveMou'])->name('saveMou');
      Route::get('/mouList', [App\Http\Controllers\Faculty\FacultyController::class, 'mouList'])->name('mouList');
      Route::get('deleteMou/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteMou'])->name('deleteMou');
      Route::get('/editMou/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editMou'])->name('editMou');
      Route::post('/editInfoMou', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoMou'])->name('editInfoMou');
      Route::get('/editMouImage/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editMouImage'])->name('editMouImage');
      Route::get('/downloadMou',[App\Http\Controllers\Faculty\FacultyController::class, 'exportMou']);
      Route::post('/autosearchMou', [App\Http\Controllers\Faculty\FacultyController::class, 'autosearchMou'])->name('faculty.autosearchMou');
    
      
    
});

////////////////////  ***************************  Research Fellow *****************************************////////////////////////////////////


Route::group(['prefix'=>'researchfellow','middleware'=>['isResearchfellow','auth','PreventBackHistory']],function(){
    Route::get('/dashboardfellow', [App\Http\Controllers\Research\ResearchController::class, 'dashboardfellow'])->name('researchfellow.dashboardfellow');
    Route::get('/addPhdProgress', [App\Http\Controllers\Faculty\FacultyController::class, 'addPhdProgress'])->name('faculty.addPhdProgress');
	 Route::get('/editResearchFellow/{id}', [App\Http\Controllers\Office\OfficeController::class, 'editResearchFellow'])->name('editResearchFellow');
         Route::post('/editInfoResearchFellow', [App\Http\Controllers\Office\OfficeController::class, 'editInfoResearchFellow'])->name('editInfoResearchFellow');
     Route::post('/fetchSupervisor', [App\Http\Controllers\Office\OfficeController::class, 'fetchSupervisor'])->name('fetchSupervisor');
     Route::post('/fetchguide', [App\Http\Controllers\Office\OfficeController::class, 'fetchguide'])->name('fetchguide');
         Route::post('/store-profile-image-fellow', [App\Http\Controllers\Research\ResearchController::class, 'storeProfileImagefellow'])->name('storeProfileImagefellow');
      Route::get('/editProfileImage', [App\Http\Controllers\Research\ResearchController::class, 'editProfileImage'])->name('editProfileImage');
	 Route::post('/savePhdprogress', [App\Http\Controllers\Faculty\FacultyController::class, 'savePhdprogress'])->name('savePhdprogress');
     Route::get('/PhdprogressList', [App\Http\Controllers\Faculty\FacultyController::class, 'PhdprogressList'])->name('PhdprogressList');
      Route::get('deletePhdprogress/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deletePhdprogress'])->name('deletePhdprogress');
       Route::get('/editPhdprogress/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editPhdprogress'])->name('editPhdprogress');
       Route::post('/editInfoPhdprogress', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoPhdprogress'])->name('editInfoPhdprogress');
	
     Route::get('/addJournalPublication', [App\Http\Controllers\Faculty\FacultyController::class, 'addJournalPublication'])->name('faculty.addJournalPublication');
    Route::post('/autocompleteSearchResearchPerson', [App\Http\Controllers\Faculty\FacultyController::class, 'autocompleteSearchResearchPerson'])->name('faculty.autocompleteSearchResearchPerson');
    Route::post('/saveJournal', [App\Http\Controllers\Faculty\FacultyController::class, 'saveJournal'])->name('saveJournal');
     
     Route::get('/journalList', [App\Http\Controllers\Faculty\FacultyController::class, 'journalList'])->name('journalList');
     
     
     Route::get('/editJournal/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editJournal'])->name('editJournal');
     Route::post('/editInfoJournal', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoJournal'])->name('editInfoJournal');
     Route::get('/downloadJournalfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportJournalfac']);
      Route::get('/editBook/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editBook'])->name('editBook');
     Route::post('/editInfoBook', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoBook'])->name('editInfoBook');
     Route::get('/downloadBookfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportBookfac']);
      Route::get('/editPatent/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editPatent'])->name('editPatent');
     Route::post('/editInfoPatent', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoPatent'])->name('editInfoPatent');
     Route::get('/downloadPatentfac',[App\Http\Controllers\Faculty\FacultyController::class, 'exportPatentfac']);
    Route::get('/editImagePublication/{id}/{type}', [App\Http\Controllers\Faculty\FacultyController::class, 'editImagePublication'])->name('editImagePublication');
     Route::get('/editfapiAcademicBody/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editfapiAcademicBody'])->name('editfapiAcademicBody');
     Route::post('/editInfofapiAcademicBody', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfofapiAcademicBody'])->name('faculty.editInfofapiAcademicBody');
    
    Route::get('deleteJournal/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteJournal'])->name('deleteJournal');
     Route::get('/addBookChapter', [App\Http\Controllers\Faculty\FacultyController::class, 'addBookChapter'])->name('faculty.addBookChapter');
     Route::get('/addPatentFilled', [App\Http\Controllers\Faculty\FacultyController::class, 'addPatentFilled'])->name('faculty.addPatentFilled');
      Route::post('/saveBookChapter', [App\Http\Controllers\Faculty\FacultyController::class, 'saveBookChapter'])->name('saveBookChapter');
      Route::post('/savePatent', [App\Http\Controllers\Faculty\FacultyController::class, 'savePatent'])->name('savePatent');
        Route::get('/bookList', [App\Http\Controllers\Faculty\FacultyController::class, 'bookList'])->name('bookList');
     Route::get('deleteBook/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteBook'])->name('deleteBook');
        Route::get('/patentList', [App\Http\Controllers\Faculty\FacultyController::class, 'patentList'])->name('patentList');
     Route::get('deletePatent/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deletePatent'])->name('deletePatent');
       Route::get('/addMou', [App\Http\Controllers\Faculty\FacultyController::class, 'addMou'])->name('faculty.addMou');    //add Mou
      Route::post('/saveMou', [App\Http\Controllers\Faculty\FacultyController::class, 'saveMou'])->name('saveMou');
      Route::get('/mouList', [App\Http\Controllers\Faculty\FacultyController::class, 'mouList'])->name('mouList');
      Route::get('deleteMou/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'deleteMou'])->name('deleteMou');
      Route::get('/editMou/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editMou'])->name('editMou');
      Route::post('/editInfoMou', [App\Http\Controllers\Faculty\FacultyController::class, 'editInfoMou'])->name('editInfoMou');
      Route::get('/editMouImage/{id}', [App\Http\Controllers\Faculty\FacultyController::class, 'editMouImage'])->name('editMouImage');
      Route::get('/downloadMou',[App\Http\Controllers\Faculty\FacultyController::class, 'exportMou']);
	  Route::get('/downloadPhdProgressList',[App\Http\Controllers\Faculty\FacultyController::class, 'downloadPhdProgressList']);
      Route::post('/autosearchMou', [App\Http\Controllers\Faculty\FacultyController::class, 'autosearchMou'])->name('faculty.autosearchMou');
    
    
});





////****************************Front End*******************//////////////////////

Route::get('/vision', [App\Http\Controllers\front_end\MenuController::class, 'menu_vision'])->name('menu.vision');
Route::get('/gallery', [App\Http\Controllers\front_end\MenuController::class, 'gallery'])->name('menu.gallery');

Route::get('/about', [App\Http\Controllers\front_end\MenuController::class, 'menu_about'])->name('menu.about');
Route::get('/collegeprofile', [App\Http\Controllers\front_end\MenuController::class, 'menu_college_profile'])->name('menu.collegeprofile');
Route::get('/management', [App\Http\Controllers\front_end\MenuController::class, 'menu_management'])->name('menu.management');
Route::get('/principal', [App\Http\Controllers\front_end\MenuController::class, 'menu_principal'])->name('menu.principal');
Route::get('/collegecouncil', [App\Http\Controllers\front_end\MenuController::class, 'menu_college_council'])->name('menu.collegecouncil');
Route::get('/administrative-staff', [App\Http\Controllers\front_end\MenuController::class, 'menu_administrative_staff'])->name('menu.administrativestaff');
Route::get('/staffassociation', [App\Http\Controllers\front_end\MenuController::class, 'menu_staff_association'])->name('menu.staffassociation');
Route::get('/quality_policy', [App\Http\Controllers\front_end\MenuController::class, 'menu_quality_policy'])->name('menu.qualitypolicy');
Route::get('/code_of_conduct', [App\Http\Controllers\front_end\MenuController::class, 'menu_code_of_conduct'])->name('menu.codeofconduct');
Route::get('/about', [App\Http\Controllers\front_end\MenuController::class, 'menu_about'])->name('menu.about');
Route::get('/about', [App\Http\Controllers\front_end\MenuController::class, 'menu_about'])->name('menu.about');

Route::get('/departments', [App\Http\Controllers\front_end\DepartmentController::class, 'menu_departments'])->name('menu.departments');
Route::get('/cell/{id}', [App\Http\Controllers\front_end\CellController::class, 'index'])->name('cell');
Route::get('/event_details/{id}', [App\Http\Controllers\front_end\DepartmentController::class, 'event_details'])->name('event_details');
Route::get('/event_details_upcoming/{id}', [App\Http\Controllers\front_end\DepartmentController::class, 'event_details_upcoming'])->name('event_details_upcoming');
Route::get('/event_details_cell/{id}', [App\Http\Controllers\front_end\DepartmentController::class, 'event_details_cell'])->name('event_details_cell');
Route::get('/event_details_upcoming_cell/{id}', [App\Http\Controllers\front_end\DepartmentController::class, 'event_details_upcoming_cell'])->name('event_details_upcoming_cell');
Route::get('/events/{id}', [App\Http\Controllers\front_end\CellController::class, 'events'])->name('events');

Route::get('/programmes', [App\Http\Controllers\front_end\ProgrammesController ::class, 'menu_programmes'])->name('menu.programmes');
Route::get('/admission', [App\Http\Controllers\front_end\AdmissionController ::class, 'menu_admission'])->name('menu.admission');
Route::get('/academic-calendar', [App\Http\Controllers\front_end\MenuController::class, 'menu_academic_calendar'])->name('menu.academiccalendar');

Route::get('/research-centers', [App\Http\Controllers\front_end\MenuController::class, 'research_centers'])->name('menu.researchcenters');
Route::get('/research-promotion-council', [App\Http\Controllers\front_end\MenuController::class, 'research_promotion_council'])->name('menu.researchpromotioncouncil');
Route::get('/scholarship', [App\Http\Controllers\front_end\MenuController::class, 'scholarship'])->name('menu.scholarship');
Route::get('/research-guide', [App\Http\Controllers\front_end\MenuController::class, 'research_guide'])->name('menu.researchguide');
Route::get('/research-student', [App\Http\Controllers\front_end\MenuController::class, 'research_student'])->name('menu.researchstudent');
Route::get('/publications', [App\Http\Controllers\front_end\MenuController::class, 'publications'])->name('menu.publications');
Route::get('/research_guides/{id}', [App\Http\Controllers\front_end\MenuController::class, 'research_guides'])->name('research_guides');
Route::get('/research_fellow/{id}', [App\Http\Controllers\front_end\MenuController::class, 'research_fellow'])->name('research_fellow');
Route::get('/mou', [App\Http\Controllers\front_end\JournalController::class, 'menu_mou'])->name('menu.mou');
Route::get('/project', [App\Http\Controllers\front_end\JournalController::class, 'menu_project'])->name('menu.project');
Route::get('/fellowship', [App\Http\Controllers\front_end\JournalController::class, 'menu_fellowship'])->name('menu.fellowship');
Route::get('/grant', [App\Http\Controllers\front_end\JournalController::class, 'menu_grant'])->name('menu.grant');
Route::get('/journal', [App\Http\Controllers\front_end\JournalController::class, 'menu_journal'])->name('menu.journal');
Route::get('/book', [App\Http\Controllers\front_end\JournalController::class, 'menu_book'])->name('menu.book');
Route::get('/patent', [App\Http\Controllers\front_end\JournalController::class, 'menu_patent'])->name('menu.patent');
Route::get('/teaching-method', [App\Http\Controllers\front_end\JournalController::class, 'teaching_method'])->name('menu.teachingmethod');
Route::get('/research-projects', [App\Http\Controllers\front_end\ResearchController::class, 'research_projects'])->name('menu.researchprojects');
Route::get('/achievements', [App\Http\Controllers\front_end\MenuController::class, 'menu_achievements'])->name('menu.achievements');

Route::get('departments_details/{id}/{slug}', [App\Http\Controllers\front_end\DepartmentController::class, 'departments_details'])->name('departments_details');

Route::get('/language-lab', [App\Http\Controllers\front_end\MenuController::class, 'menu_language_lab'])->name('menu.language_lab');
Route::get('/grievance-redressal-cell', [App\Http\Controllers\front_end\MenuController::class, 'menu_grievance_redressal_cell'])->name('menu.grievance_redressal_cell');
Route::get('/hostel', [App\Http\Controllers\front_end\MenuController::class, 'menu_hostel'])->name('menu.hostel');
Route::get('/health-club', [App\Http\Controllers\front_end\MenuController::class, 'menu_health_club'])->name('menu.health_club');
Route::get('/library', [App\Http\Controllers\front_end\MenuController::class, 'menu_library'])->name('menu.library');
Route::get('/media-lab', [App\Http\Controllers\front_end\MenuController::class, 'menu_media_lab'])->name('menu.media_lab');
Route::get('/sports', [App\Http\Controllers\front_end\MenuController::class, 'menu_sports'])->name('menu.sports');
Route::get('/pta', [App\Http\Controllers\front_end\MenuController::class, 'menu_pta'])->name('menu.pta');
Route::get('/tutorial-system', [App\Http\Controllers\front_end\MenuController::class, 'menu_tutorial_system'])->name('menu.tutorial_system');
Route::get('/syllabus', [App\Http\Controllers\front_end\MenuController::class, 'menu_syllabus'])->name('menu.syllabus');
Route::get('/internship', [App\Http\Controllers\front_end\MenuController::class, 'menu_internship'])->name('menu.internship');
Route::get('/counselling-center', [App\Http\Controllers\front_end\MenuController::class, 'menu_counselling_center'])->name('menu.counselling_center');
Route::get('/day-care', [App\Http\Controllers\front_end\MenuController::class, 'menu_day_care'])->name('menu.day_care');
Route::get('/college-reunion', [App\Http\Controllers\front_end\MenuController::class, 'menu_college_reunion'])->name('menu.college_reunion');
Route::get('/college-bus', [App\Http\Controllers\front_end\MenuController::class, 'menu_college_bus'])->name('menu.college_bus');
Route::get('/dubbing-studio', [App\Http\Controllers\front_end\MenuController::class, 'menu_dubbing_studio'])->name('menu.dubbing_studio');
Route::get('/canteen', [App\Http\Controllers\front_end\MenuController::class, 'menu_canteen'])->name('menu.canteen');
Route::get('/centre', [App\Http\Controllers\front_end\MenuController::class, 'menu_centre'])->name('menu.centre');
Route::get('/coperative-society', [App\Http\Controllers\front_end\MenuController::class, 'menu_coperative_society'])->name('menu.coperative_society');
Route::get('/cells', [App\Http\Controllers\front_end\MenuController::class, 'menu_cells'])->name('menu.cells');
Route::get('/infrastructure', [App\Http\Controllers\front_end\DepartmentController::class, 'infrastructure'])->name('menu.infrastructure');
Route::get('/committies', [App\Http\Controllers\front_end\DepartmentController::class, 'committies'])->name('menu.committies');
Route::get('/greeninitiative', [App\Http\Controllers\front_end\DepartmentController::class, 'greeninitiative'])->name('menu.greeninitiative');
Route::get('/gender', [App\Http\Controllers\front_end\DepartmentController::class, 'gender'])->name('menu.gender');
Route::get('/ethics', [App\Http\Controllers\front_end\DepartmentController::class, 'ethics'])->name('menu.ethics');
Route::get('/environment', [App\Http\Controllers\front_end\DepartmentController::class, 'environment'])->name('menu.environment');
Route::get('/skill', [App\Http\Controllers\front_end\DepartmentController::class, 'skill'])->name('menu.skill');
Route::get('/seminar', [App\Http\Controllers\front_end\DepartmentController::class, 'seminar'])->name('menu.seminar');
Route::get('/extensionactivity', [App\Http\Controllers\front_end\DepartmentController::class, 'extensionactivity'])->name('menu.extensionactivity');
Route::get('/bestpractice', [App\Http\Controllers\front_end\DepartmentController::class, 'bestpractice'])->name('menu.bestpractice');
Route::get('/criterion1', [App\Http\Controllers\front_end\MenuController::class, 'criterion1'])->name('menu.criterion1');
Route::get('/criterion1_1', [App\Http\Controllers\front_end\MenuController::class, 'criterion1_1'])->name('menu.criterion1_1');
Route::get('/criterion1_2', [App\Http\Controllers\front_end\MenuController::class, 'criterion1_2'])->name('menu.criterion1_2');
Route::get('/criterion1_3', [App\Http\Controllers\front_end\MenuController::class, 'criterion1_3'])->name('menu.criterion1_3');
Route::get('/criterion1_4', [App\Http\Controllers\front_end\MenuController::class, 'criterion1_4'])->name('menu.criterion1_4');
Route::get('/criterion2', [App\Http\Controllers\front_end\MenuController::class, 'criterion2'])->name('menu.criterion2');
Route::get('/criterion2_1', [App\Http\Controllers\front_end\MenuController::class, 'criterion2_1'])->name('menu.criterion2_1');
Route::get('/criterion2_2', [App\Http\Controllers\front_end\MenuController::class, 'criterion2_2'])->name('menu.criterion2_2');
Route::get('/criterion2_3', [App\Http\Controllers\front_end\MenuController::class, 'criterion2_3'])->name('menu.criterion2_3');
Route::get('/criterion2_4', [App\Http\Controllers\front_end\MenuController::class, 'criterion2_4'])->name('menu.criterion2_4');
Route::get('/criterion2_5', [App\Http\Controllers\front_end\MenuController::class, 'criterion2_5'])->name('menu.criterion2_5');
Route::get('/criterion2_6', [App\Http\Controllers\front_end\MenuController::class, 'criterion2_6'])->name('menu.criterion2_6');
Route::get('/criterion2_7', [App\Http\Controllers\front_end\MenuController::class, 'criterion2_7'])->name('menu.criterion2_7');
Route::get('/criterion3', [App\Http\Controllers\front_end\MenuController::class, 'criterion3'])->name('menu.criterion3');
Route::get('/criterion4', [App\Http\Controllers\front_end\MenuController::class, 'criterion4'])->name('menu.criterion4');
Route::get('/criterion4_1', [App\Http\Controllers\front_end\MenuController::class, 'criterion4_1'])->name('menu.criterion4_1');
Route::get('/criterion4_2', [App\Http\Controllers\front_end\MenuController::class, 'criterion4_2'])->name('menu.criterion4_2');
Route::get('/criterion4_3', [App\Http\Controllers\front_end\MenuController::class, 'criterion4_3'])->name('menu.criterion4_3');
Route::get('/criterion4_4', [App\Http\Controllers\front_end\MenuController::class, 'criterion4_4'])->name('menu.criterion4_4');
Route::get('/criterion5', [App\Http\Controllers\front_end\MenuController::class, 'criterion5'])->name('menu.criterion5');
Route::get('/criterion5_1', [App\Http\Controllers\front_end\MenuController::class, 'criterion5_1'])->name('menu.criterion5_1');
Route::get('/criterion5_2', [App\Http\Controllers\front_end\MenuController::class, 'criterion5_2'])->name('menu.criterion5_2');
Route::get('/criterion5_3', [App\Http\Controllers\front_end\MenuController::class, 'criterion5_3'])->name('menu.criterion5_3');
Route::get('/criterion5_4', [App\Http\Controllers\front_end\MenuController::class, 'criterion5_4'])->name('menu.criterion5_4');
Route::get('/criterion6', [App\Http\Controllers\front_end\MenuController::class, 'criterion6'])->name('menu.criterion6');
Route::get('/criterion6_1', [App\Http\Controllers\front_end\MenuController::class, 'criterion6_1'])->name('menu.criterion6_1');
Route::get('/criterion6_4', [App\Http\Controllers\front_end\MenuController::class, 'criterion6_4'])->name('menu.criterion6_4');
Route::get('/criterion7', [App\Http\Controllers\front_end\MenuController::class, 'criterion7'])->name('menu.criterion7');
Route::get('/criterion7_1', [App\Http\Controllers\front_end\MenuController::class, 'criterion7_1'])->name('menu.criterion7_1');
Route::get('/criterion7_2', [App\Http\Controllers\front_end\MenuController::class, 'criterion7_2'])->name('menu.criterion7_2');
Route::get('/criterion7_3', [App\Http\Controllers\front_end\MenuController::class, 'criterion7_3'])->name('menu.criterion7_3');


////****************************new End*******************//////////////////////


Route::get('/ipr-cell', [App\Http\Controllers\front_end\MenuController::class, 'ipr_cell'])->name('menu.iprcell');
Route::get('/iedc', [App\Http\Controllers\front_end\MenuController::class, 'menu_iedc'])->name('menu.iedc');
Route::get('/incubation-center', [App\Http\Controllers\front_end\IncubationcenterController::class, 'incubation_center'])->name('menu.incubationcenter');
Route::get('/research-papers', [App\Http\Controllers\front_end\ResearchController::class, 'research_papers'])->name('menu.researchpapers');

Route::get('/ariia', [App\Http\Controllers\front_end\MenuController::class, 'ariia'])->name('menu.ariia');
Route::get('/objectives', [App\Http\Controllers\front_end\MenuController::class, 'objectives'])->name('menu.objectives');
Route::get('/composition', [App\Http\Controllers\front_end\MenuController::class, 'composition'])->name('menu.composition');
Route::get('/aqar', [App\Http\Controllers\front_end\MenuController::class, 'aqar'])->name('menu.aqar');
Route::get('/iminutes-and-atr', [App\Http\Controllers\front_end\MenuController::class, 'minutes_and_atr'])->name('menu.minutes and atr');
Route::get('/activities', [App\Http\Controllers\front_end\MenuController::class, 'activities'])->name('menu.activities');
Route::get('/ssr-reports', [App\Http\Controllers\front_end\MenuController::class, 'ssr_reports'])->name('menu.ssr reports');
Route::get('/nirf', [App\Http\Controllers\front_end\MenuController::class, 'nirf'])->name('menu.nirf');
Route::get('/aishe', [App\Http\Controllers\front_end\MenuController::class, 'aishe'])->name('menu.aishe');











