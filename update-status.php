<?php

$sid = $_POST['id'];
$status = $_POST['status'];

//query in here
$conn = new mysqli('localhost', 'root', '', 'db_diemdanh');
$new_stt = !$status;
$sql = "UPDATE students SET students.status= '.$new_stt.' WHERE id = $sid";
$result = $conn->query($sql);
//xong \
echo json_encode(array(
    "sid" => $sid,
    "status" => !$status, 
    
));


?>