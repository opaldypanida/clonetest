<?php

class BaseModel
{
    
    protected $db_connection;
    
    function __construct($connection = null){
        if(!empty($connection)){
            $this->db_connection = $connection;
        }
    }
    
    
    public function getAll(){
        $items = array();
        $query = "SELECT * FROM {$this->TableName}";
        $result = $this->db_connection->query($query);
        
        if (!$result) {
            printf("Error: %s\n", $this->db_connection->error);
            return;
        }
        
        while ($item = $result->fetch_object($this->ModelName)) {
            $items[] = $item;
        }
        
        $this->_data = $items;
    }

    public function getOne($id){
        $query = "SELECT * FROM {$this->TableName}  WHERE id = $id";
        $result = $this->db_connection->query($query);
        
        if (!$result) {
            printf("Error: %s\n", $this->db_connection->error);
            return;
        }
        
        $item = $result->fetch_object($this->ModelName);
        $this->_data = $item;
    }


    //
    // Save the payload as a new Item in to the Database
    //
    public function create($payload){
        
        $fields = array();
        foreach($payload as $field => $val) {
            $fields[] = "$field = '$val'";
        }

        $setStatement = implode(', ' , $fields);
        $query = "INSERT INTO {$this->TableName} SET $setStatement";

        $result = $this->db_connection->query($query);
        
        if (!$result) {
            printf("Error: %s\n", $this->db_connection->error);
            return;
        }
        
        $insertedId = $this->db_connection->insert_id;
        return $this->getOne($insertedId);
    }

    
}
