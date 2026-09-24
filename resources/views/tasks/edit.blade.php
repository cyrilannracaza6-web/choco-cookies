<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Task - Choco Cookies</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f7efe8;
            color: #3d2418;
        }

        .container {
            width: 600px;
            max-width: 90%;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h1 {
            margin-bottom: 25px;
            color: #4b2618;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 15px;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        .buttons {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        .update-btn {
            background: #6b351f;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 7px;
            cursor: pointer;
        }

        .back-btn {
            background: #ddd;
            color: #333;
            padding: 12px 20px;
            border-radius: 7px;
            text-decoration: none;
        }

        .errors {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>✏️ Edit Task</h1>

    @if($errors->any())

        <div class="errors">

            <strong>Please fix the following:</strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form
        action="{{ route('tasks.update', $task->id) }}"
        method="POST">

        @csrf

        @method('PUT')

        <label for="task_name">
            Task Name
        </label>

        <input
            type="text"
            id="task_name"
            name="task_name"
            value="{{ old('task_name', $task->task_name) }}"
            required
        >

        <label for="description">
            Description
        </label>

        <textarea
            id="description"
            name="description"
        >{{ old('description', $task->description) }}</textarea>

        <label for="status">
            Status
        </label>

        <select
            id="status"
            name="status">

            <option
                value="Pending"
                {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option
                value="Completed"
                {{ old('status', $task->status) === 'Completed' ? 'selected' : '' }}>
                Completed
            </option>

        </select>

        <label for="due_date">
            Due Date
        </label>

        <input
            type="date"
            id="due_date"
            name="due_date"
            value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
        >

        <div class="buttons">

            <button
                type="submit"
                class="update-btn">
                Update Task
            </button>

            <a
                href="{{ route('tasks.index') }}"
                class="back-btn">
                Cancel
            </a>

        </div>

    </form>

</div>

</body>

</html>