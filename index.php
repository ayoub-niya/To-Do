<?php

    include 'connect.php';

    $query = "SELECT * FROM task";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $task = $_POST['task'];
        
        if (!empty($task)) {

            $query = "INSERT INTO task(task) VALUES(:task)";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(":task", $task);
            $stmt->execute();
            
            header('Location: index.php');
            exit();
        }
        
    }
    
    if (isset($_GET['taskId'])) {

        $id = $_GET['taskId'];
        $query = "DELETE FROM task WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        header('Location: index.php');
    }

    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Todo</title>
</head>
<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <input type="text" name="task">
            <input type="submit" value="Add">
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Task</th>    
                <th>Action</th>
            </tr>
            <?php $i = 1; foreach($todos as $id => $todo): ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $todo['task'] ?></td>
                <td><a href="index.php?taskId=<?php echo $todo['id'] ?>">Delete</a></td>
            </tr>
            <?php $i++; endforeach; ?>
        </table>
    </div>
</body>
</html>

