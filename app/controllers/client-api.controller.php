<?php
require_once './app/models/client.model.php';
require_once './app/views/api.view.php';

class ClientApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new ClientModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getClients($params = null) {
        $clients = $this->model->getAll();
        $this->view->response($clients);
        }

    public function getClient($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $client = $this->model->get($id);

        // si no existe devuelvo 404
        if ($client)
            $this->view->response($client);
        else 
            $this->view->response("El cliente con el id=$id no existe", 404);
    }

    public function deleteClient($params = null) {
        $id = $params[':ID'];

        $client = $this->model->get($id);
        if ($client) {
            $this->model->delete($id);
            $this->view->response($client);
        } else 
            $this->view->response("El cliente con el id=$id no existe", 404);
    }

    public function insertClient($params = null) {
        $client = $this->getData();

        if (empty($client->nombre) || empty($client->apellido) || empty($client->dni) || empty($client->email)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($client->nombre, $client->apellido, $client->dni, $client->email);
            $client = $this->model->get($id);
            $this->view->response($client, 201);
        }
    }

    public function updateClient($params = null){
        $id = $params[':ID'];

        $client = $this->model->get($id);

        $data= $this->getData();

        if ($client) {
            $this->model->update($client, $data->nombre, $data->apellido,  $data->dni,  $data->email );
            $this->view->response("El cliente fue modificado con éxito", 200);
        } else 
            $this->view->response("El cliente con el id=$id no existe", 404);

    }

}