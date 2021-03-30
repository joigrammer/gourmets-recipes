<?php

namespace App\Http\Controllers;

use App\Models\Ration;
use Illuminate\Http\Request;
use App\Http\Requests\RationStoreRequest;

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

    public function store(RationStoreRequest $request)
    {      
        $ration_id = $request->get('ration');
        $ration = Ration::find($ration_id);
        $ration->users()->attach([[                
            'rations' => $request->get('rations'),                
            'user_id' => \auth()->user()->id
        ]]);
        $ration->save();
        return redirect()->route('rations.schedule');
    }
}
