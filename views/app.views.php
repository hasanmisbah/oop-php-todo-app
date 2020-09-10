<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Todo App</title>
</head>

<body>
<section class="todoapp">
    <header class="header">
        <h1>todos</h1>
        <input class="new-todo" placeholder="What needs to be done?" autofocus="">
    </header>
    <section class="main" style="display: block;">
        <input id="toggle-all" class="toggle-all" type="checkbox">
        <label for="toggle-all">Mark all as complete</label>
        <ul class="todo-list">
            <?php foreach ($todos as $todo): ?>

                <li>
                    <div class="view">
                        <input data-id="<?= $todo['id'] ?>" class="toggle"
                               type="checkbox" <?= $todo['completed'] ? 'checked' : '' ?>>
                        <label><?= $todo['task'] ?></label>
                        <button data-id="<?= $todo['id'] ?>" class="destroy"></button>
                    </div>
                    <input data-id="<?= $todo['id'] ?>" class="edit" value="<?= $todo['task'] ?>">
                </li>

            <?php endforeach; ?>
        </ul>
    </section>
    <footer class="footer" style="display: block;">
        <span class="todo-count"><strong></strong> items left</span>
        <ul class="filters">
            <li>
                <a data-value="all" class="selected" href="#">All</a>
            </li>
            <li>
                <a data-value="active" href="#">Active</a>
            </li>
            <li>
                <a data-value="complete" href="#">Completed</a>
            </li>
        </ul>
        <button class="clear-completed">Clear completed</button>
    </footer>
</section>

<script src="public/js/jquery.min.js"></script>
<script src="public/js/script.js"></script>
</body>

</html>
