<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once("../../config/connect.php");
    include_once("../../model/question.php");

    // tạo đối tượng connect
    $connectOBJ = new connection();
    $db= $connectOBJ->getConn();

    // Get danh sách câu hỏi
    $question = new Question($db);
    $readResult = $question->read();
    
    // count num row 
    $num = $readResult->rowCount();

    if($num > 0){
        $question_array = [];
       
        while($row = $readResult->fetch(\PDO::FETCH_ASSOC)){
            extract($row);
            $question_item = array(
                'id' => $row['id'],  // row['id'] hoặc $id;
                'content' => $row['content'],
                'ansA' => $ansA,
                'ansB' =>$ansB,
                'ansTrue' => $ansTrue
            );
           array_push($question_array,$question_item);
        }
        echo json_encode($question_array);
    }
    
?>