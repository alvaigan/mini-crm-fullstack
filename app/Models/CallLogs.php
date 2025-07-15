<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallLogs extends Model
{
    protected $table = 'call_logs';

    protected $fillable = [
        'contact_name',
        'duration',
        'status',
    ];
}
