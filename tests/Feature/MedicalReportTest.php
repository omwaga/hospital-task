<?php

namespace Tests\Feature;

use App\Models\LabTest;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MedicalReportTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /**
     * A patient can have a mediacl report
     *
     * @test
     */
    public function a_patient_can_have_medical_report()
    {
        $this->signIn();
        $patient = Patient::factory()->create();
        $data = [
            'name' => $this->faker->name(),
            'patient_id' => $patient->id
        ];

        $lab_test = LabTest::create($data);

        $data = [
            'lab_tests_id' => $lab_test->id,
            'patient_id' => $patient->id,
            'result' => $this->faker->text(160),
            'diagnosis' => $this->faker->text(160)
        ];

        $this->post('/medical-reports', $data);

        $this->get($patient->path())
            ->assertSee($data);
    }
}
