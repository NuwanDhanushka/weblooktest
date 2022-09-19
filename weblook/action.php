<?php
$connect = new PDO("mysql:host=localhost;dbname=clientinformation_db;charset=utf8", "root", "");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if ($received_data->action == 'insertquestion') {
    $data = array(
        ':instituteid' => $received_data->instituteid,
        ':officerid' => $received_data->officerid,
        ':question' => $received_data->question
    );

    $query = "
 INSERT INTO questions 
 (instituteID,officerID,question) 
 VALUES (:instituteid,:officerid, :question)
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Inserted',
        'id' =>  $connect->lastInsertId(),
    );

    echo json_encode($output);
}
if ($received_data->action == 'insertofficer') {
    $data = array(
        ':officerNumber' => $received_data->officerNumber,
        ':officerInstituteid' => $received_data->officerInstituteid,
        ':officerName' => $received_data->officerName
    );

    $query = "
 INSERT INTO officers 
 (officerID,instituteID,name) 
 VALUES (:officerNumber,:officerInstituteid, :officerName)
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Inserted'
    );

    echo json_encode($output);
}
if ($received_data->action == 'insertclient') {
    $data = array(
        ':name' => $received_data->name,
        ':gender' => $received_data->gender,
        ':nicnumber' => $received_data->nicnumber,
        ':gnDivision' => $received_data->gnDivision,
        ':phonenumber' => $received_data->phonenumber,
        ':registerDate' => date('Y-m-d'),
    );

    $query = "
 INSERT INTO clients
 (nicNumber,name,gender,gnDivision,phonenumber,registerDate) 
 VALUES (:nicnumber,:name, :gender,:gnDivision,:phonenumber,:registerDate)
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Inserted'
    );

    echo json_encode($output);
}
if ($received_data->action == 'insertinstitute') {
    $data = array(
        ':instituteName' => $received_data->instituteName,
    );

    $query = "
 INSERT INTO institutes
 (name) 
 VALUES (:instituteName)
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Inserted'
    );

    echo json_encode($output);
}
if ($received_data->action == 'insertservices') {
    $data = array(
        ':nicNumber' => $received_data->nicNumber,
        ':instituteID' => $received_data->instituteID,
        ':questionID' => $received_data->questionID,
        ':officerID'  => $received_data->officerID,
        ':date' => $received_data->date,
        ':time' => $received_data->time,
        ':status' => $received_data->status,
        ':count' => $received_data->count,
        ':note' => $received_data->note,
    );

    $query = "
 INSERT INTO services
 (nicNumber,instituteID,questionID,officerID,date,time,status,count,note) 
 VALUES (:nicNumber,:instituteID, :questionID,:officerID,:date,:time,:status,:count,:note)
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Inserted'
    );

    echo json_encode($output);
}
if ($received_data->action == 'updateofficer') {
    $data = array(
        ':institute_ID' => $received_data->instituteiD,
        ':officer_name' => $received_data->officerName,
        ':officer_ID'   => $received_data->officeriD
    );
    $query = "
UPDATE officers
SET instituteID = :institute_ID, 
name = :officer_name
WHERE officerID = :officer_ID
";
    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Updated'
    );

    echo json_encode($output);
}
if ($received_data->action == 'updatesolution') {
    $data = array(
        ':editstatus' => $received_data->editstatus,
        ':editcount' =>  $received_data->editcount,
        ':editsolutionnote' =>  $received_data->editsolutionnote,
        ':editsolutionid' =>   $received_data->editsolutionid
    );
    $query = "
UPDATE services
SET status = :editstatus, 
count = :editcount,
note = :editsolutionnote
WHERE servicesID = :editsolutionid
";
    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Updated'
    );

    echo json_encode($output);
}

if ($received_data->action == 'updateservice') {
    $data = array(
        ':question_ID' => $received_data->questioniD,
        ':institute_ID' => $received_data->instituteiD,
        ':officer_ID'   => $received_data->officeriD
    );
    $query = "
UPDATE questions
SET instituteID = :institute_ID, 
officerID = :officer_ID
WHERE questionID = :question_ID
";
    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Updated'
    );

    echo json_encode($output);
}
if ($received_data->action == 'updateclient') {
    $data = array(
        ':clientname' => $received_data->name,
        ':nicNum'   => $received_data->nic,
        ':clientphonenumber'   => $received_data->phonenumber,
        ':clientgender'   => $received_data->gender,
        ':clientgnDivision'   => $received_data->gnDivision
    );
    $query = "
UPDATE clients
SET name = :clientname,
gender = :clientgender,
gnDivision = :clientgnDivision,
phonenumber = :clientphonenumber
WHERE nicNumber = :nicNum
";
    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Updated'
    );

    echo json_encode($output);
}
