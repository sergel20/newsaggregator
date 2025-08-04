<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Source;
class NewsController extends Controller
{
     public function feed(Request $request)
    {
        $query = Article::query();

        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by source
        if ($request->has('source_id')) {
            $query->where('source_id', $request->source_id);
        }

        // Search
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('content', 'like', '%'.$request->search.'%');
            });
        }

        $articles = $query->latest()->paginate(10);
        $categories = Category::all();
        $sources = Source::all();

        return view('news', compact('articles', 'categories', 'sources'));
    }
}

