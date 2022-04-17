<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods:DELETE');
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once("../../config/connect.php");
    include_once("../../model/question.php");

    // tạo đối tượng connect
    $connectOBJ = new connection();
    $db= $connectOBJ->getConn();

      // Tạo đối tượng model questin
    $question = new Question($db);
    $data  = json_decode(file_get_contents("php://input"));
    $question->id = $data->id;

    if($question->delete()){
        echo json_encode(array('message','Question Deleted'));
    }else{
        echo json_encode(array('message','Question not Deleted'));
    }
?>