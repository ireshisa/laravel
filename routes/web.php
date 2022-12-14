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

Route::get('/link', function () {
    Artisan::call('storage:link');
    echo "done";
});
Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    return 1;
});


Route::get('mailx',function() {
    // $data = array('name'=>"Virat Gandhi");
    // Mail::send('mail', $data, function($message) {
    //     $message->to('khushalasdeo@gmail.com', 'Tutorials Point')->subject
    //     ('Laravel HTML Testing Mail');
    // });
    // // try{
    // // }catch(\Exception $e){
    // //     echo '<pre>';
    // //     print_r($e->getMessage());
    // //     exit;
    // // }
    // echo "HTML Email Sent. Check your inbox.";
    // echo '<pre>';
    // print_r('ccc');
    // exit;
    mail("1997529iresh@gmail.com","test","testtt");
 });

/*
|--------------------------------------------------------------------------
| Upgrading
|--------------------------------------------------------------------------
|
| The upgrading process routes
|
*/


Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => ['web']], function () {
    Route::get('upgrade', 'UpgradeController@version');
});

Route::get('template','App\Http\Controllers\HomeController@template');
/*
|--------------------------------------------------------------------------
| Installation
|--------------------------------------------------------------------------
|
| The installation process routes
|
*/


/*
|--------------------------------------------------------------------------
| Back-end
|--------------------------------------------------------------------------
|
| The admin panel routes
|
*/
Route::group([
    'namespace'  => 'App\Http\Controllers\Admin',
 //   'middleware' => ['web', 'install.checker'],
    'prefix'     => config('larapen.admin.route_prefix', 'admin'),
], function ($router) {
    // Auth
    Route::auth();
    Route::get('logout', 'Auth\LoginController@logout');

    // Admin Panel Area
    Route::group([
        'middleware' => ['admin', 'clearance', 'banned.user', 'prevent.back.history'],
    ], function ($router) {
        // Dashboard
        Route::get('dashboard', 'DashboardController@dashboard');
        Route::get('/', 'DashboardController@redirect');

        // Extra (must be called before CRUD)
        Route::get('homepage/{action}', 'HomeSectionController@reset')->where('action', 'reset_(.*)');
        Route::get('languages/sync_files', 'LanguageController@syncFilesLines');
        Route::get('permissions/create_default_entries', 'PermissionController@createDefaultEntries');
        Route::get('blacklists/add', 'BlacklistController@banUserByEmail');

        // CRUD
        CRUD::resource('advertisings', 'AdvertisingController');

        CRUD::resource('blacklists', 'BlacklistController');
        CRUD::resource('categories', 'CategoryController');
        CRUD::resource('categories/{catId}/subcategories', 'SubCategoryController');
        CRUD::resource('cities', 'CityController');
        CRUD::resource('companies', 'CompanyController');
        CRUD::resource('countries', 'CountryController');
        CRUD::resource('countries/{countryCode}/cities', 'CityController');
        CRUD::resource('countries/{countryCode}/admins1', 'SubAdmin1Controller');
        CRUD::resource('currencies', 'CurrencyController');
        CRUD::resource('genders', 'GenderController');
        CRUD::resource('homepage', 'HomeSectionController');
        CRUD::resource('admins1/{admin1Code}/cities', 'CityController');
        CRUD::resource('admins1/{admin1Code}/admins2', 'SubAdmin2Controller');
        CRUD::resource('admins2/{admin2Code}/cities', 'CityController');
        CRUD::resource('languages', 'LanguageController');
        CRUD::resource('meta_tags', 'MetaTagController');
        CRUD::resource('packages', 'PackageController');
        CRUD::resource('pages', 'PageController');
        CRUD::resource('payments', 'PaymentController');
        CRUD::resource('payment_methods', 'PaymentMethodController');
        CRUD::resource('permissions', 'PermissionController');
        CRUD::resource('pictures', 'PictureController');
        CRUD::resource('posts', 'PostController');
        CRUD::resource('p_types', 'PostTypeController');
        CRUD::resource('report', 'ReportController');
        CRUD::resource('report_types', 'ReportTypeController');
        CRUD::resource('roles', 'RoleController');
        CRUD::resource('salary_types', 'SalaryTypeController');
        CRUD::resource('settings', 'SettingController');
        CRUD::resource('testimonials', 'TestimonialController');
        CRUD::resource('time_zones', 'TimeZoneController');
        CRUD::resource('users', 'UserController');
        CRUD::resource('interviews', 'MeetingController');
        CRUD::resource('report-review', 'ReportReviewController');
        Route::get('post/{id}/{status}', 'PostController@updateStatus');

        // Others
        Route::get('account', 'UserController@account');
        Route::post('ajax/{table}/{field}', 'InlineRequestController@make');
        Route::post('report_status', 'ReportController@reportStatus');
        Route::post('review-report', 'ReportReviewController@updateReviewReport');
        // Backup
        Route::get('backups', 'BackupController@index');
        Route::put('backups/create', 'BackupController@create');
        Route::get('backups/download/{file_name?}', 'BackupController@download');
        Route::delete('backups/delete/{file_name?}', 'BackupController@delete')->where('file_name', '(.*)');

        // Actions
        Route::get('actions/clear_cache', 'ActionController@clearCache');
        Route::get('actions/clear_images_thumbnails', 'ActionController@clearImagesThumbnails');
        Route::get('actions/call_ads_cleaner_command', 'ActionController@callAdsCleanerCommand');
        Route::post('actions/maintenance_down', 'ActionController@maintenanceDown');
        Route::get('actions/maintenance_up', 'ActionController@maintenanceUp');

        // Re-send Email or Phone verification message
        Route::get('verify/user/{id}/resend/email', 'UserController@reSendVerificationEmail');
        Route::get('verify/user/{id}/resend/sms', 'UserController@reSendVerificationSms');
        Route::get('verify/post/{id}/resend/email', 'PostController@reSendVerificationEmail');
        Route::get('verify/post/{id}/resend/sms', 'PostController@reSendVerificationSms');

        // Plugins
        Route::get('plugins', 'PluginController@index');
        Route::post('plugins/{plugin}/install', 'PluginController@install');
        Route::get('plugins/{plugin}/install', 'PluginController@install');
        Route::get('plugins/{plugin}/uninstall', 'PluginController@uninstall');
        Route::get('plugins/{plugin}/delete', 'PluginController@delete');
    });
});


