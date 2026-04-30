<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        //query from table 'blogs' using model Blog
        $blogs = \App\Models\Blog::all();

        //return to views - resources/views/blogs/index.blade.php
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        // return to views - resources/views/blogs/create.blade.php
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        //store data to table 'blogs' using model Blog Method POPO
        $blog = new \App\Models\Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->author = $request->author;
        $blog->genre = $request->genre;
        $blog->save();

        //redirect to blogs.index
        return redirect()->route('blogs.index');
    }

    public function show(\App\Models\Blog $blog)
    {
        // return to views - resources/views/blogs/show.blade.php
        return view('blogs.show', compact('blog'));
    }

    public function edit(\App\Models\Blog $blog)
    {
        // return to views - resources/views/blogs/edit.blade.php
        return view('blogs.edit', compact('blog'));
    }

    public function update(\App\Models\Blog $blog, Request $request)
    {
        //update data to table 'blogs' using Model Blog Method POPO
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->author = $request->author;
        $blog->genre = $request->genre;
        $blog->save();

        // redirect to blogs.index
        return redirect()->route('blogs.index');
    }

    public function delete(\App\Models\Blog $blog)
    {
        //delete blog
        $blog->delete();

        return redirect()->route('blogs.index');
    }
}
