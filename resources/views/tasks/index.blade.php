@extends('main-layout')
@section('title', 'Tasks List')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="container">
        <div class="text-center">
            <h1>Tasks List</h1>
        </div>

        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Assigned Name</th>
                        <th scope="col">Admin Name</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->assignedToUser->name }}</td>
                            <td>{{ $task->assignedByUser->name }}</td>
                        </tr>
                    @empty
                        <div class="alert alert-info" role="alert">
                            No Tasks Found!.
                        </div>
                    @endforelse
                </tbody>
            </table>
            {{ $tasks->links() }}
        </div>

    </div>
@endsection
