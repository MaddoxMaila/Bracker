<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'message_id';

    protected $fillable = [
    	'user_name', 'message', 'message_time', 'message_date', 'message_id'
    ];

    public $timestamps = false;
}
