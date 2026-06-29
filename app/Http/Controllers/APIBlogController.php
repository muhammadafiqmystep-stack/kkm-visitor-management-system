<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class APIBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return response()->json([
            'message' => 'Successfully retrieved blogs',
            'data' => $blogs
        ]);
    }

    public function show(Blog $blog)
    {
        return response()->json([
            'message' => 'Successfully retrieved blog',
            'data' => $blog
        ]);
    }

    public function delete(Blog $blog)
    {
        $blog->delete();
        return response()->json([
            'message' => 'Successfully deleted blog',
            'data' => $blog
        ]);
    }
}
