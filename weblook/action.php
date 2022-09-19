<?php
$connect = new PDO("mysql:host=localhost;dbname=weblook;charset=utf8", "root", "");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();

if ($received_data->action == 'insertTodo') {
    $data = array(
        ':desc' => $received_data->ntodoDesc,
        ':status' => $received_data->ntodostatus
    );
    $query = "
 INSERT INTO todolist (todoDescription,status) VALUES (:desc,:status)
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);
    $output = array(
        'message' => 'Data Updated'
    );
    echo json_encode($output);
}

if ($received_data->action == 'editTodo') {
    $data = array(
        ':todoId' => $received_data->todoID,
        ':todoDescription' => $received_data->todoDes,
        ':status'   => $received_data->todoStatus
    );
    $query = "
UPDATE todolist
SET todoDescription = :todoDescription,
status = :status
WHERE id = :todoId
";
    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Updated'
    );

    echo json_encode($query);
}
if ($received_data->action == 'deleteTodo') {
    $data = array(
        ':todoId' => $received_data->todoID,
    );
    $query = "
    DELETE FROM todolist WHERE id = :todoId";
    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Updated'
    );

    echo json_encode($output);
}
?>
