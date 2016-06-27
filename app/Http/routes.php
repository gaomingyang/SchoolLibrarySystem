<?php
//front
// Route::get('/','FrontController@index');
Route::get('/','BookController@index');
Route::post('/search','FrontController@search');

//book
Route::get('/book','BookController@index');
Route::get('/book/{id}','BookController@show');
Route::get('book/ajaxrepeat/','BookController@ajaxRepeat');
Route::post('book/ajaxstore','BookController@ajaxstore');
Route::get('book/name/{name}','BookController@name');
Route::get('/book/searchbyid/{id}','BookController@searchbyid');
Route::get('/book/searchbykw/{keyword}','BookController@searchbykw');   //borrow search loanable
Route::get('/book/borrowinfo/{kw}','BookController@borrowinfo');

//student
Route::get('stuBySquad/{squad_id}','StudentController@stuBySquad');
Route::get('student/{id}','StudentController@show');
Route::get('student/{id}/returnbooks','StudentController@returnbooks');		//根据学生还书

Route::post('student/ajaxupdategender','StudentController@ajaxUpdateGender');	//借书界面对未设置性别的学生进行设置
Route::get('student/checkallow/{id}','StudentController@checkallow');	//借书监测是否还可借。目前只限制本数


//borrow
Route::resource('borrow','BorrowController');
Route::get('return','BorrowController@back');
Route::post('/return','BorrowController@doreturn');
Route::get('return/student/{id}','BorrowController@student');
Route::get('/borrowed','BorrowController@borrowed');
Route::get('/returned/{day?}','BorrowController@returned');
Route::get('/success','BorrowController@success');

//tag
Route::get('tag/{id}','TagController@show');


//ranking list
Route::get('ranks','FrontController@ranks');
Route::get('rank/student','FrontController@studentrank');
Route::get('rank/book','FrontController@bookrank');


//后台   登记图书和学生信息，借书、还书的信息修改。
// Route::group(['middleware'=>['auth'],'prefix'=>'admin'],function(){
//     Route::resource('admin','AdminController');
//     // Route::resource('admins','AdminsController');
//     // Route::resource('system','SystemController');
// });
Route::group(['middleware' => 'web'], function () {
	Route::auth();
});

//Route::group(['middleware' => 'web','prefix'=>'admin'], function () {
Route::group(['middleware' => 'web','prefix'=>'admin'], function () {
    Route::get('/','Admin\AdminController@index');
    // Route::get('admin/books', 'AdminController@index');

    Route::get('borrowed','Admin\BorrowController@borrowed');
	Route::get('returned','Admin\BorrowController@returned');
	Route::get('borrowlog','Admin\BorrowController@borrowlog');

    Route::get('book/trashed','Admin\BookController@trashed');

	Route::get('student/trashed','Admin\StudentController@trashed');
	Route::get('student/graduated','Admin\StudentController@graduated');	//已毕业学生
	Route::put('student/{id}/grollback',['as'=>'admin.student.grollback','uses'=>'Admin\StudentController@graduatedrollback']);	//已毕业学生
	Route::get('student/{id}/restore','Admin\StudentController@restore');

	Route::get('student/rise','Admin\StudentController@rise');
	Route::post('student/dorise','Admin\StudentController@dorise');
	Route::post('student/{id}/unrise','Admin\StudentController@unrise');

	Route::get('grade/trashed','Admin\GradeController@trashed');
	
	// Route::get('grade/{id}/seattable','Admin\GradeController@seattable');
	// Route::get('grade/{id}/seattable/create','Admin\GradeController@seattable_create');

	//管理员 变更密码
	Route::get('user/{id}/password','Admin\UserController@password');


    Route::resource('user','Admin\UserController');
    Route::resource('book','Admin\BookController');
	Route::resource('category','Admin\CategoryController');
	Route::resource('tag','Admin\TagController');
    Route::resource('grade','Admin\GradeController');
    Route::resource('squad','Admin\SquadController');
    Route::resource('student','Admin\StudentController');

    Route::resource('system','Admin\SystemController',['only'=>['index','update']]);

});
