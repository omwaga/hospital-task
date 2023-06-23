<?php

namespace Tests\Feature;

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PatientsTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /**
     * A patient has a path.
     *
     * @test
     */
    public function it_has_a_path()
    {
        $this->signIn();
        $patient = Patient::factory()->create();

        $this->assertEquals('/patients/'.$patient->id, $patient->path());
    }

    /**
     * A user can add patient record.
     *
     * @test
     */
    public function a_user_can_add_a_patient_record()
    {
        $this->signIn();
        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber()
        ];
        $this->post('/patients', $data);
        $this->assertDatabaseHas('patients', $data);
    }

    /**
     * A user can update patient record
     *
     * @test
     */
    public function a_user_can_update_a_patient_record()
    {
        $this->signIn();
        $patient = Patient::factory()->create();
        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber()
        ];
        $this->put('/patients/'.$patient->id, $data);
        $this->assertDatabaseHas('patients', $data);
    }


}
