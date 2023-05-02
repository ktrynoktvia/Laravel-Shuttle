<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shuttles extends Model
{
    use HasFactory;

    protected $fillable = [
        'idbus', 'busname', 'location', 'address', 'website', 'email', 'callcenter'
    ];
}
