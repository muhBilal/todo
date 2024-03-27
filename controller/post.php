<?php
require_once 'config/connection.php';
function addTodoItem($message) {
    global $conn;
    $sql = "INSERT INTO todo (message) VALUES (?)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $message);
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}
function getAllTodoItems() {
    global $conn;
    $sql = "SELECT * FROM todo";
    $result = $conn->query($sql);
    $todo_items = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $todo_items[] = $row;
        }
    }
    return $todo_items;
}
function deleteTodoItem($id) {
    global $conn;
    $sql = "DELETE FROM todo WHERE id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}

?>
