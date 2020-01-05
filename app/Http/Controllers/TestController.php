<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;

class TestController extends Controller
{
    public function test(TestRequest $request)
    {
        \Log::info('controller line one');

        $validated = $request->validated();

        \Log::info('controller after validated()');

        \Log::info($validated);

    }
}
