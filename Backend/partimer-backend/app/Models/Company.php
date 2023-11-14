<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
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
        'icon_url'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
