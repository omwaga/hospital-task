<?php

namespace Tests\Feature;

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PatientsLabTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /**
     * A patient can have laboratory test
     *
     * @test
     */
    public function a_patient_can_have_laboratory_test()
    {
        $this->signIn();
        $patient = Patient::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'patient_id' => $patient->id
        ];

        $this->post('/lab-tests', $data);

        $this->get($patient->path())
            ->assertSee($data);
    }
}
