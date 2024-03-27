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

/*Start Fronend Routes*/

Route::get('/', 'IndexController@index');

Route::get('/clear', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('optimize:clear');
    $exitCode = Artisan::call('route:clear');
    return '<center>Cache clear</center>';
});


Route::group(['prefix' => 'property'], function () {
	Route::any('/', 'PropertyController@index');
	Route::any('/filter-property', 'PropertyController@filter_property');
	Route::any('/propty-search', 'PropertyController@propty_search');
	Route::get('/detail/{id}', 'PropertyController@getDetails');
	Route::any('/propty-neighbour', 'PropertyController@propty_neighbour');
	Route::any('/paysuccess', 'PropertyController@paysuccess');
	Route::any('/savebeforepayment', 'PropertyController@saveBeforePayment');
	//Route::any('/razor-thank-you','PropertyController@RazorThankYou');
	Route::any('/enquiry-thank-you', 'PropertyController@enquiryThankYou');
	Route::any('/contact-thank-you', 'PropertyController@contactThankYou');
	Route::post('/enquiryformdata', 'PropertyController@enquiryFormData');
	Route::post('/contact', 'PropertyController@contact');
	Route::post('/review', 'PropertyController@review');
	Route::post('/sub-email', 'PropertyController@sub_email');
	Route::post('/info', 'PropertyController@contactInfo');

	// Rate Calculation
	Route::any('/cal-rate', 'PropertyController@rateCalculation');

});



//Footer pages

Route::get('about-us', 'IndexController@AboutUs');
Route::get('booking-details', 'IndexController@bookingDetails');
Route::get('enquiry', 'IndexController@enquiry');
Route::get('contact-us', 'IndexController@ContactUs');
Route::get('make-an-enquiry', 'IndexController@makeAnEnquiry');
Route::get('terms-privacy', 'IndexController@TermsPrivacy');
Route::get('who-we-are', 'IndexController@WhoWeAre');
Route::get('why-work-with-us', 'IndexController@WorkWithUs');
Route::get('testimonals', 'IndexController@Testimonals');
Route::get('reviews', 'IndexController@Reviews');
Route::get('partner-with-us', 'IndexController@Partnerwithus');
Route::get('why-work-with-us', 'IndexController@WorkWithUs');
Route::get('policies', 'IndexController@getPolicies');
Route::get('faqs', 'IndexController@getFaqs');
Route::get('blog', 'IndexController@Blog');
Route::get('short-term-rentals-paris', 'IndexController@shorttermrentalsparis');
Route::get('luxury-apartments-rent-paris', 'IndexController@luxuryapartmentsrentparis');
Route::get('paris-vacation-rentals', 'IndexController@parisvacationrentals');
Route::get('luxury-apartments-dublin', 'IndexController@luxuryapartmentsdublin');
Route::get('vacation-rentals-dublin', 'IndexController@vacationrentalsdublin');
Route::get('/blogs/{id}', 'IndexController@getDetails');
Route::post('/blogcomments', 'IndexController@blogComments');

Route::get('sitemap.xml', function () {
	return response()->view('sitemap')->header('Content-Type', 'xml');

});

Route::get('robots.txt', function () {
	return response()->view('robots')->header('Content-Type', 'txt');

});
Route::get('404', 'IndexController@pagenotfound');
Route::fallback(function () {
	return redirect('404');
});

/*End Fronted Routes */


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*Route::get('/clear-cache', function() {

	 Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";
	print_r($exitCode);
	// return what you want
});*/





