<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        //query from table 'visitor' using model Visitor
        $visitors = \App\Models\Visitor::all();

        //return to views - resources/views/visitors/index.blade.php
        return view('visitors.index', compact('visitors'));
    }

    public function create() 
    {
        // return to views - resources/views/visitors/create.blade.php
        return view('visitors.create');
    }

    public function store(Request $request)
    {
        //store data to table 'visitors' using model Visitor Method POPO
        $visitor = new \App\Models\Visitor();
        $visitor->name = $request->name;
        $visitor->phone = $request->phone;
        $visitor->email = $request->email;
        $visitor->save();

        //redirect to visitors.index
        return redirect()->route('visitors.index');
        
    }
}
