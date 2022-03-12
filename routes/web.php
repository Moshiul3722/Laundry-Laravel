<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OrderManagerController;
use App\Http\Controllers\PhoneOrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\StaffController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('frontend.pages.home');
});


// auth route for both
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});

// for user
Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/dashboard/myprofile', 'App\Http\Controllers\DashboardController@profile')->name('dashboard.myprofile');
});

require __DIR__ . '/auth.php';

/**
 * Dashboard Routs for testing view
 */
Route::get('adminpanel', function () {
    return view('admin.app');
});

Route::get('dashboardNew', [DashboardController::class, 'dashboardNew']);
// Route::get('dashCity', [LocationController::class, 'dashboardCity']);

// Route::get('area', [LocationController::class, 'areaView']);


/**
 * city & Area
 *
 * City CRUD
 */
Route::get('cities', [LocationController::class, 'index'])->name('dashboard.addCity');
Route::post('addCity', [LocationController::class, 'storeCity']);
Route::get('fetchCities', [LocationController::class, 'fetchCities']);
Route::get('edit-city/{id}', [LocationController::class, 'editCity']);
Route::put('updateCity/{id}', [LocationController::class, 'updateCity']);
Route::post('/locationStatusInactive', [LocationController::class, 'editStatusToInactive']);
Route::post('/locationStatusActive', [LocationController::class, 'editStatusToActive']);
// Route::delete('deleteCity/{id}', [LocationController::class, 'deleteCity']);
Route::post('/deleteCityByID', [LocationController::class, 'deleteCityByID']);
/**
 * Area CRUD
 */
Route::get('/area', [AreaController::class, 'index']);
Route::post('/addArea', [AreaController::class, 'storeArea']);
Route::get('/getAreaList', [AreaController::class, 'fetchAreas']);
Route::get('/edit-area/{id}', [AreaController::class, 'editArea']);
Route::put('updateArea/{id}', [AreaController::class, 'updateArea']);
Route::post('/areaStatusInactive', [AreaController::class, 'editStatusToInactive']);
Route::post('/areaStatusActive', [AreaController::class, 'editStatusToActive']);
Route::post('/deleteAreaByID', [AreaController::class, 'deleteAreaByID']);

/**
 * Order Details CRUD
 */




/**
 * Old Order Detail CRUD
 */

Route::get('phone_order', [OrderDetailController::class, 'index']);
Route::get('/phone_order_process', [OrderDetailController::class, 'phone_order_process']);




// Route::post('/store_phone_order', [OrderDetailController::class, 'store_phone_order'])->name('store_phone_order');
// Route::get('/getOrder', [OrderDetailController::class, 'index']);
// Route::get('/getOrderArea', [OrderDetailController::class, 'getOrderArea']);
// Route::post('/addOrderDetail', [OrderDetailController::class, 'storeOrderDetail']);
// Route::post('/getPhones', [OrderDetailController::class, 'getPhones'])->name('getPhones');
// Route::get('/getCustomerInfo/{id}', [OrderDetailController::class, 'getCustomerInfo']);
// Route::post('/storeCustomerOrder', [OrderDetailController::class, 'storeCustomerOrder'])->name('storeCustomerOrder');
// Route::get('/getOrderDetailList', [OrderDetailController::class, 'getOrderDetailList']);
// Route::get('/getOrder/{id}', [OrderDetailController::class, 'getOrder']);
// Route::get('/getOrderDetailList', function () {
//     return view('admin.pages.viewOrderList');
// });

// Route::get('dataTable', function () {
//     return view('dataTable');
// });

// FrontEnd Routs
// Route::get('home', function () {
//     return view('frontend.pages.home');
// });


/**
 * Vendors Details CRUD
 */
Route::get('vendors', [VendorsController::class, 'index']);
Route::post('addVendor', [VendorsController::class, 'storeVendor']);
Route::get('/getVendors', [VendorsController::class, 'getVendors']);
Route::post('/getVendorByID', [VendorsController::class, 'editVendor']);
Route::post('/updateVendor/{id}', [VendorsController::class, 'updateVendor']);
Route::post('/deleteVendorByID', [VendorsController::class, 'deleteVendorByID']);
Route::post('/vendorStatusInactive', [VendorsController::class, 'editStatusToInactive']);
Route::post('/vendorStatusActive', [VendorsController::class, 'editStatusToActive']);

// Route::get('vendors', function () {
//     return view('admin.pages.vendors');
// });


/**
 * Staff Management CRUD
 */

Route::get('staffManagerList', [StaffController::class, 'index']);
Route::post('addStaff', [StaffController::class, 'storeStaff']);
Route::get('/getStaffs', [StaffController::class, 'getStaffs']);
Route::post('/staffStatusInactive', [StaffController::class, 'editStatusToInactive']);
Route::post('/staffStatusActive', [StaffController::class, 'editStatusToActive']);
Route::post('/getStaffByID', [StaffController::class, 'editStaff']);
Route::post('/updateStaff/{id}', [StaffController::class, 'updateStaff']);
Route::post('/deleteStaffByID', [StaffController::class, 'deleteStaffByID']);

/**
 * Coupon Code CRUD
 */
