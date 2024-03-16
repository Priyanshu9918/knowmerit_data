<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RazorpayController;
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
//////////for landing page////////


/////////end landing page section////
Route::get('/', function () {
    return view('welcome');
});


Route::get('student/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('student.logout');
Route::get('logout', [App\Http\Controllers\Auth\Admin\LoginController::class, 'logout'])->name('admin.logout');

Route::get('user/login', [App\Http\Controllers\Auth\LoginController::class, 'login_view'])->name('front.login');

//forgot password///////////////////////////

Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
Route::post('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');


/////////////////////forgetpassword/////////////////////////

Route::post('doUsrlgn', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('user.dologin');
Route::post('doAdmlgn', [App\Http\Controllers\Auth\Admin\LoginController::class, 'login'])->name('admin.dologin');

Auth::routes();
Route::get('admin/login', [App\Http\Controllers\Auth\Admin\LoginController::class, 'login_view'])->name('admin.login');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.dashboard');

//route admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['Admin']], function () {

    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
    Route::match(['get', 'post'], '/user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
    Route::match(['get', 'post'], '/user/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
    Route::post('/enable-action', [App\Http\Controllers\Admin\AjaxController::class, 'setEnableAction'])->name('enable-action');
    Route::post('/status-action', [App\Http\Controllers\Admin\AjaxController::class, 'setStatusAction'])->name('status-action');
    Route::post('/delete-action', [App\Http\Controllers\Admin\AjaxController::class, 'setDeleteAction'])->name('delete-action');
    Route::post('/enable-action1', [App\Http\Controllers\Admin\AjaxController::class, 'setEnableAction1'])->name('enable-action1');

    // slider
    Route::get('/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('role');
    Route::match(['get', 'post'], '/role/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('role.create');
    Route::match(['get', 'post'], '/role/edit/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('role.edit');
    Route::get('/role-permission/{id}', [App\Http\Controllers\Admin\RoleController::class, 'getAddPermissionPage'])->name('role.permission');
    Route::post('/role-permission/update', [App\Http\Controllers\Admin\RoleController::class, 'updateRolePermission'])->name('role.permission');
    ///catecory//

    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category');

    Route::match(['get', 'post'], '/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');

    Route::match(['get', 'post'], '/category/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/sub-category-list', [App\Http\Controllers\Admin\AjaxController::class, 'subCategoryList'])->name('sub-category-list');
    Route::get('/sub-category', [App\Http\Controllers\Admin\AjaxController::class, 'subCategoryList1'])->name('sub-category');

    //managepage
    Route::get('/manage-page', [App\Http\Controllers\Admin\ManagePageController::class, 'index'])->name('manage-page');

    Route::match(['get', 'post'], '/manage-page/create', [App\Http\Controllers\Admin\ManagePageController::class,'create'])->name('manage-page.create');

    Route::match(['get', 'post'], '/manage-page/edit/{id}', [App\Http\Controllers\Admin\ManagePageController::class, 'edit'])->name('manage-page.edit');

    //cms
    Route::get('/cms', [App\Http\Controllers\Admin\CmsController::class, 'index'])->name('cms');
    Route::match(['get', 'post'], '/cms/create', [App\Http\Controllers\Admin\CmsController::class,'create'])->name('cms.create');
    Route::match(['get', 'post'], '/cms/edit/{id}', [App\Http\Controllers\Admin\CmsController::class, 'edit'])->name('cms.edit');

    //products
    Route::get('/products', [App\Http\Controllers\Admin\ProductsController::class, 'index'])->name('products');
    Route::match(['get', 'post'], '/products/create', [App\Http\Controllers\Admin\ProductsController::class,'create'])->name('products.create');
    Route::match(['get', 'post'], '/products/edit/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'edit'])->name('products.edit');
    Route::match(['get','post'],'/products/image-gallery/{id}',[App\Http\Controllers\Admin\ProductsController::class, 'productGallery'])->name('products.image-gallery');

    Route::post('/products/remove/image',[App\Http\Controllers\Admin\ProductsController::class, 'removeImage'])->name('products.remove.image');

});

// Route::get('{slug}', [App\Http\Controllers\CommonController::class, 'fetch']);
