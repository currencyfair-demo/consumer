<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Validators\CurrencyTransactionValidator;

class ValidationServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->app->validator->resolver(function($translator, $data, $rules, $messages)
        {
            return new CurrencyTransactionValidator($translator, $data, $rules, $messages);
        });
    }

    public function register()
    {
    }

}
