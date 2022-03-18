<?php

Route::get('verify-bussiness/check-mail', 'BussinessController@sendEmail');
Route::middleware('isNewCustomer')->group(function() {
    Route::resources([
        'devices'          =>  'DeviceController',
        'plans'            =>  'PlanController',
        'confirmation'     =>  'ConfirmationController',
        'verify-bussiness' =>  'BussinessController'
    ]);
    Route::get('rvs', 'PlanController@rvs');
});

Route::get('sample-image', 'SampleImageController@index')->name('test.image');

Route::post('sample-image', 'SampleImageController@fileUpload')->name('test.image');

Route::get('test-invoice', 'SampleInvoiceController@getInvoice')->name('test.invoice');

// Clear all sessions
Route::get('clear', 'StaticPageController@clearSession');

// Resend email
Route::get('resend/email', 'OrderHashController@resendEmail')->name('resend.email');

// Edit Cart
Route::post('edit/cart', 'OrderHashController@editCart')->name('edit.cart');


Route::post('device/insert', 'OrderHashController@insertDevice')->name('insert.device');

// Checkout routes
Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('checkout/insert', 'CheckoutController@store')->name('checkout.store');
Route::post('create/customer', 'CheckoutController@createCustomer')->name('create.customer');
Route::post('checkout/downgrade', 'CustomerPlanController@downgrade')->name('downgrade.plan');
Route::post('checkout/save-billing-details', 'CheckoutController@saveTaxDetails')->name('billing-info.save');
Route::get('checkout/caclulate-tax', 'CheckoutController@calculateTax')->name('calculate.tax');
Route::post('checkout/sign-on', 'SignOnController@signOnWithoutRedirect')->name('signOn.no-redirect');

// Fetch Sims
Route::get('{deviceId}/sims/{planId}', 'OrderHashController@getPlanSims')->name('get.sims');
// Fetch Plans
Route::get('{id}/plans', 'OrderHashController@getPlans')->name('get.plans');

// Destroy Cart
Route::delete('remove/{id}', 'CartController@removeItem')->name('cart.destroy');

// Edit Cart
Route::get('edit/{id}', 'CartController@editItem')->name('cart.edit');

// Delete File (Currently not in use because ajax upload is not implemented)
// Route::post('file/remove', 'BusinessDocsController@removeFile')->name('file.remove');


// Static Contents
Route::middleware('isNewCustomer')->group(function() {
    Route::get('/', 'StaticPageController@home')->middleware('isNewCustomer');
    Route::get('/{slug}', 'StaticPageController@index')->where('slug', '|features|why-all-choice-connect');
    Route::get('support', 'SupportController@index')->name('support.index');
    Route::post('support-email', 'SupportController@sendEmail')->name('support.email');
    Route::get('sign-out', 'SignOnController@signOut')->name('sign-out');
    Route::post('/check-email', 'CustomerController@email')->name('update.email');
    Route::post('/check-password', 'CustomerController@password')->name('update.password');
});
Route::get('mobile-features', 'StaticPageController@mobile_features'); /* karamvir code add at 30-11-2020*/
Route::get('product_details', 'StaticPageController@product_details'); /* karamvir code add at 30-11-2020*/
Route::get('feature', 'StaticPageController@feature'); /* karamvir code a dd at 30-11-2020*/
Route::middleware('login')->group(function () {

	Route::post('update-customer', 'CustomerController@update')->name('updateCustomer');

	Route::post('update-Port', 'CustomerPlanController@updatePort')->name('update.port');


	Route::post('add-card', 'CustomerCardController@store')->name('addCard');

	Route::post('remove-card', 'CustomerCardController@remove')->name('delete.card');

	Route::post('primary-card', 'CustomerCardController@primaryCard')->name('primary.card');

	Route::get('customer-plans', 'CustomerPlanController@get')->name('plans.details');

	Route::get('compatible-plans/{id}', 'CustomerPlanController@compatiblePlans')->name('compatible.plans');

	Route::post('compatible-addons', 'CustomerPlanController@compatibleAddons')->name('compatible.addons');

    Route::post('update-sub-label', 'CustomerPlanController@updateSubLabel')->name('update.label');

    Route::any('/ckeck-number', 'CustomerPlanController@checkNumber')->name('check.number');

    Route::post('/download-usages', 'CustomerPlanController@downloadUsages')->name('download.usages');

    Route::post('/data-usages', 'CustomerPlanController@getUsagesData')->name('usages.data');

	Route::get('account', 'CustomerController@index')->name('account');

	Route::get('history', 'HistoryController@get')->name('history');

    Route::post('/make-payment', 'CustomerController@makePayment')->name('make.payment');

    Route::post('change-plan', 'CustomerPlanController@changePlan')->name('change.plan');

    Route::post('change-sim', 'CustomerPlanController@changeSim')->name('change.sim');

    Route::post('prorated-days', 'CustomerController@proratedRemainingDays')->name('prorated.days');

    Route::post('coupon/check', 'CouponController@get')->name('coupon.store');

    Route::post('coupon/remove', 'CouponController@remove')->name('coupon.remove');

    Route::post('update-requested-zip', 'CustomerPlanController@updateRequestedZip')->name('update.requested-zip');

});

Route::get('edit-sim', 'CartController@editSim')->name('edit.sim');

Route::get('terms', 'ServiceTermsController@index');

Route::get('clear-order', 'CartController@clearOrder')->name('clear.order');

Route::middleware('user')->group(function () {

	// Forgot Password
	 Route::get('forgot-password',  function () {
	    return view('customer.forgot-password');
	})->name('forgot-password');

	Route::post('forgot-password', 'ForgotPasswordController@password')->name('forgotPassword');

	Route::get('/reset-password', 'ForgotPasswordController@resetPassword');

	Route::post('/reset-password', 'ForgotPasswordController@update')->name('reset.password');

	//Customer Login &Logout
	Route::post('sign-on', 'SignOnController@signOn')->name('signOn');

	Route::get('sign-on',  function () {
	    return view('customer/sign-on');
	})->name('sign-on');

});

Route::get('user-login/{IdHash}', 'SignOnController@signOnWithoutPassword')->name('admin.SignOn');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('coverage', 'StaticPageController@coverage');
Route::get('compatible', 'StaticPageController@compatible');
Route::get('compatible/model_value/', 'StaticPageController@model_value');
Route::get('neworexisting', 'StaticPageController@neworexisting');

Route::get('plans_step1_choose.php', function () {
    return redirect('/plans');
});

Route::get('/', function () {
    return redirect('/plans');
});
