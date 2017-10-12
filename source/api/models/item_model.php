<?php

class ItemModel extends BaseModel
{
    public $id;
    public $name;
    public $description;
    public $price;
    
    public $_data;
    
    protected $ModelName = 'ItemModel';
    protected $TableName = 'items';
    
    public function update($id, $payload){
        // Using sprintf to format the query in a nicer way
        $query = sprintf("UPDATE items SET name = '%s' , description = '%s', price = '%s' WHERE id = %d",
        $payload->name,
        $payload->description,
        $payload->price,
        $id);
        
        $result = $this->db_connection->query($query);
        
        if (!$result) {
            printf("Error: %s\n", $this->db_connection->error);
            return;
        }
        
        return $this->getOne($id);
    }
    
    public function delete($id){
        $query = 'DELETE FROM items WHERE ID = ' . $id;
        $result = $this->db_connection->query($query);
        
        if (!$result) {
            printf("Error: %s\n", $this->db_connection->error);
            return;
        }
        
        $this->_data = true;
    }
}