<?php

namespace App\Providers;

use App\Models\LabTest;
use App\Models\MedicalReport;
use App\Models\Patient;
use App\Observers\LabTestObserver;
use App\Observers\MedicalReportObserver;
use App\Observers\PatientObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Patient::observe(PatientObserver::class);
        LabTest::observe(LabTestObserver::class);
        MedicalReport::observe(MedicalReportObserver::class);
    }
}
