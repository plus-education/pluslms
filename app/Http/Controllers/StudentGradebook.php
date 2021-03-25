<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentGradebook extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Gradebook');
    }
}
