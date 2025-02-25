<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with(['children', 'parent'])->whereNull('parent_id')->get();
        return response()->json($pages);
    }

    // Create a new page
    public function store(Request $request)
    {
        $data = $request->validate([
            'parent_id' => 'nullable|exists:pages,id',
            'slug'      => 'required|string',
            'title'     => 'required|string',
            'content'   => 'nullable|string'
        ]);

        $page = Page::create($data);
        return response()->json($page, 201);
    }

    // Retrieve a page based on dynamic route
    public function show(...$segments)
    {
        $page = null;
        foreach ($segments as $slug) {
            $page = Page::where('slug', $slug)
                ->first();

            if (!$page) {
                return response()->json(['error' => 'Page not found'], 404);
            }
        }

        return response()->json($page);
    }
}
