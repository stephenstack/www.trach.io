<?php
/* PUBLIC ROUTES */
Route::get('/', 'HomeController@wwwindex')->middleware('requestlogger');
Route::get('/terms', 'HomeController@termsindex');
Route::get('/privacy', 'HomeController@privacyindex');
Route::post('/mailing-list-subscribe', 'HomeController@mailingListSubscribe')->name('mailing-list-subscribe');
Route::get('/mailing-list-subscriber-verification/{id}', 'HomeController@mailingListSubscribeVerification')->name('mailing-list-subscriber-verification');

Route::post('/invitee-request', 'InviteController@requestAccess');
Route::get('invitee/{tenant_id}', 'InviteController@index');

/* AUTH ROUTES */
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes(['verify' => true]);

/* TRIAL USER ROUTES */
Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('profile/billing', 'BillingController@billing')->name('billing');
    Route::post('profile/billing', 'BillingController@billing_save')->name('billing.save');
});

/* AUTHORISED NON-TRIAL USER ROUTES */
/* Primary Account Holder (Admin Level 2) Profile Routes */
Route::group(['middleware' => ['auth', 'verified', 'subscriber']], function(){
    Route::get('profile', 'ProfileController@profile')->name('profile');
    Route::post('profile', 'ProfileController@profile_save')->name('profile.save');
    Route::get('profile/security', 'ProfileController@security')->name('security');
    Route::post('profile/security', 'ProfileController@security_save')->name('security.save');
    Route::post('profile/billing/switch_plan', 'BillingController@switch_plan')->name('billing.switch_plan');
    Route::get('profile/invoices', 'BillingController@invoices')->name('invoices');
    Route::get('profile/invoices/download/{invoice}', 'BillingController@invoices_download')->name('invoices.download');
    Route::get('profile/billing/cancel', 'BillingController@cancel')->name('cancel');
    Route::get('profile/billing/resume', 'BillingController@resume')->name('resume');
});

/* ADMIN ROUTES*/
Route::group(['middleware' => ['auth', 'verified', 'admin']], function(){
    Route::get('admin', 'AdminController@index')->name('admin');

    // Route::get('admin/tickets', 'AdminController@tickets_show');
    // Route::get('admin/view-ticket/{id}', 'AdminController@ticket_show');
    // Route::get('admin/create_ticket_comment/{id}', 'AdminController@ticket_comment_create');
    // Route::post('/admin/new-comment/', 'AdminController@ticket_comment_store');
    // Route::get('admin/close-ticket/{id}', 'AdminController@closeTicket');
    // Route::get('admin/delete-ticket/{id}', 'AdminController@destroy_ticket');

    // Route::post('admin/publish-announcement', 'AdminController@store_announcement')->name('publish-announcement');
    // Route::get('admin/new-announcement', 'AdminController@create_announcement');
    // Route::get('admin/delete-announcement/{id}', 'AdminController@destroy_announcement');
    Route::get('admin', 'AdminController@index')->name('admin');
    Route::get('admin/subscriptions', 'AdminController@subscriptions_show');
    // Route::get('admin/incomplete-payments', 'AdminController@incomplete_payments_show');
    // Route::get('admin/plans', 'AdminController@plans_show');
    Route::get('admin/failed_jobs', 'AdminController@get_and_show_failed_jobs_results');
    Route::get('admin/jobs-delete-all', 'AdminController@delete_all_current_jobs');
    Route::get('admin/jobs-retry-all', 'AdminController@jobs_retry_current_all');
    Route::get('admin/failed-jobs-delete-all', 'AdminController@delete_all_failed_jobs');
    Route::get('admin/failed-jobs-retry-all', 'AdminController@jobs_retry_failed_all');

    Route::get('admin/{jobs}', 'AdminController@get_and_show_results');
    Route::get('admin/{users}', 'AdminController@get_and_show_results');
    Route::get('admin/{mailing_lists}', 'AdminController@get_and_show_results');
    // Route::get('admin/{announcements}', 'AdminController@get_and_show_results');
});



/* SPA VUE ROUTE */
/* AUTHORISED NON-TRIAL USER ROUTES */
Route::get('/{any}', 'SpaController@index')->where('any', '^(?!api\/)[\/\w\.-]*')->middleware('auth', 'tenantIdentification', 'verified', 'subscriber');



// Route::get('/', function () {
//     return view('www');
// })->name('/');

// Route::post('/early-subscribe', function () {
//     echo 'www';
// })->name('early-subscribe');