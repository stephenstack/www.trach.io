<?php

namespace App\Models\Override;

use Illuminate\Notifications\DatabaseNotification as DatabaseNotification;

class TenantDatabaseNotification extends DatabaseNotification
{
    // set your preferred connection here
    protected $connection = 'tenant';
}