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
}
