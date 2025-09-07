<?php
    $file = __DIR__ . "/tem_query.php";

    if (file_exists($file)) {
        include_once $file;
    } else {
        echo $file . " not exists!";
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>To-Do App</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
        <style>
            body { margin-top: 20px; }
            .task-card {
            border: 1px solid #ececec; padding: 20px; border-radius: 5px;
            background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            .task { color: #333; }
            .task-done { text-decoration: line-through; color: #888; }
            .task-item {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="task-card">
                <h1>To-Do App</h1>

                <!-- Add Task Form -->
                <form method="POST">
                    <div class="row">
                        <div class="column column-75">
                            <input type="text" name="inputData" placeholder="Enter a new task" required>
                        </div>
                        <div class="column column-25">
                            <button type="submit" class="button-primary">Add Task</button>
                        </div>
                    </div>
                </form>

                <!-- Task List -->
                <h2>Task List</h2>
                <ul style="list-style: none; padding: 0;">
                    <?php if (empty($inputData)): ?>
                        <li>No tasks yet. Add one above!</li>
                    <?php else: ?>
                        <?php foreach ($inputData as $index => $values): ?>
                        <li class="task-item">
                            <!-- Toggle Form -->
                            <form method="POST" style="flex-grow: 1;">
                            <input type="hidden" name="toggle" value="<?= $index ?>">
                            <button type="submit" style="border: none; background: none; cursor: pointer; text-align: left; width: 100%;">
                                <span class="<?= $values['bool'] ? 'task-done' : 'task' ?>">
                                <?= htmlspecialchars($values['inputData']) ?>
                                </span>
                            </button>
                            </form>

                            <!-- Delete Form -->
                            <form method="POST">
                            <input type="hidden" name="delete" value="<?= $index ?>">
                            <button type="submit" class="button button-outline">Delete</button>
                            </form>
                        </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </body>
</html>
