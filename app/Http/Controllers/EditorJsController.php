<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorJsController extends Controller
{
    public function uploadFile(Request  $request)
    {
        return $request->file('file')->store('homework');
    }
}
