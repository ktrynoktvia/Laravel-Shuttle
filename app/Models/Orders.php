<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'idorder', 'busname', 'customername', 'customeremail', 'customerphone', 'customeraddress', 'total', 'price'
    ];
}
