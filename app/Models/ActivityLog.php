<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ActivityLog extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'activity_logs';
    
    protected $fillable = [
        'type',
        'user_id',
        'assets'
    ];
}
