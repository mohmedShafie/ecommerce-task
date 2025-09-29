<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'notification_type',
        'title',
        'message',
        'recipient_type',
        'recipient_id',
        'data',
        'channel',
        'is_sent',
    ];
}