Route::get('coupon', [CouponController::class, 'index']);
Route::get('manage_coupon', [CouponController::class, 'manage_coupon']);
Route::get('manage_coupon/{id}', [CouponController::class, 'manage_coupon']);
Route::post('manage_coupon_process', [CouponController::class, 'manage_coupon_process'])->name('coupon.manage_coupon_process');
Route::get('delete/{id}', [CouponController::class, 'delete']);


/**
 * Phone Order CRUD
 */

Route::get('phoneOrder', [PhoneOrderController::class, 'index']);
Route::get('manage_phoneOrder', [PhoneOrderController::class, 'manage_phoneOrder']);
Route::get('manage_phoneOrder/{id}', [PhoneOrderController::class, 'manage_phoneOrder']);
Route::post('manage_phoneOrder_process', [PhoneOrderController::class, 'manage_phoneOrder_process'])->name('manage_phoneOrder');
Route::get('delete_phoneOrder/{id}', [PhoneOrderController::class, 'delete_phoneOrder']);
Route::post('/editNonPickedUpToPickedUp', [PhoneOrderController::class, 'editPickedUpStatus']);

/**
 * Phone Order Related Routs
 */
Route::get('/getCustomerInfo/{id}', [PhoneOrderController::class, 'getCustomerInfo']);
Route::get('/getOrderArea', [OrderDetailController::class, 'getOrderArea']);

/**
 * Category CRUD
 */
Route::get('category', [CategoryController::class, 'index']);
Route::post('addCategory', [CategoryController::class, 'addCategory']);
Route::get('/getCategories', [CategoryController::class, 'getCategories']);
Route::post('/editStatusToInactive', [CategoryController::class, 'editStatusToInactive']);
Route::post('/editStatusToActive', [CategoryController::class, 'editStatusToActive']);
Route::post('/getCategoryByID', [CategoryController::class, 'editCategory']);
Route::post('/updateCategory/{id}', [CategoryController::class, 'updateCategory']);
Route::post('/deleteCategoryByID', [CategoryController::class, 'deleteCategoryByID']);
/**
 * Item management CRUD
 */
Route::get('items', [ItemController::class, 'index']);
Route::post('addItem', [ItemController::class, 'addItem']);
Route::get('/getItems', [ItemController::class, 'getItems']);
Route::post('/editStatusToInactive', [ItemController::class, 'editStatusToInactive']);
Route::post('/editStatusToActive', [ItemController::class, 'editStatusToActive']);
Route::post('/getItemByID', [ItemController::class, 'editItem']);
Route::post('/updateItem/{id}', [ItemController::class, 'updateItem']);
Route::post('/deleteItemByID', [ItemController::class, 'deleteItemByID']);


/**
 * Order Manager CRUD
 */
Route::get('orderManagerList', [OrderManagerController::class, 'index'])->name('orderManagerList');
// Route::get('addOrderManager', [OrderManagerController::class, 'addOrderManager']);
Route::get('manage_orderManager', [OrderManagerController::class, 'manage_orderManager']);
Route::get('manage_orderManager/{id}', [OrderManagerController::class, 'manage_orderManager']);
Route::get('mange_itemProcess/{id}', [OrderManagerController::class, 'mange_itemProcess']);
// Route::get('manage_orderModal/{id}', [OrderManagerController::class, 'manage_orderModal']);
Route::get('orderDetail_orderManager/{id}', [OrderManagerController::class, 'manage_orderManager']);
Route::post('addItemOrder', [OrderManagerController::class, 'addItemOrder'])->name('add.items');
Route::post('editItemOrder/{id}', [OrderManagerController::class, 'addItemOrder']);
Route::get('delete_orderManager/{id}', [OrderManagerController::class, 'delete_orderManager']);
Route::get('remove_items/{item_id}/{item_detail_id}', [OrderManagerController::class, 'remove_items']);
Route::get('checkoutManager/{id}', [OrderManagerController::class, 'checkoutManager']);
Route::get('processManager/{id}', [OrderManagerController::class, 'processManager']);

Route::get('/getCustomerOrderInfo/{id}', [OrderManagerController::class, 'getCustomerOrderInfo']);
Route::get('/getServiceItem/{id}', [OrderManagerController::class, 'getServiceItem']);
Route::get('/getVendorByID/{id}', [OrderManagerController::class, 'getVendorByID']);
Route::get('/getItemPriceByID/{id}', [OrderManagerController::class, 'getItemPriceByID']);
Route::post('/updateCheckoutQty/{id}', [OrderManagerController::class, 'updateCheckoutQty']);
Route::get('/getTotalPrice/{id}', [OrderManagerController::class, 'getTotalPrice']);
Route::post('/addCheckoutDetail', [OrderManagerController::class, 'addCheckoutDetail']);
Route::get('/collectionManager', [OrderManagerController::class, 'collectionManager'])->name('collectionManager');
Route::get('/paymentInfo', [OrderManagerController::class, 'paymentInfo'])->name('collectionManager');
Route::get('/customerInfo/{id}', [OrderManagerController::class, 'customerInfo']);

Route::post('/itemInProcess', [OrderManagerController::class, 'itemInProcess']);
Route::post('/itemComplete', [OrderManagerController::class, 'itemComplete']);

/**
 * User Manager CRUD
 */

Route::get('userManagerList', [UserController::class, 'index']);
Route::get('userProcess/{id}', [UserController::class, 'userProcess']);
