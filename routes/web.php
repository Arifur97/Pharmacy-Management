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

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
	Route::get('/dashboard', 'HomeController@dashboard');
});

Route::group(['middleware' => ['auth', 'active']], function() {
	Route::get('/', 'HomeController@index');
	Route::get('switch-theme/{theme}', 'HomeController@switchTheme')->name('switchTheme');
	Route::get('/dashboard-filter/{start_date}/{end_date}', 'HomeController@dashboardFilter');
	Route::get('check-batch-availability/{product_id}/{batch_no}/{warehouse_id}', 'ProductController@checkBatchAvailability');

	Route::get('language_switch/{locale}', 'LanguageController@switchLanguage');

	Route::get('role/permission/{id}', 'RoleController@permission')->name('role.permission');
	Route::post('role/set_permission', 'RoleController@setPermission')->name('role.setPermission');
	Route::resource('role', 'RoleController');

	Route::post('importwarehouse', 'WarehouseController@importWarehouse')->name('warehouse.import');
	Route::post('warehouse/deletebyselection', 'WarehouseController@deleteBySelection');
	Route::get('warehouse/lims_warehouse_search', 'WarehouseController@limsWarehouseSearch')->name('warehouse.search');
	Route::resource('warehouse', 'WarehouseController');

	Route::post('importcustomer_group', 'CustomerGroupController@importCustomerGroup')->name('customer_group.import');
	Route::post('customer_group/deletebyselection', 'CustomerGroupController@deleteBySelection');
	Route::get('customer_group/lims_customer_group_search', 'CustomerGroupController@limsCustomerGroupSearch')->name('customer_group.search');
	Route::resource('customer_group', 'CustomerGroupController');

    Route::get('shelf_location/status/{id}/chang', 'ShelfLocationController@changeStatus')->name('shelf_location.status.change');
	Route::resource('shelf_location', 'ShelfLocationController');

	Route::post('importcustomer', 'CustomerController@importCustomer')->name('customer.import');
	Route::get('customer/getDeposit/{id}', 'CustomerController@getDeposit');
	Route::post('customer/add_deposit', 'CustomerController@addDeposit')->name('customer.addDeposit');
	Route::post('customer/update_deposit', 'CustomerController@updateDeposit')->name('customer.updateDeposit');
	Route::post('customer/deleteDeposit', 'CustomerController@deleteDeposit')->name('customer.deleteDeposit');
	Route::post('customer/deletebyselection', 'CustomerController@deleteBySelection');
	Route::get('customer/lims_customer_search', 'CustomerController@limsCustomerSearch')->name('customer.search');
	Route::post('customers/clear-due', 'CustomerController@clearDue')->name('customer.clearDue');
	Route::resource('customer', 'CustomerController');


	Route::get('user/profile/{id}', 'UserController@profile')->name('user.profile');
	Route::put('user/update_profile/{id}', 'UserController@profileUpdate')->name('user.profileUpdate');
	Route::put('user/changepass/{id}', 'UserController@changePassword')->name('user.password');
	Route::get('user/genpass', 'UserController@generatePassword');
	Route::post('user/deletebyselection', 'UserController@deleteBySelection');
	Route::resource('user','UserController');

	Route::get('setting/general_setting', 'SettingController@generalSetting')->name('setting.general');
	Route::post('setting/general_setting_store', 'SettingController@generalSettingStore')->name('setting.generalStore');

	Route::get('setting/reward-point-setting', 'SettingController@rewardPointSetting')->name('setting.rewardPoint');
	Route::post('setting/reward-point-setting_store', 'SettingController@rewardPointSettingStore')->name('setting.rewardPointStore');

	Route::get('backup', 'SettingController@backup')->name('setting.backup');
	Route::get('setting/general_setting/change-theme/{theme}', 'SettingController@changeTheme');
	Route::get('setting/mail_setting', 'SettingController@mailSetting')->name('setting.mail');
	Route::get('setting/sms_setting', 'SettingController@smsSetting')->name('setting.sms');
	Route::get('setting/createsms', 'SettingController@createSms')->name('setting.createSms');
	Route::post('setting/sendsms', 'SettingController@sendSms')->name('setting.sendSms');
	Route::get('setting/hrm_setting', 'SettingController@hrmSetting')->name('setting.hrm');
	Route::post('setting/hrm_setting_store', 'SettingController@hrmSettingStore')->name('setting.hrmStore');
	Route::post('setting/mail_setting_store', 'SettingController@mailSettingStore')->name('setting.mailStore');
	Route::post('setting/sms_setting_store', 'SettingController@smsSettingStore')->name('setting.smsStore');
	Route::get('setting/pos_setting', 'SettingController@posSetting')->name('setting.pos');
	Route::post('setting/pos_setting_store', 'SettingController@posSettingStore')->name('setting.posStore');
	Route::get('setting/empty-database', 'SettingController@emptyDatabase')->name('setting.emptyDatabase');


});

