<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RationController extends Controller
{
    public function index()
    {
        return view('rations.index');
    }
}
