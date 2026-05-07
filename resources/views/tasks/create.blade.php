<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>

    <style>
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-label {
            display: block;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
        }
        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
            background: #f8fafc;
        }
        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
            background: white;
        }
        textarea.form-input {
            resize: vertical;
            min-height: 120px;
        }
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(118, 75, 162, 0.3);
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(118, 75, 162, 0.4);
        }
        .error-message {
            color: #e53e3e;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }
    </style>

    <div class="form-container">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="title" class="form-label">Task Title</label>
                <input type="text" name="title" id="title" class="form-input" value="{{ old('title') }}" required autofocus placeholder="What needs to be done?">
                @error('title')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description (Optional)</label>
                <textarea name="description" id="description" class="form-input" placeholder="Add more details about this task...">{{ old('description') }}</textarea>
                @error('description')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="display: flex; gap: 20px;">
                <div style="flex: 1;">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-input" required>
                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div style="flex: 1;">
                    <label for="due_date" class="form-label">Due Date (Optional)</label>
                    <input type="date" name="due_date" id="due_date" class="form-input" value="{{ old('due_date') }}">
                    @error('due_date')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn-submit">Create Task</button>
            
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('tasks.index') }}" style="color: #718096; text-decoration: none; font-size: 0.9rem;">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
