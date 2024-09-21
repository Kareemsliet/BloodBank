<?php

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auto-permission'=>App\Http\Middleware\Permissions::class,
        ]);

        $middleware->redirectGuestsTo(function(){
            if(auth()->guest()){
               return route('login');
            }else{
                return route('client.login');
            };
        });

        $middleware->redirectUsersTo(function(){
            return route('index');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
