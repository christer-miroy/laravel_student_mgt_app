<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class CustomValidationServiceProvider extends ServiceProvider
{
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
        Validator::extend('valid_payment_amount', function ($attribute, $value, $parameters, $validator) {
            // $parameters[0] will be the enrollment_id
            $enrollment = \App\Models\Enrollment::find($parameters[0]);

            if (!$enrollment) {
                return false; // Enrollment not found
            }

            // Check if the payment amount is within the enrollment amount range
            return ($value >= 0.01 && $value <= $enrollment->amount);
        });
    }
}
