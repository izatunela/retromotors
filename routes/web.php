<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminMarketController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GalleryCommentsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarketAutomobilesController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\MarketEquipmentController;
use App\Http\Controllers\MarketMotorcyclesController;
use App\Http\Controllers\MarketPartsController;
use App\Http\Controllers\MarketTrucksController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;

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

Route::domain('www.admin.retromotorsdev.com')->group(function () {
		Route::get('login',[AdminController::class,'create'])->name('alogin');
		Route::post('login',[AdminController::class,'store']);
		Route::group(['middleware' => ['admin']], function () {
			Route::get('/',[AdminController::class,'index'])->name('admin-index');
			Route::get('logout',[AdminController::class,'destroy'])->name('admin-logout');

			Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin-dashboard');
			Route::get('/frontpage',[AdminController::class,'frontpage'])->name('admin-frontpage');
			Route::get('/users',[AdminController::class,'users'])->name('admin-users');
			Route::post('/users/create',[AdminController::class,'createUser'])->name('admin-user-create');
			Route::get('/users/delete/{id}',[AdminController::class,'deleteUser'])->name('admin-user-delete');
			Route::get('/users/restore',[AdminController::class,'restoreUser'])->name('admin-user-restore');
			Route::get('/market',[AdminMarketController::class,'market'])->name('admin-market');
			Route::get('/market/automobile',[AdminMarketController::class,'automobile'])->name('admin-market-automobile');
			Route::get('/market/delete',[AdminMarketController::class,'marketDelete'])->name('admin-market-automobile-delete');
			// Route::get('/market/automobile/delete/{item}',[AdminMarketController::class,'automobileDelete'])->name('admin-market-automobile-delete');
			Route::get('/market/restore',[AdminMarketController::class,'marketRestore'])->name('admin-market-automobile-restore');
			// Route::get('/market/{cat}/restore/{item}',[AdminMarketController::class,'automobileRestore'])->name('admin-market-automobile-restore');
			Route::get('/market/motorcycle',[AdminMarketController::class,'motorcycle'])->name('admin-market-motorcycle');
			Route::get('/market/truck',[AdminMarketController::class,'truck'])->name('admin-market-truck');
			Route::get('/market/parts',[AdminMarketController::class,'parts'])->name('admin-market-parts');
			Route::get('/market/equipment',[AdminMarketController::class,'equipment'])->name('admin-market-equipment');
			Route::get('/gallery',[AdminGalleryController::class,'gallery'])->name('admin-gallery');
			Route::get('/gallery/delete/{id}',[AdminGalleryController::class,'galleryDelete'])->name('admin-gallery-delete');
			Route::get('/gallery/restore',[AdminGalleryController::class,'galleryRestore'])->name('admin-gallery-restore');
		});
	});

	Route::get('/',[HomepageController::class,'home'])->where('home','home')->name('home');
	Route::get('about',[HomepageController::class,'about'])->where('about','about')->name('about');

	// /****************************************************************************************/
	// /**************************************Market********************************************/
	// /****************************************************************************************/
	Route::get('market/create','MarketController@create')->name('market-create');
	// //auto
	Route::get('market/automobile',[MarketAutomobilesController::class,'index'])->name('market-automobile');
	Route::get('market/automobile/{brand}',[MarketAutomobilesController::class,'index'])->name('market-automobile-brand');
	Route::get('market/create-automobile',[MarketAutomobilesController::class,'create'])->name('market-create-automobile');
	Route::post('market/create-automobile',[MarketAutomobilesController::class,'store'])->name('market-store-automobile');
	Route::get('market/automobile/{item}/{title}',[MarketAutomobilesController::class,'show'])->name('market-automobile-item');
	Route::post('market/edit/automobile/{title}',[MarketAutomobilesController::class,'edit'])->name('market-automobile-edit');
	Route::patch('market/edit/automobile/update',[MarketAutomobilesController::class,'update'])->name('market-automobile-update');
	Route::delete('market/automobile/delete/{item}',[MarketAutomobilesController::class,'delete'])->name('market-automobile-delete');
	// //moto
	Route::get('market/motorcycle',[MarketMotorcyclesController::class,'index'])->name('market-motorcycle');
	Route::get('market/create-motorcycle',[MarketMotorcyclesController::class,'create'])->name('market-create-motorcycle');
	Route::post('market/create-motorcycle',[MarketMotorcyclesController::class,'store'])->name('market-store-motorcycle');
	Route::get('market/motorcycle/{item}/{title}',[MarketMotorcyclesController::class,'show'])->name('market-motorcycle-item');
	Route::post('market/edit/motorcycle/{title}',[MarketMotorcyclesController::class,'edit'])->name('market-motorcycle-edit');
	Route::patch('market/edit/motorcycle/update',[MarketMotorcyclesController::class,'update'])->name('market-motorcycle-update');
	Route::delete('market/motorcycle/delete/{item}',[MarketMotorcyclesController::class,'delete'])->name('market-motorcycle-delete');
	// //truck
	Route::get('market/truck',[MarketTrucksController::class,'index'])->name('market-truck');
	Route::get('market/create-truck',[MarketTrucksController::class,'create'])->name('market-create-truck');
	Route::post('market/create-truck',[MarketTrucksController::class,'store'])->name('market-store-truck');
	Route::get('market/truck/{item}/{title}',[MarketTrucksController::class,'show'])->name('market-truck-item');
	Route::post('market/edit/truck/{title}',[MarketTrucksController::class,'edit'])->name('market-truck-edit');
	Route::patch('market/edit/truck/update',[MarketTrucksController::class,'update'])->name('market-truck-update');
	Route::delete('market/truck/delete/{item}',[MarketTrucksController::class,'delete'])->name('market-truck-delete');
	// //parts
	Route::get('market/parts',[MarketPartsController::class,'index'])->name('market-parts');
	Route::get('market/create-parts',[MarketPartsController::class,'create'])->name('market-create-parts');
	Route::post('market/create-parts',[MarketPartsController::class,'store'])->name('market-store-parts');
	Route::get('market/parts/{item}/{title}',[MarketPartsController::class,'show'])->name('market-parts-item');
	Route::post('market/edit/parts/{title}',[MarketPartsController::class,'edit'])->name('market-parts-edit');
	Route::patch('market/edit/parts/update',[MarketPartsController::class,'update'])->name('market-parts-update');
	Route::delete('market/parts/delete/{item}',[MarketPartsController::class,'delete'])->name('market-parts-delete');
	// //equipment
	Route::get('market/equipment',[MarketEquipmentController::class,'index'])->name('market-equipment');
	Route::get('market/create-equipment',[MarketEquipmentController::class,'create'])->name('market-create-equipment');
	Route::post('market/create-equipment',[MarketEquipmentController::class,'store'])->name('market-store-equipment');
	Route::get('market/equipment/{item}/{title}',[MarketEquipmentController::class,'show'])->name('market-equipment-item');
	Route::post('market/edit/equipment/{title}',[MarketEquipmentController::class,'edit'])->name('market-equipment-edit');
	Route::patch('market/edit/equipment/update',[MarketEquipmentController::class,'update'])->name('market-equipment-update');
	Route::delete('market/equipment/delete/{item}',[MarketEquipmentController::class,'delete'])->name('market-equipment-delete');

	Route::post('market/store-market-temp-img',[MarketController::class,'storeTempImages'])->name('market-store-temp-img');
	Route::post('market/edit/item/get-photos',[MarketController::class,'editGetPhotos'])->name('market-edit-get-photos');
	Route::post('market/edit/temp/store-img',[MarketController::class,'storeEditTempImages'])->name('market-edit-store-temp-img');

	Route::post('gallery/store-gallery-temp-img',[GalleryController::class,'storeTempImages'])->name('gallery-store-temp-img');
	Route::post('gallery/edit/item/get-photos',[GalleryController::class,'editGetPhotos'])->name('gallery-edit-get-photos');
	Route::post('gallery/edit/temp/store-img',[GalleryController::class,'storeEditTempImages'])->name('gallery-edit-store-temp-img');

	Route::get('market/automobile/search',[SearchController::class,'searchAutomobile'])->name('search-market-automobile');
	Route::get('market/motorcycle/search',[SearchController::class,'searchMotorcycle'])->name('search-market-motorcycle');
	Route::get('market/truck/search',[SearchController::class,'searchTruck'])->name('search-market-truck');
	Route::get('market/parts/search',[SearchController::class,'searchParts'])->name('search-market-parts');
	Route::get('market/equipment/search',[SearchController::class,'searchEquipment'])->name('search-market-equipment');

	// /****************************************************************************************/
	// /**************************************Gallery*******************************************/
	// /****************************************************************************************/

	Route::get('gallery/comments',[GalleryCommentsController::class,'getComments'])->name('gallery-get-comments');
	Route::post('gallery/{galleryItem}/comment',[GalleryCommentsController::class,'store'])->name('gallery-create-comment');
	Route::get('gallery/{galleryItem}/sessioncomment',[GalleryCommentsController::class,'storeInSession'])->name('gallery-session-comment');
	Route::get('gallery',[GalleryController::class,'index'])->name('gallery-index');
	Route::get('gallery/create',[GalleryController::class,'create'])->name('gallery-create');
	Route::post('gallery/store',[GalleryController::class,'store'])->name('gallery-store');
	Route::get('gallery/{id}/{title}',[GalleryController::class,'show'])->name('gallery-item');
	Route::post('gallery/edit/{title}',[GalleryController::class,'edit'])->name('gallery-edit');
	Route::patch('gallery/edit/update',[GalleryController::class,'update'])->name('gallery-update');
	Route::delete('gallery/delete/{item}',[GalleryController::class,'delete'])->name('gallery-delete');

	// /****************************************************************************************/
	// /**************************************Vehicles******************************************/
