<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apllied_Job extends Model
{
    use HasFactory;

    protected $table = 'applied_job';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'company_id',
        'job_id',
        'status_apllied_job',
    ];
}
