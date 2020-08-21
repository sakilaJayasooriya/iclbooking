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

//cron job
Route::get('cron', 'CronController@index');
Route::get('import', 'CronController@importDump');
Route::get('cron/ical-synchronization','CronController@iCalendarSynchronization');

//user can view it anytime with or without logged in
Route::group(['middleware' => ['locale']], function () {
	Route::get('/', 'HomeController@index');
	Route::post('search/result', 'SearchController@searchResult');
	Route::get('search', 'SearchController@index');
	Route::match(array('GET', 'POST'),'properties/{id}', 'PropertyController@single');
	Route::match(array('GET', 'POST'),'property/get-price', 'PropertyController@getPrice');
	Route::get('signup', 'LoginController@signup');
	Route::post('/checkUser/check', 'LoginController@check')->name('checkUser.check');
});
//Auth::routes();

Route::post('set_session', 'HomeController@setSession');

//only can view if admin is logged in
Route::group(['prefix' => 'admin', 'middleware' => ['guest:admin']], function(){
	Route::get('/', function(){
        return Redirect::to('admin/dashboard');
    });
    Route::match(array('GET', 'POST'), 'profile', 'Admin\AdminController@profile');
    Route::get('logout', 'Admin\AdminController@logout');
	Route::get('dashboard', 'Admin\DashboardController@index');
	Route::get('customers', 'Admin\CustomerController@index')->middleware(['permission:customers']);
	Route::get('customers/customer_search', 'Admin\CustomerController@searchCustomer')->middleware(['permission:customers']);

    Route::post('add-ajax-customer', 'Admin\CustomerController@ajaxCustomerAdd')->middleware(['permission:add_customer']);
	Route::match(array('GET', 'POST'), 'add-customer', 'Admin\CustomerController@add')->middleware(['permission:add_customer']);

	Route::group(['middleware' => 'permission:edit_customer'], function () {
		Route::match(array('GET', 'POST'), 'edit-customer/{id}', 'Admin\CustomerController@update');
		Route::get('customer/properties/{id}', 'Admin\CustomerController@customerProperties');
		Route::get('customer/bookings/{id}', 'Admin\CustomerController@customerBookings');
		Route::post('customer/bookings/property_search', 'Admin\BookingsController@searchProperty');
		Route::get('customer/payouts/{id}', 'Admin\CustomerController@customerPayouts');
		Route::get('customer/payment-methods/{id}', 'Admin\CustomerController@paymentMethods');

		Route::get('customer/properties/{id}/property_list_csv', 'Admin\PropertiesController@propertyCsv');
		Route::get('customer/properties/{id}/property_list_pdf', 'Admin\PropertiesController@propertyPdf');

		Route::get('customer/bookings/{id}/booking_list_csv', 'Admin\BookingsController@bookingCsv');
		Route::get('customer/bookings/{id}/booking_list_pdf', 'Admin\BookingsController@bookingPdf');

		Route::get('customer/payouts/{id}/payouts_list_pdf', 'Admin\PayoutsController@payoutsPdf');
		Route::get('customer/payouts/{id}/payouts_list_csv', 'Admin\PayoutsController@payoutsCsv');

		Route::get('customer/customer_list_csv', 'Admin\CustomerController@customerCsv');
		Route::get('customer/customer_list_pdf', 'Admin\CustomerController@customerPdf');
	});
		Route::group(['middleware' => 'permission:manage_messages'], function () {
	    Route::get('messages', 'Admin\AdminController@customerMessage');
		Route::match(array('GET', 'POST'), 'delete-message/{id}', 'Admin\AdminController@deleteMessage');
		Route::match(array('GET','POST'), 'send-message-email/{id}', 'Admin\AdminController@sendEmail');
		Route::match(['get', 'post'],'upload_image','Admin\AdminController@uploadImage')->name('upload');
		Route::get('messaging/host/{id}', 'Admin\AdminController@hostMessage');
        Route::post('reply/{id}', 'Admin\AdminController@reply');
     });

	

	Route::get('properties', 'Admin\PropertiesController@index')->middleware(['permission:properties']);
	
	Route::match(array('GET', 'POST'), 'add-properties', 'Admin\PropertiesController@add')->middleware(['permission:add_properties']);
	Route::get('properties/property_list_csv', 'Admin\PropertiesController@propertyCsv');
	Route::get('properties/property_list_pdf', 'Admin\PropertiesController@propertyPdf');
	Route::get('properties/featured_ajax/{id}', 'Admin\PropertiesController@makeFeatured')->middleware(['permission:properties']);

	Route::group(['middleware' => 'permission:edit_properties'], function () {
	    Route::match(array('GET', 'POST'),'listing/{id}/photo_message', 'Admin\PropertiesController@photoMessage');

	    Route::match(array('GET', 'POST'),'listing/{id}/photo_delete', 'Admin\PropertiesController@photoDelete');

	    Route::match(array('GET', 'POST'),'listing/{id}/update_status', 'Admin\PropertiesController@update_status');

		Route::match(array('POST'),'listing/photo/make_default_photo', 'Admin\PropertiesController@makeDefaultPhoto');

		Route::match(array('POST'),'listing/photo/make_photo_serial', 'Admin\PropertiesController@makePhotoSerial');

	    Route::match(array('GET', 'POST'),'listing/{id}/{step}', 'Admin\PropertiesController@listing')->where(['id' => '[0-9]+','page' => 'basics|description|location|amenities|photos|pricing|calendar|details|booking']);
	});

    Route::post('ajax-calender/{id}', 'Admin\CalendarController@calenderJson');
    Route::post('ajax-calender-price/{id}', 'Admin\CalendarController@calenderPriceSet');
    //iCalender routes for admin
    Route::post('ajax-icalender-import/{id}', 'Admin\CalendarController@icalendarImport');
    Route::get('icalendar/synchronization/{id}', 'Admin\CalendarController@icalendarSynchronization');
    //iCalender routes end

	Route::match(array('GET', 'POST'), 'edit_property/{id}', 'Admin\PropertiesController@update')->middleware(['permission:edit_properties']);
	Route::get('delete-property/{id}', 'Admin\PropertiesController@delete')->middleware(['permission:delete_property']);

	Route::get('bookings', 'Admin\BookingsController@index')->middleware(['permission:manage_bookings']);
	Route::get('bookings/property_search', 'Admin\BookingsController@searchProperty')->middleware(['permission:manage_bookings']);
	Route::get('bookings/customer_search', 'Admin\BookingsController@searchCustomer')->middleware(['permission:manage_bookings']);
	//booking details
	Route::get('bookings/detail/{id}', 'Admin\BookingsController@details')->middleware(['permission:manage_bookings']);
	Route::post('bookings/pay', 'Admin\BookingsController@pay')->middleware(['permission:manage_bookings']);
	Route::get('booking/need_pay_account/{id}/{type}', 'Admin\BookingsController@needPayAccount');
	Route::get('booking/booking_list_csv', 'Admin\BookingsController@bookingCsv');
	Route::get('booking/booking_list_pdf', 'Admin\BookingsController@bookingPdf');

	Route::get('payouts', 'Admin\PayoutsController@index')->middleware(['permission:view_payouts']);
	Route::get('payouts/payouts_list_pdf', 'Admin\PayoutsController@payoutsPdf');
	Route::get('payouts/payouts_list_csv', 'Admin\PayoutsController@payoutsCsv');

	Route::group(['middleware' => 'permission:manage_reviews'], function () {
		Route::get('reviews', 'Admin\ReviewsController@index');
		Route::match(array('GET', 'POST'), 'edit_review/{id}', 'Admin\ReviewsController@edit');
		Route::get('reviews/review_search', 'Admin\ReviewsController@searchReview');
		Route::get('reviews/review_list_csv', 'Admin\ReviewsController@reviewCsv');
		Route::get('reviews/review_list_pdf', 'Admin\ReviewsController@reviewPdf');

	});

	// Route::get('reports', 'Admin\ReportsController@index')->middleware(['permission:manage_reports']);
	// For Reporting
	Route::group(['middleware' => 'permission:view_reports'], function () {
		Route::get('sales-report', 'Admin\ReportsController@salesReports');
		Route::get('sales-analysis', 'Admin\ReportsController@salesAnalysis');
		Route::get('reports/property-search', 'Admin\ReportsController@searchProperty');
		Route::get('overview-stats', 'Admin\ReportsController@overviewStats');
	});

	Route::group(['middleware' => 'permission:manage_amenities'], function () {
		Route::get('amenities', 'Admin\AmenitiesController@index');
		Route::match(array('GET', 'POST'), 'add-amenities', 'Admin\AmenitiesController@add');
		Route::match(array('GET', 'POST'), 'edit-amenities/{id}', 'Admin\AmenitiesController@update');
		Route::get('delete-amenities/{id}', 'Admin\AmenitiesController@delete');
	});

	Route::group(['middleware' => 'permission:manage_pages'], function () {
		Route::get('pages', 'Admin\PagesController@index');
		Route::match(array('GET', 'POST'), 'add-page', 'Admin\PagesController@add');
		Route::match(array('GET', 'POST'), 'edit-page/{id}', 'Admin\PagesController@update');
		Route::get('delete-page/{id}', 'Admin\PagesController@delete');
	});

	
	Route::group(['middleware' => 'permission:manage_admin'], function () {
		Route::get('admin-users', 'Admin\AdminController@index');
		Route::match(array('GET', 'POST'), 'add-admin', 'Admin\AdminController@add');
		Route::match(array('GET', 'POST'), 'edit-admin/{id}', 'Admin\AdminController@update');
		Route::match(array('GET', 'POST'), 'delete-admin/{id}', 'Admin\AdminController@delete');
	});


	// Route::group(['middleware' => 'permission:manage_withdraw'], function () {
	// 	Route::get('withdrawals', 'Admin\WithdrawalsController@index');
	// 	Route::get('withdrawals/approve/{id}', 'Admin\WithdrawalsController@approve_payments');
	// });

	Route::group(['middleware' => 'permission:general_setting'], function () {

		Route::match(array('GET', 'POST'), 'settings', 'Admin\SettingsController@general')->middleware(['permission:general_setting']);
		Route::match(array('GET', 'POST'), 'settings/preferences', 'Admin\SettingsController@preferences')->middleware(['permission:preference']);

		Route::post('settings/delete_logo', 'Admin\SettingsController@deleteLogo');
		Route::post('settings/delete_favicon', 'Admin\SettingsController@deleteFavIcon');
		Route::match(array('GET', 'POST'), 'settings/fees', 'Admin\SettingsController@fees')->middleware(['permission:manage_fees']);

		Route::group(['middleware' => 'permission:manage_banners'], function () {
			Route::get('settings/banners', 'Admin\BannersController@index');
			Route::match(array('GET', 'POST'), 'settings/add-banners', 'Admin\BannersController@add');
		    Route::match(array('GET', 'POST'), 'settings/edit-banners/{id}', 'Admin\BannersController@update');
			Route::get('settings/delete-banners/{id}', 'Admin\BannersController@delete');
		});

		Route::group(['middleware' => 'permission:starting_cities_settings'], function () {
			Route::get('settings/starting-cities', 'Admin\StartingCitiesController@index');
			Route::match(array('GET', 'POST'), 'settings/add-starting-cities', 'Admin\StartingCitiesController@add');
		    Route::match(array('GET', 'POST'), 'settings/edit-starting-cities/{id}', 'Admin\StartingCitiesController@update');
			Route::get('settings/delete-starting-cities/{id}', 'Admin\StartingCitiesController@delete');
		});
		//added newly controler and model called top destination
		Route::group(['middleware' => 'permission:starting_cities_settings'], function () {
			Route::get('settings/top-destinations', 'Admin\TopDestinationController@index');
			Route::match(array('GET', 'POST'), 'settings/add-top-destinations', 'Admin\TopDestinationController@add');
		    Route::match(array('GET', 'POST'), 'settings/edit-top-destinations/{id}', 'Admin\TopDestinationController@update');
			Route::get('settings/delete-top-destinations/{id}', 'Admin\TopDestinationController@delete');
		});
		//added newly controler and model called ListingMsg for admin
		Route::group(['middleware' => 'permission:starting_cities_settings'], function () {
			Route::get('listing-message', 'Admin\ListingMsgController@index');
			Route::get('listing-message/{id}', 'Admin\ListingMsgController@delete');
		});

		Route::group(['middleware' => 'permission:manage_property_type'], function () {
			Route::get('settings/property-type', 'Admin\PropertyTypeController@index');
			Route::match(array('GET', 'POST'), 'settings/add-property-type', 'Admin\PropertyTypeController@add');
		    Route::match(array('GET', 'POST'), 'settings/edit-property-type/{id}', 'Admin\PropertyTypeController@update');
			Route::get('settings/delete-property-type/{id}', 'Admin\PropertyTypeController@delete');
		});

		Route::group(['middleware' => 'permission:space_type_setting'], function () {
			Route::get('settings/space-type', 'Admin\SpaceTypeController@index');
			Route::match(array('GET', 'POST'), 'settings/add-space-type', 'Admin\SpaceTypeController@add');
		    Route::match(array('GET', 'POST'), 'settings/edit-space-type/{id}', 'Admin\SpaceTypeController@update');
			Route::get('settings/delete-space-type/{id}', 'Admin\SpaceTypeController@delete');
		});

		Route::group(['middleware' => 'permission:manage_bed_type'], function () {
			Route::get('settings/bed-type', 'Admin\BedTypeController@index');
			Route::match(array('GET', 'POST'), 'settings/add-bed-type', 'Admin\BedTypeController@add');
		    Route::match(array('GET', 'POST'), 'settings/edit-bed-type/{id}', 'Admin\BedTypeController@update');
			Route::get('settings/delete-bed-type/{id}', 'Admin\BedTypeController@delete');
		});

		Route::group(['middleware' => 'permission:manage_currency'], function () {
			Route::get('settings/currency', 'Admin\CurrencyController@index');
			Route::match(array('GET', 'POST'), 'settings/add-currency', 'Admin\CurrencyController@add');
		    Route::match(array('GET', 'POST'), 'settings/edit-currency/{id}', 'Admin\CurrencyController@update');
			Route::get('settings/delete-currency/{id}', 'Admin\CurrencyController@delete');
		});

		Route::group(['middleware' => 'permission:manage_country'], function () {
			Route::get('settings/country', 'Admin\CountryController@index');
			Route::match(array('GET', 'POST'), 'settings/add-country', 'Admin\CountryController@add');
		    Route::match(array('GET', 'POST'), 'settings/edit-country/{id}', 'Admin\CountryController@update');
			Route::get('settings/delete-country/{id}', 'Admin\CountryController@delete');
		});

		Route::group(['middleware' => 'permission:manage_amenities_type'], function () {
			Route::get('settings/amenities-type', 'Admin\AmenitiesTypeController@index');
			Route::match(array('GET', 'POST'), 'settings/add-amenities-type', 'Admin\AmenitiesTypeController@add');
		    Route::match(array('GET', 'POST'), 'settings/edit-amenities-type/{id}', 'Admin\AmenitiesTypeController@update');
			Route::get('settings/delete-amenities-type/{id}', 'Admin\AmenitiesTypeController@delete');
		});

		Route::match(array('GET', 'POST'), 'settings/email', 'Admin\SettingsController@email')->middleware(['permission:email_settings']);



		Route::group(['middleware' => 'permission:manage_language'], function () {
			Route::get('settings/language', 'Admin\LanguageController@index');
			Route::match(array('GET', 'POST'), 'settings/add-language', 'Admin\LanguageController@add');
		    Route::match(array('GET', 'POST'), 'settings/edit-language/{id}', 'Admin\LanguageController@update');
			Route::get('settings/delete-language/{id}', 'Admin\LanguageController@delete');
		});

		Route::match(array('GET', 'POST'), 'settings/fees', 'Admin\SettingsController@fees')->middleware(['permission:manage_fees']);

		Route::group(['middleware' => 'permission:manage_metas'], function () {
			Route::get('settings/metas', 'Admin\MetasController@index');
			Route::match(array('GET', 'POST'), 'settings/edit_meta/{id}', 'Admin\MetasController@update');
		});

		Route::match(array('GET', 'POST'), 'settings/api-informations', 'Admin\SettingsController@apiInformations')->middleware(['permission:api_informations']);
		Route::match(array('GET', 'POST'), 'settings/payment-methods', 'Admin\SettingsController@paymentMethods')->middleware(['permission:payment_settings']);
		Route::match(array('GET', 'POST'), 'settings/social-links', 'Admin\SettingsController@socialLinks')->middleware(['permission:social_links']);

		Route::group(['middleware' => 'permission:manage_roles'], function () {
			Route::get('settings/roles', 'Admin\RolesController@index');
			Route::match(array('GET', 'POST'), 'settings/add-role', 'Admin\RolesController@add');
		    Route::match(array('GET', 'POST'), 'settings/edit-role/{id}', 'Admin\RolesController@update');
			Route::get('settings/delete-role/{id}', 'Admin\RolesController@delete');
		});

		Route::group(['middleware' => 'permission:database_backup'], function () {
		    Route::get('settings/backup', 'Admin\BackupController@index');
		    Route::get('backup/save', 'Admin\BackupController@add');
		    Route::get('backup/download/{id}', 'Admin\BackupController@download');
	    });


	    Route::group(['middleware' => 'permission:manage_email_template'], function () {
		Route::get('email-template/{id}', 'Admin\EmailTemplateController@index');
		Route::post('email-template/{id}','Admin\EmailTemplateController@update');

		});
	});

});

