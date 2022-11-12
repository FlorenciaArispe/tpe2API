<?php

class ClientModel {

    private $db;

    public function __construct(){
        $this->db = new PDO ('mysql:host=localhost;'.'dbname=db_showroom;charset=utf8mb4', 'root', '');
    }

    public function getAll($filterName, $offset, $limit, $order, $sort){
        $consultation= "SELECT * FROM cliente";

        if(isset($filterName)){ //SI TIENE UN VALOR DISTINTO A NULL
            $consultation .= " WHERE nombre LIKE '%$filterName%'"; //CONCATENAR LAS CONSULTAS
        }

        if ((isset($sort))&&(isset($order))){
            $consultation .= " ORDER BY $sort $order";            
        }

        if(isset($limit)){
            $consultation .= " LIMIT $limit OFFSET $offset";
        }

        $query= $this->db->prepare($consultation);
        $query->execute();
        $clients= $query->fetchAll(PDO:: FETCH_OBJ);
        return $clients;
    }

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
    /*
    public function getNames(){
        $query = $this->db->prepare('SELECT nombre FROM cliente');

        $query->execute();
        $names= $query->fetchAll(PDO::FETCH_OBJ);

        return $names;        
    }   
    */
}
?>