<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'conversations';

    protected $fillable = ['sender_id', 'receiver_id', 'message'];
}
