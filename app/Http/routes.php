<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/hello', function(){
//    return 'Hello World';
//});

//Route::get('/hello', 'Hello@index');
//Route::get('/hello/{name}', 'Hello@show');

Route::get('/insert', function(){
	App\Category::create(array('name'=>"Music"));
	return 'Category Added';
});

Route::get('/read', function(){
	$category = new App\Category();

	$data = $category->all(array('id','name'));

	foreach ($data as $list) {
		echo $list->id . ') ' . $list->name . '<br/>';
	}
});

Route::get('/update', function(){
	$category = App\Category::find(6);
	$category->name = "Heavy metal";
	$category->save();


	$data = $category->all(array('id','name'));

	foreach ($data as $list) {
		echo $list->id . ') ' . $list->name . '<br/>';
	}
});

Route::get('/delete', function(){
	$category = App\Category::find(6);
	$category->delete();

	$data = $category->all(array('id','name'));

	foreach ($data as $list) {
		echo $list->id . ') ' . $list->name . '<br/>';
	}
});

Route::post('/cart', 'Front@cart');

Route::get('/blade', function(){
    $drinks = array('Vodka', 'Gin', 'Whiskey');
    return view('page', array('name'=> "This is Rabin", 'day'=>"Friday", 'drinks'=>$drinks));
});

Route::get('/', 'Front@index');
Route::get('/products', 'Front@products');
Route::get('/products/details/{id}', 'Front@product_details');
Route::get('/products/categories', 'Front@product_categories');
Route::get('/products/brands', 'Front@product_brands');
Route::get('/blog', 'Front@blog');
Route::get('/blog/post/{id}', 'Front@blog_post');
Route::get('/contact-us', 'Front@contact_us');
Route::get('/login', 'Front@login');
Route::get('/logout', 'Front@logout');
Route::get('/cart', 'Front@cart');
Route::get('/clear-cart', 'Front@clear_cart');
Route::get('/checkout', 'Front@checkout');
Route::get('/search/{query}', 'Front@search');
