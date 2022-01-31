<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function install(Request $request)
    {
        Artisan::call("migrate",['--force'=>true]);
        return response(Artisan::output());
    }

    public function systemRestore(Request $request)
    {
        Artisan::call("migrate:fresh",['--force'=>true]);
        return response(Artisan::output());
    }
}
