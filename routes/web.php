<?php



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PagesController@index' );
Route::get('/about', 'PagesController@about' );
Route::get('/services', 'PagesController@services' );

//posts routs
Route::get('/posts', 'PostsController@index' )->name('posts.index');

//create routs
Route::get('/posts/create', 'PostsController@create' )->name('posts.create');
Route::post('/posts', 'PostsController@store' )->name('posts.store');

Route::get('/posts/{id}', 'PostsController@show' )->name('posts.show');

//edit routs
Route::get('/posts/{id}/edit', 'PostsController@edit' )->name('posts.edit');
Route::put('/posts/{id}', 'PostsController@update' )->name('posts.update');

//delete post
Route::delete('/posts/{id}', 'PostsController@destroy' )->name('posts.destroy');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
