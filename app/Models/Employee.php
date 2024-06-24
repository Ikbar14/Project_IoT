<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'Number',
        'Name',
        'Email',
        'Address',
        'Phone_Number',
        'Position',
        'Status',
        'City',
        'Country',
    ];
}