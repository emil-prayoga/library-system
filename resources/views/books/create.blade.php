@extends('layouts.app')

@section('title', 'Create Book')

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="{{ route('books.index') }}" style="color: #3b82f6; text-decoration: none;">&larr; Back to Books</a>
</div>

<div class="card" style="max-width: 600px;">
    <h1 style="margin-top: 0;">Add New Book</h1>
    
    <form method="POST" action="{{ route('admin.books.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label">Title *</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')<span style="color: #dc2626;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Author *</label>
            <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
            @error('author')<span style="color: #dc2626;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">ISBN *</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}" required>
            @error('isbn')<span style="color: #dc2626;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Category *</label>
            <input type="text" name="category" class="form-control" value="{{ old('category') }}" required>
            @error('category')<span style="color: #dc2626;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Published Date</label>
            <input type="date" name="published_date" class="form-control" value="{{ old('published_date') }}">
            @error('published_date')<span style="color: #dc2626;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            @error('description')<span style="color: #dc2626;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label">Stock *</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', 1) }}" required min="1">
            @error('stock')<span style="color: #dc2626;">{{ $message }}</span>@enderror
        </div>

        <div style="display: flex; gap: 0.5rem;">
            <button type="submit" class="btn btn-primary">Create Book</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection