<?php

namespace App;

use App\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Eventaction extends BaseModel
{
    protected $guarded = [];
    protected $connection = 'tenant';

    protected $casts = [ 'status' => 'integer', 'order' => 'integer'];

}
