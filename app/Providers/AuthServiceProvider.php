<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\AppointmentPolicy;
use App\Policies\DepartmentPolicy;
use App\Policies\LabTestPolicy;
use App\Policies\MedicalRecordPolicy;
use App\Policies\NotificationPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\PrescriptionPolicy;
use App\Policies\WardPolicy;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\LabTest;
use App\Models\MedicalRecord;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\Prescription;
use App\Models\Ward;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Appointment::class => AppointmentPolicy::class,
        Department::class => DepartmentPolicy::class,
        LabTest::class => LabTestPolicy::class,
        MedicalRecord::class => MedicalRecordPolicy::class,
        Notification::class => NotificationPolicy::class,
        Payment::class => PaymentPolicy::class,
        Prescription::class => PrescriptionPolicy::class,
        Ward::class => WardPolicy::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
