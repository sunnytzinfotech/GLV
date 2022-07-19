<?php

use Illuminate\Support\Facades\Route;

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

define('admin_assets', url('assets/backend'));
define('front_assets', url('assets/frontend'));
define('file_path', url('uploads'));
define('file_folder',url('uploads'));
define('img_upload_path', url('uploads'));
define('site_data', url('uploads/site_data'));
define('document', 'uploads/document');

Route::get('clearCache', function () {
    Cache::flush();
    return Redirect::to('/');
});

Auth::routes();

Route::post('reset_password_without_token', 'IndexController@validatePasswordRequest');
Route::post('reset_password_with_token', 'IndexController@resetPassword');
Route::get('/forget-password', 'IndexController@forgetPassword')->name('forget-password');


Route::get('/', 'Frontend\IndexController@index')->name("home_page");
Route::post('/do-signup', 'Frontend\IndexController@doSignup');
Route::post('/do-detail', 'Frontend\IndexController@doRegister');
Route::get('/email', 'Frontend\IndexController@emailTemplate');
Route::get('/confirm_email/{id}', 'Frontend\IndexController@verify_email');
Route::get('/deine', 'Frontend\IndexController@deineIndex')->name("deine");
Route::post('varifyemail','Frontend\IndexController@emailValidation');
Route::post('varifytotal','Frontend\IndexController@totalValidation');
Route::post('secondvarifytotal','Frontend\IndexController@secondtotalValidation');
// Route::post('/login', 'Frontend\IndexController@doLogin')->name("login");

Route::get('distribution_download/{id?}','Frontend\IndexController@downloadDistribution');

Route::post('distribution-store-file','Frontend\IndexController@distributionStore');
Route::post('confidentiality-store-file','Frontend\IndexController@confidentialityStore');
Route::post('avv-contract-store-file','Frontend\IndexController@avvContractStore');
Route::post('action-confim','Frontend\IndexController@actionConfim');


// Send Message
Route::post('send-message','Frontend\IndexController@sendMessage')->name('send-message');
// Route::get('anmelding/{phone}','Frontend\IndexController@anmelding')->name('anmelding');
Route::get('code','Frontend\IndexController@anmelding')->name('anmelding');
Route::post('api/tfa','Frontend\IndexController@checkSMS')->name('check-sms');
Route::post('send-message-add-data','Frontend\IndexController@sendMessageAddData')->name('send-message-add-data');
Route::post('add-data','Frontend\IndexController@secondAddData')->name('second-add-data');


Route::get('/open-iframe/{id}/{uid?}','Frontend\IndexController@openIframe');
// Route::get('/open-iframe/{id}','Frontend\IndexController@openIframe1');

// other pages
Route::get('soeinfach', 'Frontend\IndexController@soeinfach')->name('soeinfach');
Route::get('faq', 'Frontend\IndexController@faq')->name('faq');
Route::get('kontakt', 'Frontend\IndexController@contact')->name('contact');


Route::get('impressum', 'Frontend\IndexController@Impressum')->name('Impressum');
Route::get('datenschutz', 'Frontend\IndexController@Datenschutz')->name('Datenschutz');
Route::get('erstinformation', 'Frontend\IndexController@Erstinformation')->name('Erstinformation');

// Forgot password
Route::post('/forgot_passwords', 'Frontend\IndexController@GenerateNewPassword')->name("forgot_password");
Route::post('/resetpassword', 'Frontend\IndexController@resetPassword')->name("resetpassword");
Route::get('/forget/{id}', 'Frontend\IndexController@resetPasswordPage');


