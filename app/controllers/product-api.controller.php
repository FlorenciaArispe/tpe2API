<?php
require_once './app/models/product.model.php';
require_once './app/views/api.view.php';

class ProductApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new ProductModel();
        $this->view = new ApiView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getProducts($params = null) {
        $products = $this->model->getAll();
        $this->view->response($products);
        }

    public function getProduct($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $product = $this->model->get($id);

        // si no existe devuelvo 404
        if ($product)
            $this->view->response($product);
        else 
            $this->view->response("El producto con el id=$id no existe", 404);
    }

    public function deleteProduct($params = null) {
        $id = $params[':ID'];

        $product = $this->model->get($id);
        if ($product) {
            $this->model->delete($id);
            $this->view->response($product);
        } else 
            $this->view->response("El producto con el id=$id no existe", 404);
    }

    public function insertProduct($params = null) {
        $product = $this->getData();

        if (empty($product->producto) || empty($product->precio) || empty($product->fecha) || empty($product->deuda)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($product->producto, $product->precio, $product->fecha, $product->deuda);
            $product = $this->model->get($id);
            $this->view->response($product, 201);
        }
    }

    public function updateClient($params = null){
        $id = $params[':ID'];


        $data= $this->getData();

        if ($id) {
            $this->model->update($id, $data->producto, $data->precio,  $data->fecha,  $data->deuda );
            $this->view->response("El producto fue modificado con éxito", 200);
        } else 
            $this->view->response("El producto con el id=$id no existe", 404);

    }

}