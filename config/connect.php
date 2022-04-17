
<?php 
    // search gg keyword "connect dbo php w3school" 
      class connection{
      private $conn;
      //Thong so ket noi CSDL
      private $servername ="localhost"; 
      private $username ="root";
      private $password =""; 
      private $db_name ="api_question";
        function __construct()
        {
            
            //Tao ket noi CSDL
            try {
                $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->db_name",$this->username,$this->password);
                // set the PDO error mode to exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              //  echo "Connected successfully";
              } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
              }
   
        }

        public function getConn(){
          return $this->conn;
        }
    }
   /*  $conObj = new connection();
    $con = $conObj->conn;  */

?>