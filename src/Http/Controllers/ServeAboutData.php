<?php

namespace LearnKit\ExposeAbout\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;

class ServeAboutData extends Controller
{
    public function __invoke(): array
    {
        Artisan::call('about', [
            '--json' => true,
        ]);

        $output = Artisan::output();

        return [
            'data' => $output,
        ];
    }
}