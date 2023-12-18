<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'company_id',
        'jobName',
        'Category',
        'Salary',
        'jobDesc',
        'requirement',
        'status',
        'approved'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function job_apply()
    {
        return $this->hasOne(Applied_Job::class);
    }

}
