<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\VisitorExport;
use Maatwebsite\Excel\Facades\Excel;

class VisitorController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
        $this->middleware('permission:index visitors', ['only'=>['index']]);
        $this->middleware('permission:create visitors', ['only'=>['create','store']]);
        $this->middleware('permission:edit visitors', ['only'=>['edit','update']]);
        $this->middleware('permission:soft delete visitors', ['only'=>['delete']]);
        $this->middleware('permission:restoreDelete visitors', ['only'=>['restore', 'forceDelete']]);
    }

    public function index()
    {
        //query from table 'visitor' using model Visitor
        $visitors = Visitor::all();
        $deletedVisitors = Visitor::onlyTrashed()->get();

        //return to views - resources/views/visitors/index.blade.php
        return view('visitors.index', compact('visitors', 'deletedVisitors'));
    }

    public function create() 
    {
        // return to views - resources/views/visitors/create.blade.php
        return view('visitors.create');
    }

    public function store(Request $request)
    {
        //store data to table 'visitors' using model Visitor Method POPO
        $visitor = new Visitor();
        $visitor->name = $request->name;
        $visitor->phone = $request->phone;
        $visitor->email = $request->email;
        $visitor->save();

        auth()->user()->notify(new \App\Notifications\VisitorCreatedNotification());
        //redirect to visitors.index
        return redirect()->route('visitors.index');
        
    }

    public function show(Visitor $visitor)
    {
        // return to views - resources/views/visitors/show.blade.php
        return view('visitors.show', compact('visitor'));
    }

    public function edit(Visitor $visitor)
    {
        // return to views - resources/views/visitors/edit.blade.php
        return view('visitors.edit', compact('visitor'));
    }

    public function update(Visitor $visitor, Request $request)
    {
        //update data to table 'visitors' using Model Visitor Method POPO
        $visitor->name = $request->name;
        $visitor->phone = $request->phone;
        $visitor->email = $request->email;
        $visitor->save();

        // redirect to visitors.index
        return redirect()->route('visitors.index');
    }

    public function delete(Visitor $visitor)
    {
        //delete visitor
        $visitor->delete();
        
        auth()->user()->notify(new \App\Notifications\VisitorDeletedNotification());
        return redirect()->route('visitors.index');
    }

    public function restore($visitor)
    {
        $visitor = \App\Models\Visitor::onlyTrashed()->find($visitor);
        //restore visitor
        $visitor->restore();

        return redirect()->route('visitors.index');
    }

    public function forceDelete($visitor)
    {
        $visitor = \App\Models\Visitor::onlyTrashed()->find($visitor);
        //force delete visitor
        $visitor->forceDelete();
        
        return redirect()->route('visitors.index');
    }

    public function download(Visitor $visitor)
    {
        $pdf = Pdf::loadView('visitors.pdf', compact('visitor'));
        $pdf->setPaper('a4', 'landscape');
        //password
        //$pdf->setEncryption("12345","56789");
        //$pdf->setEncryption("userPassword","adminPassword");

        return $pdf->download('visitor-'.$visitor->id.'-pass.pdf');
    }

    public function export()
    {
        return Excel::download(new VisitorExport(), 'visitors-export.xlsx');
    }
}
