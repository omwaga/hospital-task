<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalReport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'lab_tests_id',
        'result',
        'diagnosis',
        'prescription'
    ];


    /**
     * Laboratory Test.
     *
     * @return BelongsTo
     */
    public function labTest(): BelongsTo
    {
        return $this->belongsTo(LabTest::class, 'lab_tests_id');
    }


    /**
     * Patient.
     *
     * @return BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
