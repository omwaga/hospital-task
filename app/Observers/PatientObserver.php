<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Patient;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class PatientObserver
{
    /**
     * Handle the Patient "created" event.
     *
     * @param Patient $patient
     * @return void
     */
    public function created(Patient $patient)
    {
        // Generate and save a ticket and associate it with the patient
        Ticket::create([
            'patient_id' => $patient->id,
            'ticket_number' => $this->generateTicketNumber()
        ]);

        $this->recordActivity($patient, 'created');
    }

    /**
     * Handle the Patient "updated" event.
     *
     * @param Patient $patient
     * @return void
     */
    public function updated(Patient $patient)
    {
        $this->recordActivity($patient, 'updated');
    }

    /**
     * Record Activity.
     *
     */
    protected function recordActivity($patient, $type)
    {
        Activity::create([
            'patient_id' => $patient->id,
            'user_id' =>  Auth::id(),
            'description' => $type
        ]);
    }

    /**
     * Generates the ticket No.
     *
     * @return string
     */
    public function generateTicketNumber(): string
    {
        $prefix = 'TICKET';
        $randomDigits = mt_rand(10, 99); // Generate a random 2-digit number
        $timestamp = time(); // Get the current timestamp

        // Concatenate the prefix, timestamp, and random number to create the ticket number
        return $prefix . '-' . $timestamp . '-0' . $randomDigits;
    }
}
