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

    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->author = $request->author;
        $blog->genre = $request->genre;
        $blog->save();
        return response()->json([
            'message' => 'Successfully store blog',
            'data' => $blog
        ]);
    }

    public function edit(Blog $blog, Request $request)
    {
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->author = $request->author;
        $blog->genre = $request->genre;
        $blog->save();
        return response()->json([
            'message' => 'Successfully edit blog',
            'data' => $blog
        ]);
    }
}