//only can view if admin is not logged in if they are logged in then they will be redirect to dashboard
Route::group(['prefix' => 'admin', 'middleware' => 'no_auth:admin'], function () {
    Route::get('login', 'Admin\AdminController@login');
});


//only can view if user is not logged in if they are logged in then they will be redirect to dashboard
Route::group(['middleware' => ['no_auth:users', 'locale']], function () {
    Route::get('login', 'LoginController@index');
    Route::get('auth/login', function()
    {
    	return Redirect::to('login');
    });

    Route::get('googleLogin', 'LoginController@googleLogin');
    Route::get('facebookLogin', 'LoginController@facebookLogin');
   
    
    Route::get('register', 'HomeController@register');

    Route::match(array('GET', 'POST'), 'forgot_password', 'LoginController@forgotPassword');

    Route::post('create', 'UserController@create');

    Route::post('authenticate', 'LoginController@authenticate');

    Route::get('users/reset_password/{secret?}', 'LoginController@resetPassword');

    Route::post('users/reset_password', 'LoginController@resetPassword');
});

  Route::get('googleAuthenticate', 'LoginController@googleAuthenticate');
  Route::get('facebookAuthenticate', 'LoginController@facebookAuthenticate');

//only can view if user is logged in
Route::group(['middleware' => ['guest:users', 'locale']], function () {
	
    Route::get('dashboard', 'UserController@dashboard');
    Route::match(array('GET', 'POST'),'users/profile', 'UserController@profile');
    Route::match(array('GET', 'POST'),'users/profile/media', 'UserController@media');
    
    // User verification
    Route::get('users/edit-verification', 'UserController@verification');
    Route::get('users/confirm_email/{code?}', 'UserController@confirmEmail');
    Route::get('users/new_email_confirm', 'UserController@newConfirmEmail');

    Route::get('facebookLoginVerification', 'UserController@facebookLoginVerification');
    Route::get('facebookConnect/{id}', 'UserController@facebookConnect');
    Route::get('facebookDisconnect', 'UserController@facebookDisconnectVerification');

    Route::get('googleLoginVerification', 'UserController@googleLoginVerification');
    Route::get('googleConnect/{id}', 'UserController@googleConnect');
    Route::get('googleDisconnect', 'UserController@googleDisconnect');
    //Route::get('googleAuthenticate', 'LoginController@googleAuthenticate');

    Route::get('users/show/{id}', 'UserController@show');
    Route::match(array('GET', 'POST'),'users/reviews', 'UserController@reviews');
    Route::match(['get', 'post'], 'reviews/edit/{id}', 'UserController@editReviews');
    Route::match(['get', 'post'], 'reviews/details/{id}', 'UserController@reviewDetails');

    Route::match(array('GET', 'POST'),'properties', 'PropertyController@userProperties');
    Route::match(array('GET', 'POST'),'property/create', 'PropertyController@create');
    Route::match(array('GET', 'POST'),'listing/{id}/photo_message', 'PropertyController@photoMessage')->middleware(['checkUserRoutesPermissions']);
    Route::match(array('GET', 'POST'),'listing/{id}/photo_delete', 'PropertyController@photoDelete')->middleware(['checkUserRoutesPermissions']);

	Route::match(array('POST'),'listing/photo/make_default_photo', 'PropertyController@makeDefaultPhoto');

	Route::match(array('POST'),'listing/photo/make_photo_serial', 'PropertyController@makePhotoSerial');

    Route::match(array('GET', 'POST'),'listing/{id}/update_status', 'PropertyController@updateStatus');
    Route::match(array('GET', 'POST'),'listing/{id}/{step}', 'PropertyController@listing')->where(['id' => '[0-9]+','page' => 'basics|description|location|amenities|photos|pricing|calendar|details|booking'])->middleware(['checkUserRoutesPermissions']);
    
    Route::post('ajax-calender/{id}', 'CalendarController@calenderJson');
    Route::post('ajax-calender-price/{id}', 'CalendarController@calenderPriceSet');
    //iCalendar routes start 
    Route::post('ajax-icalender-import/{id}', 'CalendarController@icalendarImport');
    Route::get('icalendar/synchronization/{id}', 'CalendarController@icalendarSynchronization');
    //iCalendar routes end 
    
    Route::post('currency-symbol', 'PropertyController@currencySymbol');

    Route::match(['get', 'post'], 'payments/book/{id?}', 'PaymentController@index');
    Route::post('payments/create_booking', 'PaymentController@createBooking');
    Route::get('payments/success', 'PaymentController@success');
    Route::get('payments/cancel', 'PaymentController@cancel');

    Route::get('payments/stripe', 'PaymentController@stripePayment');
    Route::post('payments/stripe-request', 'PaymentController@stripeRequest');
    
    Route::get('booking/{id}', 'BookingController@index')->where('id', '[0-9]+');
    Route::get('booking/requested', 'BookingController@requested');
    Route::get('booking/itinerary_friends', 'BookingController@requested');
    Route::post('booking/accept/{id}', 'BookingController@accept');
    Route::post('booking/decline/{id}', 'BookingController@decline');
    Route::get('booking/expire/{id}', 'BookingController@expire');

    Route::get('my-bookings', 'BookingController@myBookings');
    Route::post('booking/host_cancel', 'BookingController@hostCancel');

    Route::get('trips/active', 'TripsController@active');
    Route::get('trips/previous', 'TripsController@previous');
    Route::get('booking/receipt', 'TripsController@receipt');
    Route::post('trips/guest_cancel', 'TripsController@guestCancel');

    Route::get('inbox', 'InboxController@index');
    //Route::get('messaging/qt_with/{id}', 'InboxController@host_message'); //temporary
    Route::get('messaging/booking/{id}', 'InboxController@chatMessage');
    Route::get('messaging/host/{id}', 'InboxController@hostMessage')->middleware(['checkUserRoutesPermissions']);
    Route::get('messaging/guest/{id}', 'InboxController@guestMessage')->middleware(['checkUserRoutesPermissions']);
    Route::post('inbox/reply/{id}', 'InboxController@reply');
    Route::post('inbox/message_count', 'InboxController@messageCount');
	Route::post('inbox/message_with_type', 'InboxController@messageWithType');
	
	//user listning msg read,send fucntion
	Route::get('listing-message', 'ListingMsgController@index');
	Route::get('listing-message/{id}', 'ListingMsgController@delete');

    Route::match(['get', 'post'], 'users/account-preferences', 'UserController@accountPreferences');
    Route::get('users/account_delete/{id}', 'UserController@accountDelete');
    Route::get('users/account_default/{id}', 'UserController@accountDefault');
    
    Route::get('users/transaction-history', 'UserController@transactionHistory');
    Route::post('users/account_transaction_history', 'UserController@getCompletedTransaction');

    Route::match(['get', 'post'], 'users/security', 'UserController@security');
    Route::get('logout', function()
	{
		Auth::logout(); 
		return Redirect::to('login');
	});
});
//for exporting iCalendar
Route::get('icalender/export/{id}', 'CalendarController@icalendarExport');

Route::post('admin/authenticate', 'Admin\AdminController@authenticate');

Route::get('{name}', 'HomeController@staticPages');
Route::post('duplicate-phone-number-check', 'UserController@duplicatePhoneNumberCheck');
Route::post('duplicate-phone-number-check-for-existing-customer', 'UserController@duplicatePhoneNumberCheckForExistingCustomer');
Route::match(['GET', 'POST'], 'admin/settings/sms', 'Admin\SettingsController@smsSettings');