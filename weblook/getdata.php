<?php
$connect = new PDO("mysql:host=localhost;dbname=weblook;charset=utf8", "root", "");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if ($received_data->action == 'getTodo') {
      $query = "SELECT * FROM todolist";
      $statement = $connect->prepare($query);
      $statement->execute();

      while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
      }
      echo json_encode($data);
}

?>