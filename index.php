<?php
require_once 'config/connection.php';
require_once 'controller/post.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['newitem'])) {
    $newItem = $_POST['newitem'];
    if (empty($newItem)) {
        echo "Please enter a valid todo item.";
        exit();
    }
    echo "Todo item successfully added! $newItem";

    if (addTodoItem($newItem)) {
        echo "Todo item successfully added!";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Failed to add todo item!";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];
    if (deleteTodoItem($deleteId)) {
        echo "Todo item successfully deleted!";
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Failed to delete todo item!";
    }
}

$todo_items = getAllTodoItems();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="/public/style/style.css">
    <script src="/public/script/script.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<main id="todolist">
    <div id="name"></div>

    <h1>Todo List <span>Get things done, one item at a time.</span></h1>

    <ul>
        <?php foreach ($todo_items as $todo): ?>
            <li>
                <span class="label"><?php echo $todo['message']; ?></span>
                <div class="actions">
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $todo['id']; ?>">
                        <button type="submit" class="btn-delete" aria-label="Delete" title="Delete">
                            <i aria-hidden="true" class="material-icons">Hapus</i>
                        </button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <form method="post" name="form">
        <label for="item">Add to the todo list</label>
        <input type="text" name="newitem" id="item">
        <button type="submit">Add item</button>
    </form>

    <script>
        $(document).ready(function() {
            var name = document.cookie.replace(/(?:(?:^|.*;\s*)name\s*\=\s*([^;]*).*$)|^.*$/, "$1");
            if(!name || name === "" || name === "null"){
                alert('halo selamat datang di todo list!');
                name = prompt('What is your name?');
                document.cookie = "name=" + name + ";max-age=" + 60 * 10;
            }
            $('#name').text('Hello, ' + name + '!');
        });
    </script>
</main>
</body>
</html>
