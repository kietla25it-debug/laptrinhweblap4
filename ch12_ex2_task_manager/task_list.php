<!DOCTYPE html>
<html>
<head>
    <title>Task List Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <header>
        <h1>Task List Manager</h1>
    </header>
    <main>
        <p><?php echo "Session ID: " . session_id(); ?></p>

        <h2>Tasks</h2>
        <?php if (empty($_SESSION['task_list'])) : ?>
            <p>There are no tasks in the task list.</p>
        <?php else : ?>
            <ul>
                <?php foreach ($_SESSION['task_list'] as $id => $task) : ?>
                    <li>
                        <span><?php echo htmlspecialchars($task); ?></span>
                        <form action="index.php" method="post" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="taskid" value="<?php echo $id; ?>">
                            <input type="submit" value="Delete Task">
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <h2>Add Task</h2>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="add">
            <label>Task:</label>
            <input type="text" name="newtask">
            <input type="submit" value="Add Task">
        </form>
    </main>
</body>
</html>