<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ReportsController extends Controller
{
    public function index()
    {

        // dd(123);
        return Inertia::render('Reports/Index');
    }
}