/*adminside route*/

	Route::group(array('prefix' => 'admin', 'middleware' => 'is_loggedin'), function() {
	    // Common
	    Route::post('/update_meta_info', 'admin\CommonController@update_meta_info');
	    Route::post('/uploadimage', 'admin\CommonController@uploadimage');
	    Route::post('/deleteimage', 'admin\CommonController@deleteimage');

	    //    Login
	    Route::get('/', 'admin\LoginController@getIndex');
	    Route::get('/login', 'admin\LoginController@getIndex');
	    Route::post('/login', 'admin\LoginController@doLogin');
	    Route::get('/logout', 'admin\LoginController@doLogout');

	    // Forgot password
	    Route::get('/forgot_password', 'admin\LoginController@getIndexForgotPassword');
    	Route::post('/forgot_password', 'admin\LoginController@GenerateNewPassword');

	    // Dashboard
	    Route::get('/dashboard', array('uses' => 'admin\DashboardController@getIndex'));

	    // Logo & Favicon
	    Route::get('/logo', array('uses' => 'admin\LogoController@getIndex'));
	    Route::post('/logo', array('uses' => 'admin\LogoController@updatelogo'));

	    // Site setting
	    Route::get('/site_setting', 'admin\SiteSettingController@getIndex');
	    Route::post('/site_setting', 'admin\SiteSettingController@updateSite');

	    // Profile
	    Route::get('/profile', 'admin\ProfileController@getIndex');
	    Route::post('/profile', 'admin\ProfileController@updateprofile');
	    Route::get('/change_password', 'admin\ChangePasswordController@getIndex');
	    Route::post('/change_password', 'admin\ChangePasswordController@updatepassword');


	    Route::post('/active-user', 'admin\HomeSectionController@actionConfim');
	    Route::post('/active-user-deactive', 'admin\HomeSectionController@actionConfimDeactive');
	    Route::post('/delete-user', 'admin\HomeSectionController@deleteUser');

		Route::post('/active-borker', 'admin\HomeSectionController@activeBorker');
	    Route::post('/deactive-borker', 'admin\HomeSectionController@deactiveBorker');


        Route::get('/user-detail', 'admin\HomeSectionController@userAllData');
        Route::get('/user-detail/{ids}', 'admin\HomeSectionController@userEdit');


        //Portal Controller
        Route::get('/get-portal', 'admin\PortalController@getIndex');
        Route::get('/add-portal', 'admin\PortalController@add');
        Route::post('/store-portal', 'admin\PortalController@store');
        Route::get('/edit-portal/{id}', 'admin\PortalController@edit');
        Route::post('/update-portal', 'admin\PortalController@update');
        Route::post('/delete-portal', 'admin\PortalController@delete');
        Route::get('/tippgeber-portal', 'admin\PortalController@tippgeberPortal');

		Route::post('/add-portal-category', 'admin\PortalController@addCategory');
		Route::post('/edit-portal-category', 'admin\PortalController@editCategory');
		Route::post('/delete-portal-category', 'admin\PortalController@deleteCategory');


        //Deine Controller
        Route::get('/deine', 'admin\DeineController@getIndex');
        Route::post('/pdf-save', 'admin\DeineController@store');

		//Home Page Slider Controller
        Route::get('/home-slider', 'admin\HomeSliderController@getIndex');
        Route::post('/add-slider', 'admin\HomeSliderController@addSlider');
		Route::post('/edit-slider', 'admin\HomeSliderController@editSlider');
		Route::post('/delete-slider', 'admin\HomeSliderController@delete');

		Route::post('/savesitedata', 'admin\SaveDataController@datasubmit');

        Route::get('/home_page', 'admin\pages_content\HomecontentController@index');
        Route::get('/so_einfach', 'admin\pages_content\SoeinfachcontentController@index');

		Route::get('/page-content', 'admin\pages_content\HomecontentController@pageContent');

        Route::get('/contact', 'admin\pages_content\ContactcontentController@index');

        // FAQ
        Route::get('/faq', 'admin\pages_content\FaqcontentController@index');
        Route::post('/add_faq', 'admin\pages_content\FaqcontentController@addFaq')->name('add_faq');
        Route::post('/update_faq', 'admin\pages_content\FaqcontentController@updateFaq')->name('update_faq');
        Route::post('/delete_faq/', 'admin\pages_content\FaqcontentController@deleteFaq')->name('delete_faq');

		// Add Admin
        Route::get('/view-admin', 'admin\AdminController@getIndex');
		Route::post('/add-admin', 'admin\AdminController@addAdmin');
		Route::post('/add-update', 'admin\AdminController@updateAdmin');

		Route::post('/active-admin', 'admin\AdminController@actionConfim');
	    Route::post('/active-admin-deactive', 'admin\AdminController@actionConfimDeactive');


		Route::post('/active-product', 'admin\PortalController@actionConfim');
	    Route::post('/active-product-deactive', 'admin\PortalController@actionConfimDeactive');

		Route::get('/user-log', 'admin\LogController@getIndex');


    });

	Route::post('document-store', 'admin\PortalController@documentStore')->name('admin.documentStore');
	Route::post('document-remove','admin\PortalController@documentRemove')->name('admin.documentRemove');
	Route::post('document-get','admin\PortalController@documentGet')->name('admin.documentGet');
/*adminside route end*/
