<?php

namespace Tests\Feature;

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Adding a patient records activity.
     *
     * @test
     */
    public function creating_a_patient_records_activity()
    {
        $this->signIn();
        $patient = Patient::factory()->create();

        $this->assertCount(1, $patient->activity);
        $this->assertEquals('created', $patient->activity[0]->description);
    }

    /**
     * Updating a patient records activity.
     *
     * @test
     */
    public function updating_a_patient_records_activity()
    {
        $this->signIn();
        $patient = Patient::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber()
        ];

        $patient->update($data);

        $this->assertCount(2, $patient->activity);
        $this->assertEquals('created', $patient->activity[0]->description);
    }
}
