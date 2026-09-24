<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Choco Cookies - Task Manager</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f7efe8;
            color: #3d2418;
        }

        .navbar {
            background: #4b2618;
            color: white;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 25px;
        }

        .container {
            width: 84%;
            margin: 40px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h2 {
            font-size: 28px;
        }

        .add-btn {
            background: #8b4a2f;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
        }

        .add-btn:hover {
            background: #69351f;
        }

        .alert {
            background: #dff0d8;
            color: #27632a;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #6b351f;
            color: white;
            padding: 15px;
            text-align: left;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #faf5f0;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
            padding: 6px 10px;
            border-radius: 15px;
            font-size: 13px;
        }

        .completed {
            background: #d4edda;
            color: #155724;
            padding: 6px 10px;
            border-radius: 15px;
            font-size: 13px;
        }

        .edit-btn {
            background: #c88a3d;
            color: white;
            padding: 7px 12px;
            text-decoration: none;
            border-radius: 6px;
        }

        .delete-btn {
            background: #b83232;
            color: white;
            padding: 7px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #777;
        }

        @media (max-width: 700px) {

            .header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .container {
                width: 94%;
            }

        }

    </style>

</head>

<body>

<nav class="navbar">

    <h1>🍪 Choco Cookies</h1>

    <span>Personal Task Manager</span>

</nav>

<div class="container">

    <div class="header">

        <h2>My Tasks</h2>

        <a
            href="{{ route('tasks.create') }}"
            class="add-btn">
            + Add Task
        </a>

    </div>

    @if(session('success'))

        <div class="alert">
            {{ session('success') }}
        </div>

    @endif

    <div class="table-container">

        @if($tasks->count() > 0)

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($tasks as $task)

                        <tr>

                            <td>
                                {{ $task->id }}
                            </td>

                            <td>
                                <strong>
                                    {{ $task->task_name }}
                                </strong>
                            </td>

                            <td>
                                {{ $task->description ?? 'No description' }}
                            </td>

                            <td>

                                @if($task->status === 'Completed')

                                    <span class="completed">
                                        Completed
                                    </span>

                                @else

                                    <span class="pending">
                                        Pending
                                    </span>

                                @endif

                            </td>

                            <td>

                                @if($task->due_date)

                                    {{ $task->due_date->format('M d, Y') }}

                                @else

                                    No due date

                                @endif

                            </td>

                            <td>

                                <a
                                    href="{{ route('tasks.edit', $task->id) }}"
                                    class="edit-btn">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('tasks.destroy', $task->id) }}"
                                    method="POST"
                                    style="display:inline;">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this task?')">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty">

                <h3>No tasks yet 🍪</h3>

                <p>
                    Click "Add Task" to create your first task.
                </p>

            </div>

        @endif

    </div>

</div>

</body>

</html>