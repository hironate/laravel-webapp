<?php

namespace App\Http\Controllers;

use App\Events\HelloWorld;
use Illuminate\Http\RedirectResponse;

class HelloWorldController extends Controller
{
    public function store(): RedirectResponse
    {
        HelloWorld::dispatch();

        return back()->with(
            'status',
            'Hello World event queued. Run `php artisan queue:work` to process it.',
        );
    }
}
