<?php

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

Route::get('/','Auth\LoginController@showLoginForm');
Route::get('maintainance','AuthenticationController@maintainance')->name('maintainance');
Route::get('access-denied','AuthenticationController@deniedAccess')->name('access.denied');
Auth::routes();

Route::group(['middleware' => ['auth','access']], function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::resource('staff','StaffController');
    Route::get('find/staff','StaffController@search')->name('staff.file.find');
    Route::get('search/staff','StaffController@searchResult')->name('staff.file.search');
    Route::put('staff/{staff}/authorize','AuthenticationController@authorizeStaff')->name('staff.authorize');
    Route::put('staff/{staff}/reauthorize','AuthenticationController@reAuthorizeStaff')->name('staff.reauthorize');
    Route::put('staff/{staff}/access/revoke','AuthenticationController@revokeAccess')->name('staff.access.revoke');
    Route::put('staff/{staff}/access/restore','AuthenticationController@restoreAccess')->name('staff.access.restore');
    
    Route::put('staff/{staff}/class','StaffController@assignClass')->name('staff.class.assign');
    Route::put('staff/{staff}/role','StaffController@changeRole')->name('staff.role.change');
    Route::get('staff/{id}/restore', 'StaffController@restore')->name('staff.restore');
    Route::get('staff/{id}/kill', 'StaffController@kill')->name('staff.kill');
    Route::resource('staff/{staff}/guarantor','GuarantorController');

    Route::get('bin/enrollment', 'EnrollmentController@bin')->name('enrollment.bin');
    Route::get('bin/staff', 'StaffController@bin')->name('staff.bin');

    Route::get('import/staff','ImportController@staffForm')->name('staff.import.form');
    Route::post('import/staff','ImportController@importStaff')->name('staff.import');
    Route::get('import/students','ImportController@studentForm')->name('student.import.form');
    Route::post('import/students','ImportController@importStudents')->name('student.import');

    Route::get('export/staff','ExportController@staff')->name('staff.export');
    Route::get('export/students','ExportController@students')->name('student.export');

    Route::resource('enrollment','EnrollmentController');
    Route::get('find/enrollment','EnrollmentController@search')->name('enrollment.file.find');
    Route::get('search/enrollment','EnrollmentController@searchResult')->name('enrollment.file.search');
    Route::get('enrollment/{enrollment}/parent/add', 'ParenttController@create')->name('parent.create');
    Route::post('enrollment/{enrollment}/parent/add', 'ParenttController@store')->name('parent.store');
    Route::get('enrollment/{enrollment}/admit', 'StudentController@create')->name('student.create');
    Route::post('enrollment/{enrollment}/admit', 'StudentController@store')->name('student.store');
    Route::put('bin/enrollment/action', 'EnrollmentController@batchAction')->name('enrollment.bin.action');
    
    Route::get('students','StudentController@index')->name('student.index');
    Route::get('student/{student}','StudentController@show')->name('student.show');
    Route::get('student/{student}/enrollment','StudentController@enrollment')->name('student.enrollment');
    Route::put('student/{student}/fee/add','StudentController@addFee')->name('student.fee.add');
    Route::put('student/{student}/fee/{fee}/cancel','FeeController@cancelStudentFee')->name('student.fee.cancel');
    Route::get('student/{student}/fee/{fee}/pay','StudentController@payFee')->name('student.fee.pay');
    Route::get('students/results','ResultController@studentResults')->name('student.results');
    Route::post('result/print','PrinterController@result')->name('result.print');
    
    Route::get('parents','ParenttController@index')->name('parents');
    Route::get('parent/{id}/edit', 'ParenttController@edit')->name('parent.edit');
    Route::put('parent/{id}/edit', 'ParenttController@update')->name('parent.update');
    Route::delete('parent/{id}/delete', 'ParenttController@destroy')->name('parent.destroy');


    
    Route::resource('class','ClassroomController');
    Route::put('class/{class}/fee/add','ClassroomController@addFee')->name('class.fee.add');
    Route::put('class/{class}/fee/{fee}/cancel','FeeController@cancelClassFee')->name('class.fee.cancel');
    Route::put('class/{class}/subject/update', 'ClassroomController@updateSubjects')->name('class.subject.update');
    Route::put('promotion','ClassroomController@changeClass')->name('class.change');
    Route::put('class/{class}/attendance','AttendanceController@markStudentAttendance')->name('class.attendance');
    Route::get('class/{class}/results','ResultController@classResults')->name('class.results');

    Route::resource('role','RoleController');
    
    Route::resource('subject','SubjectController');
    Route::get('/subject/bin', 'SubjectController@bin')->name('subject.bin');
    Route::get('/subject/{id}/restore', 'SubjectController@restore')->name('subject.restore');
    Route::get('/subject/{id}/kill', 'SubjectController@kill')->name('subject.kill');
    
    
    Route::resource('book','BookController');
    Route::get('/book/bin', 'BookController@bin')->name('book.bin');
    Route::get('/book/{id}/restore', 'BookController@restore')->name('book.restore');
    Route::get('/book/{id}/kill', 'BookController@kill')->name('book.kill');
    
    Route::resource('fee','FeeController');
    Route::get('fee/{fee}/payments','FeeController@payments')->name('fee.payments');
    Route::get('fee/{fee}/pay','FeeController@pay')->name('fee.pay');
    Route::post('fee/{fee}/attachclasses','FeeController@attachClasses')->name('fee.attach.classes');
    Route::post('fee/{fee}/attachstudents','FeeController@attachStudents')->name('fee.attach.students');
    
    Route::get('payment/create','PaymentController@create')->name('payment.create');
    Route::post('payment/create','PaymentController@store')->name('payment.store');
    Route::get('payments','PaymentController@index')->name('payments');
    Route::get('payment/{payment}/receipt','PrinterController@receipt')->name('payment.receipt');
    Route::get('payment/verify','PaymentController@verify')->name('payment.verify');
    Route::delete('payment/{payment}/destroy','PaymentController@destroy')->name('payment.destroy');
  
    Route::resource('term','TermController');

    Route::get('class/{class}/subject/{subject}/results','ResultController@record')->name('result.record');
    Route::post('class/{class}/subject/{subject}/results','ResultController@save')->name('result.save');
    
    Route::get('password','AuthenticationController@editPassword')->name('user.password.edit');
    Route::put('password','AuthenticationController@updatePassword')->name('user.password.update');
    
    Route::get('settings/portal','PortalController@editSettings')->name('portal.settings.edit');    
    Route::put('settings/portal','PortalController@updateSettings')->name('portal.settings.update');    
    Route::get('settings/grading', 'PortalController@editGrading')->name('grade.settings.edit');
    Route::put('settings/grading', 'PortalController@updateGrading')->name('grade.settings.update');

    Route::get('backups', 'BackupController@index')->name('backups');
    Route::get('backup/create', 'BackupController@create')->name('backup.create');
    Route::get('backup/download/{file_name}', 'BackupController@download')->name('backup.download');
    Route::get('backup/delete/{file_name}', 'BackupController@delete')->name('backup.delete');
});