/*
|--------------------------------------------------------------------------
| Front-end
|--------------------------------------------------------------------------
|
| The not translated front-end routes
|
*/
Route::group([
    'namespace'  => 'App\Http\Controllers',
   // 'middleware' => ['web', 'install.checker'],
], function ($router) {
    // FILES
    Route::get('file', 'FileController@show');

    // SEO
    Route::get('sitemaps.xml', 'SitemapsController@index');

    // Impersonate (As admin user, login as an another user)
    Route::group(['middleware' => 'auth'], function ($router) {
        Route::impersonate();
    });
});

/*
|--------------------------------------------------------------------------
| Front-end
|--------------------------------------------------------------------------
|
| The translated front-end routes
|
*/
Route::group([
    'namespace'  => 'App\Http\Controllers',
    'middleware' => ['local'],
    'prefix'     => LaravelLocalization::setLocale(),
], function ($router) {
    Route::group(['middleware' => ['web', ]], function ($router) {
        // HOMEPAGE
        Route::get('company-detail/{id}', 'CompanyController@getCompany');

        Route::get('/', 'HomeController@index');
        Route::get(LaravelLocalization::transRoute('routes.countries'), 'CountriesController@index');


        // AUTH
        Route::group(['middleware' => ['guest', 'prevent.back.history']], function ($router) {
            // Registration Routes...
            Route::get(LaravelLocalization::transRoute('routes.register'), 'Auth\RegisterController@showRegistrationForm');
            Route::post(LaravelLocalization::transRoute('routes.register'), 'Auth\RegisterController@register');
            Route::get('register/finish', 'Auth\RegisterController@finish');

            // Authentication Routes...
            Route::get(LaravelLocalization::transRoute('routes.login'), 'Auth\LoginController@showLoginForm');
            Route::post(LaravelLocalization::transRoute('routes.login'), 'Auth\LoginController@login');

            // Forgot Password Routes...
            Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
            Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

            // Reset Password using Token
            Route::get('password/token', 'Auth\ForgotPasswordController@showTokenRequestForm');
            Route::post('password/token', 'Auth\ForgotPasswordController@sendResetToken');

            // Reset Password using Link (Core Routes...)
            Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
            Route::post('password/reset', 'Auth\ResetPasswordController@reset');

            // Social Authentication
            $router->pattern('provider', 'facebook|linkedin|twitter|google');
            Route::get('auth/facebook', 'Auth\SocialController@redirectToProviderFacebook');
            Route::get('auth/google', 'Auth\SocialController@redirectToProviderGoogle');
            Route::get('auth/{provider}/callback', 'Auth\SocialController@handleProviderCallback');
        });

        // Email Address or Phone Number verification
        $router->pattern('field', 'email|phone');
        Route::get('verify/user/{id}/resend/email', 'Auth\RegisterController@reSendVerificationEmail');
        Route::get('verify/user/{id}/resend/sms', 'Auth\RegisterController@reSendVerificationSms');
        Route::get('verify/user/{field}/{token?}', 'Auth\RegisterController@verification');
        Route::post('verify/user/{field}/{token?}', 'Auth\RegisterController@verification');

        // User Logout
        Route::get(LaravelLocalization::transRoute('routes.logout'), 'Auth\LoginController@logout');

//        Route::get('payment', 'PaymentsController@show');
        Route::post('payment', 'PaymentsController@store');
        Route::post('upgrade_package', 'PaymentsController@upgradePackage');
        // POSTSpo
        Route::group(['namespace' => 'Post'], function ($router) {
            $router->pattern('id', '[0-9]+');
            // $router->pattern('slug', '.*');
            $router->pattern('slug', '^(?=.*)((?!\/).)*$');

            // SingleStep Post creation
            Route::group(['namespace' => 'CreateOrEdit\SingleStep'], function ($router) {
                Route::get('create', 'CreateController@getForm');
                Route::post('create', 'CreateController@postForm');
                Route::get('create/finish', 'CreateController@finish');

                // Payment Gateway Success & Cancel
                Route::get('create/payment/success', 'CreateController@paymentConfirmation');
                Route::get('create/payment/cancel', 'CreateController@paymentCancel');

                // Email Address or Phone Number verification
                $router->pattern('field', 'email|phone');
                Route::get('verify/post/{id}/resend/email', 'CreateController@reSendVerificationEmail');
                Route::get('verify/post/{id}/resend/sms', 'CreateController@reSendVerificationSms');
                Route::get('verify/post/{field}/{token?}', 'CreateController@verification');
                Route::post('verify/post/{field}/{token?}', 'CreateController@verification');
            });

            // MultiSteps Post creation
            Route::group(['namespace' => 'CreateOrEdit\MultiSteps'], function ($router) {
                Route::get('posts/create/{tmpToken?}', 'CreateController@getForm');
                Route::post('posts/create', 'CreateController@postForm');
                
                Route::get('posts/sendmailtofloowers', 'CreateController@sendmailtofloowers');
                Route::get('posts/sendmailtoalert', 'CreateController@sendmailtoalert');
                
                Route::put('posts/create/{tmpToken}', 'CreateController@postForm');
                Route::get('posts/create/{tmpToken}/payment', 'PaymentController@getForm');
                Route::post('posts/create/{tmpToken}/payment', 'PaymentController@postForm');
                Route::get('posts/finish', 'CreateController@finish');
                Route::get('posts/matched', 'CreateController@showMatched');
                // Payment Gateway Success & Cancel
                Route::get('posts/create/{tmpToken}/payment/success', 'PaymentController@paymentConfirmation');
                Route::get('posts/create/{tmpToken}/payment/cancel', 'PaymentController@paymentCancel');

                // Email Address or Phone Number verification
                $router->pattern('field', 'email|phone');
                Route::get('verify/post/{id}/resend/email', 'CreateController@reSendVerificationEmail');
                Route::get('verify/post/{id}/resend/sms', 'CreateController@reSendVerificationSms');
                Route::get('verify/post/{field}/{token?}', 'CreateController@verification');
                Route::post('verify/post/{field}/{token?}', 'CreateController@verification');
            });

            Route::group(['middleware' => 'auth'], function ($router) {
                $router->pattern('id', '[0-9]+');

                // SingleStep Post edition
                Route::group(['namespace' => 'CreateOrEdit\SingleStep'], function ($router) {
                    Route::get('edit/{id}', 'EditController@getForm');
                    Route::put('edit/{id}', 'EditController@postForm');

                    // Payment Gateway Success & Cancel
                    Route::get('edit/{id}/payment/success', 'EditController@paymentConfirmation');
                    Route::get('edit/{id}/payment/cancel', 'EditController@paymentCancel');
                });

                // MultiSteps Post edition
                Route::group(['namespace' => 'CreateOrEdit\MultiSteps'], function ($router) {
                    Route::get('posts/{id}/edit', 'EditController@getForm');
                    Route::put('posts/{id}/edit', 'EditController@postForm');
                    Route::get('posts/{id}/payment', 'PaymentController@getForm');
                    Route::post('posts/{id}/payment', 'PaymentController@postForm');

                    // Payment Gateway Success & Cancel
                    Route::get('posts/{id}/payment/success', 'PaymentController@paymentConfirmation');
                    Route::get('posts/{id}/payment/cancel', 'PaymentController@paymentCancel');
                });
            });

            // Post's Details
            Route::get(LaravelLocalization::transRoute('routes.post'), 'DetailsController@index');

            // Contact Job's Author
            Route::post('posts/{id}/contact', 'DetailsController@sendMessage');

            // Send report abuse
            Route::get('posts/{id}/report', 'ReportController@showReportForm');
            Route::post('posts/{id}/report', 'ReportController@sendReport');
        });
        Route::post('send-by-email', 'Search\SearchController@sendByEmail');


        // ACCOUNT
        Route::group(['middleware' => ['auth', 'banned.user', 'prevent.back.history'], 'namespace' => 'Account'], function ($router) {
            $router->pattern('id', '[0-9]+');

            // Users
            Route::get('account', 'EditController@index');
            Route::group(['middleware' => 'impersonate.protect'], function () {
                Route::put('account', 'EditController@updateDetails');
                Route::put('account/settings', 'EditController@updateSettings');
                Route::put('account/preferences', 'EditController@updatePreferences');
            });
            Route::get('account/close', 'CloseController@index');
            Route::group(['middleware' => 'impersonate.protect'], function () {
                Route::post('account/close', 'CloseController@submit');
            });

            // Companies
            Route::get('account/companies', 'CompanyController@index');
            Route::get('account/companies/create', 'CompanyController@create');
            Route::post('account/companies', 'CompanyController@store');
            Route::get('account/companies/{id}', 'CompanyController@show');
            Route::get('account/companies/{id}/edit', 'CompanyController@edit');
            Route::put('account/companies/{id}', 'CompanyController@update');
            Route::get('account/companies/{id}/delete', 'CompanyController@destroy');
            Route::post('account/companies/delete', 'CompanyController@destroy');

            // Resumes
            Route::get('account/resumes', 'ResumeController@index');
            Route::get('account/resumes/create', 'ResumeController@create');
            Route::get('account/coverletter/create', 'ResumeController@coverLetterCreate');
            Route::post('account/resumes', 'ResumeController@store');
            Route::post('account/resumes/skills', 'ResumeController@updateSkills');
            Route::get('account/resumes/{id}', 'ResumeController@show');
            Route::get('account/resumes/{id}/edit', 'ResumeController@edit');
            Route::put('account/resumes/{id}', 'ResumeController@update');
            Route::get('account/resumes/{id}/delete', 'ResumeController@destroy');
            Route::post('account/resumes/delete', 'ResumeController@destroy');
            Route::get('account/cover', 'CoverController@index');
            
            Route::get('account/resume/download', 'ResumeController@resumeDownload')->name('resume.download');

            // Posts
            Route::get('account/saved-search', 'PostsController@getSavedSearch');

            /**
             * CUSTOM ADDITIONAL features
             */
            Route::get('account/reviews', 'ReviewController@index');
            Route::get('account/reviews/{id}/delete', 'ReviewController@destroy');
            Route::post('account/reviews/delete', 'ReviewController@destroy');
            $router->pattern('pagePath', '(my-posts|archived|favourite|pending-approval|saved-search|followers|reviews|company-followers)+');


           Route::get('account/{pagePath}', 'PostsController@getPage');
            Route::get('account/my-posts/{id}/offline', 'PostsController@getMyPosts');
            Route::get('account/archived/{id}/repost', 'PostsController@getArchivedPosts');
            Route::get('account/{pagePath}/{id}/delete', 'PostsController@destroy');
            Route::post('account/{pagePath}/delete', 'PostsController@destroy');

            // Conversations
            
            Route::get('account/conversations', 'ConversationsController@index');
            Route::get('account/conversations/{id}/delete', 'ConversationsController@destroy');
            Route::get('account/conversations/{id}/deletePending', 'ConversationsController@destroyPendingApproval');
            Route::post('account/conversations/delete', 'ConversationsController@destroy');
            Route::post('account/conversations/{id}/reply', 'ConversationsController@reply');
            $router->pattern('msgId', '[0-9]+');
            Route::get('account/conversations/{id}/messages', 'ConversationsController@messages');
            Route::get('account/conversations/{id}/messages/{msgId}/delete', 'ConversationsController@destroyMessages');
            Route::post('account/conversations/{id}/messages/delete', 'ConversationsController@destroyMessages');
            Route::get('account/conversations/{id}/approve', 'ConversationsController@approve');

            // Transactions
            Route::get('account/transactions', 'TransactionsController@index');
            Route::get('account/applicants', 'ApplicantsController@index');
            Route::get('account/connected-companies', 'ApplicantsController@connected');
            Route::get('account/meetings', 'MeetingController@index');
            Route::post('account/meetings/delete', 'MeetingController@destroy');
            Route::get('account/candidates/{postId}', 'MeetingController@getCandidates');
            Route::post('account/meetings', 'MeetingController@store');
            Route::get('account/meetings/{id}/edit', 'MeetingController@edit');
            Route::post('account/meetings/{id}/update', 'MeetingController@update');
            Route::post('account/report', 'MeetingController@reportNoShow');
            Route::post('account/meetings/shedule', 'MeetingController@shedule');
            Route::get('account/meetings/{id}', 'MeetingController@getMeeting');
            Route::get('account/meetings/{id}/delete', 'MeetingController@destroy');
            Route::get('account/meetings/new', 'MeetingController@create');
            Route::post('account/meetings/status', 'MeetingController@setStatus');
                    Route::get('account/meetings/status', 'MeetingController@setStatus');
            Route::get('account/hired', 'HiredController@index');
            Route::get('account/package', 'PackageController@index');
            Route::get('account/connected', 'ConnectedController@index');
            Route::get('account/connected/{postId}/{userId}', 'ConnectedController@viewCandidateDetails');
            Route::post('account/connected/referee_check/send','ConnectedController@sendRefereeEmail');
            Route::get('account/pending', 'PendingController@index');
            Route::get('account/job-alerts', 'JobAlertController@index');
            Route::get('account/alerts/{id}', 'JobAlertController@edit');
            Route::get('account/alerts/{id}/delete', 'JobAlertController@destroy');
            Route::get('account/save-applicants', 'SaveCandidateController@index')->name('save.candidate.list');
            Route::get('account/save-applicants/delete/{save_applicants_delete}', 'SaveCandidateController@destroy')->name('save.candidate.destroy');
        });


        // AJAX
        Route::group(['prefix' => 'ajax'], function ($router) {
            Route::get('countries/{countryCode}/admins/{adminType}', 'Ajax\LocationController@getAdmins');
            Route::get('countries/{countryCode}/admins/{adminType}/{adminCode}/cities', 'Ajax\LocationController@getCities');
            Route::get('countries/{countryCode}/cities/{id}', 'Ajax\LocationController@getSelectedCity');


            Route::get('countries/cities/{subAdmin1Code}','Ajax\LocationController@getAdmin1Cities');
            Route::post('countries/{countryCode}/cities/autocomplete', 'Ajax\LocationController@searchedCities');
            Route::post('countries/{countryCode}/admin1/cities', 'Ajax\LocationController@getAdmin1WithCities');
            Route::post('category/sub-categories', 'Ajax\CategoryController@getSubCategories');
            Route::post('save/post', 'Ajax\PostController@savePost');
            Route::post('save/candidate', 'Ajax\SaveCandidateController@saveCandidate')->name('save.candidate');
            Route::post('delete/candidate', 'Ajax\SaveCandidateController@deleteCandidate')->name('delete.candidate');
            Route::post('save/search', 'Ajax\PostController@saveSearch');

            Route::post('post/phone', 'Ajax\PostController@getPhone');
            Route::post('messages/check', 'Ajax\ConversationController@checkNewMessages');

        });


        // FEEDS
        Route::feeds();


        // Country Code Pattern
        $countryCodePattern = implode('|', array_map('strtolower', array_keys(getCountries())));
        $router->pattern('countryCode', $countryCodePattern);


        // XML SITEMAPS
        Route::get('{countryCode}/sitemaps.xml', 'SitemapsController@site');
        Route::get('{countryCode}/sitemaps/pages.xml', 'SitemapsController@pages');
        Route::get('{countryCode}/sitemaps/categories.xml', 'SitemapsController@categories');
        Route::get('{countryCode}/sitemaps/cities.xml', 'SitemapsController@cities');
        Route::get('{countryCode}/sitemaps/posts.xml', 'SitemapsController@posts');


        // STATICS PAGES
        Route::get(LaravelLocalization::transRoute('routes.page'), 'PageController@index');
        Route::get(LaravelLocalization::transRoute('routes.contact'), 'PageController@contact');
        Route::post(LaravelLocalization::transRoute('routes.contact'), 'PageController@contactPost');
        Route::get(LaravelLocalization::transRoute('routes.sitemap'), 'SitemapController@index');
        Route::get(LaravelLocalization::transRoute('routes.companies-list'), 'Search\CompanyController@index');



        // DYNAMIC URL PAGES
        $router->pattern('id', '[0-9]+');
        $router->pattern('username', '[a-zA-Z0-9]+');
        Route::get(LaravelLocalization::transRoute('routes.search'), 'Search\SearchController@index');
        Route::get(LaravelLocalization::transRoute('routes.search-user'), 'Search\UserController@index');
        Route::get(LaravelLocalization::transRoute('routes.search-username'), 'Search\UserController@profile');
        Route::get(LaravelLocalization::transRoute('routes.search-company'), 'Search\CompanyController@profile');
        Route::get(LaravelLocalization::transRoute('routes.search-tag'), 'Search\TagController@index');
        Route::get(LaravelLocalization::transRoute('routes.search-city'), 'Search\CityController@index');
        Route::get(LaravelLocalization::transRoute('routes.search-subCat'), 'Search\CategoryController@index');
        Route::get(LaravelLocalization::transRoute('routes.search-cat'), 'Search\CategoryController@index');
        Route::get(LaravelLocalization::transRoute('routes.search'), 'Search\SearchController@index');
        Route::get('latest-jobs-ajax', 'Search\SearchController@ajaxJobs');
        //CUSTOM PAGES URL
        Route::get('pricing', 'PricingController@index');
        Route::get('search-talent', 'Search\SearchTalentController@index');
        Route::get('search-talent-filter', 'Search\SearchTalentController@getJsonTalents');
        Route::get('search-talent/seeker/{id}', 'Search\SearchTalentController@show');
       // Route::get('search-talent/seeker/{id}/{post_id}', 'Search\SearchTalentController@show');

        Route::get('search-talent/seeker/{id}/connexion', 'Search\SearchTalentController@connect');
        Route::get('ajax/companies', 'Search\CompanyController@getCompaniesAjax');
        // Company Following routes
        Route::get('companies/{id}/follow', 'Account\CompanyFollowerController@follow');
        Route::get('companies/{id}/unfollow', 'Account\CompanyFollowerController@unfollow');
        Route::get('faq', 'PageController@faqPage');
        Route::get('terms', 'PageController@termsPage');
        Route::get('privacy-policy', 'PageController@policyPage');
        Route::get('resume-advice', 'PageController@advicePage');
        Route::get('our-story','PageController@ourstoryPage');
        Route::get('blog','PageController@blogPage');
        Route::get('candidate-support','PageController@candidatesupportPage');
        Route::get('faq-employer','PageController@faqemployerPage');
        Route::get('faq-candidate','PageController@faqcandidatePage');
        // Review routes
        Route::post('seeker/{id}/review', 'Account\ReviewController@store');
        Route::post('seeker/{id}/endorse', 'Account\EndorsementController@store');
        Route::post('report_review','Account\ReviewController@reportReview');

        Route::post('job-alerts', 'Account\JobAlertController@store');
//        Route::post('job-alerts', 'Account\JobAlertController@store');


        //Comment routes
        Route::post('page/comment/{id}','PageController@createComment');
        Route::get('page/comment/{id}/delete','PageController@deleteComment');
        Route::Post('page/comment/{id}/edit','PageController@editComment');

        
        Route::post('latest-jobs', 'Account\JobAlertController@store');
        Route::get('account/alerts', 'Account\JobAlertController@index');        
        Route::post(LaravelLocalization::transRoute('routes.search-subCat'), 'Account\JobAlertController@store');
        Route::post(LaravelLocalization::transRoute('routes.search-cat'), 'Account\JobAlertController@store');
    });
});