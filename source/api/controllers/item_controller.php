<?php

class ItemController
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function getAll(){
        $this->model->getAll();
    }

    public function getOne($id){
        $this->model->getOne($id);
    }

    public function create($payload){

        // Validating the data inside the JSON
        // We make sure the `title` and `price` are provided

        if(!array_key_exists('name', $payload)){
            throw new Exception('`name` should be provided!', 400);
        }elseif(!array_key_exists('price', $payload)){
            throw new Exception('`price` should be provided!', 400);
        }

        $this->model->create($payload);
    }

    public function update($id, $requestBody){

        if(!array_key_exists('name', $payload)){
            throw new Exception('`name` should be provided!', 400);
        }elseif(!array_key_exists('price', $payload)){
            throw new Exception('`price` should be provided!', 400);
        }

        $this->model->update($id, $payload);
    }

    public function delete($id){
        $this->model->delete($id);
    }


}