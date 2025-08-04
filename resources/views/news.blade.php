
@extends('layout')

@section('content')
<h1>News Aggregator</h1>

<form method="GET" class="row mb-3">
    <div class="col-md-3">
        <select name="category_id" class="form-control">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select name="source_id" class="form-control">
            <option value="">All Sources</option>
            @foreach($sources as $src)
                <option value="{{ $src->id }}" {{ request('source_id') == $src->id ? 'selected' : '' }}>
                    {{ $src->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <input type="text" name="search" placeholder="Search..." class="form-control" value="{{ request('search') }}">
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100">Filter</button>
    </div>
</form>

@foreach ($articles as $article)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $article->title }}</h5>
            <p>{{ Str::limit($article->content, 150) }}</p>
            <p>
                <strong>Category:</strong> {{ $article->category->name ?? 'N/A' }},
                <strong>Source:</strong> {{ $article->source->name ?? 'N/A' }},
                <strong>Published:</strong> {{ $article->created_at->diffForHumans() }}
            </p>
        </div>
    </div>
@endforeach

{{ $articles->links() }}
@endsection
