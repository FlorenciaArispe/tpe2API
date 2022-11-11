<?php

class ProductModel {

    private $db;

    public function __construct(){
        $this->db = new PDO ('mysql:host=localhost;'.'dbname=db_showroom;charset=utf8mb4', 'root', '');
    }

    public function getAll(){
        $query= $this->db->prepare("SELECT * FROM producto");
        $query->execute();        
        $products= $query->fetchAll (PDO::FETCH_OBJ);
        return $products;
    }

    public function get($id){
        $query= $this->db->prepare("SELECT * FROM producto WHERE id= ?");
        $query->execute([$id]);        
        $product= $query->fetch(PDO::FETCH_OBJ);
        return $product;
    }  

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM producto WHERE id = ?');
        $query->execute([$id]);
    }

    public function insert($producto, $precio, $fecha, $deuda) {
        $query = $this->db->prepare("INSERT INTO producto (nombre, apellido, dni, email) VALUES (?, ?, ?, ?)");
        $query->execute([$nombre, $apellido, $dni, $email]);
        return $this->db->lastInsertId();
    }

    //TERMINARRRRRRRR DE ARREGLAR
    public function update($id,$producto, $precio, $fecha, $deuda){
        $query= $this->db->prepare("UPDATE producto SET producto= ? , precio= ? , fecha= ? , deuda= ?  WHERE id= ?");
        try{
            $query->execute([$producto, $precio, $fecha, $deuda,  $id]);
        }
        catch(PDOException $e){
            var_dump($e);
        }
    } 
}