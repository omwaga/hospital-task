<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * Return Patient Url Path
     *
     * @return string
     */

    public function path(): string
    {
        return "/patients/{$this->id}";
    }

    /**
     * Tickets.
     *
     * @return HasOne
     */
    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }

    /**
     * Patient Activities.
     *
     * @return HasMany
     */
    public function activity(): HasMany
    {
        return $this->hasMany(Activity::class)->latest();
    }

    /**
     * Laboratory Tests.
     *
     * @return HasMany
     */
    public function labTests(): HasMany
    {
        return $this->hasMany(LabTest::class);
    }

    /**
     * Medical Reports.
     *
     * @return HasMany
     */
    public function medicalReports(): HasMany
    {
        return $this->hasMany(MedicalReport::class);
    }

    /**
     * Add Lab Test
     *
     */

    public function addLabTest($data): Model
    {
        return $this->labTests()->create($data);
    }

    /**
     * Add Medical Report
     *
     */
    public function addMedicalReport($data): Model
    {
        return $this->medicalReports()->create($data);
    }

}