Route::group(['middleware' => ['auth', 'admin']], function () {
	Route::group(['prefix' => 'admin'], function () {
		Route::any('logout', 'admin\AdminController@logout');
		Route::any('change-password', 'admin\AdminController@changePwd');
		Route::group(['prefix' => 'destination'], function () {
			Route::get("country", 'admin\DestinationController@index');
			Route::get("state", 'admin\DestinationController@stateData');
			Route::get("city", 'admin\DestinationController@cityData');
			Route::get("area", 'admin\DestinationController@areaData');
			Route::get("status-update/{id}", 'admin\DestinationController@updateCityStatus');

			Route::get("importcsv", 'admin\DestinationController@showCSV');

			Route::post("saveCountry", "admin\DestinationController@save");
			Route::any("edit-country", "admin\DestinationController@edit");
			Route::any("delete-country", "admin\DestinationController@delete");

			Route::post("saveState", "admin\DestinationController@saveState");
			Route::any("edit-state", "admin\DestinationController@editState");
			Route::any("delete-state", "admin\DestinationController@deleteState");

			Route::post("saveCity", "admin\DestinationController@saveCity");
			Route::any("edit-city", "admin\DestinationController@editCity");
			Route::any("delete-city", "admin\DestinationController@deleteCity");

			Route::post("saveArea", "admin\DestinationController@saveArea");
			Route::any("edit-area", "admin\DestinationController@editArea");
			Route::any("delete-area", "admin\DestinationController@deleteArea");

		});

		Route::group(['prefix' => 'property'], function () {
			Route::get("add", "admin\PropertyController@create");
			Route::get("inactive", "admin\PropertyController@inactive");
			Route::post("save", "admin\PropertyController@save");
			Route::get("importCSVData", "admin\PropertyController@importCSVData");

			Route::post("savemultiple", "admin\PropertyController@savemultiple");
			Route::any("edit/{id}", "admin\PropertyController@edit");
			Route::any("delete", "admin\PropertyController@delete");
			Route::any("/", "admin\PropertyController@index");
			Route::any("delete-image", "admin\PropertyController@delete_Image");
			Route::any("reorder-image", "admin\PropertyController@reorder_Image");
			Route::any("update-caption", "admin\PropertyController@update_Caption");
			Route::any("delete-rates", "admin\PropertyController@delete_Rates");
			Route::any("delete-special", "admin\PropertyController@delete_Special");
			Route::any("edit-rates", "admin\PropertyController@edit_rates");
			Route::any("edit-special", "admin\PropertyController@edit_special");
			Route::any("update-rates", "admin\PropertyController@update_rates");
			Route::any("update-offer", "admin\PropertyController@update_offer");
			Route::any("prop-search", "admin\PropertyController@prop_search");
			Route::any("active", "admin\PropertyController@active");
			Route::any("prop-dates", "admin\PropertyController@dates");
			Route::any("next-dates", "admin\PropertyController@next_dates");
			Route::any("selected-dates", "admin\PropertyController@selected_dates");
			Route::any("delete-db-cal", "admin\PropertyController@delete_cal");
			Route::any("edit-db-cal", "admin\PropertyController@edit_cal");
			Route::any("update-cal", "admin\PropertyController@update_cal");

			Route::any("booked-property", 'admin\PropertyController@booked_property');
			Route::any("delete-booked-property", 'admin\PropertyController@delete_booked_property');

			Route::get("property-type", "admin\PropertyTypeController@index");
			Route::any("save-type", "admin\PropertyTypeController@savePType");
			Route::any("edit-type", "admin\PropertyTypeController@editPType");
			Route::any("delete-type", "admin\PropertyTypeController@deletePType");
		});
		Route::group(['prefix' => 'otherfeature'], function () {
			Route::get("other-feature", "admin\OtherFeatureController@index");
			Route::any("save", "admin\OtherFeatureController@save");
			Route::any("edit", "admin\OtherFeatureController@edit");
			Route::any("delete", "admin\OtherFeatureController@delete");
		});
		Route::group(['prefix' => 'testimonals'], function () {
			Route::get("/", "admin\TestimonialController@index");
			Route::any("save", "admin\TestimonialController@save");
			Route::any("edit", "admin\TestimonialController@edit");
			Route::any("delete", "admin\TestimonialController@delete");
		});



		Route::group(['prefix' => 'blog'], function () {
			Route::get("/", "admin\BlogController@index");
			Route::any("save", "admin\BlogController@save");
			Route::any("edit", "admin\BlogController@edit");
			Route::any("delete", "admin\BlogController@delete");
		});


		Route::group(['prefix' => 'blogcomment'], function () {
			Route::get("/", "admin\BlogController@blogComments");
			Route::any("active", "admin\BlogController@active");
		});



		Route::group(['prefix' => 'amenity'], function () {
			Route::get("/", "admin\AmenitiesController@index");
			Route::any("save", "admin\AmenitiesController@save");
			Route::any("edit", "admin\AmenitiesController@edit");
			Route::any("delete", "admin\AmenitiesController@delete");
			Route::get("{id}", "admin\AmenitiesController@getSubAmenity");
			Route::any("save-sub", "admin\AmenitiesController@save_sub");
			Route::any("edit-sub", "admin\AmenitiesController@edit_sub");
			Route::any("delete-sub", "admin\AmenitiesController@delete_sub");
		});
		Route::group(['prefix' => 'coupan'], function () {
			Route::get("/", "admin\CoupanController@index");
		});

		Route::group(['prefix' => 'common'], function () {
			Route::any("/", "admin\UpdateController@index");
		});

		Route::group(['prefix' => 'booking'], function () {
			Route::any("/", "admin\PaymentController@index");
		});
		Route::group(['prefix' => 'payments'], function () {
			Route::get("/", "admin\PaymentController@payments");
		});
		Route::group(['prefix' => 'journey'], function () {
			Route::any("/", "admin\JourneyController@index");
			Route::any("save", "admin\JourneyController@save");
			Route::any("list", "admin\JourneyController@list");
			Route::any("delete", "admin\JourneyController@delete");
			Route::any("edit/{id}", "admin\JourneyController@edit");
		});
		Route::group(['prefix' => 'customer'], function () {
			Route::any("/sub_email", "admin\PaymentController@sub_email");
			Route::any("/reviews", "admin\PaymentController@reviews");
			Route::any("/updatestatus", "admin\PaymentController@updatestatus");
			Route::any("/contact", "admin\PaymentController@contact");
			Route::any("/enquiries", "admin\PaymentController@inquiries");
			Route::any("/contact", "admin\PaymentController@contact");
			Route::any("/delete-review", "admin\PaymentController@delete_review");
			Route::any("/delete-email", "admin\PaymentController@delete_email");
			Route::any("/delete-enquiry", "admin\PaymentController@delete_enquiry");
			Route::any("/delete-contact", "admin\PaymentController@delete_contact");
			Route::any("/delete-booking", "admin\PaymentController@delete_booking");
		});

	});





	Route::get("/dashboard/addamenities", "admin\AmenitiesController@create")->name("addamenities");

	Route::get("/dashboard/amenitieslist", "admin\AmenitiesController@index")->name("amenitieslist");
	Route::get("/dashboard/amenitiesdata", "admin\AmenitiesController@aminitydata")->name("amenitiesdata");
	Route::get("/dashboard/editamenities/{id}", "admin\AmenitiesController@edit")->name("editamenities");
	Route::post("/dashboard/saveamenities", "admin\AmenitiesController@save")->name("saveamenities");
	Route::post("/dashboard/deleteamenities", "admin\AmenitiesController@delete")->name("deleteamenities");


	Route::get("/dashboard", "admin\DashboardController@index")->name("dashboard");
	Route::get("/dashboard/skills", "admin\SkillController@index")->name("skills");
	Route::get("/dashboard/add_user", "admin\UserController@create")->name("adduser");
	Route::get("/dashboard/user_list", "admin\UserController@index")->name("listuser");
	Route::get("/dashboard/user_data", "admin\UserController@userData")->name("userdata");
	//Route::get("/dashboard/edit_data/{id}", "admin\UserController@edit")->name("editdata");
	Route::post("/dashboard/save_user", "admin\UserController@save")->name("saveuser");
	Route::post("/dashboard/delete_user", "admin\UserController@delete")->name("deleteuser");

	Route::get("/dashboard/add_client", "admin\ClientController@create")->name("addclient");
	Route::get("/dashboard/client_list", "admin\ClientController@index")->name("listclient");

	Route::get("/dashboard/query_list", "admin\QueryController@index")->name("listquery");
	Route::post("/dashboard/save_user", "admin\UserController@save")->name("saveuser");
	Route::get("/dashboard/query_data", "admin\QueryController@queryData")->name("querydata");

});

Route::get("/admin/popup", "admin\PopupController@index");
Route::any("admin/popup/edit-popup", "admin\PopupController@edit");
Route::any("admin/popup/save", "admin\PopupController@save");


Route::get('/{cityUrl}/{room}/{area}/{proUrl}', 'PropertyController@getPropertyDetailsByUrl');

Route::get('demourl/{proUrl}', 'PropertyController@demoUrl');

Route::get('/{url}', 'PropertyController@indexpropert');

##Route::get('/properties','PropertyController@indexpropert');