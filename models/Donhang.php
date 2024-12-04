<?php
class Donhang{
    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    //don hang
    public function getAllDonhang(){
   
        $sql = 'SELECT * FROM don_hang ORDER BY id_don_hang DESC';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
}



}
?>