<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Tasks') }}
        </h2>
    </x-slot>

    <style>
        .task-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .btn-create {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 24px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(118, 75, 162, 0.3);
            transition: all 0.3s ease;
        }
        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(118, 75, 162, 0.4);
        }
        .task-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
        .task-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid rgba(255,255,255,0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .task-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        .task-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
        }
        .status-Pending::before { background: #f6ad55; }
        .status-Completed::before { background: #68d391; }
        
        .task-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 10px;
        }
        .task-desc {
            color: #718096;
            font-size: 0.95rem;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        .task-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: #a0aec0;
            margin-bottom: 20px;
        }
        .task-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
        }
        .status-badge-Pending { background: #feebc8; color: #c05621; }
        .status-badge-Completed { background: #c6f6d5; color: #276749; }
        
        .task-actions {
            display: flex;
            gap: 10px;
            border-top: 1px solid #edf2f7;
            padding-top: 15px;
        }
        .btn-edit {
            color: #4299e1;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: color 0.2s;
        }
        .btn-edit:hover { color: #2b6cb0; }
        .btn-delete {
            color: #f56565;
            background: none;
            border: none;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: color 0.2s;
        }
        .btn-delete:hover { color: #c53030; }
        .empty-state {
            text-align: center;
            padding: 50px;
            color: #a0aec0;
            grid-column: 1 / -1;
        }
    </style>

    <div class="task-container">
        @if (session('success'))
            <div style="background: #c6f6d5; color: #276749; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-weight: 600;">
                {{ session('success') }}
            </div>
        @endif

        <div class="task-header">
            <h3 style="font-size: 1.5rem; font-weight: 700; color: #2d3748;">Your Tasks</h3>
            <a href="{{ route('tasks.create') }}" class="btn-create">+ New Task</a>
        </div>

        <div class="task-grid">
            @forelse ($tasks as $task)
                <div class="task-card status-{{ $task->status }}">
                    <div class="task-title">{{ $task->title }}</div>
                    <div class="task-desc">{{ $task->description ?? 'No description provided.' }}</div>
                    
                    <div class="task-meta">
                        <span class="task-status status-badge-{{ $task->status }}">
                            {{ $task->status }}
                        </span>
                        @if($task->due_date)
                            <span>📅 {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</span>
                        @endif
                    </div>

                    <div class="task-actions">
                        <a href="{{ route('tasks.edit', $task) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Are you sure you want to delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <h4 style="font-size: 1.2rem; color: #4a5568; margin-bottom: 10px;">No tasks found!</h4>
                    <p>You have no tasks pending. Enjoy your free time or create a new task.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
