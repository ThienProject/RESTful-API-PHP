<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once("../../config/connect.php");
    include_once("../../model/question.php");

    // tạo đối tượng connect
    $connectOBJ = new connection();
    $db= $connectOBJ->getConn();

    // Get câu hỏi theo id
    $question = new Question($db);
    if(isset($_GET['id'])){
        $question->id = $_GET['id'];
    }
    else {
        $question->id = null;
        echo "erro";
    }

    $question->getQuestionByID();
    $question_item = array(
        'id' => $question->id,  // row['id'] hoặc $id;
        'content' => $question->content,
        'ansA' => $question->ansA,
        'ansB' =>$question->ansB,
        'ansTrue' => $question->ansTrue
    );
    echo json_encode($question_item);
?>