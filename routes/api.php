<?php

use Illuminate\Http\Request;

Route::namespace('Api')->middleware('auth:api', 'tenantIdentification')->group(function () {

    /* NOTIFICATION SEND */
    Route::post('notification/send-action-suggestion', 'NotificationController@sendActionSuggestion');
    Route::post('notification/send-newnote-notification', 'NotificationController@sendNewNoteNotification');
    Route::post('support/contact', 'SupportController@sendMessage')->name('contact');

    /* LOGS */
    Route::post('get-logs-previous-shift', 'ReportsLogController@get_prev_shift_logs');
    Route::post('get-logs-current-shift', 'ReportsLogController@get_curr_shift_logs');
    Route::post('get-all-log-data', 'ReportsLogController@get_all_log_data');

    /* GRAPHS */
    Route::post('/chart/create_graph', 'ReportsChartController@create_graph');

    /* EVENT ACTIONS */
    Route::get('o2LatestStatus', 'O2sController@o2LatestStatus');
    Route::get('latest-o2s', 'O2sController@latest');
    Route::get('latest-desat', 'DesatsController@latest');
    Route::get('latest-envvar', 'EnvvarsController@latest');
    Route::get('latest-suction', 'SuctionsController@latest');
    Route::get('latest-neb', 'NebsController@latest');
    Route::get('latest-meds', 'MedsController@latest');
    Route::get('latest-toilets', 'ToiletsController@latest');
    Route::get('awakeLatestStatus', 'AwakesleepsController@awakeLatestStatus');
    Route::get('latest-cough', 'CoughsController@latest');
    Route::get('event-action-enabled', 'EventActionsController@indexEnabled');
    Route::get('event-action-disabled', 'EventActionsController@indexDisabled');
    Route::post('set-event-action-thresholds', 'EventActionsController@store_thresholds');
    Route::resource('o2s', 'O2sController');
    Route::resource('desats', 'DesatsController');
    Route::resource('envvars', 'EnvvarsController');
    Route::resource('suctions', 'SuctionsController');
    Route::resource('nebs', 'NebsController');
    Route::resource('meds', 'MedsController');
    Route::resource('toilets', 'ToiletsController');
    Route::resource('awakesleeps', 'AwakesleepsController');
    Route::resource('coughs', 'CoughsController');
    Route::resource('event-action', 'EventActionsController');

    /* NOTIFICATIONS */
    Route::get('notification-count', 'NotificationsController@notificationCount');
    Route::post('latestNotifications', 'NotificationsController@showLatest');
    Route::resource('notifications', 'NotificationsController');

    /* NOTES */
    Route::post('get-all-notes', 'NoteController@getAllNotes');
    Route::post('notes-where-category', 'NoteController@notesWhereCategory');
    Route::resource('note-comment', 'NoteCommentController');
    Route::resource('note', 'NoteController');
    Route::resource('note-categories', 'NoteCategoriesController');

    /* SHIFTS */
    Route::post('shift-sign-in', 'ShiftController@shiftSignIn');
    Route::post('shift-sign-out', 'ShiftController@shiftSignOut');
    Route::get('get-latest-shift', 'ShiftController@latestShift');
    Route::post('get-latest-shift-task', 'ShiftTasksController@latestShiftTask');
    Route::post('set-shift-tasks', 'ShiftTasksController@SetShiftTasks');
    Route::resource('shift-history', 'ShiftController');

    /* USERS */
    Route::get('user-actions-latest/{count}', 'UserActionsController@latest');
    Route::post('invite-user', 'TenantUsersController@inviteUser');
    Route::post('get-pending-user-approvals-count', 'TenantUsersController@countPendingApprovals');
    Route::post('get-pending-users', 'TenantUsersController@usersPendingApproval');
    Route::post('notify-approved-user', 'TenantUsersController@notifyApprovedUser');
    Route::post('count-tenant-users', 'TenantUsersController@countTenantUsers');
    Route::post('tenant-users/set-status', 'TenantUsersController@setUserStatus');
    Route::post('get-tenant-users', 'TenantUsersController@getThisTenantsUsers');
    Route::get('nonGlobalRoles', 'RolesController@nonGlobalRoles');
    Route::resource('roles', 'RolesController');
    Route::resource('users', 'UsersController');
    Route::resource('user-actions', 'UserActionsController');
    Route::resource('tenant-users', 'TenantUsersController');

    /* SETTINGS */
    Route::post('set-env-temp-scale', 'TenantSettingsController@setEnvTempScale');
    Route::post('update-timezone', 'TenantSettingsController@updateTimezone');
    Route::get('list-timezones', 'TenantSettingsController@listTimeZones');
    Route::get('get-timezone', 'TenantSettingsController@getTimezone');
    Route::get('get-temp-scale', 'TenantSettingsController@getTempScale');
    Route::get('get-tenant-settings', 'TenantSettingsController@getAllSettings');

});


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return response()->json(['name' => Auth::User()->name]);
// });
// Route::post('getAllUserLoginLogoutActivity', function(Request $request) {
//     // $user = App\User::all();

// });
// Route::get('user/{id}', function ($id) {
//     return 'User '.$id;
// });