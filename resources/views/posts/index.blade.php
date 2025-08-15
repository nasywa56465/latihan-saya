@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Post Management</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Post Create/Edit Form -->
        <div class="card mb-4 shadow-sm"><!-- Tambah shadow untuk efek -->
            <div class="card-header">Add / Edit Post</div>
            <div class="card-body">
                <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($post))
                        @method('PUT')
                    @endif

                    <!-- Row untuk form agar responsif -->
                    <div class="row g-3"><!-- Tambah row dengan gap -->
                        <div class="col-md-6">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $post->title ?? old('title') }}">
                        </div>

                        <div class="col-md-6">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ $post->slug ?? old('slug') }}" required>
                        </div>

                        <div class="col-12">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" class="form-control" rows="4" required>{{ $post->content ?? old('content') }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="published_at" class="form-label">Published At</label>
                            <input type="datetime-local" name="published_at" class="form-control"
                                value="{{ isset($post->published_at) ? \Carbon\Carbon::parse($post->published_at)->format('Y-m-d\TH:i') : old('published_at') }}"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" {{ isset($post) ? '' : 'required' }}>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ isset($post) ? 'Update' : 'Create' }}</button>
                            @if(isset($post))
                                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Post Table -->
        <div class="card shadow-sm"><!-- Tambah shadow untuk efek -->
            <div class="card-header">Post List</div>
            <div class="card-body">
                <!-- Tambahkan table-responsive agar tabel bisa discroll di layar kecil -->
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Slug</th>
                                <th>Published At</th>
                                <th>Creator</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $index => $post)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-thumbnail"
                                            style="max-width: 100px;">
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td class="text-truncate" style="max-width: 200px;">{{ $post->content }}</td>
                                    <td>{{ $post->slug }}</td>
                                    <td>{{ $post->published_at }}</td>
                                    <td>{{ $post->creator?->name }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No posts found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection