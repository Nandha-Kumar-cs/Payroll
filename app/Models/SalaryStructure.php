<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalaryStructure extends Model
{
    protected $table = 'salary';

    protected $fillable = [
        'employee_id',
        'ctc',
        'variable'
    ];

    protected $casts = [
        'variable' => 'decimal:2',
        'ctc' => 'decimal:2',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
