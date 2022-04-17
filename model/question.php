<?php
    class Question{
        public $conn;
        public $id;
        public $content;
        public $ansA;
        public $ansB;
        public $ansTrue;

        //connnect db
        public function __construct($db){
            $this->conn = $db;
        }

        //read data
        public function read(){
            $query = "Select * from question as c order by c.id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getQuestionByID(){
            $query = "Select * from question where id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $this->content = $row['content'];
            $this->ansA= $row['ansA'];
            $this->ansB= $row['ansB'];
            $this->ansTrue = $row['ansTrue'];        
        }

        // create data
        public function create(){
            $query = "Insert into question set content=:content , ansA =:ansA, ansB =:ansB , ansTrue =:ansTrue";
            $stmt = $this->conn->prepare($query);
            // clean data ;  lọc những ký tự đặc biệt
            $this->content = htmlspecialchars(strip_tags($this->content));
            $this->ansA= htmlspecialchars(strip_tags($this->ansA));
            $this->ansB= htmlspecialchars(strip_tags($this->ansB));
            $this->ansTrue = htmlspecialchars(strip_tags($this->ansTrue));
            
            // bind data
            $stmt->bindParam(':content',$this->content);
            $stmt->bindParam(':ansA',$this->ansA);
            $stmt->bindParam(':ansB',$this->ansB);
            $stmt->bindParam(':ansTrue',$this->ansTrue);
            echo($query);
           if( $stmt->execute()){
               return true;

           }
           else {
                printf("Error "+$stmt->error);
               return false;
              
           }

        }

        //Update data (method PUT )
        public function update(){
            $query = "update question set content=:content , ansA =:ansA, ansB =:ansB , ansTrue =:ansTrue where id =:id";
            $stmt = $this->conn->prepare($query);
            // clean data ;  lọc những ký tự đặc biệt
            $this->content = htmlspecialchars(strip_tags($this->content));
            $this->ansA= htmlspecialchars(strip_tags($this->ansA));
            $this->ansB= htmlspecialchars(strip_tags($this->ansB));
            $this->ansTrue = htmlspecialchars(strip_tags($this->ansTrue));
            
            // bind data
            $stmt->bindParam(':content',$this->content);
            $stmt->bindParam(':ansA',$this->ansA);
            $stmt->bindParam(':ansB',$this->ansB);
            $stmt->bindParam(':ansTrue',$this->ansTrue);
            $stmt->bindParam(':id',$this->id);
            echo($query);
           if( $stmt->execute()){
               return true;

           }
           else {
                printf("Error "+$stmt->error);
               return false;
              
           }

        }

        //delete data
        public function delete(){
            $query = "delete from question where id =:id";
            $stmt = $this->conn->prepare($query);
            // bind data
            $stmt->bindParam(':id',$this->id);
            echo($query);
            if( $stmt->execute()){
                return true;

            }
            else {
                    printf("Error "+$stmt->error);
                return false;
                
            }

        }
    }
?>