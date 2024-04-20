<?php

namespace Cubecoding\Dates;

use Illuminate\Support\ServiceProvider;

class DatesServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string,class-string>
     */
    public array $bindings = [

    ];

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                commands: [
                ],
            );
        }
    }
}
