<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsConfig extends Model
{

    protected $fillable=[
        'name','username','status','password'
    ];
}
