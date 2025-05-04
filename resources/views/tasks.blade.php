
@foreach ($tasks as $task)

    <div>
        <h3>{{ $task->title }}</h3>
        <p>Due: {{ $task->due_date->format('M d, Y') }}</p>
        <p>Status: {{ $task->is_completed ? '✅ Done' : '❌ Not Done' }}</p>

        @if (!$task->is_completed)
            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @method('PUT')
                @csrf
                <button type="submit">Mark as Done</button>
            </form>
        @endif

        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach

<a href="">Create Task</a>
