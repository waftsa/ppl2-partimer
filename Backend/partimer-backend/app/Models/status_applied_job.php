<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_applied_job extends Model
{
    use HasFactory;

    protected $table = 'status_apllied_job';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'status'
    ];
}
