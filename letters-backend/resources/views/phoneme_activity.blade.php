<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phoneme Activities</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --danger: #ef4444;
            --danger-dark: #dc2626;
            --success: #10b981;
            --success-dark: #059669;
            --bg-light: #f9fafb;
            --bg-white: #ffffff;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --border: #e5e7eb;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        
        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.5;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        h1 {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        
        .phoneme-tree {
            background-color: var(--bg-white);
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .phoneme-tree-header {
            display: grid;
            grid-template-columns: 100px 1fr 1fr 200px;
            background-color: var(--primary);
            color: white;
            padding: 1rem;
            font-weight: 600;
        }
        
        .phoneme-item {
            display: grid;
            grid-template-columns: 100px 1fr 1fr 200px;
            border-bottom: 1px solid var(--border);
            align-items: center;
            transition: background-color 0.2s;
        }
        
        .phoneme-item:hover {
            background-color: rgba(79, 70, 229, 0.05);
        }
        
        .phoneme-item > div {
            padding: 1rem;
        }
        
        .phoneme-char {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-align: center;
            background-color: rgba(79, 70, 229, 0.1);
            border-right: 1px solid var(--border);
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .phoneme-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .btn-edit {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-edit:hover {
            background-color: var(--primary-dark);
        }
        
        .btn-delete {
            background-color: var(--danger);
            color: white;
        }
        
        .btn-delete:hover {
            background-color: var(--danger-dark);
        }
        
        .edit-form {
            display: none;
            grid-template-columns: 100px 1fr 1fr 200px;
            padding: 1rem;
            background-color: rgba(79, 70, 229, 0.05);
            border-bottom: 1px solid var(--border);
        }
        
        .edit-form > div {
            padding: 0 1rem;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .form-group label {
            font-weight: 500;
            color: var(--text-dark);
        }
        
        .form-control {
            padding: 0.5rem;
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .btn-save {
            background-color: var(--success);
            color: white;
        }
        
        .btn-save:hover {
            background-color: var(--success-dark);
        }
        
        .btn-cancel {
            background-color: white;
            border: 1px solid var(--border);
        }
        
        .btn-cancel:hover {
            background-color: var(--bg-light);
        }
        
        .alert {
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }
        
        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid var(--success);
            color: var(--success-dark);
        }
        
        .alert-error {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--danger);
            color: var(--danger-dark);
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--text-light);
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Phoneme Activities</h1>
        </header>
        
        <!-- Display the success or error message -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
        @endif
        
        <div class="phoneme-tree">
            <div class="phoneme-tree-header">
                <div>Phoneme</div>
                <div>Type</div>
                <div>Examples</div>
                <div>Actions</div>
            </div>
            
            @if(count($activities) > 0)
                @foreach($activities as $activity)
                    <div class="phoneme-item" id="item-{{ $activity->id }}">
                        <div class="phoneme-char">{{ $activity->phoneme->char }}</div>
                        <div class="phoneme-type">{{ $activity->type }}</div>
                        <div class="phoneme-examples">{{ $activity->examples }}</div>
                        <div class="phoneme-actions">
                            <button class="btn btn-edit" onclick="showEditForm('{{ $activity->id }}')">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('phoneme-activities.destroy', $activity->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this activity?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="edit-form" id="edit-form-{{ $activity->id }}">
                        <div class="phoneme-char">{{ $activity->phoneme->char }}</div>
                        <div>
                            <form action="{{ route('phoneme-activities.update', $activity->id) }}" method="POST" class="form-group">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="type-{{ $activity->id }}">Type</label>
                                    <input type="text" id="type-{{ $activity->id }}" name="type" value="{{ $activity->type }}" class="form-control">
                                </div>
                        </div>
                        <div>
                                <div class="form-group">
                                    <label for="examples-{{ $activity->id }}">Examples</label>
                                    <input type="text" id="examples-{{ $activity->id }}" name="examples" value="{{ $activity->examples }}" class="form-control">
                                </div>
                        </div>
                        <div>
                                <div class="form-actions">
                                    <button type="button" class="btn btn-cancel" onclick="hideEditForm('{{ $activity->id }}')">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-save">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="fas fa-search fa-3x"></i>
                    <p>No phoneme activities found</p>
                </div>
            @endif
        </div>
    </div>
    
    <script>
        function showEditForm(id) {
            document.getElementById('item-' + id).style.display = 'none';
            document.getElementById('edit-form-' + id).style.display = 'grid';
        }
        
        function hideEditForm(id) {
            document.getElementById('item-' + id).style.display = 'grid';
            document.getElementById('edit-form-' + id).style.display = 'none';
        }
    </script>
</body>
</html>