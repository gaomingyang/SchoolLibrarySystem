<?php
//front
Route::get('/','FrontController@index');
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
Route::get('stuByGrade/{grade_id}','StudentController@stuByGrade');
Route::get('student/{id}','StudentController@show');
Route::get('student/{id}/returnbooks','StudentController@returnbooks');

Route::post('student/ajaxupdategender','StudentController@ajaxUpdateGender');
Route::get('student/checkallow/{id}','StudentController@checkallow');


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
	Route::get('student/{id}/restore','Admin\StudentController@restore');

    Route::resource('user','Admin\UserController');
    Route::resource('book','Admin\BookController');
	Route::resource('category','Admin\CategoryController');
	Route::resource('tag','Admin\TagController');
    Route::resource('grade','Admin\GradeController');
    Route::resource('student','Admin\StudentController');

    Route::resource('system','Admin\SystemController',['only'=>['index','update']]);

});
