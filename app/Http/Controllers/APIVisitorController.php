<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

class APIVisitorController extends Controller
{
    public function index()
    {
        $visitors = Visitor::all();
        return response()->json([
            'message' => 'Successfully retrieved visitors',
            'data' => $visitors
        ]);
    }

    public function show(Visitor $visitor)
    {
        return response()->json([
            'message' => 'Successfully retrieved visitor',
            'data' => $visitor
        ]);
    }

    public function delete(Visitor $visitor)
    {
        $visitor->delete();
        return response()->json([
            'message' => 'Successfully deleted visitor',
            'data' => $visitor
        ]);
    }

    public function store(Request $request)
    {
        $visitor = new Visitor();
        $visitor->name = $request->name;
        $visitor->phone = $request->phone;
        $visitor->email = $request->email;
        $visitor->save();
        return response()->json([
            'message' => 'Successfully store visitor',
            'data' => $visitor
        ]);
    }

    public function edit(Visitor $visitor, Request $request)
    {
        $visitor->name = $request->name;
        $visitor->phone = $request->phone;
        $visitor->email = $request->email;
        $visitor->save();
        return response()->json([  
            'message' => 'Successfully edit visitor',
            'data' => $visitor
        ]);
    }
}
