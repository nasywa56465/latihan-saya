@extends('layouts.app')

@section('content')
<div class="container">
    <h2>User Management</h2>

    {{-- User Create/Edit Form --}}
    <div class="card mb-4">
        <div class="card-header">Add / Edit User</div>
        <div class="card-body">
            <form method="POST" action="{{ isset($editUser) ? route('users.update', $editUser->id) : route('users.store') }}">
                @csrf
                @if(isset($editUser))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $editUser->name ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $editUser->email ?? '') }}" required>
                </div>
                @if(!isset($editUser))
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                @endif
                <button type="submit" class="btn btn-primary">{{ isset($editUser) ? 'Update' : 'Create' }}</button>
                @if(isset($editUser))
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                @endif
            </form>
        </div>
    </div>

    {{-- User Table --}}
    <div class="card">
        <div class="card-header">User List</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($data as $index => $user)
                     <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No users found.</td>
                    </tr>
                 
                  
                    @endforelse
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>
</div>
@endsection