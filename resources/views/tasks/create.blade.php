@extends('main-layout')
@section('title', 'Create New Task')
@section('content')
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="container">
            <h1 class="text-center">Create New Task</h1>
            <div class="row">
                <div class="mb-3">
                    <label for="assigned_by_id" class="form-label">Admin Name</label>
                    <select class="form-select" id="assigned_by_id" name="assigned_by_id">
                        <option selected disabled>Admin name</option>
                        @foreach ($adminUsers as $id => $name)
                            <option value="{{ $id }}">{{ $id }} - {{ $name }}</option>
                        @endforeach
                    </select>
                    @error('assigned_by_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="title" class="form-control" id="title" name="title" placeholder="Title">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" rows="5" id="description" name="description" placeholder="Description"></textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="assigned_to_id" class="form-label">Assigned User</label>
                    <select class="form-select" id="assigned_to_id" name="assigned_to_id">
                        <option selected disabled>Assigned User</option>
                        @foreach ($nonAdminUsers as $id => $name)
                            <option value="{{ $id }}">{{ $id }} - {{ $name }}</option>
                        @endforeach
                    </select>
                    @error('assigned_to_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
