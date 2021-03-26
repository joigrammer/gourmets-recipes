<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RationController extends Controller
{
    public function index()
    {
        return view('rations.index');
    }

    public function create(Request $request)
    {
        $ration = $request->get('ration'); 
        return view('rations.create', compact('ration'));
    }

    public function store(Request $request)
    {
        // TODO: Seguir la lógica de negocio
        dd($request->get('ration'));
    }
}
