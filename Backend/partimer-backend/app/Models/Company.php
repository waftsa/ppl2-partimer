<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Company extends Authenticatable
{
    use HasFactory;

    protected $table = 'company';
    protected $primaryKey = 'id';
    protected $guard = 'company';

    protected $fillable = [
        'id',
        'email',
        'password',
        'companyName',
        'address',
        'phoneNum',
        'description',
        'icon_url',
        'verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}