// /****************************************************************************************/
    Route::get('vehicles/automobile/brands',[VehiclesController::class,'getAutomobileBrands'])->name('automobile-brands');
    Route::get('vehicles/automobile/brand/models',[VehiclesController::class,'getAutomobileModels'])->name('automobile-models');
    Route::get('vehicles/all/brands',[VehiclesController::class,'getBrandsByVehicleCategory'])->name('vehicle-category-brands');

	// /****************************************************************************************/
	// /**************************************User**********************************************/
	// /****************************************************************************************/
	Route::get('user/{user}/profile',[UserController::class,'profile'])->name('user-profile');
	Route::get('user/{user}',[UserController::class,'profile']);
	Route::get('user/{user}/market',[UserController::class,'market'])->name('user-market');
	Route::get('user/{user}/market/{category}',[UserController::class,'getMarketItemsByCategory'])->name('user-market-items');
	Route::get('user/{user}/gallery',[UserController::class,'gallery'])->name('user-gallery');
	Route::get('user/{user}/inbox',[UserController::class,'inbox'])->name('user-inbox');
	Route::get('user/{user}/notifications',[UserController::class,'notifications'])->name('user-notifications');
	Route::get('user/{user}/settings',[UserController::class,'settings'])->name('user-settings');
	Route::get('user/{user}/password',[UserController::class,'getChangePasswordForm'])->name('user-password-change-form');
	Route::post('user/{user}/password',[UserController::class,'changePassword'])->name('user-password-change');
	Route::get('user/{user}/email',[UserController::class,'getChangeEmailForm'])->name('user-email-change-form');
	Route::post('user/{user}/email',[UserController::class,'changeEmail'])->name('user-email-change');
	Route::get('user/email/confirm/{code}',[UserController::class,'changeEmailConfirm'])->name('user-email-change-confirm');
	Route::patch('user/profile',[UserController::class,'profileUpdate'])->name('user-profile-update');

	// /****************************************************************************************/
	// /**************************************Auth**********************************************/
	// /****************************************************************************************/
	Route::get('register',[RegisterController::class,'registerForm'])->name('register');
	Route::post('register',[RegisterController::class,'store']);
	Route::get('confirm/{code}',[RegisterController::class,'confirm']);

	Route::get('password/reset', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password-forget-form');
	Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password-forget-email');
	Route::get('password/reset/{token}', [ForgotPasswordController::class,'showResetForm'])->name('password-reset-form');
	Route::post('password/reset', [ForgotPasswordController::class,'reset'])->name('password-reset');

	Route::get('login',[LoginController::class,'create'])->name('login');
	Route::post('login',[LoginController::class,'store']);
	Route::get('logout',[LoginController::class,'destroy'])->name('logout');
	Route::get('success',[LoginController::class,'success'])->name('success');
