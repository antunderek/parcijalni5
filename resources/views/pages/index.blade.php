@extends('layouts.default')
@section('content')


<div class="container">
  <div class="card">
    <div class="card-body">
    
        <table class="table is-fullwidth">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Completed</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($todos as $todo)
            <tr>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->description }}</td>
                <td>
                    @if ($todo->completed)
                        YES
                    @else
                        NO
                    @endif
                </td>
                <td><a href="{{ route('todo.edit', $todo->id) }}">Edit</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('todo.create') }}">
        <button class="btn btn-primary">
            New
        </button>
        </a>
    </div>
  </div>
</div>

@stop