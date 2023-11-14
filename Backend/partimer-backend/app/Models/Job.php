<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'jobName',
        'Category',
        'Salary',
        'jobDesc',
        'requirement',
        'avail'
    ];
}
