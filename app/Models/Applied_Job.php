<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Applied_Job extends Model
{
    use HasFactory;

    protected $table = 'applied_job';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'job_id',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jobs(): BelongsTo
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}


