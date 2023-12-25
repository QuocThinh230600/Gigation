<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use App\Library\Administrator\BankCharge;

class NganluongServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/nganluong.php' => config_path('nganluong.php'),
        ]);
    }

    public function register()
    {
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('NLBankCharge', 'App\Library\Administrator\NLBankCharge');
        });

        $this->app->bind('BankCharge', BankCharge::class);
    }
}
