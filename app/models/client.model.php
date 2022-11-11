<?php

class ClientModel {

    private $db;

    public function __construct(){
        $this->db = new PDO ('mysql:host=localhost;'.'dbname=db_showroom;charset=utf8mb4', 'root', '');
    }

    public function getClientOrder($sort, $order){
        $query= $this->db->prepare("SELECT * FROM cliente ORDER BY $sort $order");
        $query->execute();        
        $clients= $query->fetchAll (PDO::FETCH_OBJ);
        return $clients;
    }

    public function getAll(){
        $query= $this->db->prepare("SELECT * FROM cliente");
        $query->execute();        
        $clients= $query->fetchAll (PDO::FETCH_OBJ);
        return $clients;
    }
    /*

    public function getAllOrder(){
        $query= $this->db->prepare("SELECT * FROM cliente ORDER BY nombre ASC | DESC");
        $query->execute();
        $clients= $query->fetchAll (PDO::FETCH_OBJ);
        return $clients;
    }
    */

    public function get($id){
        $query= $this->db->prepare("SELECT * FROM cliente WHERE id= ?");
        $query->execute([$id]);        
        $client= $query->fetch(PDO::FETCH_OBJ);
        return $client;
    }  

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM cliente WHERE id = ?');
        $query->execute([$id]);
    }

    public function insert($nombre, $apellido, $dni, $email) {
        $query = $this->db->prepare("INSERT INTO cliente (nombre, apellido, dni, email) VALUES (?, ?, ?, ?)");
        $query->execute([$nombre, $apellido, $dni, $email]);
        return $this->db->lastInsertId();
    }

    
    public function update($id,  $nombre, $apellido, $dni, $email){
        $query= $this->db->prepare("UPDATE cliente SET nombre= ? , apellido= ? , dni= ? , email= ?  WHERE id= ?");
        try{
            $query->execute([$nombre, $apellido, $dni, $email,  $id]);
        }
        catch(PDOException $e){
            var_dump($e);
        }
    }    
    

    
}
?>