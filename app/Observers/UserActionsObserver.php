<?php

namespace App\Observers;

use Auth;
use App\UserAction;

//https://quickadminpanel.com/blog/log-your-laravel-model-data-changes-with-observers/
//https://laravel.com/docs/5.4/eloquent#observers
class UserActionsObserver
{
    public function saved($model)
    {
        if ($model->wasRecentlyCreated == true) {
            // Data was just created
            $action = 'Added';
        } else {
            // Data was updated
            $action = 'Edited';
        }
        if (Auth::check()) {
            UserAction::create([
                'user_id'      => Auth::user()->id,
                'action'       => $action,
                'action_model' => class_basename($model),
                'action_id'    => $model->id
            ]);
        }
    }

    public function deleting($model)
    {
        if (Auth::check()) {
            UserAction::create([
                'user_id'      => Auth::user()->id,
                'action'       => 'Deleted',
                'action_model' => $model->getTable(),
                'action_id'    => $model->id
            ]);
        }
    }
}