<?php

namespace App\Http\Controllers\Api;

use App\Models\Override\TenantDatabaseNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class NotificationsController extends BaseController
{

    public function index()
    {
        return TenantDatabaseNotification::where('notifiable_id', \Auth::user()->id)->get();
    }

    public function show($id)
    {
        return Notification::find($id);
    }

    public function notificationCount()
    {
        return TenantDatabaseNotification::whereNull('read_at')->where('notifiable_id', \Auth::user()->id)->count();
    }

    public function update(Request $request, $id)
    {

        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        return 204;
    }


}
