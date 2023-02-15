<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiResponseLog extends Model
{
    protected $table = 'api_response_logs';
    protected $guarded = ['id'];

    public function api()
    {
        return $this->belongsTo(Api::class);
    }
}
