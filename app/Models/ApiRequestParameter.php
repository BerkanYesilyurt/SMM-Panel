<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiRequestParameter extends Model
{
    protected $table = 'api_request_parameters';
    protected $guarded = ['id'];
}
