@extends('main-layout')
@section('title', 'Tasks Statistics')
@section('content')

    <div class="container">
        <h1 class="text-center">Tasks Statistics</h1>
        <div class="text-center">
            <a class="btn btn-primary" href="{{ route('tasks.index') }}">Tasks List</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Task Count</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($topTasks as $task)
                    <tr>
                        <td>{{ $task->assignedToUser->id }}</td>
                        <td>{{ $task->assignedToUser->name }}</td>
                        <td>{{ $task->task_count }}</td>
                    </tr>
                @empty
                    <div class="alert alert-info" role="alert">
                        No Tasks Found!.
                    </div>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
